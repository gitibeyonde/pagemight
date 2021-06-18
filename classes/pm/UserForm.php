<?php
// include the config
require_once (__ROOT__ . '/classes/core/Sqlite.php');

class UserForm extends Sqlite {
    private $user_name = null;

    // User id is the first param
    public function __construct($uname) {
        parent::__construct ( $uname, "forms", self::$UD );
        $this->user_name = $uname;
        if (! $this->t_exists ( "form_metadata" )) {
            $this->t_crtinsupd ( "CREATE TABLE IF NOT EXISTS form_metadata ( name text, metadata text, changedOn text, unique(name)) ;" );
        }
    }
    public function createFormTable($table, $col, $input){
        $new_cols = array();
        $type= array();
        for($i=0; $i<count($col); $i++){
            array_push($new_cols, $this->esc($col[$i]."->".$input[$i]));
            array_push($type, "TEXT");
        }
        $this->createTable($table, $new_cols, $type);
    }
    public function deleteForm($table){
        $this->t_delete($table);
    }

    public function saveFormType($table, $type){
        $this->query(sprintf ("replace into form_metadata values ('%s', '%s', '%s');", $table, $type, strtotime ( 'now' )));
    }
    public function getFormType($table){
        return $this->single_value(sprintf ("select metadata from form_metadata where name='%s';", $table));
    }

    public function getUserForm($tabella){
        $html = '<form id=action-'.$tabella.' action="/doin/form_submit.php" method="post">';
        foreach($this->t_columns_types($tabella) as $col_type=>$type){
            list($col, $type) = explode("->", $col_type);
            $html .= '<input type="hidden" name="table" value="'.$tabella.'">';
            $html .= '<div class="form-group">';
            $html .= '<label id="label" style="display: none;">'.ucfirst($col).'</label>';
            $html .= '<input class="form-control" type="'.$type.'" name="'.$col.'" placeholder="'.$col.'" required>';
            $html .= '</div>';
        }
        $html .= '<div class="form-group">';
        $html .= '<button type="submit" name="submit" value="customise_add" class="btn btn-info">Submit</button>';
        $html .= '<p id=message-'.$tabella.' ></p>';
        $html .= '</div>';
        $html .= '</form>';
        return $html;

    }

}
?>