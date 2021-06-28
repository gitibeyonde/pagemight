<?php
 // $content will be defined where the file is included
 define('__ROOT__', dirname(dirname(__FILE__)));
 include_once(__ROOT__ . '/classes/pm/UserForm.php');



 $seo = $p['seo'];

 //title 60 chars
 //meta_description 160 chars
 //meta image

 if (isset($seo) && strlen($seo) > 5){
     $seo_options = unserialize($seo);

     $title=$seo_options['title'];
     $description=$seo_options['description'];
     $img=$seo_options['image'];
 }

$user_name = $p['user_name'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta property="title" content="<?php echo $title; ?>">
		<meta property="og:title" content="<?php echo $title; ?>">
		<meta property="description" content="<?php echo $description; ?>">
		<meta property="og:description" content="<?php echo $description; ?>">
		<meta property="og:image" content="<?php echo $img; ?>">
		<meta property="og:url" content="<?php echo "https://".$_SERVER['SERVER_NAME']."/".$_SERVER['REQUEST_URI']; ?>">
		<meta name="twitter:card" content="<?php $description;?>">
        <meta name="author" content="Abhinandan Prateek" />
        <title><?php echo $title; ?></title>
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Bootstrap core JS-->
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


        <style type="text/css">
        .pagemight {
            position:fixed;
            bottom:5px;
            right:0px;
            height:26px;
            width:150px;
            background-color:gold;
        }
        .pagemight a {
            color: green;
            padding: 0 5px 5px 10px;
            }
        </style>


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-GZM18BWQGY"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-GZM18BWQGY');
        </script>
    </head>
<body>

<?php
    echo "<style>".$p['css']."</style>";
    echo "<script>".$p['js']."</script>";

    echo $p['html'];
?>
<div class="pagemight">
 <a href="https://pagemight.com" target="_blank">©&nbsp;PageMight</a>
</div>

<script>

<?php $kb = new UserForm($user_name);
foreach( $kb->ls() as $tn){
   if ($tn == "form_metadata")continue;
    ?>
    $("#<?php echo "form-".$tn; ?>").html('<?php echo $kb->getUserForm($user_name, $tn); ?>');

    $("#<?php echo "action-".$tn; ?>").on("submit", function (e) {
        var dataString = $(this).serialize();

        $.ajax({
          type: "POST",
          url: "/doin/form_submit.php",
          data: dataString,
          success: function (data) {
        	  $("#<?php echo "message-".$tn; ?>")
              .html("<i>Submission Id = #" + data + "</i>");
          }
        });

        e.preventDefault();

  	  	$(this).find(':input[type=submit]').prop('disabled', true);
    });
<?php } ?>

</script>

</body>
</html>


