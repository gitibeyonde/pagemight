<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/classes/core/Minify.php');

error_log("Id=".$_GET['id']);
if (isset($_GET['id'])){
    $id=$_GET['id'];
    //error_log("Id id=".$id." p=".$p);
    $od = new Minify();
    $content =  $od->getUrlContent($id);
    error_log("Content=".$content);
    $ip = getenv('HTTP_CLIENT_IP')?:
    getenv('HTTP_X_FORWARDED_FOR')?:
    getenv('HTTP_X_FORWARDED')?:
    getenv('HTTP_FORWARDED_FOR')?:
    getenv('HTTP_FORWARDED')?:
    getenv('REMOTE_ADDR');
    if (!isset($_SERVER['HTTP_USER_AGENT'])){
        header("Location:  /index.php", true, 307);
        die;
    }
    $ag = $_SERVER['HTTP_USER_AGENT'];
    if ($content==null){
        header("Location: /removed.html", true, 301);
    }
    else {
        $od->logAccess($id, $ip, $ag);
        include(__ROOT__.'/doin/_header.php');
        echo $content;
        include(__ROOT__.'/doin/_footer.php');
    }
}
else {
    header("Location:  /index.php", true, 301);
}
?>

