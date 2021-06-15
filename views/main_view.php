<?php
if (!defined('__ROOT__')) define ( '__ROOT__', dirname ( __FILE__ ) ) ;
include (__ROOT__ . '/views/_header.php');

require_once (__ROOT__ . '/classes/core/Log.php');
require_once (__ROOT__ . '/classes/pm/Template.php');
require_once (__ROOT__ . '/classes/pm/Page.php');

$log = $_SESSION['log'];
$user_id = $_SESSION ['user_id'];

$log->debug("User id=".$user_id);

$T = new Template();
$ts = $T->getAllTemplates();

$P = new Page();
$ps = $P->getPages($user_id);
?>

<link rel="stylesheet" href="/css/thumbnail.css">
<!-- Page content-->
<div class="container">


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
                	  	   <div class="thumbnail-container">
                            <div class="thumbnail">
                              <iframe src="/views/editor/display.php?m=<?php echo urlencode(base64_encode($t['content'])); ?>"
                                           onload="this.style.opacity = 1" style="opacity: 1;border: 10px #007c76 solid;" > </iframe>
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