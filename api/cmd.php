<?php
define ( '__ROOT__',  dirname ( dirname ( __FILE__ )));

require_once(__ROOT__.'/config/config.php');
require_once(__ROOT__.'/classes/Login.php');
require_once(__ROOT__.'/classes/core/Encryption.php');
include_once(__ROOT__ . '/classes/pm/Images.php');

session_start();

$user_name = null;

if (isset($_POST['t']) || isset($_GET['t']) ){

    $t = isset($_POST['t']) ? $_POST['t'] : $_GET['t'];
    $E = new Encryption();
    $token = unserialize($E->decrypt($t));

    $user_tpass = $token['tpass'];
    $user_name = $token['user_name'];

    $L = new Login();
    $r = $L->validateTpass($user_name, $user_tpass);
    if(! isset($r)){
        echo -2;
        die;
    }
}
else {
    echo -3;
    die;
}

$user_name = $r->user_name;

$cmd = $_GET['cmd'];


if ($cmd == "images"){
    $SU = new Images();

    echo json_encode($SU->listImages($user_name));

}
else if ($cmd == "upload"){
    $image_name=$_GET['image_name'];

    var_dump($_FILES);

    $error = false;
    if ($_FILES["fileToUpload"]["error"] != 0){
        error_log(' File upload failed for '.$_FILES["fileToUpload"]["name"] . ' with error ' . $_FILES["fileToUpload"]["error"] . ' size is ' . $_FILES["fileToUpload"]["size"]);
        $msg=" Unknown error ";
        $error = true;
    }

    if ($_FILES["fileToUpload"]["type"] != 'image/jpeg' && $_FILES["fileToUpload"]["type"] != 'image/png' && $_FILES["fileToUpload"]["type"] != 'image/jpg' ){
        error_log('Bad format for '.$_FILES["fileToUpload"]["name"] . ' with error ' .$_FILES["fileToUpload"]["type"]);
        $msg=$msg." Illegal Format, Use jpg/jpeg/png ";
        $error = true;
    }

    if ($_FILES["fileToUpload"]["size"] > 2500000) {
        error_log('File is too large for '.$_FILES["fileToUpload"]["name"] . ' with error ' . $_FILES["fileToUpload"]["size"]);
        $msg=$msg." File size of less than 2MB is allowed ";
        $error = true;
    }
    if ($user_name == null){
        $msg=$msg." Authorization error ";
        $error = true;
    }
    if ($error){
        echo -4;
        error_log($error);
    }
    else {
        $SU = new Images();
        $filename = $_FILES["fileToUpload"]["tmp_name"];
        error_log("Upload file=".$_FILES["fileToUpload"]["name"]);
        $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
        $SU->uploadFilePageMight($user_name."/img/".$image_name.".".$ext, $filename);
        echo 1;
    }
}
else {
    echo -1;
}
?>