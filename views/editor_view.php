<?php
include (__ROOT__ . '/views/_header.php');

include_once(__ROOT__ . '/classes/core/Log.php');
include_once(__ROOT__ . '/classes/pm/Page.php');
include_once(__ROOT__ . '/classes/pm/Template.php');
include_once(__ROOT__ . '/classes/pm/PageUtils.php');
include_once(__ROOT__ . '/classes/pm/Images.php');
include_once(__ROOT__ . '/classes/pm/UserForm.php');



$log = $_SESSION['log'] = new Log ("trace");
$user_id=$_SESSION['user_id'];


$template_name = $_GET['template'];
$page_name = $_GET['page'];

$log->debug("User id=".$user_id." submit=".$submit." template=".$template_name);

if (isset($page_name)){
    //editing and existing page
}
else if (isset($template_name)){
    //create page from template and start
    $user_id = $_SESSION['user_id'];
    $T = new Template();
    $P = new Page();
    $t = $T->getTemplate($template_name);
    $r = $P->createPageFromTemplate($user_id, $t);
    if ($r){
        $page_name = $template_name;
        $content = $t['content'];
    }
}

if ($submit == "add" && $state != null && $content != null){
    $state = $_POST['state'];
}


?>
<link rel="stylesheet" href="/css/editor.css">
<link rel="stylesheet" href="/css/thumbnail.css">
<script src="/js/editor.js"></script>
<div class='container-fluid'>

    <?php //include_once(__ROOT__.'/views/sms/wiz/wiz_wf_node_menu.php'); ?>

    <div class="row">
    	<div class="col-lg-1 d-lg-block d-md-none d-sm-none d-none">
    	</div>
    	<div class="col-lg-8 col-md-9 d-lg-block d-md-block col-12 col-sm-12">
                <form id="nodeform" name="nodeform" action="/index.php" method="post" onsubmit="return doSubmitNodeForm();">

                  <?php include_once(__ROOT__ . '/views/editor/page_toolbar.php'); ?>

                  <div class="form-group" id="html_content">
                   		<div id="htmlEditorPane" contenteditable="true" onscroll="setScrollPosition();"><?php echo $page_name==null ? "": $content; ?></div>
                  </div>

                  <input id="content_input" type="hidden" name="content" value="">

             </form>
      </div> <!-- End second Column -->


	<div class="col-lg-3 col-md-3 d-lg-block d-md-block d-sm-none d-none  sel0">
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
    if (confirm('Do you really want delete this Node ?')){
        if ("start1" == "<?php echo $state; ?>"){
            alert("Cannot delete start1 node");
            return false;
        }
        else {
            $("#viewname").val(view);
            return true;
        }
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