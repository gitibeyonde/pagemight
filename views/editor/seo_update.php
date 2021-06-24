<?php
include (__ROOT__ . '/views/_header.php');
include_once(__ROOT__ . '/classes/pm/Page.php');
include_once(__ROOT__ . '/classes/pm/Images.php');


$user_name = $_SESSION['user_name'];
$page_code = isset($_GET['page_code']) ? $_GET['page_code'] : $_POST['page_code'];
$submit = isset($_GET['submit']) ? $_GET['submit'] : null;


$SU = new Images();
$Limages = $SU->listImages($user_name);

$P = new Page();
if ($submit == "add"){
    $title = $_GET['title'];
    $description = $_GET['description'];
    $image = $_GET['image'];

    $p = $P->savePageSEO($user_name, $page_code, serialize(['title' => $title, 'description' => $description, 'image' => $image]));
}
else {
    $p = $P->getPageForUser($user_name, $page_code);
}


$seo = $p['seo'];

//title 60 chars
//meta_description 160 chars
//meta image

if (isset($seo) && strlen($seo) > 5){
    $seo_options = unserialize($seo);

    $title=$seo_options['title'];
    $description=$seo_options['description'];
    $img=$seo_options['image'];
}


?>

<!--

<meta property="og:title" content="European Travel Destinations">
<meta property="og:description" content="Offering tour packages for individuals or groups.">
<meta property="og:image" content="http://euro-travel-example.com/thumbnail.jpg">
<meta property="og:url" content="http://euro-travel-example.com/index.htm">
<meta name="twitter:card" content="summary_large_image">

 -->

<div class=container" style="padding: 4vh 20vh 0vh 15vh;">
    <form action="/redirect.php"  method="get">
    <input type=hidden name="view" value="<?php echo EDITOR_VIEW; ?>">
    <input type=hidden name="page_code" value="<?php echo $page_code; ?>">
    	<button type="submit" name="submit" value="editor" class="btn btn-link">Back&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-control-backward icon-blue"></i></button>
    </form>
</div>
 <div class=container" style="padding: 6vh 20vh 0vh 20vh;">
    <h3 class="sel0">Update SEO Info</h3>

  	<form action="/redirect.php?"  method="get">
        <input type=hidden name=view value="<?php echo SEO_UPDATE; ?>">
		<input type=hidden name="page_code" value="<?php echo $page_code; ?>">

        <div class="form-group form-fields">
            <label>Title: </label>
        	<input type="text" name="title" value="<?php echo $title; ?>" Placeholder="Title">
       	</div>

        <div class="form-group form-fields">
            <label>Desc: </label>
        	<textarea name="description" Placeholder="Description"><?php echo $description; ?></textarea>
       	</div>


        <div class="form-group form-fields">
            <label>Image: </label>
       	 	<?php echo "<select name='image'>";
                foreach ($Limages as $img) {
                    if ($img == $val){
                        echo "<option value='".$img."' selected>".basename($img)."</option>";
                    }
                    else {
                        echo "<option value='".$img."'>".basename($img)."</option>";
                    }
                }
                echo "</select>";
           ?>
         </div>

	      <div class="mb-3">
            <button type="submit" name="submit" value="add" class="btn btn-sim1">Upload</button>
          </div>

    </form>
    <hr/>
	<div class="row" style="background-color: #f0f0f0;">
		<div class="col-6">
			<img class="img-fluid" src="<?php echo $img; ?>"/>
		</div>
		<div class="col-6" style="padding: 5vh 0 0 0;">
			<h2><?php echo $title; ?></h2>
			<h6><?php echo $description; ?></h6>
		</div>
	</div>

 </div>
<script>
function copyToClipboard(text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
  }
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