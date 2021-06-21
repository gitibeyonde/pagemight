 <?php
 // $content will be defined where the file is included
 define('__ROOT__', dirname(dirname(__FILE__)));
 include_once(__ROOT__ . '/classes/pm/UserForm.php');

include(__ROOT__.'/doin/_header.php');

echo "<style>".$p['css']."</style>";
echo "<script>".$p['js']."</script>";

echo $p['content'];

include(__ROOT__.'/doin/_footer.php');

$user_name = $p['user_name'];
?>
<script>

<?php $kb = new UserForm($user_name);
foreach( $kb->ls() as $tn){
   if ($tn == "form_metadata")continue;
    ?>
    $("#<?php echo "form-".$tn; ?>").html('<?php echo $kb->getUserForm($user_name, $tn); ?>');

    $("#<?php echo "action-".$tn; ?>").on("submit", function (e) {
        var dataString = $(this).serialize();

        $.ajax({
          type: "POST",
          url: "/doin/form_submit.php",
          data: dataString,
          success: function (data) {
        	  $("#<?php echo "message-".$tn; ?>")
              .html("<i>Submission Id = #" + data + "</i>");
          }
        });

        e.preventDefault();

  	  	$(this).find(':input[type=submit]').prop('disabled', true);
    });
<?php } ?>

</script>

