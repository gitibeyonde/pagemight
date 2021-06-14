<?php
require_once (__ROOT__ . '/classes/core/Mysql.php');

class Page extends Mysql {


    public function __construct() {
        parent::__construct ();
    }

    public function savePage($user_id, $page_name, $content) {
        $page_name = $this->quote($page_name);
        $content = $this->quote($content);
        $this->changeRow ( sprintf ( "insert into page values( %s, %s, %s, 'true', now()) ".
            "on duplicate key update user_id=%s, page_name=%s, content=%s",
             $user_id, $page_name, $content ) );
    }

    public function getPage($id) {
        return $this->selectRow( sprintf ( "select * from page where id=%s;", $id) );
    }

    public function getPageForUser($user_id, $page_name) {
        $page_name = $this->quote($page_name);
        return $this->selectRow( sprintf ( "select * from page where user_id=%s and name=%d;", $user_id , $page_name) );
    }
}