<?php

class Utils {

    private $_log = null;

    public function __construct() {
        $this->_log = isset($_SESSION['log']) ? $_SESSION['log'] : $GLOBALS['log'];
    }

    public static function format($value, $type){
        if ($type == "datetime"){
            return array(date('j F \a\t H:i',strtotime($value)));
        }
        else {
            return array($value);
        }
    }

    public function fix_type_value($string, $type, $validate){
        switch($type){
            case "fixed":
                return $validate;
            case "string":
                if ($validate == "name"){
                    return $this->cleanName($string);
                }
                else if ($validate == "email"){
                    $email_pattern = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
                    preg_match_all($email_pattern, $string, $matches);
                    $email = $matches[0][0];
                    $this->_log->trace("Email parsed=".$email);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        return null;
                    }
                    else {
                        return $email;
                    }
                }
                else if ($validate == "text"){
                    $string = preg_replace("/[^a-zA-Z0-9,.:\/\s]/", "", $string);
                    return $string;
                }
                else {
                    return $string;
                }
            case "number":
                if(preg_match_all("/([0-9]+)/", $string, $matches)){
                    return $matches[1][0];
                }
            case "integer":
                if(preg_match_all("/([+-]?[0-9]+)/", $string, $matches)){
                    return $matches[1][0];
                }
            case "decimal":
                if(preg_match_all("/([+-]?[0-9\.]+)/", $string, $matches)){
                    return $matches[1][0];
                }
            case "datetime":
                return $this->find_datetime($string);
            case "date":
                $this->_log->trace("Date=".$string);
                if ($validate == "date"){
                    return $this->find_date($string);
                }
                else if ($validate == "day_month"){
                    return $this->find_date($string);
                }
                else {
                    return $string;
                }
            default:
                throw new Exception("Unable to fix value of ".$string);
        }
    }
    private function cleanName($name_str){
        $this->_log->trace("Name is".$name_str);
        $pa = array("my name is", "name is", "hi my name is", "i am", "hi i am", "hi name is", "myself", "people call me");
        $name_str = $this->to_alphabet_string($name_str);
        foreach ($pa as $prefix){
            if (substr($name_str, 0, strlen($prefix)) == $prefix) {
                $name_str = substr($name_str, strlen($prefix));
                break;
            }
        }
        $this->_log->trace("Cleaned Name is".$name_str);
        return ucwords(trim($name_str));
    }

    public function find_datetime( $string ) {
        $string = str_replace(",", " at ", $string);
        if (strpos($string, "at") === False){
            return null;
        }
        $da =  date_parse($string);
        $this->_log->debug("Date array = ".Utils::flatten($da));
        $now = new DateTime('now');
        if ($da['year'] == null){
            $da['year'] = $now->format('Y');
        }
        if ($da['month'] == null){
            $da['month'] =  $now->format('m');
        }
        if ($da['day'] == null){
            return null;
        }
        if ($da['hour'] == null){
            return null;
        }
        if ($da['minute'] == null || $da['minute']<10){
            $da['minute'] = "00";
        }
        $s = $da['day']."/".$da['month']."/".$da['year']." ".$da['hour'].":".$da['minute'];
        $this->_log->trace("FINDDATETIME string = $s");
        $date = DateTime::createFromFormat("d/m/Y H:i", $s);
        $this->_log->trace("FINDDATETIME date ".$date->format(DateTime::ATOM));
        return $date->format(DateTime::ATOM); //"D, d M H:i"
    }

    public function find_date( $string ) {
        $day = null;
        if(preg_match_all("/([0-9]+)/", $string, $matches)){
            $day = $matches[1][0];
        }
        else {
            return null;
        }
        $string = self::to_alphabet_string($string);
        $months = array( "january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december" );
        $max_days = array( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $similarity = 0;
        $matched_index = -1;
        for ($i=0; $i< 12; $i++){
            $month=$months[$i];
            similar_text($string, $month, $sim);
            if ($similarity < $sim){
                $similarity = $sim;
                $matched_index = $i;
            }
        }
        $matched_month = $months[$matched_index];
        $maxd = $max_days[$matched_index];
        if ($day > $maxd){
            return null;
        }
        $this->_log->trace("FINDDATETIME day ".$matched_month);
        return $day." ".$matched_month; //"D, d M H:i"
    }
    private function clean_name($sms){
        $sms = preg_replace("/[^a-zA-Z0-9\s]/", "", $sms);
        return ucwords(rtrim(ltrim($sms, " "), " "));
    }
    private static function to_alphabet_string($sms){
        $sms = strtolower(preg_replace('/\s+/', ' ', $sms));
        $sms = preg_replace("/[^a-zA-Z\/\s]/", "", $sms);
        return $sms;
    }

    public function range($value, $type, $min, $max){
        if ($type == "number"){
            if ($value < $min[0]){
                return $min[3];
            }
            else if ($value > $max[0]){
                return $max[3];
            }
        }
        else if ($type == "string"){
            if (strlen($value) < $min[0]){
                return $min[3];
            }
            else if (strlen($value) > $max[0]){
                return $max[3];
            }
        }
        else if ($type == "datetime"){
            $now = new DateTime();
            $diff = $now->diff($value);
            if ($diff->d < $min[0]){
                return $min[3];
            }
            else if ($diff->d > $max[0]){
                return $max[3];
            }
        }
        return "";
    }

    public static function flatten($a){
        return "( ". Utils::put_together($a, ", ", "(", ")")  . ")";
    }

    public static function join($a){
        return Utils::put_together($a, '', '', '');
    }

    public static function put_together($a, $separator, $prefix, $suffix){
        $result = "";
        if (is_array($a)){
            foreach($a as $i){
                if (is_array($i)){
                    if ($result==null){
                        $result = Utils::put_together($i, $separator, $prefix, $suffix);
                    }
                    else {
                        $result = $result .$separator .Utils::put_together($i, $separator, $prefix, $suffix);
                    }
                }
                else {
                    if ($result==null){
                        $result = $result .$i;
                    }
                    else {
                        $result = $result.$separator .$i;
                    }
                }
            }
        }
        else {
            $result = $result .$a;
        }
        if (strpos($result, "/img/")){
            return $result;
        }
        else {
            return  $prefix. $result. $suffix;
        }
    }




    public static function rand10()
    {
        $data = random_bytes(10);
        return substr(bin2hex($data), 0, 10);
    }

    public static function rand20()
    {
        $data = random_bytes(20);
        return substr(bin2hex($data), 0, 20);
    }

    public static function rand32()
    {
        $data = random_bytes(32);
        return substr(bin2hex($data), 0, 32);
    }
}

?>