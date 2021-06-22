<?php
define ( '__ROOT__',  dirname ( dirname ( __FILE__ )));

require_once(__ROOT__.'/config/config.php');
require_once(__ROOT__.'/classes/Login.php');
require_once(__ROOT__.'/classes/core/Encryption.php');
include_once(__ROOT__ . '/classes/pm/Images.php');

session_start();

var_dump($_POST);

if (isset($_POST['t'])){

    $t = $_POST['t'];
    $E = new Encryption();
    $token = unserialize($E->decrypt($t));

    var_dump($token);

    $user_tpass = $token['tpass'];
    $user_name = $token['user_name'];

    $L = new Login();
    $r = $L->validateTpass($user_name, $user_tpass);
    if( !$r){
       die;
    }
}
else {
   die;
}

$user_name = $r->user_name;

$cmd = $_GET['cmd'];


if ($cmd == "images"){
    $SU = new Images();

    echo json_encode($SU->listImages($user_name));

}
?>