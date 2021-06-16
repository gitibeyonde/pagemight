<?php
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__ . '/classes/core/Log.php');
include_once(__ROOT__ . '/classes/pm/Page.php');

$log = new Log("trace");

$submit = isset($_GET['a']) ? $_GET['a'] : $_POST['a'];
$page_id = isset($_GET['pid']) ? $_GET['pid'] : $_POST['pid'];
$user_name = isset($_GET['uid']) ? $_GET['uid'] : $_POST['uid'];
$comment = isset($_GET['comment']) ? $_GET['comment'] : $_POST['comment'];
$public = isset($_GET['public']) ? $_GET['public'] : $_POST['public'];

error_log("User name=".$user_name." submit=".$submit." page=".$page_id);

$P = new Page();

if ($submit == "u"){
    if (isset($comment)){
        echo $P->updatePageComment($user_name, $page_id, $comment);
    }
    else if (isset($public)){
        echo $P->updatePagePublic($user_name, $page_id, $public);
    }
    else {
        echo "0";
    }
}
else {
    echo "0";
}
?>