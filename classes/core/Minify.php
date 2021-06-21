<?php
require_once (__ROOT__ . '/config/config.php');
require_once (__ROOT__ . '/classes/core/Mysql.php');
require_once(__ROOT__.'/classes/pm/Page.php');


class Minify
{
    private $db_connection = null;
    public $log = null;

    public function __construct()
    {
    }
    private function databaseConnection()
    {
        // if connection already exists
        if ($this->db_connection != null) {
            return true;
        } else {
            try {
                $this->db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $_SESSION['message']  = MESSAGE_DATABASE_ERROR . $e->getMessage();
            }
        }
        return false;
    }
    public function getUrlContent($url_id){
        error_log("getUrlContent Id=".$url_id);
        if ($this->databaseConnection()) {
            // database query, getting all the info of the selected user
            $sth = $this->db_connection->prepare('select * from url_map where id=:id;');
            $sth->bindValue(':id',  $url_id, PDO::PARAM_STR);
            $sth->execute();
            $map = $sth->fetch();
            error_log("getUrl Error=".implode(",", $sth->errorInfo()));
            error_log("Result=".print_r($map, true));
        }

        if (isset($map['user_name']) && isset($map['page_id'])){
            //get page
            $P = new Page();
            $page = $P->getPage($map['user_name'], $map['page_id']);
            error_log("getUrlContent content=".$page['content']);
            return array($page['content'], $page['css'], $page['js'], $map['user_name']) ;
        }
        else return null;
    }

    public function logAccess($id){
        return;
        $result=array();
        if ($this->databaseConnection()) {
            // database query, getting all the info of the selected user
            $sth = $this->db_connection->prepare('select * from url_log where id=:id');
            $sth->bindValue(':id',  $id, PDO::PARAM_STR);
            $sth->execute();
            error_log("logHits Error=" . implode(",", $sth->errorInfo()));
            while($obj =  $sth->fetch()){
                $result[]=$obj;
            }
            error_log("Result=".count($result));
        }
        return count($result);
    }
}

?>
