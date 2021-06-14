

<div class="container">

    <div id="message_image_tool">
       <br/>
        <div class="row sel1">
            <h3>Insert Image</h3>
        </div>
        <div class="row">
            <?php $Limges = PageUtils::getImageList($bot_id);
            foreach($Limges as $imgurl){
                $name = basename($imgurl);
                $jsname = preg_replace("/[^A-Za-z0-9]/", '', $name);;
                echo "<img id='".$jsname."' src='".$imgurl."' width='25%' height='25%'  style='padding: 5px;'>";
            }
            ?>
        </div>
    </div>



    <div id="forms_tool">
       <br/>
        <div class="row sel1">
            <h3>Insert Form</h3>
        </div>
        <br/>
        <div class="row">
            <?php $forms = PageUtils::getForms($user_id);
            foreach($forms as $f){
                if ($f == "form_metadata")continue;
                echo "<h1 id=".$f." class='img-box'>".$f."</h1>";
            }
            ?>
        </div>
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
