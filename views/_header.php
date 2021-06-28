<?php
require_once(__ROOT__.'/config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Create Landing Pages, Catalogs and Flyers, Share minified links, QR-code and measure performance." />
        <meta name="author" content="Abhinandan Prateek" />
        <title>Free Landing Page builder</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/img/write48x48.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="/css/styles.css" rel="stylesheet" />


		<!-- https://material.io/resources/icons/?style=baseline -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
              rel="stylesheet">

        <!-- https://material.io/resources/icons/?style=outline -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined"
              rel="stylesheet">

        <!-- https://material.io/resources/icons/?style=round -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round"
              rel="stylesheet">

        <!-- https://material.io/resources/icons/?style=sharp -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp"
              rel="stylesheet">

        <!-- https://material.io/resources/icons/?style=twotone -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Two+Tone"
      		rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-GZM18BWQGY"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-GZM18BWQGY');
        </script>

	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Bootstrap core JS-->
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
       <script src="/js/scripts.js"></script>

    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/index.php" >
   					<span class="material-icons md-48 orange">home</span>&nbsp;&nbsp;PageMight</a>
                 <ul class="nav navbar-nav menu_nav justify-content-end">
                    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == 1){ ?>
                 	<li class="nav-item"><a class="nav-link" href="/redirect.php?view=<?php echo LOGOUT_VIEW ?>">
                    	<i class="ti-power-off btn-logout"></i></a></li>
                    <?php } ?>
                 </ul>
            </div>
        </nav>


