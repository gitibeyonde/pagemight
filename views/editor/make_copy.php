<?php
require_once(__ROOT__.'/config/config.php');
include_once(__ROOT__ . '/classes/core/Log.php');
include_once(__ROOT__ . '/classes/pm/Page.php');
include_once(__ROOT__ . '/classes/pm/Template.php');
include_once(__ROOT__ . '/classes/pm/Images.php');
include_once(__ROOT__ . '/classes/pm/UserForm.php');

$user_name=$_SESSION['user_name'];

$submit = isset($_GET['submit']) ? $_GET['submit'] : $_POST['submit'];
$template_name = isset($_GET['template']) ? $_GET['template'] : $_POST['template'];

error_log("Template=".$template_name." user=".$user_name);

if (isset($template_name)){
    //create page from template and start
    $P = new Page();
    $p = $P->createPageFromTemplate($user_name, $P->getTemplate($template_name));
    header("Location:  /redirect.php?view=editor_view&page_code=".$p['code'], true, 307);
}
else {
    header("Location:  /index.php", true, 307);
}

?>