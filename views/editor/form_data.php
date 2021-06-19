<?php
define ( '__ROOT__', dirname ( dirname ( __FILE__ ) ) );
include_once(__ROOT__ . '/views/_header.php');
include_once(__ROOT__ . '/classes/pm/UserForm.php');
include_once(__ROOT__ . '/classes/core/Log.php');
require_once (__ROOT__ . '/classes/core/Utils.php');

$_SESSION['message'] = "";
$user_name = $_SESSION['user_name'];

$kb = new UserForm($user_name);

$tabella = isset($_GET['tabella']) ? $_GET['tabella'] : null;
$rowid = isset($_GET['rowid']) ? $_GET['rowid'] : null;
$submit = isset($_GET['submit']) ? $_GET['submit'] : null;

if($submit == "saverow"){
    $sql = "update ".$tabella." set ";
    $headers = $kb->t_columns($tabella);
    foreach($headers as $head){
        $sql.= "`".$head."`='".$_GET[$head]."', ";
    }
    $sql = substr($sql, 0, strlen($sql)-2);
    $sql .= " where rowid = ".$rowid;
    error_log( $sql);
    $kb->t_crtinsupd($sql);
}
else if ($submit == "delrow"){
    $sql = "delete from ".$tabella." where rowid=".$rowid;
    error_log( $sql);
    $kb->t_crtinsupd($sql);
}
else if ($submit == "addrow"){
    $sql = "insert into ".$tabella." values (";
    $headers = $kb->t_columns($tabella);
    error_log(print_r($headers, true));
    foreach($headers as $head){
        $sql.= "'".$_GET[$head]."', ";
    }
    $sql = substr($sql, 0, strlen($sql)-2);
    $sql .= ")";
    error_log( $sql);
    $kb->t_crtinsupd($sql);
}

?>

<div class=container" style="padding: 4vh 20vh 0vh 15vh;">
    <form action="/redirect.php"  method="get">
    <input type=hidden name=view value="<?php echo MAIN_VIEW; ?>">
    	<button type="submit" name="submit" value="editor" class="btn btn-link">Back&nbsp;&nbsp;&nbsp;&nbsp;<i class="ti-control-backward"></i></button>
    </form>
</div>
 <div class=container" style="padding: 6vh 20vh 0vh 20vh;">
    <h3 class="sel0"><?php echo $tabella; ?></h3>

    <table class="table table-striped">
    <thead>
    <tr>
    <th>
    <h4>id</h4>
    </th>
    <?php
    $headers = $kb->t_columns($tabella);
    foreach($headers as $head){
        echo "<th><h4>".$head."</h4></th>";
    }
    ?>
    <th>
    <h4>edit</h4>
    </th>
    <th>
    <h4>del</h4>
    </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $rows = $kb->multiple_rows_cols("select rowid, * from ".$tabella." order by rowid desc;");
    foreach($rows as $row){

        echo "<tr>";
        if ($submit == "editrow"){
            echo '<form action="/redirect.php"  method="get" style="float: left;">';
            foreach($row as $key=>$val){
                if (in_array($key, array("rowid", "number", "name", "changedOn"))){
                    echo "<td>".$val."</td>";
                    echo '<input type=hidden name="'.$key.'" value="'.$val.'">';
                }
                else {
                    echo "<td>";
                    echo '<input type=text name="'.$key.'" value="'.$val.'">';
                    echo "</td>";
                }
            }
            echo "<td>";
            echo '<input type=hidden name=view value="form_data">';
            echo '<input type=hidden name=tabella value="'.$tabella.'">';
            echo '<button class="btn btn-sim1" type="submit" name="submit" value="saverow">Save</button>';
            echo '</form>';
            echo "</td><td></td>";
        }
        else {
        foreach($row as $val){
           echo "<td>".htmlspecialchars($val)."</td>";
        }
        echo "<td>";
        echo '<form action="/redirect.php"  method="get" style="float: left;">';
        echo '<input type=hidden name=view value="form_data">';
        echo '<input type=hidden name=number value="'.$row['number'].'">';
        echo '<input type=hidden name=tabella value="'.$tabella.'">';
        echo '<input type=hidden name=rowid value="'.$row['rowid'].'">';
        echo '<button class="btn btn-sim1" type="submit" name="submit" value="editrow" style="">Edit</button>';
        echo '</form>';
        echo "</td>";
        echo "<td>";
        echo '<form action="/redirect.php"  method="get" style="float: left;" onsubmit="return confirm(\'Do you really want delete this row ?\');">';
        echo '<input type=hidden name=view value="form_data">';
        echo '<input type=hidden name=number value="'.$row['number'].'">';
        echo '<input type=hidden name=tabella value="'.$tabella.'">';
        echo '<input type=hidden name=rowid value="'.$row['rowid'].'">';
        echo '<button class="btn btn-sim1" type="submit" name="submit" value="delrow"">Del</button>';
        echo '</form>';
        echo "</td>";
        }
        echo "</tr>";
    }

    echo "<tr><td></td>";
    echo '<form action="/redirect.php"  method="get" style="float: left;">';
    echo '<input type=hidden name=view value="form_data">';
    echo '<input type=hidden name=tabella value="'.$tabella.'">';
    $headers = $kb->t_columns($tabella);
    foreach($headers as $head){
        echo '<td><input type=text name="'.$head.'" value=""></td>';
    }
    echo "<td>";
    echo '<button class="btn btn-sim1" type="submit" name="submit" value="addrow">Add</button>';
    echo '</form>';
    echo "</td>";
    echo "</tr>";
    ?>
    </tbody>
    </table>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
</div>


<?php
include(__ROOT__.'/views/_footer.php');
?>
</body>
</html>