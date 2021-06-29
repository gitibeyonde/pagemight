<?php
require_once(__ROOT__.'/config/config.php');
include_once(__ROOT__ . '/classes/pm/Template.php');
include_once(__ROOT__ . '/views/_header.php');


$view = isset($_GET['view']) ? $_GET['view'] : $_POST['view'];
$submit = isset($_GET['submit']) ? $_GET['submit'] : $_POST['submit'];
$template_name = isset($_GET['template_name']) ? $_GET['template_name'] : $_POST['template_name'];

$T = new Template();
if ($submit == "update"){
    //editing an existing page
    $t = $T->saveTemplateJs($template_name, $_POST['content']);
}
else {
    $t = $T->getTemplate($template_name);
}

$content = $t['js'];
?>
<link rel="stylesheet" href="/css/editor.css">
<script src="/js/editor.js"></script>
<body>
	<div class='container-fluid'>

    <div class="row">
    	<div class="col-lg-10 col-md-10 d-lg-block d-md-block col-12 col-sm-12">

           <form id="nodeform" name="nodeform" action="/redirect.php" method="post">


        	  <div id="headerToolbar" class="row">

                <!-- BACK -->
                <div class="col-1">
                    <button type="submit" name="submit" value="back" class="btn btn-link  btn-icon"
							   onclick="return onClickSubmitButton('<?php echo MAIN_VIEW; ?>');">
            			<span class="material-icons md-36 blue">arrow_back</span></button>
                </div>

                <!-- SAVE -->
                <div class="col-1">
            		<button type="submit" id="save_content" name="submit" value="update" class="btn btn-link btn-icon"
								onclick="return onClickSubmitButton('<?php echo TEMPLATE_JS; ?>');"><span class="material-icons md-36 green">save</span></button></button>

                </div>

                 <!-- NAME -->
                <div class="col-3">
        			   <input type="text" name="template_name" placeholder="template name" size="16" value="<?php echo $template_name; ?>"
                    												style="border: 0px;text-decoration: underline;" required>
        	    </div>


                <!-- XXX -->
                <div class="col-3">
                </div>

                <!-- XXX -->
                <div class="col-1">
                </div>

                <!-- HTML CSS JS SELECTOR -->
        		<div class="col-1">
            			<a class="btn btn-sim0" href="/redirect.php?view=template_html&template_name=<?php echo $template_name; ?>"><b>HTML</b></a>
        		</div>
        		<div class="col-1">
            			<a class="btn btn-sim0" href="/redirect.php?view=template_css&template_name=<?php echo $template_name; ?>"><b>CSS</b></a>
        		</div>
        		<div class="col-1">
            			<a class="btn btn-sim0" href="/redirect.php?view=template_js&template_name=<?php echo $template_name; ?>"><h2>JS</h2></a>
        		</div>

              </div>


              <div class="row header-toolbar">
                <br/>
			  </div>

                  <div class="form-group" id="css_content">
                   	 <textarea id="htmlEditorPane" name="content"><?php echo $content; ?></textarea>
                  </div>
                  <input type="hidden" id="viewname" name="view" value="">
                  <input type="hidden" name="template_name" value="<?php echo $template_name; ?>">
             </form>

      </div> <!-- End second Column -->


	<div class="col-lg-2 col-md-2 d-lg-block d-md-block d-sm-none d-none  sel0">
	</div>
  </div> <!-- End Big Row -->


</div> <!-- End fluid Container -->

<script>
$("#htmlEditorPane").keyup(function(e) {
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

</script>


<?php include (__ROOT__ . '/views/_footer.php'); ?>
</body>
</html>