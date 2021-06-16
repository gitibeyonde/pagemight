<?php
require_once (__ROOT__ . '/classes/core/Mysql.php');

class Page extends Mysql {

    private static $dv;

    public function __construct() {
        parent::__construct ();
        Page::$dv = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }

    public function savePage($user_name, $page_name, $content) {
        $user_name = $this->quote($user_name);
        $page_name = $this->quote($page_name);
        $content = $this->quote($content);
        $r = $this->changeRow ( sprintf ( "insert into page (user_name, name, content, changedOn)  values( %s, %s, %s, now()) ".
            "on duplicate key update user_name=%s, name=%s, content=%s",
            $user_name, $page_name, $content,  $user_name, $page_name, $content ) );
        return $this->selectOne(sprintf ("select id from page where user_name=%s and name=%s;", $user_name , $page_name));
    }

    public function getPages($user_name) {
        return $this->selectRows( sprintf ( "select * from page where user_name=%s;", $this->quote($user_name)) );
    }

    public function getPage($user_name, $id) {
        return $this->selectRow( sprintf ( "select * from page where user_name=%s and id=%s;",  $this->quote($user_name), $id) );
    }
    public function getPageForUser($user_name, $page_name) {
        $page_name = $this->quote($page_name);
        return $this->selectRow( sprintf ( "select * from page where user_name=%s and name=%s;", $this->quote($user_name) , $page_name) );
    }

    public function getPageUrlCode($user_name, $page_id) {
        $url_code=  $this->selectOne( sprintf ( "select id from url_map where user_name=%s and page_id=%d;", $this->quote($user_name) , $page_id) );
        error_log("createUrlCode=".$url_code);
        if ($url_code == null){
            $url_code = $this->quote($this->createUrlCode($user_name, $page_id));
        }
        return $url_code;
    }
    public function createPageFromTemplate($user_name, $template){
        return $this->savePage($user_name, $template['name'], $template['content']);
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
            $sth->bindValue(':user_id', $user_id, PDO::PARAM_STR);
            $sth->bindValue(':page_id', $page_id, PDO::PARAM_STR);
            $sth->execute();
            error_log("createUrlCode Error=".implode(",", $sth->errorInfo()));
        }
        return $url_id;
    }

}