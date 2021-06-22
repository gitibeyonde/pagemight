<?php
define ( '__ROOT__',  dirname ( __FILE__ ));
// include the config
require_once(__ROOT__.'/config/config.php');
require_once (__ROOT__ . '/classes/core/Log.php');

// load the login class
require_once(__ROOT__.'/classes/Login.php');

error_log("Redirect POST=" .print_r($_POST, true));
error_log("Redirect GET=" .print_r($_GET, true));
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();


$log = $_SESSION['log'] = new Log('trace');

$log->debug( $_SESSION ['user_name']." logged in ".$login->isUserLoggedIn());


if (isset($_POST['view'])){
    unset($_GET['logout']);
    $login->setView($_POST['view']);
}
else if (isset($_GET['view'])) {
    unset($_GET['logout']);
    $login->setView($_GET['view']);
}

$log->debug( "VIEW=".$login->getView() );
if  ($login->getView() == MAIN_VIEW){
    if (isset( $_SESSION ['user_id']) && isset( $_SESSION ['user_name'])){
         include("views/main_view.php");
    }
    else {
        include("index.php");
    }
}
else if  ($login->getView() == EDITOR_VIEW){
    if (isset( $_SESSION ['user_id']) && isset( $_SESSION ['user_name'])){
        include("views/editor_view.php");
    }
    else {
        include("index.php");
    }
}
else if  ($login->getView() == EDITOR_CSS){
    if (isset( $_SESSION ['user_id']) && isset( $_SESSION ['user_name'])){
        include("views/editor/editor_css.php");
    }
    else {
        include("index.php");
    }
}
else if  ($login->getView() == EDITOR_JS){
        if (isset( $_SESSION ['user_id']) && isset( $_SESSION ['user_name'])){
            include("views/editor/editor_js.php");
        }
        else {
            include("index.php");
        }
}
else if  ($login->getView() == UPLOAD_IMAGES){
    if (isset( $_SESSION ['user_id']) && isset( $_SESSION ['user_name'])){
        include("views/editor/upload_images.php");
    }
    else {
        include("index.php");
    }
}
else if  ($login->getView() == FORM_CREATE){
    if (isset( $_SESSION ['user_id']) && isset( $_SESSION ['user_name'])){
        include("views/editor/form_create.php");
    }
    else {
        include("index.php");
    }
}
else if  ($login->getView() == FORM_DATA){
    if (isset( $_SESSION ['user_id']) && isset( $_SESSION ['user_name'])){
        include("views/editor/form_data.php");
    }
    else {
        include("index.php");
    }
}
else if  ($login->getView() == LOGOUT_VIEW){
        $login->doLogout();
        include("index.php");
}
else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("index.php");
}

?>
