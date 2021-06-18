<?php
if (!defined('__ROOT__')) define ( '__ROOT__', dirname ( __FILE__ ) ) ;
include (__ROOT__ . '/views/_header.php');

require_once (__ROOT__ . '/classes/core/Log.php');
require_once (__ROOT__ . '/classes/pm/Template.php');
require_once (__ROOT__ . '/classes/pm/Page.php');

$log = $_SESSION['log'];
$user_name = $_SESSION ['user_name'];

$submit = isset($_GET['submit']) ? $_GET['submit'] : $_POST['submit'];
$template_id = isset($_GET['template']) ? $_GET['template'] : $_POST['template'];
$page_name = isset($_GET['page']) ? $_GET['page'] : $_POST['page'];

$log->debug("User name=".$user_name);

if ($submit == "delete"){
    if (isset($page_name)){
        $P = new Page();
        $P->deletePage($user_name, $page_name);
    }
}

$T = new Template();
$ts = $T->getAllTemplates();

$P = new Page();
$ps = $P->getPages($user_name);
?>

<link rel="stylesheet" href="/css/thumbnail.css">
<!-- Page content-->
<div class="container" style="padding: 5vh 0 0 0;">


   <div class="card card-feature">

       <div class="row">
       		<b class="card-feature__title">Choose a template</b>
       </div>

 		<div class="card card-feature text-lg-left mb-4 mb-lg-0">
           <div class="row">
              <?php foreach ($ts as $t) { ?>
            	  <div class="col">
            	  	<div class="overlay-image" style="width: 150px;">
            	  	  <a href="/redirect.php?view=editor_view&template=<?php echo $t['name']; ?>">
                      <img class="image" src="/img/<?php echo $t['name']; ?>.png" alt="Alt text"/>
                      <div class="normal">
                        <div class="text">
                        		<?php echo $t['name']; ?>
                         </div>
                      </div>
                      <div class="hover">
                        <div class="text">
                        +<br/><?php echo $t['name']; ?>
                        </div>
                      </div>
                      </a>
            	  </div>
           		</div>
        	   <?php } ?>
       		</div>

		</div>
    </div>


   <div class="card card-feature">

       <div class="row">
       		<b class="card-feature__title">My Pages</b>
       </div>

 		<div class="card card-feature text-lg-left mb-4 mb-lg-0">
           <div class="row">
              <?php foreach ($ps as $t) { ?>
            	  <div class="col">
            	  	<div class="overlay-image" style="width: 150px;">
            	  	  <a href="/redirect.php?view=editor_view&page=<?php echo $t['name']; ?>">
                	  	   <div class="thumbnail-container"  style="border: 3px #007c76 solid;">
                            <div class="thumbnail">
                				<?php echo $t['content']; ?>
                            </div>
                          </div>
                          <div class="hover">
                            <div class="text">
                            ><br/><?php echo $t['name']; ?>
                            </div>
                          </div>
                      </a>
            	  </div>
           		</div>
        	   <?php } ?>
       		</div>

		</div>
    </div>

</div>




<?php include (__ROOT__ . '/views/_footer.php'); ?>
</body>
</html>