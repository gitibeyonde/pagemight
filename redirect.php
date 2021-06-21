<?php
define ( '__ROOT__',  dirname ( __FILE__ ));
// include the config
require_once(__ROOT__.'/config/config.php');
require_once (__ROOT__ . '/classes/core/Log.php');

// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once(__ROOT__.'/libraries/password_compatibility_library.php');
}

// load the login class
require_once(__ROOT__.'/classes/Login.php');
require_once(__ROOT__.'/classes/Mobile_detect.php');

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
