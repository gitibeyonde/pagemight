<?php
require_once (__ROOT__ . '/classes/core/Mysql.php');

class Template extends Mysql {


    public function __construct() {
        parent::__construct ();
    }

    public function getTemplate($template_name) {
        return $this->selectRow( sprintf ( "select * from template where name=%s;", $this->quote($template_name)) );
    }

    public function getAllTemplates() {
        return $this->selectRows( sprintf ( "select * from template;") );
    }

    public function saveTemplateHtml($template_name, $html) {
        $r = $this->changeRow ( sprintf ( "update template set html=%s where name=%s;", $this->quote($html), $this->quote($template_name)) );
        return $this->getTemplate($template_name);
    }
    public function saveTemplateCss($template_name, $css) {
        $r = $this->changeRow ( sprintf ( "update template set css=%s where name=%s;", $this->quote($css), $this->quote($template_name)) );
        return $this->getTemplate($template_name);
    }
    public function saveTemplateJs($template_name, $js) {
        $r = $this->changeRow ( sprintf ( "update template set js=%s where name=%s;", $this->quote($js), $this->quote($template_name)) );
        return $this->getTemplate($template_name);
    }

}