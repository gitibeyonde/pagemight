
<?php
require_once(__ROOT__.'/config/config.php');
include_once(__ROOT__ . '/classes/core/Log.php');
include_once(__ROOT__ . '/classes/pm/Template.php');
include_once(__ROOT__ . '/classes/pm/Images.php');

include_once(__ROOT__ . '/views/_header.php');

$log = $_SESSION['log'];
$user_name=$_SESSION['user_name'];

$submit = isset($_GET['submit']) ? $_GET['submit'] : $_POST['submit'];
$view = isset($_GET['view']) ? $_GET['view'] : $_POST['view'];
$template_name = isset($_GET['template_name']) ? $_GET['template_name'] : $_POST['template_name'];

if ($submit == "edit"){
    if (isset($template_name)){
        //create page from template and start
        $T = new Template();
        $t = $T->getTemplate($template_name);
    }
}
else if ($submit == "save"){
    $T = new Template();
    $t = $T->savesavePageHtmlPageCss($template_name, $_POST['content']);
}


$html = $t['html'];

$imgs = new Images();
?>
<link rel="stylesheet" href="/css/editor.css">
<script src="/js/editor.js"></script>
<body onload="initDoc();">
	<div class='container-fluid'>

    <div class="row">
    	<div class="col-lg-10 col-md-10 d-lg-block d-md-block col-12 col-sm-12">
                <form id="nodeform" name="nodeform" action="/redirect.php" method="post" onsubmit="return doSubmitNodeForm();">
                  <input type="hidden" id="viewname" name="view" value="">
                  <input type="hidden" name="template_name" value="<?php echo $template_name; ?>">

                  <?php include_once(__ROOT__ . '/views/editor/page_toolbar.php'); ?>

                  <div class="form-group" id="html_content">
                   		<div id="htmlEditorPane" contenteditable="true" ondrop="drop(event)" ondragover="allowDrop(event)" style="display:inline-block;" onscroll="setScrollPosition();">
                   				<?php echo $html; ?>
                   		</div>
                  </div>

                  <input id="content_input" type="hidden" name="content" value="">

             </form>
      </div> <!-- End second Column -->


	<div class="col-lg-2 col-md-2 d-lg-block d-md-block d-sm-none d-none  sel0">
       <?php include_once(__ROOT__.'/views/editor/page_right.php'); ?>
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

    //console.log("Setting content to " + oDoc.innerHTML);
    $("#content_input").val(oDoc.innerHTML);
    return true;
}

var texttags = [ 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'P' ];

$('#htmlEditorPane').keydown(function(e) {
    // trap the return key being pressed
    if (e.keyCode === 13) {
        console.log("Return pressed.." + e.keyCode);
        //console.log(e.target.innerHTML);
        var selection = window.getSelection();
          var range = selection.getRangeAt(0);
          var container = range.commonAncestorContainer;
          var nodeParent = container.parentNode;
          console.log("tageName=" + nodeParent.tagName);
          if (texttags.includes(nodeParent.tagName)){
              console.log("Text tag");
          	   e.preventDefault();
              insertAtCursor("<br/><br/>");
              document.getSelection().collapseToEnd();
          }

        //
        // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
        //if you are in a column then insert at sursor
        //insertAtCursor("<br/><br/>");
        //document.getSelection().collapseToEnd();
        //else insert deafult
        //document.execCommand('insertHTML', false, '<br><br>');
        // prevent the default behaviour of return key pressed
    }
});


enableImageResizeInDiv("htmlEditorPane");
</script>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php include (__ROOT__ . '/views/_footer.php'); ?>
</body>
</html>