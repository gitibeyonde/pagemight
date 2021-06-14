<?php
require_once (__ROOT__ . '/classes/core/Mysql.php');

class Template extends Mysql {


    public function __construct() {
        parent::__construct ();
    }

    public function getTemplate() {
        return $this->selectRows( sprintf ( "select * from template;") );
    }

}