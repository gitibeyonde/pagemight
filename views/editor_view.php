<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="build online html pages with embedded forms and images" />
        <meta name="author" content="Abhinandan Prateek" />
        <title>PageMight - Online Page builder</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/img/write48x48.ico" />
        <link href="/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/themify-icons/themify-icons.css">
        <link rel="stylesheet" href="/css/editor.css">
        <link rel="stylesheet" href="/css/thumbnail.css">
        <link rel="stylesheet" href="/css/styles.css">
        <!-- Bootstrap core JS-->
        <script src="/jquery/jquery-3.6.0.min.js"></script>
        <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="/js/scripts.js"></script>
        <script src="/js/editor.js"></script>
        <script src="/js/tidy.js"></script>
    </head>
<?php
require_once(__ROOT__.'/config/config.php');
include_once(__ROOT__ . '/classes/core/Log.php');
include_once(__ROOT__ . '/classes/pm/Page.php');
include_once(__ROOT__ . '/classes/pm/Template.php');
include_once(__ROOT__ . '/classes/pm/Images.php');
include_once(__ROOT__ . '/classes/pm/UserForm.php');

$log = $_SESSION['log'];
$user_name=$_SESSION['user_name'];

$submit = isset($_GET['submit']) ? $_GET['submit'] : $_POST['submit'];
$template_name = isset($_GET['template']) ? $_GET['template'] : $_POST['template'];
$page_code = isset($_GET['page_code']) ? $_GET['page_code'] : $_POST['page_code'];
$page_name = isset($_GET['page_name']) ? $_GET['page_name'] : $_POST['page_name'];

$log->debug("User name=".$user_name." submit=".$submit." template=".$template_name." page code=".$page_code);

$P = new Page();
if (isset($page_code)){
    if ($submit == "update"){
        //editing an existing page
        $p = $P->savePageContent($user_name, $page_code, $page_name, $_POST['content']);
    }
    else {
        $p = $P->getPageForUser($user_name, $page_code);
    }
}
else if (isset($template_name)){
    //create page from template and start
    $T = new Template();
    $P = new Page();
    $t = $T->getTemplate($template_name);
    $p  = $P->createPageFromTemplate($user_name, $t, Utils::rand10());
}
$page_name = $p['name'];
$page_code = $p['code'];
$content = $p['content'];
$public = $p['public'];
$comment = $p['comment'];;
error_log("Page code = ".$page_code." comment=".$comment." public=".$public);

$kb = new UserForm($user_name);
$imgs = new Images();
?>
<link rel="stylesheet" href="/css/login.css">
<body onload="initDoc();">
	<div class='container-fluid'>

    <div class="row">
    	<div class="col-lg-1 d-lg-block d-md-none d-sm-none d-none my-login-page">
    		<div class="brand">
					<img src="/img/html.png" alt="pagemight html builder login page">
			</div>
    	</div>
    	<div class="col-lg-9 col-md-10 d-lg-block d-md-block col-12 col-sm-12">
                <form id="nodeform" name="nodeform" action="/redirect.php" method="post" onsubmit="return doSubmitNodeForm();">
                  <input type="hidden" id="viewname" name="view" value="">
                  <input type="hidden" name="page_code" value="<?php echo $page_code; ?>">

                  <?php include_once(__ROOT__ . '/views/editor/page_toolbar.php'); ?>

                  <div class="form-group" id="html_content">
                   		<div id="htmlEditorPane" contenteditable="true" onscroll="setScrollPosition();"><?php echo $page_code==null ? "": $content; ?></div>
                  </div>

                  <input id="content_input" type="hidden" name="content" value="">

             </form>
      </div> <!-- End second Column -->


	<div class="col-lg-2 col-md-2 d-lg-block d-md-block d-sm-none d-none  sel0">
       <?php include_once(__ROOT__.'/views/editor/page_right.php'); ?><!-- End third Column -->
	</div>
  </div> <!-- End Big Row -->


</div> <!-- End fluid Container -->

<script>
$("#html_content").keyup(function(e) {
    if (e.keyCode == 83 && event.ctrlKey){
        $("#save_content").click();
    }
});


function onClickSubmitButton(view){
    console.log("onClickSubmitButton " + $(view));
    $("#viewname").val(view);

    if (!isHTML){
        setDocMode(false);
    }
    return true;
}


function onClickDel(view){
    if (confirm('Do you really want delete this Page ?')){
            $("#viewname").val(view);
            return true;
    }
    else {
       return false;
    }
}

function doSubmitNodeForm(){
    console.log(">>>> doSubmitNodeForm " + $("#viewname").val());
    if (document.nodeform.switchMode.checked) {
        document.nodeform.switchMode.checked = false;
	}
    //remove resize frames added by image resizer
    document.querySelectorAll(".resize-frame,.resizer").forEach((item) => item.parentNode.removeChild(item));

    console.log("Setting content to " + oDoc.innerHTML);
    $("#content_input").val(oDoc.innerHTML);
    return true;
}


enableImageResizeInDiv("htmlEditorPane");
</script>


<?php include (__ROOT__ . '/views/_footer.php'); ?>
</body>
</html>