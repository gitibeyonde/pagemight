
<div class="container">

   &nbsp;&nbsp;Preview<a class="btn btn-link" href="https://1do.in/<?php echo $P->getPageUrlCode($user_name, $page_id); ?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-new-window"></i></a>
   <hr/>


	&nbsp;&nbsp;<label id="console-event1">Public</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" id="toggle-event1" data-toggle="toggle" data-on="<i class='ti-world'></i>"
			data-off="<i class='ti-na'></i>" style="width: 26px; height: 26px;" <?php echo ($public == 1 ?  "checked" :  ""); ?> >

   <hr/>

<!--

	&nbsp;&nbsp;<label id="console-event2">Comments</label>&nbsp;&nbsp;
	<input type="checkbox" id="toggle-event2" data-toggle="toggle" data-on="<i class='ti-check'></i>"
			data-off="<i class='ti-close'></i>" <?php echo ($comment == 1 ? "checked" : ""); ?>>
   <hr/>
 -->


    <form action="/redirect.php"  method="get">
    <input type=hidden name=view value="<?php echo UPLOAD_IMAGES; ?>">
    <input type=hidden name=page value="<?php echo $page_name; ?>">
    &nbsp;&nbsp;<label>Images</label>
    <button type="submit" name="submit" value="toimages" class="btn btn-link">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus"></i></button>
    </form>

    <div class="row">
        <?php $Limges = PageUtils::getImageList($user_name);
        foreach($Limges as $imgurl){
            $name = basename($imgurl);
            $jsname = preg_replace("/[^A-Za-z0-9]/", '', $name);;
            echo "<img class='img-box' id='".$jsname."' src='".$imgurl."' width='25%' height='25%'  style='padding: 5px;'>";
        }
        ?>
    </div>

    <hr/>

    <form action="/redirect.php"  method="get">
    <input type=hidden name=view value="<?php echo CREATE_FORMS; ?>">
    <input type=hidden name=page value="<?php echo $page_name; ?>">
    &nbsp;&nbsp;<label>Forms</label>
    <button type="submit" name="submit" value="toimages" class="btn btn-link">&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus"></i></button>
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
 <?php $Limges = PageUtils::getImageList($user_name);
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
