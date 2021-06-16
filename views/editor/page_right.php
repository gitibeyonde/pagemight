
<div class="container">

   <a class="btn btn-link" href="https://1do.in/<?php echo $P->getPageUrlCode($user_name, $page_id); ?>" target="_blank">Preview&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-new-window"></i></a>
   <hr/>


	&nbsp;&nbsp;<label id="console-event1">Private</label>
	<input type="checkbox" id="toggle-event1" data-toggle="toggle" data-on="<i class='ti-world'></i>"
			data-off="<i class='ti-na'></i>" size="small" onstyle="warning" offstyle="info" >
   <hr/>


	&nbsp;&nbsp;<label id="console-event2">Comments</label>
	<input type="checkbox" id="toggle-event2" data-toggle="toggle" size="small" onstyle="warning" offstyle="info" data-on="<i class='ti-check'></i>"
			data-off="<i class='ti-close'></i>">
   <hr/>

    <form action="/redirect.php"  method="get">
    <input type=hidden name=view value="<?php echo UPLOAD_IMAGES; ?>">
    <input type=hidden name=page value="<?php echo $page_name; ?>">
    <button type="submit" name="submit" value="toimages" class="btn btn-link">Images&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus"></i></button>
    </form>
    <hr/>

    <div class="row">
        <?php $Limges = PageUtils::getImageList($bot_id);
        foreach($Limges as $imgurl){
            $name = basename($imgurl);
            $jsname = preg_replace("/[^A-Za-z0-9]/", '', $name);;
            echo "<img id='".$jsname."' src='".$imgurl."' width='25%' height='25%'  style='padding: 5px;'>";
        }
        ?>
    </div>


    <form action="/redirect.php"  method="get">
    <input type=hidden name=view value="<?php echo CREATE_FORMS; ?>">
    <input type=hidden name=page value="<?php echo $page_name; ?>">
    <button type="submit" name="submit" value="toimages" class="btn btn-link">Forms&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus"></i></button>
    </form>
    <hr/>

    <div class="row">
        <?php $forms = PageUtils::getForms($user_name);
        foreach($forms as $f){
            if ($f == "form_metadata")continue;
            echo "<h1 id=".$f." class='img-box'>".$f."</h1>";
        }
        ?>
    </div>

</div>
 <script>
 <?php $Limges = PageUtils::getImageList($bot_id);
 foreach($Limges as $imgurl){
     $name = basename($imgurl);
     $jsname = preg_replace("/[^A-Za-z0-9]/", '', $name);;
     ?>
 $("#<?php echo $jsname; ?>").click(function(){
     var src = '<img class="img-fluid" src="<?php echo $imgurl; ?>">\n' ;
     console.log("Img URL=" + src);
     insertAtCursor(src);
  });
 <?php } ?>

 <?php $forms = PageUtils::getForms($user_name);
 foreach($forms as $f){ ?>
 $("#<?php echo $f; ?>").click(function(){
     var form_name = '<?php echo $f; ?>' ;
     console.log("Form name=" + form_name);
     insertAtCursor("<div class=form>" + form_name + "</div>");
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
             		$('#console-event1').html( $public == 1 ? "Public" : "Private" )
              }
          }
        };
        xmlhttp.open("GET", "/views/editor/api_update_page.php?uid=<?php echo $user_name; ?>&pid=<?php echo $page_id; ?>&a=u&public=" + $public, true);
        xmlhttp.send();

    })
  })
</script>
