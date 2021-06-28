

        <button type="button" class="btn btn-link btn-icon" data-bs-toggle="modal" data-bs-target="#insertImageModal">
          <span class="material-icons md-36 orange">images</span>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="insertImageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Click on a image to insert:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               <p>To insert a images place your cursor on the page and then click on the image in this dialog</p>
                <div class="row">
                        <?php
                            $Limges = $imgs->listImages($user_name);
                            foreach($Limges as $imgurl){
                                $image_name = basename($imgurl);
                                $jsname = preg_replace("/[^A-Za-z0-9]/", '', $image_name);;
                                echo "<div class='col'><img class='img-box' id='image-".$jsname."' src='".$imgurl."'></div>";
                            }
                        ?>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>



 <script>

 <?php $Limges = $imgs->listImages($user_name);
 foreach($Limges as $imgurl){
     $image_name = basename($imgurl);
     $jsname = preg_replace("/[^A-Za-z0-9]/", '', $image_name);;
     ?>
 $("#<?php echo "image-".$jsname; ?>").click(function(){
     var src = '<?php echo $imgurl; ?>' ;
     console.log("Img URL=" + src);
     insertImageAtCursor(src);
  });
 <?php } ?>

 </script>