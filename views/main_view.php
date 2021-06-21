<?php
if (!defined('__ROOT__')) define ( '__ROOT__', dirname ( __FILE__ ) ) ;
include (__ROOT__ . '/views/_header.php');

require_once (__ROOT__ . '/classes/core/Log.php');
require_once (__ROOT__ . '/classes/pm/Template.php');
require_once (__ROOT__ . '/classes/pm/Page.php');
include_once(__ROOT__ . '/classes/pm/UserForm.php');

$log = $_SESSION['log'];
$user_name = $_SESSION ['user_name'];

$submit = isset($_GET['submit']) ? $_GET['submit'] : $_POST['submit'];
$template_id = isset($_GET['template']) ? $_GET['template'] : $_POST['template'];
$page_code = isset($_GET['page_code']) ? $_GET['page_code'] : $_POST['page_code'];

$log->debug("User name=".$user_name);

if ($submit == "delete"){
    if (isset($page_code)){
        $P = new Page();
        $P->deletePage($user_name, $page_code);
    }
}

$T = new Template();
$ts = $T->getAllTemplates();

$P = new Page();
$ps = $P->getPages($user_name);
?>

<link rel="stylesheet" href="/css/thumbnail.css">

<!-- Page content-->
<div class="container" style="padding: 2vh 1vh 50vh 1vh;">

    <ul class="nav justify-content-end">
      <li class="nav-item">
        <a id="templates-link" class="nav-link btn-link"  onClick="showTemplates();">Templates</a>
      </li>
      <li class="nav-item">
        <a id="mypages-link" class="nav-link btn-link active" onClick="showMyPages();"  style="font-weight: bold">My Pages</a>
      </li>
      <li class="nav-item">
        <a id="myforms-link" class="nav-link btn-link" onClick="showMyForms();">Forms</a>
      </li>
    </ul>

 <span id="templates" style="display: none">
   <div  class="row"  style="padding: 2vh 1vh 2vh 1vh;">
   		Choose a template
   </div>


   <div class="row">
     <?php foreach ($ts as $t) { ?>
	<div class="col-sm-4 card">
		<a href="/redirect.php?view=editor_view&template=<?php echo $t['name']; ?>">
          <img class="img-fluid card-img-top" src="/img/<?php echo $t['name']; ?>.png" alt="Alt text"/>
          <h5><i class="ti-cloud-down" style="color: blue;font-size: 36px;transform: translate(-50px, -15px);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i><?php echo $t['name']; ?></h5>
        </a>
   </div>
  <?php } ?>
   </div>
 </span>

 <span id="mypages" style="display: block;">
   <div class="row"  style="padding: 2vh 1vh 2vh 1vh;">
   		My Pages
   </div>


   <div class="row">
     <?php foreach ($ps as $t) { ?>
 		<div class="col-sm-4 card" style="padding: 1vh 1vh 1vh 1vh;">
        	<div class="thumbnail-container">
                <div class="thumbnail">
    				<iframe src="/views/editor/page_view.php?uid=<?php echo $user_name; ?>&pcode=<?php echo $t['code']; ?>"
                           onload="this.style.opacity = 1" frameborder="0"> </iframe>
                </div>
            </div>
   			<div class="row" style="padding: 0px 20px 0 20px;">
   				<div class="col-2">
   					<a class="btn btn-sim0" href="/redirect.php?view=editor_view&page_code=<?php echo $t['code']; ?>">
   								<i class="ti-pencil-alt2" style="color: green;font-size: 36px;"></i> </a>
   				</div>
   				<div class="col-8">
   					<?php echo $t['name']; ?>
   				</div>
   				<div class="col-2">
                    <form action="/redirect.php?view=main_view" method="post">
                      <input type="hidden" name="page_code" value="<?php echo $t['code']; ?>">
                      <button type="submit" name="submit" value="delete"  class="btn btn-sim0"  onclick="return onClickDel('<?php echo MAIN_VIEW; ?>');">
                    					<i class="ti-trash" style="color: red;font-size: 36px;"></i></button>
                   </form>
   				</div>
   			</div>
  	</div>
  <?php } ?>
   </div>
</span>

 <span id="myforms" style="display: none">
       <div class="row"  style="padding: 2vh 1vh 2vh 1vh;">
       		My Forms
       </div>

       <div class="row">
        <?php $kb = new UserForm($user_name);
        foreach( $kb->ls() as $tn){
           if ($tn == "form_metadata")continue;
            ?>
     		<div class="col-sm-4 card" style="padding: 1vh 1vh 1vh 1vh;">
            	<div class="thumbnail-container">
                    <div class="thumbnail">
                       <div class="container" style="padding: 2vh 2vh 2vh 2vh;">
        				<h1><?php echo $tn; ?></h1>
                    		<?php echo $kb->getUserForm($user_name, $tn); ?>;
                       </div>
                    </div>
                </div>
       			<div class="row" style="padding: 0px 20px 0 20px;">
       				<div class="col-2">
       					<a href="/redirect.php?view=form_data&tabella=<?php echo $tn; ?>"><i class="ti-server" style="color: green;font-size: 36px;"></i></a>
       				</div>
       				<div class="col-8 m-auto">
       					<?php echo $tn; ?>
       				</div>
       				<div class="col-2">
       				</div>
       			</div>
      		</div>
    	   <?php } ?>
   		</div>
  </span>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
</div>
<script>

function showTemplates(){
	$("#templates-link").attr("style", "font-weight:bold");
	$("#mypages-link").attr("style", "font-weight:normal");
	$("#myforms-link").attr("style", "font-weight:normal");
	$("#templates").attr("style", "display:block");
	$("#mypages").attr("style", "display:none");
	$("#myforms").attr("style", "display:none");
}

function showMyPages(){
	$("#templates-link").attr("style", "font-weight:normal");
	$("#mypages-link").attr("style", "font-weight:bold");
	$("#myforms-link").attr("style", "font-weight:normal");
	$("#templates").attr("style", "display:none");
	$("#mypages").attr("style", "display:block;font-weight:bold");
	$("#myforms").attr("style", "display:none");
}
function showMyForms(){
	$("#templates-link").attr("style", "font-weight:normal");
	$("#mypages-link").attr("style", "font-weight:normal");
	$("#myforms-link").attr("style", "font-weight:bold");
	$("#templates").attr("style", "display:none");
	$("#mypages").attr("style", "display:none");
	$("#myforms").attr("style", "display:block;font-weight:bold");
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