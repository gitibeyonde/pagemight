<?php
include (__ROOT__ . '/views/_header.php');

include_once(__ROOT__ . '/classes/core/Log.php');
include_once(__ROOT__ . '/classes/pm/Page.php');
include_once(__ROOT__ . '/classes/pm/Template.php');
include_once(__ROOT__ . '/classes/pm/PageUtils.php');
include_once(__ROOT__ . '/classes/pm/Images.php');
include_once(__ROOT__ . '/classes/pm/UserForm.php');

$log = $_SESSION['log'];
$user_name=$_SESSION['user_name'];


$submit = isset($_GET['submit']) ? $_GET['submit'] : $_POST['submit'];
$template_name = isset($_GET['template']) ? $_GET['template'] : $_POST['template'];
$page_name = isset($_GET['page']) ? $_GET['page'] : $_POST['page'];
$page_id = null;
$public = null;
$comment = null;

$log->debug("User name=".$user_name." submit=".$submit." template=".$template_name." page=".$page_name);

$P = new Page();
if (isset($page_name)){
    if ($submit == "update"){
        //editing and existing page
        $page_id = $P->savePage($user_name, $page_name, $content = $_POST['content']);
    }
    else {
        $p = $P->getPageForUser($user_name, $page_name);
        $page_id = $p['id'];
        $content = $p['content'];
    }
}
else if (isset($template_name)){
    //create page from template and start
    $T = new Template();
    $P = new Page();
    $t = $T->getTemplate($template_name);
    $page_id  = $P->createPageFromTemplate($user_name, $t);
    if ($r){
        $page_name = $template_name;
        $content = $t['content'];
    }
}

error_log("Page id = ".$page_id)
?>
<link rel="stylesheet" href="/css/editor.css">
<link rel="stylesheet" href="/css/thumbnail.css">
<script src="/js/editor.js"></script>
<script src="/js/tidy.js"></script>
<link href="/css/toggle.min.css" rel="stylesheet">
<script src="/js/toggle.min.js"></script>

<div class='container-fluid'>
<body onload="initDoc();">

    <?php //include_once(__ROOT__.'/views/sms/wiz/wiz_wf_node_menu.php'); ?>

    <div class="row">
    	<div class="col-lg-1 d-lg-block d-md-none d-sm-none d-none">
    	</div>
    	<div class="col-lg-9 col-md-10 d-lg-block d-md-block col-12 col-sm-12">
                <form id="nodeform" name="nodeform" action="/redirect.php" method="post" onsubmit="return doSubmitNodeForm();">

                  <?php include_once(__ROOT__ . '/views/editor/page_toolbar.php'); ?>

                  <div class="form-group" id="html_content">
                   		<div id="htmlEditorPane" contenteditable="true" onscroll="setScrollPosition();"><?php echo $page_name==null ? "": $content; ?></div>
                  </div>

                  <input id="content_input" type="hidden" name="content" value="">
                  <input type="hidden" id="viewname" name="view" value="">
                  <input type="hidden" name="page" value="<?php echo $page_name; ?>">

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
        //setDocMode(false);
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