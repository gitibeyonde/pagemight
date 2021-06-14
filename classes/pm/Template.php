<?php
require_once (__ROOT__ . '/classes/core/Mysql.php');

class Template extends Mysql {


    public function __construct() {
        parent::__construct ();
    }

    public function getTemplate($template_name) {
        $template_name = $this->quote($template_name);
        return $this->selectRow( sprintf ( "select * from template where name=%s;", $template_name) );
    }

    public function getAllTemplates() {
        return $this->selectRows( sprintf ( "select * from template;") );
    }


}