<?php
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__ . '/classes/core/Log.php');
include_once(__ROOT__ . '/classes/pm/Page.php');
include_once(__ROOT__ . '/classes/pm/UserForm.php');

$log = new Log("trace");

$submit = isset($_GET['a']) ? $_GET['a'] : $_POST['a'];
$page_id = isset($_GET['pid']) ? $_GET['pid'] : $_POST['pid'];
$user_name = isset($_GET['uid']) ? $_GET['uid'] : $_POST['uid'];
$comment = isset($_GET['comment']) ? $_GET['comment'] : $_POST['comment'];
$public = isset($_GET['public']) ? $_GET['public'] : $_POST['public'];

error_log("User name=".$user_name." submit=".$submit." page=".$page_id);

error_log(print_r($_POST, true));
error_log(print_r($_GET, true));
?>