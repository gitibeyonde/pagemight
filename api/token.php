<?php
define ( '__ROOT__',  dirname ( dirname ( __FILE__ )));

require_once(__ROOT__.'/config/config.php');
require_once(__ROOT__.'/classes/Login.php');
require_once(__ROOT__.'/classes/core/Encryption.php');

session_start();

$L = new Login();

if ($L->isUserLoggedIn()){
    //generate token and return
    $token = [ 'user_name' => $L->getUsername(), 'tpass' => $L->getTPass64($L->getUsername()) ];

    $E = new Encryption();

    #var_dump($encrypt);

    #$token = unserialize($E->decrypt($encrypt));

    #var_dump($token);

    echo $E->encrypt(serialize($token));
}
else {
    echo 0;
}

?>