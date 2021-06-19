<?php
// include the config
require_once (__ROOT__ . '/classes/core/Sqlite.php');
include_once(__ROOT__ . '/classes/core/Encryption.php');

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

    public function getForms(){
        return $this->ls();
    }
    public function saveFormType($table, $type){
        $this->query(sprintf ("replace into form_metadata values ('%s', '%s', '%s');", $table, $type, strtotime ( 'now' )));
    }
    public function getFormType($table){
        return $this->single_value(sprintf ("select metadata from form_metadata where name='%s';", $table));
    }

    public function insertFormData($tname, $nv_pairs){
        error_log("insertFormData=".print_r($nv_pairs, true));

        if (is_array($nv_pairs)) {
            $tname = self::esc ( $tname );
            $colnames = $this->t_columns ( $tname );
            //$colnames = preg_filter('/^/', "'", $colnames);
            //$colnames = preg_filter('/$/', "'", $colnames);
            error_log("insertFormData columns=".print_r($colnames, true));
            $paramvalues = array();
            $paramname = array();
            foreach ( $colnames as $cname_type ) {
                list($cname, $type) = explode("->", $cname_type);
                error_log("col name=".$cname);
                $val =  $this::esc($nv_pairs[$cname]);
                $paramvalues[$cname] = "'".self::esc($val) ."'";
                $paramname[] = "'".self::esc($cname_type)."'";
            }
            $q = sprintf ( self::$qpool ['p_insert'], $tname, implode ( ',', $paramname ), implode ( ',', $paramvalues ));
            $this->log->trace ( "Query=".$q);
            return $this->query($q) ? $this->query('select last_insert_rowid()') : false;
        }
        return false;

    }

    public function getUserForm($user_name, $tabella){
        $crypt = new Encryption();
        $html = '<h3>'.$tabella.'</h3><hr/><br/>';
        $html .= '<form id=action-'.$tabella.' action="/doin/form_submit.php" method="post">';
        foreach($this->t_columns_types($tabella) as $col_type=>$type){
            list($col, $type) = explode("->", $col_type);
            $html .= '<input type="hidden" name="table" value="'.$crypt->encrypt($tabella).'">';
            $html .= '<input type="hidden" name="user_name" value="'.$crypt->encrypt($user_name).'">';
            $html .= '<div class="form-group">';
            $html .= '<label id="label" style="display: none;">'.ucfirst($col).'</label>';
            if ($type == "textarea") {
                $html .= '<textarea class="form-control" type="'.$type.'" name="'.$col.'" placeholder="'.ucfirst($col).'" required></textarea>';
            }
            else {
                $html .= '<input class="form-control" type="'.$type.'" name="'.$col.'" placeholder="'.ucfirst($col).'" required>';
            }
            $html .= '</div>';
        }
        $html .= '<div class="form-group">';
        $html .= '<button id=message-'.$tabella.' type="submit" name="submit" value="customise_add" class="btn btn-info"> Submit </button>';
        $html .= '</div>';
        $html .= '</form>';
        return $html;

    }

}
?>