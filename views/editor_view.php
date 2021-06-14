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


$message = isset($_POST['message']) ? $_POST['message'] : $wfnode['message'];
$state = isset($_POST['state']) ? $_POST['state'] : $wfnode['state'];

$log->debug("Bot id=".$bot_id." submit=".$submit." message=".$message);

if ($submit == "add" && $state != null && $message != null){
    $state = $_POST['state'];
}
else if ($submit == "set_css"){
    $css = $_GET['css'];
    $WFDB->updateCss($user_id, $bot_id, $css);
}


?>

<link rel="stylesheet" href="/css/editor.css">

<link rel="stylesheet" href="/css/thumbnail.css">

<script src="/js/editor.js"></script>

<div class='container-fluid'>

    <?php //include_once(__ROOT__.'/views/sms/wiz/wiz_wf_node_menu.php'); ?>

    <div class="row">
        <div class="col-lg-9 col-md-9">
            <div class="row">

                <form id="nodeform" name="nodeform" action="/index.php" method="post" onsubmit="return doSubmitNodeForm();">


                   <input type="hidden" name="actions_str" value="<?php echo htmlspecialchars($wfnode['actions']); ?>">
                   <div class="row">

                        <div class="col-12" style="padding-left: 20px;">

                            <h2 class="sel0"><?php echo $wf['name']; ?></h2>

                           <?php include_once(__ROOT__ . '/views/editor/page_toolbar.php'); ?>

                           <div class="form-group" id="html_content">
                           		<div id="htmlEditorPane" contenteditable="true" onscroll="setScrollPosition();"><?php echo $state==null ? "": $message; ?></div>
                           </div>

                           <input id="message_input" type="hidden" name="message" value="">
                        </div>
                  </div>

                  <input type="hidden" name="help" value="">
                  <input type="hidden" name="bot_id" value="<?php echo $bot_id; ?>">
                  <input type="hidden" id="viewname" name=view value="">

                  <table width="100%">
                      <tr style="background: var(--blue1);">
                      <td style="text-align: center">
                       <button type="submit" id="save_message" name="submit" value="update" class="btn btn-sim1"   onclick="return onClickSubmitButton('<?php echo WORKFLOW_NODE; ?>');">
                       <i class="ti-save"></i></button>
                      </td>
                      <?php if ($wfnode['state'] != "start") { ?>
                      <td style="text-align: center">
                       <button type="submit" name="submit" value="delete"  class="btn btn-sim2"  onclick="return onClickDel('<?php echo WIZ_WF_PAGES; ?>');">
                       <i class="ti-trash"></i></button>
                      </td>
                      <?php } ?>
                      </tr>
                  </table>
             </form>
         </div>
      </div> <!-- End second Column -->


       <?php include_once(__ROOT__.'/views/editor/page_right.php'); ?><!-- End third Column -->
    </div> <!-- End Big Row -->


</div> <!-- End fluid Container -->

<script>
$("#html_content").keyup(function(e) {
    if (e.keyCode == 83 && event.ctrlKey){
        $("#save_message").click();
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

    console.log("Setting message to " + oDoc.innerHTML);
    $("#message_input").val(oDoc.innerHTML);
    return true;
}


enableImageResizeInDiv("htmlEditorPane");
</script>


<?php include (__ROOT__ . '/views/_footer.php'); ?>
</body>
</html>