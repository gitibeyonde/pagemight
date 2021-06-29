<footer class="fixed-bottom">
  <div class="container">
  <div id="error" class="row">
<?php
// show potential errors / feedback (from login object)
if (isset ( $login )) {
    if ($login->errors) {
        foreach ( $login->errors as $error ) {
            echo $error;
            $error="";
        }
    }
    if ($login->messages) {
        foreach ( $login->messages as $message ) {
            echo $message;
            $message="";
        }
    }
}
if (isset ( $registration )) {
    if ($registration->errors) {
        foreach ( $registration->errors as $error ) {
            echo $error;
            $error="";
        }
    }
    if ($registration->messages) {
        foreach ( $registration->messages as $message ) {
            echo $message;
            $message="";
        }
    }
}
if (isset ( $_SESSION ['message'] ) && $_SESSION ['message'] != "") {
    echo $_SESSION ['message'];
    $_SESSION ['message'] = "";
}
?>
</div>
    <div class="row">
        <div class="col-md-4 col-6">
            <a href="/terms&conditions.html" class="footer-text">Terms</a>&emsp;|&emsp;
            <a href="/privacy_policy.html" class="footer-text">Privacy</a>
        </div>
        <div class="col-md-1 d-md-block d-sm-none d-none">
        </div>
        <div class="col-md-3 d-md-block d-sm-none d-none">
             <?php if ( isset($_SESSION ['user_email'])) { ?>
            	<i class="ti-user" style="color: blue;"></i>&nbsp;&nbsp;<?php echo $_SESSION ['user_email']; ?>
             <?php } ?>
        </div>
        <div class="col-md-4 col-6 footer-social">
            <a href="https://twitter.com/agneya2001"><span class="material-icons md-24 orange">tap_and_play</span></a>
            <a href="https://fb.me/ibeyonde"><span class="material-icons md-24 orange">facebook</span></a>
            <a href="https://www.linkedin.com/company/ibeyonde-cloud/"><span class="material-icons md-24 orange">workspace_premium</span></a>
            <a href="https://github.com/gitibeyonde"><span class="material-icons md-24 orange">folder</span></a>
        </div>
    </div>
  </div>
</footer>

<script>
setTimeout(function(){
    $('#error').hide()
}, 5000) // time in millisecond for as long as you like

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>