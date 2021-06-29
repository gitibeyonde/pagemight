
<div class=container-fluid">
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
    	<div class="col-12">
    		Background Image
    	</div>
    	<div class="col-12">
    		Height
    	</div>
    	<div>
    		Text align
    	</div>
     </div>
    </div>

</div>
</div>
<script>

'use strict';

const prop_map = { 'hero-header' : 'hero-properties' };

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