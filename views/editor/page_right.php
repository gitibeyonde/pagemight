
<div class="container no_select">
	<div class="row">
	  <div class="col" style="text-align: right;">
		<a class="btn btn-link" href="/redirect.php?view=<?php echo LOGOUT_VIEW ?>"><i class="ti-power-off btn-logout"></i></a>
	  </div>
	</div>
	<hr/>

   &nbsp;&nbsp;Preview<a class="btn btn-link" href="/doin/lkp.php?id=<?php echo $page_code; ?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-new-window icon-green"></i></a>
   <hr/>


	&nbsp;&nbsp;<label id="console-event1">Public</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" id="toggle-event1" data-toggle="toggle" class="icon-blue" style="width: 26px; height: 26px;" <?php echo ($public == 1 ?  "checked" :  ""); ?> >

   <hr/>

<!--

	&nbsp;&nbsp;<label id="console-event2">Comments</label>&nbsp;&nbsp;
	<input type="checkbox" id="toggle-event2" data-toggle="toggle" data-on="<i class='ti-check'></i>"
			data-off="<i class='ti-close'></i>" <?php echo ($comment == 1 ? "checked" : ""); ?>>
   <hr/>
 -->


    <form action="/redirect.php"  method="get">
    <input type=hidden name="view" value="<?php echo UPLOAD_IMAGES; ?>">
    <input type=hidden name="page_code" value="<?php echo $page_code; ?>">
    &nbsp;&nbsp;<label>Images</label>
    <button type="submit" name="submit" value="toimages" class="btn btn-link">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus icon-green"></i></button>
    </form>

    <div class="row">
        <?php $Limges = $imgs->listImages($user_name);
        foreach($Limges as $imgurl){
            $name = basename($imgurl);
            $jsname = preg_replace("/[^A-Za-z0-9]/", '', $name);;
            echo "<img class='img-box' id='image-".$jsname."' src='".$imgurl."' width='25%' height='25%'  style='padding: 5px;'>";
        }
        ?>
    </div>

    <hr/>

    <form action="/redirect.php"  method="get">
    <input type=hidden name="view" value="<?php echo FORM_CREATE; ?>">
    <input type=hidden name="page_code" value="<?php echo $page_code; ?>">
    &nbsp;&nbsp;<label>Forms</label>
    <button type="submit" name="submit" value="toimages" class="btn btn-link">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus icon-green"></i></button>
    </form>

    <div class="row">
        <?php $forms = $kb->getForms();
        foreach($forms as $f){
            $meta = $kb->getFormMetadata($f);
            if ($f == "form_metadata")continue;
            echo "<p id='form-".$f."' class='img-box'>".$meta['form_name']."</p>";
        }
        ?>
    </div>
    <hr/>

</div>
 <script>
 <?php $Limges = $imgs->listImages($user_name);
 foreach($Limges as $imgurl){
     $name = basename($imgurl);
     $jsname = preg_replace("/[^A-Za-z0-9]/", '', $name);;
     ?>
 $("#<?php echo "image-".$jsname; ?>").click(function(){
     var src = '<?php echo $imgurl; ?>' ;
     console.log("Img URL=" + src);
     insertImageAtCursor(src);
  });
 <?php } ?>

 <?php $forms = $kb->getForms();
 foreach($forms as $f){
    if ($f == "form_metadata")continue;
        $meta = $kb->getFormMetadata($f);
     ?>
 $("#<?php echo "form-".$f; ?>").click(function(){
     var form_name = '<?php echo $meta['form_name']; ?>' ;
     console.log("Form name=" + form_name);
     insertAtCursor("<div id='<?php echo "form-".$f; ?>' class='col no_select' style='border: 3px silver solid;text-align: center;padding: 30px 20px 30px 20px;background: #f6f6f6;'>"
    	     + form_name + " will be substituted when page is rendered</div></div>");
  });
 <?php } ?>

 $("input[type=text]").on('input', function() {
   var c = this.selectionStart,
       r = /[^a-z0-9-_ ]/gi,
       v = $(this).val();
   if(r.test(v)) {
     $(this).val(v.replace(r, ''));
     c--;
   }
   this.setSelectionRange(c, c);
 });
 </script>
 <script>
  $(function() {
    $('#toggle-event1').change(function() {
		$public = $(this).prop('checked') ? 1 : 0;

    	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              if (this.responseText == 1){
           		$('#console-event1').html( $public == 1 ? $(this).prop('checked') : $(this).prop('unchecked') )
              }
          }
        };
        xmlhttp.open("GET", "/views/editor/api_update_page.php?uid=<?php echo $user_name; ?>&pid=<?php echo $page_id; ?>&a=u&public=" + $public, true);
        xmlhttp.send();

    })
  })

  $(function() {
    $('#toggle-event2').change(function() {
		$comment = $(this).prop('checked') ? 1 : 0;

    	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              if (this.responseText == 1){
             		$('#console-event2').html( $comment == 1 ? $(this).prop('checked') : $(this).prop('unchecked') )
              }
          }
        };
        xmlhttp.open("GET", "/views/editor/api_update_page.php?uid=<?php echo $user_name; ?>&pid=<?php echo $page_id; ?>&a=u&comment=" + $comment, true);
        xmlhttp.send();

    })
  })
</script>
