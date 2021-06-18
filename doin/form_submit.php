<?php
define('__ROOT__', dirname(dirname(__FILE__)));
include_once(__ROOT__ . '/classes/pm/UserForm.php');
include_once(__ROOT__ . '/classes/core/Encryption.php');
$crypt = new Encryption();

$uname = $crypt->decrypt($_POST['user_name']);
$tabella = $crypt->decrypt($_POST['table']);


unset($_POST['user_name']);
unset($_POST['table']);

$kb = new UserForm($uname);

$result = $kb->insertFormData($tabella, $_POST);

error_log("Last row id = ".print_r($result, true));
//[table] => contact_from\n    [name] => Abhinandan Prateek\n    [email] => agneya2001@gmail.com\n)\n, referer: http://127.0.0.1/doin/lkp.php?id=2

echo $result[0]['last_insert_rowid()'];

?>