<div class="container-fluid no_select">

   <!-- HEADER TOOLBAR 1 -->
      <div id="headerToolbar" class="row">
         <!-- BACK -->
        <div class="col-1">
            <button type="submit" name="submit" value="back" class="btn btn-link  btn-icon"
							   onclick="return onClickSubmitButton('<?php echo MAIN_VIEW; ?>');">
            	<span class="material-icons md-36 blue">arrow_back</span></button>
        </div>


         <!-- NAME -->
        <div class="col-3">
			<?php if ($view == TEMPLATE_HTML) { ?>
			   <input type="text" name="template_name" placeholder="template name" size="16" value="<?php echo $template_name; ?>"
            												style="border: 0px;text-decoration: underline;" required>
			<?php } else { ?>
			   <input type="text" name="page_code" placeholder="page_code" size="16" value="<?php echo $page_code; ?>"
            														style="border: 0px;text-decoration: underline;" required>
			<?php } ?>
	    </div>


         <!-- SAVE -->
        <div class="col-1">
            <button type="submit" id="save_content" name="submit" value="update" class="btn btn-link btn-icon"
								onclick="return onClickSubmitButton('<?php echo TEMPLATE_HTML; ?>');"><span class="material-icons md-36 green">save</span></button></button>
	    </div>


        <!-- XXX -->
        <div class="col-1">
        </div>


        <!-- HTML TOGGLE -->
        <div class="col-2">
            <input type="checkbox" name="switchMode" onchange="setDocMode(this.checked);" /> <label for="switchBox">HTML</label>
        </div>


        <!-- XXX -->
        <div class="col-1">
        </div>

        <!-- HTML CSS JS SELECTOR -->
		<?php if ($view == TEMPLATE_HTML) { ?>
		<div class="col-1">
    			<a class="btn btn-sim0" href="/redirect.php?view=template_html&template_name=<?php echo $template_name; ?>"><h2>HTML</h2></a>
		</div>
		<div class="col-1">
    			<a class="btn btn-sim0" href="/redirect.php?view=template_css&template_name=<?php echo $template_name; ?>"><b>CSS</b></a>
		</div>
		<div class="col-1">
    			<a class="btn btn-sim0" href="/redirect.php?view=template_js&template_name=<?php echo $template_name; ?>"><b>JS</b></a>
		</div>
		<?php } else { ?>
		<div class="col-1">
    			<a class="btn btn-sim0" href="/redirect.php?view=editor_view&page_code=<?php echo $page_code; ?>"><b>HTML</b></a>
		</div>
		<div class="col-1">
    			<a class="btn btn-sim0" href="/redirect.php?view=editor_css&page_code=<?php echo $page_code; ?>"><b>CSS</b></a>
		</div>
		<div class="col-1">
    			<a class="btn btn-sim0" href="/redirect.php?view=editor_js&page_code=<?php echo $page_code; ?>"><b>JS</b></a>
		</div>
		<?php } ?>

      </div>

   <!-- TOOLBAR 1 -->
      <div id="toolBar1" class="row toolbar">

        <?php if ($view == EDITOR_VIEW) { ?>
		<div class="col-2" >
               <a class="btn btn-link" href="/doin/lkp.php?id=<?php echo $page_code; ?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-new-window icon-green"></i></a>
		</div>
		<div class="col-2" >
            	<label id="console-event1">Public</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	<input type="checkbox" id="toggle-event1" data-toggle="toggle" class="icon-blue" style="width: 26px; height: 26px;" <?php echo ($public == 1 ?  "checked" :  ""); ?> >

        </div>
		<div class="col-2" >

            	<label id="console-event2">Comments</label>&nbsp;&nbsp;
            	<input type="checkbox" id="toggle-event2" data-toggle="toggle" class="icon-blue" style="width: 26px; height: 26px;"  <?php echo ($comment == 1 ? "checked" : ""); ?> >

        </div>
		<div class="col-2" >
		<button type="submit" name="submit" value="back" class="btn btn-link  btn-icon"
							   onclick="return onClickSubmitButton('<?php echo SEO_UPDATE; ?>');">
                &nbsp;&nbsp;SEO
                </button>
		</div>
       <?php } else { ?>
		<div class="col-2" >
               <a class="btn btn-link btn-icon" href="/doin/lkt.php?id=<?php echo $template_name; ?>" target="_blank">
               <span class="material-icons md-36 blue">preview</span></a>
        </div>
       <?php } ?>

		<div class="col-2" >
				<button type="submit" name="submit" value="back" class="btn btn-link  btn-icon"
							   onclick="return onClickSubmitButton('<?php echo UPLOAD_IMAGES; ?>');">
                <span class="material-icons md-36 red">images</span></button>
        </div>

        <?php if ($view == EDITOR_VIEW) { ?>
		 <div class="col-2" >
				<button type="submit" name="submit" value="back" class="btn btn-link  btn-icon"
							   onclick="return onClickSubmitButton('<?php echo FORM_CREATE; ?>');">
                &nbsp;&nbsp;FORMS
                </button>
         </div>
        <?php } ?>


   </div>

   <!-- TOOLBAR TWO -->

     <div id="toolBar2" class="row">
        <!--  *** HERO **/ -->
		<div class="col-1">
            <div id="drag-cover" ondrop="drop(event)" ondragover="allowDrop(event)">
             <div  id="temp-<?php echo $id = Utils::rand10(); ?>" draggable="true" ondragstart="drag(event)" >
        		<img id="imag-<?php echo $id; ?>" class="img-fluid" src="/img/editor/hero.png" width="200px" height="150p">

                <div  id="perm-<?php echo $id; ?>"  class="hero-image" draggable="true" ondragstart="drag(event)" style="display: none"  onclick="openProperties(this);">
                  <div class="hero-text" >
                    <h1>I am John Doe</h1>
                    <p>And I\'m a Photographer</p>
                    <button>Hire me</button>
                  </div>
                </div>
             </div>
           </div> <!-- drag-cover -->
		</div>

        <!--  *** HERO **/ -->
		<div class="col-1">
		 <div id="drag-cover" ondrop="drop(event)" ondragover="allowDrop(event)">
           <div  id="temp-<?php echo $id = Utils::rand10(); ?>" draggable="true" ondragstart="drag(event)" >
				<img id="imag-<?php echo $id; ?>" class="img-fluid" src="/img/editor/col1.png" width="200px" height="150p">

                <div  id="perm-<?php echo $id; ?>"  class="row" draggable="true" ondragstart="drag(event)" style="display: none"  onclick="openProperties(this);">
                  <div class="col-12" >
						COL1
                  </div>
                </div>
              </div>
           </div>
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		 <div id="drag-cover" ondrop="drop(event)" ondragover="allowDrop(event)">
           <div  id="temp-<?php echo $id = Utils::rand10(); ?>" draggable="true" ondragstart="drag(event)" >
			  <img id="imag-<?php echo $id; ?>" class="img-fluid" src="/img/editor/col2.png" width="200px" height="150p">
                <div  id="perm-<?php echo $id; ?>"  class="row" draggable="true" ondragstart="drag(event)" style="display: none"  onclick="openProperties(this);">
                  <div class="col-6" >
					COL1
                  </div>
                  <div class="col-6" >
					COL2
                  </div>
                </div>
           </div>
          </div>
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		 <div id="drag-cover" ondrop="drop(event)" ondragover="allowDrop(event)">
           <div  id="temp-<?php echo $id = Utils::rand10(); ?>" draggable="true" ondragstart="drag(event)" >
			  <img id="imag-<?php echo $id; ?>" class="img-fluid" src="/img/editor/col3.png" width="200px" height="150p">
                <div  id="perm-<?php echo $id; ?>"  class="row" draggable="true" ondragstart="drag(event)" style="display: none"  onclick="openProperties(this);">
                  <div class="col-md-4 col-sm-12">
					COL1
                  </div>
                  <div class="col-md-4 col-sm-12">
					COL2
                  </div>
                  <div class="col-md-4 col-sm-12">
					COL3
                  </div>
                </div>
             </div>
           </div>
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		<img class="img-fluid" src="/img/editor/col4.png" width="200px" height="150p">
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		</div>
        <!--  *** HERO **/ -->
		<div class="col-1">
		</div>

        </div>

 </div>
