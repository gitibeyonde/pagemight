<!DOCTYPE html>
<html lang="en"> <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Create Landing Pages, Catalogs and Flyers, Share minified links, QR-code and measure performance." />
        <meta name="author" content="Abhinandan Prateek" />
        <title>Free Landing Page builder</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/img/write48x48.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="/css/styles.css" rel="stylesheet" />
        <link href="/css/editor.css" rel="stylesheet" />


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
        $p = $P->savePageHtml($user_name, $page_code, $page_name, $_POST['content']);
    }
    else {
        $p = $P->getPageForUser($user_name, $page_code);
    }
    $page_name = $p['name'];
    $page_code = $p['code'];
    $content = $p['content'];
    $public = $p['public'];
    $comment = $p['comment'];
}
else if (isset($template_name)){
    //create page from template and start
    $T = new Template();
    $P = new Page();
    $t = $T->getTemplate($template_name);
    $page_name = $t['name'];
    $page_code = null;
    $content = $t['html'];
    $public = 0;
    $comment = 0;
}
error_log("Page code = ".$page_code." comment=".$comment." public=".$public);

$kb = new UserForm($user_name);
$imgs = new Images();
?>
<link rel="stylesheet" href="/css/login.css">
<body onload="initDoc();">
	<div class='container-fluid'>

    <div class="row">
    	<div class="col-lg-10 col-md-10 d-lg-block d-md-block col-12 col-sm-12">
                <form id="nodeform" name="nodeform" action="/redirect.php" method="post" onsubmit="return doSubmitNodeForm();">
                  <input type="hidden" id="viewname" name="view" value="">
                  <input type="hidden" name="page_code" value="<?php echo $page_code; ?>">

                  <?php include_once(__ROOT__ . '/views/editor/page_toolbar.php'); ?>

                  <div class="form-group" id="html_content">
                   		<div id="htmlEditorPane" contenteditable="true" style="display:inline-block;" onscroll="setScrollPosition();"><?php echo $content; ?></div>
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


<?php include (__ROOT__ . '/views/_footer.php'); ?>
</body>
</html>