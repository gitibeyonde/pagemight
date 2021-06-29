<?php
define('__ROOT__', dirname(dirname(__FILE__)));
include_once(__ROOT__ . '/classes/pm/Template.php');

error_log("Id=".$_GET['id']);
if (isset($_GET['id'])){
    $id=$_GET['id'];
    error_log("Id id=".$id);
    $P = new Template();
    $p =  $P->getTemplate($id);
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
    if ($p==null){
        include(__ROOT__.'/doin/_header.php');
        echo "<div class='row' style='padding-top: 10vh;'><i style='padding-top: 10vh;'>This page does not exists, forwarding to www.pagemight.com</i></div>";
        echo "<meta http-equiv='refresh' content='5; url=https://www.pagemight.com/' />";
        include(__ROOT__.'/doin/_footer.php');
    }
    else {
        include(__ROOT__.'/doin/_header.php');
        echo "<style>".$p['css']."</style>";
        echo $p['html'];
        echo "<script>".$p['js']."</script>";
        include(__ROOT__.'/doin/_footer.php');
    }
}
else {
    header("Location:  /index.php", true, 301);
}
?>

