<?php
require_once(__ROOT__.'/config/config.php');

require_once(__ROOT__.'/classes/Mobile_detect.php');
$Md = new Mobile_Detect();
if ($Md->isMobile()){
    $_SESSION["mobile"] = true;
}
else {
    $_SESSION["mobile"] = false;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PageMight - Online Page builder</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/themify-icons/themify-icons.css">
        <link href="/css/blinking_cursor.css" rel="stylesheet" />
        <!-- Bootstrap core JS-->
        <script src="/jquery/jquery-3.6.0.min.js"></script>
        <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">PageMight</a>
                 <ul class="nav navbar-nav menu_nav justify-content-end">
                 	<li class="nav-item"><a class="nav-link" href="/index.php?view=<?php echo LOGOUT_VIEW ?>">
                    	<i class="ti-power-off btn-logout"></i></a></li>
                 </ul>
            </div>
        </nav>


