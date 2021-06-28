<?php

$id=Utils::rand10();

$hero_html = '
<div  id="'.$id.'"  class="hero-image">
  <div class="hero-text">
    <h1>I am John Doe</h1>
    <p>And I\'m a Photographer</p>
    <button>Hire me</button>
  </div>
</div>';

$hero_css = '
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
}';


?>
<style>

#insertColumnModal > * > * > * > * > * > * {
  border: 1px dotted red;
}

#insertColumnModal > * > * > * > * > * > * > * {
  border: 1px dotted blue;
}
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
</style>


    <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
        <div  id="temp-<?php echo $id; ?>" draggable="true" ondragstart="drag(event)" >
		<span type="button" class="material-icons md-36 blue">view_day</span>
        <div  id="perm-<?php echo $id; ?>"  class="hero-image" draggable="true" ondragstart="drag(event)" style="display: none">
          <div class="hero-text" >
            <h1>I am John Doe</h1>
            <p>And I\'m a Photographer</p>
            <button>Hire me</button>
          </div>
        </div>
        </div>
   </div>


        <script>
			function setRowAlignment(align){
				$('[class*="col"]').css('text-align', align);
			}

			function onClickRow(e){
				console.log(e);
				console.log(e.id);
				console.log($(e).attr("class"));
				console.log(e.children);
				insertAtCursor(e.outerHTML);
			}

        </script>