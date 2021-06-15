

<div class="container">

   <a class="btn btn-link" href="https://1do.in/<?php echo $P->getPageUrlCode($user_id, $page_id); ?>" target="_blank">Preview&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-new-window"></i></a>
   <hr/>

	<a class="btn btn-link" href="https://1do.in/<?php echo $P->getPageUrlCode($user_id, $page_id); ?>" target="_blank">Public&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-world"></i></a>
	<a class="btn btn-link" href="https://1do.in/<?php echo $P->getPageUrlCode($user_id, $page_id); ?>" target="_blank">Private&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-na"></i></a>
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
    <button type="submit" name="submit" value="toimages" class="btn btn-link">Forms&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-plus"></i></button>
    </form>
    <hr/>

    <div class="row">
        <?php $forms = PageUtils::getForms($user_id);
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

 <?php $forms = PageUtils::getForms($user_id);
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
