<?php
require_once (__ROOT__ . '/classes/core/Mysql.php');

class Page extends Mysql {

    private static $dv;

    public function __construct() {
        parent::__construct ();
        Page::$dv = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }

    public function savePage($user_id, $page_name, $content) {
        $page_name = $this->quote($page_name);
        $content = $this->quote($content);
        $r = $this->changeRow ( sprintf ( "insert into page (user_id, name, content, bitmap, changedOn)  values( %s, %s, %s, 'true', now()) ".
            "on duplicate key update user_id=%s, name=%s, content=%s",
            $user_id, $page_name, $content,  $user_id, $page_name, $content ) );
        return $this->selectOne(sprintf ("select id from page where user_id=%d and name=%s;", $user_id , $page_name));
    }

    public function getPages($user_id) {
        return $this->selectRows( sprintf ( "select * from page where user_id=%d;", $user_id) );
    }

    public function getPageForUser($user_id, $page_name) {
        $page_name = $this->quote($page_name);
        return $this->selectRow( sprintf ( "select * from page where user_id=%d and name=%s;", $user_id , $page_name) );
    }

    public function getPageUrlCode($user_id, $page_id) {
        $url_code=  $this->selectOne( sprintf ( "select id from url_map where user_id=%s and page_id=%d;", $user_id , $page_id) );
        error_log("createUrlCode=".$url_code);
        if ($url_code == null){
            $url_code = $this->quote($this->createUrlCode($user_id, $page_id));
        }
        return $url_code;
    }
    public function createPageFromTemplate($user_id, $template){
        return $this->savePage($user_id, $template['name'], $template['content']);
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

    public function createUrlCode($user_id, $page_id){
        $li = $this->getLastIndex();
        error_log("Li=".$li);
        $id = $this->getNext($li);
        error_log("Id=".$id);
        if ($this->databaseConnection()) {
            // database query, getting all the info of the selected user
            $sth = $this->db_connection->prepare('insert into url_map(id, user_id, page_id, createdOn) values(:id, :user_id, :page_id, now())');
            $sth->bindValue(':id',  $id, PDO::PARAM_STR);
            $sth->bindValue(':user_id', $user_id, PDO::PARAM_STR);
            $sth->bindValue(':page_id', $page_id, PDO::PARAM_STR);
            $sth->execute();
            error_log("createMap Error=".implode(",", $sth->errorInfo()));
        }
        return $url_id;
    }

}