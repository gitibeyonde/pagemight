<?php
include ('_header.php');
?>
<div class="container">
    <div class="row" style="padding-top: 10vh;">
        <div class="col-lg-3 col-md-2 d-lg-block d-md-block d-sm-none d-none">
        </div>
        <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
            <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 class="card-feature__title">Reset Password</h3>
                    </div>
                </div>

                <?php if ($login->passwordResetLinkIsValid() == true) { ?>
                <form role="form" class="form" method="post" action="/password_reset.php" name="new_password_form">
                    <fieldset>
                        <input type='hidden' name='user_email' value='<?php echo $_GET['user_email']; ?>' />
                        <input type='hidden' name='user_password_reset_hash'
                            value='<?php echo $_GET['verification_code']; ?>' />
                        <div class="form-group">
                            <label class="pull-left" for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
                            <input id="user_password_new" type="password" class="form-control"
                                name="user_password_new" pattern=".{6,}" required autocomplete="off" autocapitalize="none" />
                        </div>
                        <div class="form-group">
                            <label class="pull-left" for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
                            <input id="user_password_repeat" class="form-control" type="password"
                                name="user_password_repeat" pattern=".{6,}" required autocomplete="off" autocapitalize="none" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sim4 btn-block" name="submit_new_password" value="<?php echo WORDING_SUBMIT_NEW_PASSWORD; ?>" />
                        </div>
                    </fieldset>
                </form>


                <?php } else { ?>

                <form class="form" role="form" method="post" action="/password_reset.php" name="password-reset_form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend"></div>
                        <input type="text" name="user_email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 col-sm-12">
                            <button type="submit" name="request_password_reset" class="btn btn-sim4 btn-block">
                                <h7>Send Reset Link</h7>
                            </button>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-12">
                            <a href="/login.php"><small style="color: white; margin-left: 5px;" class="pull-right"><h7><?php echo WORDING_BACK_TO_LOGIN; ?></h7></small></a>
                        </div>
                    </div>
                </form>
                <?php } ?>

                <div class="row" style="padding: 3vh 0vh 0vh 5vh;">
                    <div class="col-md-12 align-self-md-end col-xs-12 col-sm-12">
                		<h7> <a href="/index.php"><h7>Sign In</h7></a>
        		                    &nbsp;|&nbsp;
        		           <a href="register.php">Sign Up</a> </h7>
                    </div>
                 </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 d-lg-block d-md-block d-sm-none d-none">
        </div>
     </div>
</div>
<?php
include ('_footer.php');
?>
</body>
</html>