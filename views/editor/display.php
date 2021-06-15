<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
<link rel="stylesheet" href="/vendors/bootstrap5/css/bootstrap.min.css">
<script src="/vendors/jquery/jquery-3.2.1.min.js"></script>
<script src="/vendors/bootstrap/bootstrap.bundle.min.js"></script>
<?php
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__ .'/classes/core/Log.php');


$log = $_SESSION['log'] = new Log('debug');

$m=urldecode(base64_decode($_GET['m']));

$log->debug("Html=".$m);
?>

<body>
	<div class="container">
  		<?php echo $m; ?>
  	</div>
</body>
