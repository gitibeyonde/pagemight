<?php
if (!defined('__ROOT__')) define ( '__ROOT__', dirname ( __FILE__ ) ) ;
include (__ROOT__ . '/views/_header.php');
require_once (__ROOT__ . '/classes/pm/Template.php');

$T = new Template();
$ts = $T->getAllTemplates();

?>

<link rel="stylesheet" href="/css/thumbnail.css">

<div class="container-fluid" style="padding: 20vh 0 25vh 0; background:transparent url('https://s3.ap-south-1.amazonaws.com/data.pagemight/0/img/bg/cycle-wall.jpg') no-repeat center center /cover">
    <div class="row">
      <div class="col-lg-1">
      </div>
      <div class="col-lg-10 m-auto d-flex justify-content-center">
         <h1 class="text-white" style="text-shadow: 0 0 5px var(--bs-red);">Build and Launch Awesome Landing Pages</h1>
      </div>
      <div class="col-lg-1">
      </div>
    </div>
</div>


<!-- Page content-->
<div class="container" style="padding: 2vh 1vh 50vh 1vh;">



  <span id="templates" style="display: block">
   <div  class="row"><h2 class="text-orange">Choose a template</h2>
   </div>


   <div class="row gx-1 gy-1">
     <?php foreach ($ts as $t) {
         ?>
	 <div class="col-12 col-sm-8 col-md-6 col-lg-4" >
		<div class="card" style="padding: 56px 0vh 0vh 56px;">
        	<div class="thumbnail-container">
                <div class="thumbnail">
    				<iframe src="/doin/lkt.php?id=<?php echo $t['name']; ?>"
                           onload="this.style.opacity = 1"> </iframe>
                </div>
            </div>
          <div class="card-img-overlay text-white d-flex flex-column justify-content-top">
          	<h4 class="card-title"  style="background-image: linear-gradient(to right, var(--bs-orange) , var(--bs-light));">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $t['name']; ?></h4>
          </div>

          <div class="card-img-overlay text-white d-flex flex-column justify-content-end">
              <a href="/redirect.php?view=editor_view&template=<?php echo $t['name']; ?>">
              	<span class="material-icons blue md-36"   style="background-color: var(--bs-white);">edit</span></a>
              	&nbsp;&nbsp;&nbsp;&nbsp;
              	<a href="/doin/lkt.php?id=<?php echo $t['name']; ?>" target="_blank">
              	<span class="material-icons green md-36"   style="background-color: var(--bs-white);">link</span></a>
              	&nbsp;&nbsp;&nbsp;&nbsp;
              	<a href="/redirect.php?view=template_editor&template_name=<?php echo $t['name']; ?>&submit=edit">
              	<span class="material-icons green md-36"   style="background-color: var(--bs-white);">settings</span></a>
		  </div>

	</div>
   </div>
   <?php } ?>
   </div>
  </span>


</div>

<?php
include (__ROOT__ . '/views/_footer.php');
?>
