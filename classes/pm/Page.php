<?php
require_once (__ROOT__ . '/classes/core/Mysql.php');

class Page extends Mysql {

    private static $dv;

    public function __construct() {
        parent::__construct ();
        Page::$dv = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }

    public function savePageHtml($user_name, $code, $name, $html) {
        $user_name = $this->quote($user_name);
        $code = $this->quote($code);
        $name = $this->quote($name);
        $html = $this->quote($html);
        $r = $this->changeRow ( sprintf ( "insert into page (user_name, code, name, html, changedOn)  values( %s, %s, %s, %s, now()) ".
            "on duplicate key update user_name=%s, code=%s, name=%s, html=%s",
            $user_name, $code, $name, $html,  $user_name, $code, $name, $html ) );
        return $this->selectRow(sprintf ("select * from page where user_name=%s and code=%s;", $user_name , $code));
    }

    public function savePageCss($user_name, $page_code, $css) {
        $user_name = $this->quote($user_name);
        $page_code = $this->quote($page_code);
        $css = $this->quote($css);
        $r = $this->changeRow ( sprintf ( "update page set css=%s where user_name=%s and code=%s;", $css, $user_name, $page_code) );
        return $this->selectRow(sprintf ("select * from page where user_name=%s and code=%s;", $user_name , $page_code));
    }

    public function savePageJs($user_name, $page_code, $js) {
        $user_name = $this->quote($user_name);
        $page_code = $this->quote($page_code);
        $js = $this->quote($js);
        $r = $this->changeRow ( sprintf ( "update page set js=%s where user_name=%s and code=%s;", $js, $user_name, $page_code) );
        return $this->selectRow(sprintf ("select * from page where user_name=%s and code=%s;", $user_name , $page_code));
    }
    public function savePageSEO($user_name, $page_code, $seo) {
        $user_name = $this->quote($user_name);
        $page_code = $this->quote($page_code);
        $seo = $this->quote($seo);
        $r = $this->changeRow ( sprintf ( "update page set seo=%s where user_name=%s and code=%s;", $seo, $user_name, $page_code) );
        return $this->selectRow(sprintf ("select * from page where user_name=%s and code=%s;", $user_name , $page_code));
    }

    public function getPages($user_name) {
        return $this->selectRows( sprintf ( "select * from page where user_name=%s;", $this->quote($user_name)) );
    }

    public function getPage($page_code) {
        return $this->selectRow( sprintf ( "select * from page where code=%s;", $this->quote($page_code)) );
    }
    public function getTemplate($template_name) {
        return $this->selectRow( sprintf ( "select * from template where name=%s;", $this->quote($template_name)) );
    }
    public function deletePage($user_name, $page_code) {
        return $this->changeRow( sprintf ( "delete from page where user_name=%s and code=%s;",  $this->quote($user_name), $this->quote($page_code)) );
    }
    public function getPageForUser($user_name, $page_code) {
        $page_code = $this->quote($page_code);
        return $this->selectRow( sprintf ( "select * from page where user_name=%s and code=%s;", $this->quote($user_name) , $page_code) );
    }

    public function getPageUrlCode($user_name, $page_id) {
        $url_code=  $this->selectOne( sprintf ( "select id from url_map where user_name=%s and page_id=%d;", $this->quote($user_name) , $page_id) );
        error_log("createUrlCode=".$url_code);
        if ($url_code == null){
            $url_code = $this->createUrlCode($user_name, $page_id);
        }
        return $url_code;
    }
    public function createPageFromTemplate($user_name, $template){
        $page_code = Utils::rand36();
        $this->savePageHtml($user_name, $page_code, $template['name'], $template['html']);
        $this->savePageCss($user_name, $page_code, $template['css']);
        $this->savePageJs($user_name, $page_code, $template['js']);
        return $this->selectRow(sprintf ("select * from page where user_name=%s and code=%s;", $this->quote($user_name) , $this->quote($page_code)));
    }
    public function updatePageComment($user_name, $page_id, $comment){
        $user_name = $this->quote($user_name);
        error_log(" updatePagePublic=".$comment);
        if ($comment == 0 || $comment == 1){
            $r = $this->changeRow ( sprintf ( "update page set comment=%d where user_name=%s and id=%d;", $comment, $user_name, $page_id) );
            return $r;
        }
        else {
            $_SESSION['message'] = "The comment value is not boolean !";
            return false;
        }
    }
    public function updatePagePublic($user_name, $page_id, $public){
        $user_name = $this->quote($user_name);
        error_log(" updatePagePublic=".$public);
        if ($public == 0 || $public == 1){
            $r = $this->changeRow ( sprintf ( "update page set public=%d where user_name=%s and id=%d;", $public, $user_name, $page_id) );
            return $r;
        }
        else {
            $_SESSION['message'] = "The public value is not boolean !";
            return false;
        }
    }



    private function getNext($cur)
    {
        $cv = str_split($cur);
        for ($i = count($cv) - 1; $i > - 1; $i --) {
            if ($cv[$i] == "_") {
                if ($i == 0) {
                    $cv = array_fill(0, count($cv) + 1, 0);
                    return implode("", $cv);
                } else {
                    if ($cv[$i - 1] != '_') {
                        $cv[$i - 1] = Page::$dv[array_search($cv[$i - 1], Page::$dv) + 1];
                        for ($j = $i; $j < count($cv); $j ++) {
                            $cv[$j] = 0;
                        }
                        return implode("", $cv);
                    }
                }
            } else {
                $cv[$i] = Page::$dv[array_search($cv[$i], Page::$dv) + 1];
                if ($i == 0) {
                    $next = array_fill(0, count($cv), 0);
                    $next[0] = $cv[$i];
                    $cv = $next;
                }
                return implode("", $cv);
            }
        }
    }

    private function getLastIndex(){
        $result=array();
        if ($this->databaseConnection()) {
            // database query, getting all the info of the selected user
            $sth = $this->db_connection->prepare('select id from url_map order by id desc limit 1');
            $sth->execute();
            $result = $sth->fetch()[0];
            error_log("getLastIndex Error=".implode(",", $sth->errorInfo()));
            error_log("Result=".$result);
            if ($result==null){
                return "0";
            }
        }
        return $result;
    }

    public function createUrlCode($user_name, $page_id){
        $li = $this->getLastIndex();
        error_log("Li=".$li);
        $id = $this->getNext($li);
        error_log("Id=".$id);
        if ($this->databaseConnection()) {
            // database query, getting all the info of the selected user
            $sth = $this->db_connection->prepare('insert into url_map(id, user_name, page_id, createdOn) values(:id, :user_name, :page_id, now())');
            $sth->bindValue(':id',  $id, PDO::PARAM_STR);
            $sth->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $sth->bindValue(':page_id', $page_id, PDO::PARAM_STR);
            $sth->execute();
            error_log("createUrlCode Error=".implode(",", $sth->errorInfo()));
        }
        return $id;
    }

}