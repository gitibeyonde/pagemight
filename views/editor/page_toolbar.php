<div class="container-fluid no_select">

   <!-- HEADER TOOLBAR 1 -->
      <div class="row header-toolbar">
         <!-- BACK -->
        <div class="col-1">
            <button type="submit" name="submit" value="back" class="btn btn-link  btn-icon"
							   onclick="return onClickSubmitButton('<?php echo MAIN_VIEW; ?>');">
            	<span class="material-icons md-36 blue">arrow_back</span></button>
        </div>


         <!-- NAME -->
        <div class="col-3">
			<?php if ($view == TEMPLATE_EDITOR) { ?>
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
								onclick="return onClickSubmitButton('<?php echo TEMPLATE_EDITOR; ?>');"><span class="material-icons md-36 green">save</span></button></button>
	    </div>


        <!-- DELETE -->
        <div class="col-1">
        </div>


        <!-- HTML TOGGLE -->
        <div class="col-2">
            <input type="checkbox" name="switchMode" onchange="setDocMode(this.checked);" /> <label for="switchBox">HTML</label>
        </div>


        <!-- DELETE -->
        <div class="col-1">
        </div>

        <!-- HTML CSS JS SELECTOR -->
		<?php if ($view == TEMPLATE_EDITOR) { ?>
		<div class="col-1">
    			<a class="btn btn-sim0" href="/redirect.php?view=template_editor&template_name=<?php echo $template_name; ?>"><b>HTML</b></a>
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
               Preview<a class="btn btn-link" href="/doin/lkp.php?id=<?php echo $page_code; ?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-new-window icon-green"></i></a>
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
                <form action="/redirect.php"  method="get">
                <input type=hidden name="view" value="<?php echo SEO_UPDATE; ?>">
                <input type=hidden name="page_code" value="<?php echo $page_code; ?>">
                &nbsp;&nbsp;<label>SEO</label>
                <button type="submit" name="submit" value="toimages" class="btn btn-link">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus icon-green"></i></button>
                </form>
		</div>
       <?php } else { ?>
		<div class="col-2" >
               Preview<a class="btn btn-link btn-icon" href="/doin/lkt.php?id=<?php echo $template_name; ?>" target="_blank">
               <span class="material-icons md-36 blue">preview</span></a>
        </div>
       <?php } ?>

		<div class="col-2" >
            <form class="form-inline" action="/redirect.php"  method="get">
            <input type=hidden name="view" value="<?php echo UPLOAD_IMAGES; ?>">
            <input type=hidden name="page_code" value="<?php echo $page_code; ?>">
            <input type=hidden name="template_name" value="<?php echo $template_name; ?>">
            <label>Images</label>
            <button type="submit" name="submit" value="toimages" class="btn btn-link  btn-icon"><span class="material-icons md-36 green">upload</span></button>
            </form>
        </div>

        <?php if ($view == EDITOR_VIEW) { ?>
		 <div class="col-2" >
                <form action="/redirect.php"  method="get">
                <input type=hidden name="view" value="<?php echo FORM_CREATE; ?>">
                <input type=hidden name="page_code" value="<?php echo $page_code; ?>">
                &nbsp;&nbsp;<label>Forms</label>
                <button type="submit" name="submit" value="toimages" class="btn btn-link">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus icon-green"></i></button>
                </form>
         </div>
        <?php } ?>


   </div>

   <!-- TOOLBAR TWO -->

     <div class="row">
		<div class="col-12 toolbar" id="toolBar2">


		<?php include_once(__ROOT__ . '/views/editor/modals/_hero_modal.php');?>
		<?php include_once(__ROOT__ . '/views/editor/modals/_col_modal.php');?>

		<?php include_once(__ROOT__ . '/views/editor/modals/_icon_modal.php');?>
		<?php include_once(__ROOT__ . '/views/editor/modals/_image_modal.php');?>


        </div>

     </div>
 </div>
