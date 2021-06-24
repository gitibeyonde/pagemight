<?php
define ( '__ROOT__',  dirname ( dirname ( __FILE__ )));

require_once(__ROOT__.'/config/config.php');
require_once(__ROOT__.'/classes/Login.php');
require_once(__ROOT__.'/classes/core/Encryption.php');

session_start();

$L = new Login();

if ($L->isUserLoggedIn()){

    echo $L->getUsername()."\n";
    echo  $L->getTPass64($L->getUsername())."\n";
    //generate token and return
    $token = [ 'user_name' => $L->getUsername(), 'tpass' => $L->getTPass64($L->getUsername()) ];

    $E = new Encryption();

    #var_dump($encrypt);

    #$token = unserialize($E->decrypt($encrypt));

    #var_dump($token);

    echo $E->encrypt(serialize($token));
}
else if (isset($_POST['t'])){
    $t = $_POST['t'];
    $E = new Encryption();
    $token = unserialize($E->decrypt($t));

    var_dump($token);

    $user_tpass = $token['tpass'];
    $user_name = $token['user_name'];

    $L = new Login();
    $r = $L->validateTpass($user_name, $user_tpass);
    if(!$r){
        echo 0;
    }
}
else {
    echo 0;
}

?>