<?php
// include the config
require_once (__ROOT__ . '/config/config.php');
require_once (__ROOT__ . '/classes/core/Mysql.php');

class Comments extends Mysql
{

    public function __construct()
    {
    }


    public function savePageComment($page_code, $parent, $author, $email, $text) {
        $page_code = $this->quote($page_code);
        $author = $this->quote($author);
        $email = $this->quote($email);
        $text = $this->quote($text);
        $r = $this->changeRow ( sprintf ( "insert into comments (page_code, parent, author, email, text, changedOn)  values( %s, %s, %s, %s, %s, now()) ".
            "on duplicate key update text=%s, changedOn=now()",
            $page_code, $author, $email, $text,  $text ) );
        return $r;
    }

    public function getComments($page_code) {
        $page_code = $this->quote($page_code);
        $r = $this->selectRows( sprintf ( "select * from comments where page_code=%s) ",  $page_code) );
        return $r;
    }
}