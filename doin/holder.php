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
		<meta property="og:title" content="<?php echo $title; ?>">
		<meta property="og:description" content="<?php $description; ?>">
		<meta property="og:image" content="<?php $img; ?>">
		<meta property="og:url" content="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<meta name="twitter:card" content="<?php $description;?>">
        <meta name="author" content="Abhinandan Prateek" />
        <title><?php echo $title; ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/img/write48x48.ico" />
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <!-- Bootstrap core JS-->
        <script src="/jquery/jquery-3.6.0.min.js"></script>
        <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
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

    echo $p['content'];
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


