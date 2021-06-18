
<?php
define ( '__ROOT__', dirname ( dirname ( __FILE__ ) ) );
include_once(__ROOT__ . '/views/_header.php');
include_once(__ROOT__ . '/classes/pm/UserForm.php');
include_once(__ROOT__ . '/classes/core/Log.php');
require_once (__ROOT__ . '/classes/core/Utils.php');

$_SESSION['log'] = new Log ("info");
$_SESSION['message'] = "";
$user_name = $_SESSION['user_name'];


$submit = isset($_GET['submit']) ? $_GET['submit'] : null;
$count = isset($_GET['count']) ? $_GET['count'] : 0;
$tabella = isset($_GET['tabella']) ? $_GET['tabella'] : null;
$page_name = isset($_GET['page']) ? $_GET['page'] : null;

$kb = new UserForm($user_name);

$col = array();
$input = array();
if ($submit == "addtable"){
    if ($count == 0) {
        $_SESSION['message']  = "Table creation requires at least one column";
    }
    else {
        for ($i=0;$i<$count; $i++){
            array_push($col, $_GET["col".$i]);
            array_push($input, $_GET["input".$i]);
        }
        $kb->createFormTable($tabella, $col, $input);
    }
    //reset
    $col = array();
    $input = array();
    $count=0;
    $tabella = null;
}
else  if ($submit == "addcolumn"){
    $count = $count +1;
    for ($i=0;$i<$count; $i++){
        array_push($col, $_GET["col".$i]);
        array_push($input, $_GET["input".$i]);
    }
}
else  if ($submit == "removecolumn"){
    $count = $count -1;
    for ($i=0;$i<$count; $i++){
        array_push($col, $_GET["col".$i]);
        array_push($input, $_GET["input".$i]);
    }
}
else if ($submit == "delete"){
    try {
        $kb->deleteForm($tabella);
    }
    catch (Exception $e){
        $_SESSION['message']  = "Delete Failed". $e->getMessage();
    }
}

?>

<div class=container" style="padding: 4vh 20vh 0vh 15vh;">
    <form action="/redirect.php"  method="get">
    <input type=hidden name=view value="<?php echo EDITOR_VIEW; ?>">
    <input type=hidden name=page value="<?php echo $page_name; ?>">
    	<button type="submit" name="submit" value="editor" class="btn btn-link">Back&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-control-backward"></i></button>
    </form>
</div>
 <div class=container" style="padding: 6vh 20vh 0vh 20vh;">
    <h3 class="sel0">Manage Forms</h3>
    <br/>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <p>Create form by creating the input fields you want to be captured by the form.
            Provide name of the form field, and type of the form field.</p>

          	<form action="/redirect.php?"  method="get">
                <input type=hidden name=view value="<?php echo CREATE_FORMS; ?>">
    			<input type=hidden name=page value="<?php echo $page_name; ?>">

                <div class="form-group">
                    <label>Form Name</label>
                	<input type="text" name="tabella" value="<?php echo $tabella; ?>" Placeholder="Form Name" required>
               	</div>

                <?php for ($i=0;$i<$count; $i++) {
                    echo '<div class="form-group">';
                    echo '<input type=text name=col'.$i.' value="'.$col[$i].'" readonly>';
                    echo '<input type=text name=input'.$i.' value="'.$input[$i].'" readonly>';
                    if ($i == $count -1){
                        echo '<button class="btn btn-sim3" type="submit" name="submit" value="removecolumn">X</button>';
                    }
                    echo '</div>';

                 } ?>

                 <div class="form-group">
                    <label>Field Name</label>
                    <input type=text name="col<?php echo $count; ?>" value="" Placeholder="Field Name">

                    <label>Input Type</label>
                    <select id="input" name="input<?php echo $count; ?>"'.$i.'>
                    <option value="text">text</option>
                    <option value="number">number</option>
                    <option value="textarea">textarea</option>
                    <option value="tel">tel</option>
                    <option value="email">email</option>
                    <option value="file">file</option>
                    <option value="color">color</option>
                    <option value="date">date</option>
                    <option value="time">time</option>
                    <option value="url">url</option>
                    <option value="image">image</option>
                    <option value="week">week</option>
                    <option value="range">range</option>
                    </select>
                    <input type=hidden name=count value="<?php echo $count; ?>">
                	<button class="btn btn-sim3" type="submit" name="submit" value="addcolumn">+</button>
                </div>


                <div class="row">
                     <div class="form-group col-6">
                        	<button class="btn btn-sim1 btn-block" type="submit" name="submit" value="addtable">Create Form</button>
                	 </div>
                </div>
          </form>
      </div>
  </div>
<hr/>
  <div class="row">
    <div class="col">
        <h3>Forms</h3>
   </div>
  </div>

  <div class="row">
    <div class="col">
        Name
    </div>
    <div class="col">
        Row
    </div>
    <div class="col">
        Columns
    </div>
    <div class="col">
        Delete
    </div>
  </div>
  <hr/>

    <?php foreach( $kb->ls() as $tn){
    if ($tn == "form_metadata") continue;
        ?>
      <div class="row">
        <div class="col">
             <?php echo $tn; ?>
        </div>
        <div class="col">
             <?php echo $kb->row_count($tn); ?>
        </div>
        <div class="col">
             <?php echo Utils::flatten($kb->t_columns($tn)); ?>
        </div>
        <div class="col">
            <?php echo $kb->getFormType($tn); ?>
        </div>
        <div class="col">
            <form action="/redirect.php?"  method="get" style="float: left;" >
                <input type=hidden name=view value="<?php echo CREATE_FORMS ?>">
                <input type=hidden name=tabella value="<?php echo $tn; ?>">
    			<input type=hidden name=page value="<?php echo $page_name; ?>">
                <button class="btn btn-sim2" type="submit" name="submit" value="delete">Delete</button>
            </form>
        </div>
      </div>
  <?php } ?>



</div>


<?php
include(__ROOT__.'/views/_footer.php');
?>
</body>