<?php
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__ . '/classes/pm/Page.php');



$page_code = isset($_GET['pcode']) ? $_GET['pcode'] : $_POST['pcode'];
$user_name = isset($_GET['uid']) ? $_GET['uid'] : $_POST['uid'];


$P = new Page();

$p = $P->getPage($user_name, $page_code);

$content = $p['content'];
$css = $p['css'];
$js = $p['js'];


include(__ROOT__.'/doin/holder.php');
?>

