
<div class=container-fluid" style="margin: 0 0 20vh 0;">
<div id="propertiesBar" class="toolbar">

    <!--
    /* The hero image */
    .hero-image {
      /* Use "linear-gradient" to add a darken background effect to the image (photographer.jpg). This will make the text easier to read */
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("photographer.jpg");

      /* Set a specific height */
      height: 50%;

      /* Position and center the image to scale nicely on all screens */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }

    /* Place text in the middle of the image */
    .hero-text {
      text-align: center;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
    }
    -->


    <div class="hero-properties">
      <div class="row">
    		<p>Select background image:</p>
 			<?php include_once(__ROOT__ . '/views/editor/modals/_image_modal.php'); ?>
    	</div>
      <div class="row">
    	<div class="col-12">
    		Adjust Height
    		<button>20%</button>
    		<button>30%</button>
    		<button>40%</button>
    		<button>50%</button>
    		<button>60%</button>
    	</div>
    	<div>
    		Text align
    		<button>Center</button>
    		<button>Left</button>
    		<button>Right</button>
    	</div>
     </div>

</div>
</div>
<script>

'use strict';

const prop_map = { 'hero-image' : 'hero-properties',
					'row' : 'row-properties'
			};

function hideAll(){
	for (const [key, value] of Object.entries(prop_map)) {
		  console.log(key, value);
		  $("." + value).hide();
	}
}

function openProperties(section){
	hideAll();
	var prop_class = $(section).attr("class")
	console.log(prop_class);
	var prop_properties = prop_map[prop_class];
	console.log(prop_properties);
	$("." + prop_properties).show();

}

</script>