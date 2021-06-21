<?php
include (__ROOT__ . '/views/_header.php');

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
$page_id = null;

$log->debug("User name=".$user_name." submit=".$submit." template=".$template_name." page=".$page_code);

$P = new Page();
if ($submit == "update"){
    //editing an existing page
    $p = $P->savePageCss($user_name, $page_code, $content = $_POST['content']);
}
else {
    $p = $P->getPageForUser($user_name, $page_code);
}

$page_code = $p['name'];
$page_code = $p['code'];
$content = $p['js'];
$public = $p['public'];
$comment = $p['comment'];;
error_log("Page id = ".$page_id." comment=".$comment." public=".$public);

$kb = new UserForm($user_name);
$imgs = new Images();
?>
<link rel="stylesheet" href="/css/editor.css">
<script src="/js/editor.js"></script>
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


        	  <div class="row header-toolbar">
                <div class="col-1">
                    <button type="submit" name="submit" value="toimages" class="btn btn-link"
        							   onclick="return onClickSubmitButton('<?php echo MAIN_VIEW; ?>');">
                    	<i class="ti-control-backward"  style="color: blue;font-size: 26px;"></i>&nbsp;&nbsp;</button>
                </div>
                <div class="col-2">
                    <input type="hidden" name="switchMode" onchange="setDocMode(this.checked);" />
                    <button type="submit" id="save_content" name="submit" value="update" class="btn btn-link"
        								onclick="return onClickSubmitButton('<?php echo EDITOR_CSS; ?>');">
                    									<i class="ti-save" style="color: green;font-size: 26px;"></i></button>
                </div>
                <div class="col-4">
                    <input type="text" name="page" placeholder="page name" size="16" value="<?php echo $page_code; ?>" style="border: 0px;text-decoration: underline;" required>
                </div>
                <div class="col-2">
                </div>
                <div class="col-3" style="text-align: right;background: red;">
        			<a class="btn btn-sim0" href="/redirect.php?view=editor_view&page_code=<?php echo $page_code; ?>"><b style="color: white;">HTML</b></a>
        			<a class="btn btn-sim0" href="/redirect.php?view=editor_css&page_code=<?php echo $page_code; ?>"><b style="color: white;">CSS</b></a>
        			<a class="btn btn-sim0" href="/redirect.php?view=editor_js&page_code=<?php echo $page_code; ?>"><b style="color: pink;">JS</b></a>
                </div>
              </div>

                  <div class="form-group" id="html_content">
                   		<pre id="display"><div id="htmlEditorPane" contenteditable="true" onscroll="setScrollPosition();">
                   		<?php echo $page_code==null ? "": $content; ?></div></pre>
                  </div>

                  <input id="content_input" type="hidden" name="content" value="">
                  <input type="hidden" id="viewname" name="view" value="">
                  <input type="hidden" name="page_code" value="<?php echo $page_code; ?>">
             </form>

      </div> <!-- End second Column -->


	<div class="col-lg-2 col-md-2 d-lg-block d-md-block d-sm-none d-none  sel0">
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

</script>


<?php include (__ROOT__ . '/views/_footer.php'); ?>
</body>
</html>