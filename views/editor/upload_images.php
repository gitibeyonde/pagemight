<?php
include (__ROOT__ . '/views/_header.php');
include_once(__ROOT__ . '/classes/pm/Images.php');

$user_id = $_SESSION['user_id'];
$SU = new Images();
$page_name = $_GET['page'];

$msg="";
if (isset($_POST['submit'])){
    $submit = $_POST['submit'];
    error_log("submit =" . $submit);
    if ($submit == "add"){
        $name=$_POST['name'];

        $error = false;
        if ($_FILES["fileToUpload"]["error"] != 0){
            error_log(' File upload failed for '.$_FILES["fileToUpload"]["name"] . ' with error ' . $_FILES["fileToUpload"]["error"] . ' size is ' . $_FILES["fileToUpload"]["size"]);
            $msg=" Unknown error ";
            $error = true;
        }

        if ($_FILES["fileToUpload"]["type"] != 'image/jpeg' && $_FILES["fileToUpload"]["type"] != 'image/png' && $_FILES["fileToUpload"]["type"] != 'image/jpg' ){
            error_log(' - bad format for '.$_FILES["fileToUpload"]["name"] . ' with error ' .$_FILES["fileToUpload"]["type"]);
            $msg=$msg." Illegal Format, Use jpg/jpeg/png ";
            $error = true;
        }

        if ($_FILES["fileToUpload"]["size"] > 2500000) {
            error_log('File is too large for '.$_FILES["fileToUpload"]["name"] . ' with error ' . $_FILES["fileToUpload"]["size"]);
            $msg=$msg." File size of less than 2MB is allowed ";
            $error = true;
        }
        if ($user_id == null){
            $msg=$msg." Authorization error ";
            $error = true;
        }
        if ($error){
            $_SESSION['message']=$msg;
        }
        else {
            $filename = $_FILES["fileToUpload"]["tmp_name"];
            $log->debug("Upload file=".$_FILES["fileToUpload"]["name"]);
            $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
            $SU->uploadFilePageMight($user_id."/img/".$name.".".$ext, $filename);
        }

    }
}

if ($submit == "delete"){
    $basename = $_GET['basename'];
    $SU->deleteImage($user_id."/img/".$basename);
    $log->debug("Deleting".$user_id."/img/".$basename);
}

$images = $SU->listImages($user_id);
$count = $SU->imageCount($user_id);
?>


<div class=container" style="padding: 4vh 20vh 0vh 15vh;">
    <form action="/redirect.php"  method="get">
    <input type=hidden name=view value="<?php echo EDITOR_VIEW; ?>">
    <input type=hidden name=page value="<?php echo $page_name; ?>">
    	<button type="submit" name="submit" value="editor" class="btn btn-link">Back&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-control-backward"></i></button>
    </form>
</div>
 <div class=container" style="padding: 6vh 20vh 0vh 20vh;">
    <h3 class="sel0">Manage Media</h3>
    <br/>
        <?php if ($count > 100) {
                echo "<b> You have exceeded the quota of 100 images, delete some to upload</b>";
         } else { ?>
              <form action="/redirect.php?view=<?php echo UPLOAD_IMAGES; ?>"  method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="textInput">Image Name:</label>
                  <input id="textInput" type="text" class="form-control" id="name" placeholder="Enter Image Name" name="name" required>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>

		      <div class="mb-3">
                <label for="sel1">Upload:</label>
                <input type="file" class="form-control-file border" name="fileToUpload" id="fileToUpload" required>
              </div>

		      <div class="mb-3">
                <button type="submit" name="submit" value="add" class="btn btn-sim1">Upload</button>
              </div>
            </form>
         <?php } ?>
         <br/>
        <b> <?php echo $count; ?> images available</b>
        <br/>
        <div class="row">
        <?php foreach ($images as $img) { ?>
            <div class="col">
                <img width="100px" src="<?php echo $img."?rand=".rand(); ?>">
                 <p id="<?php echo str_replace(".", "", basename($img)); ?>"><h6><?php echo basename($img); ?></h6></p>
                <button onclick="copyToClipboard('<?php echo $img; ?>')" class="btn btn-sim1">
                            <i class="ti-layers"></i></button>
                <form action="/redirect.php"  method="get" style="float: left;" onsubmit="return confirm('Do you want delete this Image ?');">
                <input type=hidden name=view value="<?php echo UPLOAD_IMAGES; ?>">
                <input type=hidden name=basename value="<?php echo basename($img); ?>">
                <button type="submit" name="submit" value="delete" class="btn btn-sim2">
                            <i class="ti-trash"></i></button>
                </form>
            </div>
        <?php } ?>
        </div>
 </div>


<script>
$('#textInput').on('input', function() {
	  var c = this.selectionStart,
	      r = /[^a-z0-9_\- ]/gi,
	      v = $(this).val();
	  if(r.test(v)) {
	    $(this).val(v.replace(r, ''));
	    c--;
	  }
	  this.setSelectionRange(c, c);
	});
</script>
<?php include (__ROOT__ . '/views/_footer.php'); ?>
</body>
</html>