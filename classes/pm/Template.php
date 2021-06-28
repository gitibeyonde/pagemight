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

    public function savePageHtml($template_name, $html) {
        $template_name = $this->quote($template_name);
        $html = $this->quote($html);
        $r = $this->changeRow ( sprintf ( "update template set html=%s where name=%s;", $html, $template_name) );
        return $this->getAllTemplates($template_name);
    }
    public function savePageCss($template_name, $css) {
        $template_name = $this->quote($template_name);
        $css = $this->quote($css);
        $r = $this->changeRow ( sprintf ( "update template set css=%s where name=%s;", $css, $template_name) );
        return $this->getAllTemplates($template_name);
    }

    public function savePageJs($template_name, $js) {
        $template_name = $this->quote($template_name);
        $js = $this->quote($js);
        $r = $this->changeRow ( sprintf ( "update template set js=%s where name=%s;", $js, $template_name) );
        return $this->getAllTemplates($template_name);
    }

}