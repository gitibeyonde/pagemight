<?php
include('_header.php');
?>
<div class="container">

   <div class="row" style="height: 550px;padding-top: 10vh;"">
    <div class="col-lg-3 col-md-2 d-lg-block d-md-block d-sm-none d-none">
    </div>
    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
         <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0vh 0vh 2vh 4vh;">
                        <h3 class="card-feature__title">Sign Up</h3>
                </div>
            </div>
            <form method="post" action="/register.php">
                <div class="input-group mb-3">
                    <div class="input-group-prepend"><i class="ti ti-email card-feature__icon"></i></div>
                    <input type="email" name="user_email" value="<?php echo (isset($_POST['user_email']) ? $_POST['user_email'] : ""); ?>" class="form-control" placeholder="User's Email" aria-label="User Email" aria-describedby="basic-addon2" required>
                </div>
                <!-- div class="input-group mb-3">
                    <div class="input-group-prepend">
                    </div>
                    <input type="tel" id="phone" name="user_phone" required>
                </div> -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend"><i class="ti ti-key card-feature__icon"></i></div>
                    <input type="password" name="user_password_new" pattern=".{6,}" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon3" autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend"><i class="ti ti-key card-feature__icon"></i></div>
                    <input type="password" class="form-control" name="user_password_repeat" pattern=".{6,}" placeholder="Repeat Password" aria-label="Repeat Password" aria-describedby="basic-addon4" autocomplete="off" required>
                </div>


                <img src="/tools/showCaptcha.php" class="mb-3" alt="captcha" />
                <br>
                <div class="input-group mb-3">
                    <!-- captcha -->
                     <div class="input-group-prepend"><i class="ti ti-eye card-feature__icon"></i></div>
                    <input type="text" class="form-control" placeholder="<?php echo WORDING_REGISTRATION_CAPTCHA; ?>" name="captcha" required aria-label="Captcha" aria-describedby="basic-addon5" />
                </div>

            	<div class="row" style="padding: 0vh 6vh 0vh 6vh;">
                    <button name="register" type="submit" class="btn btn-block btn-sim4"><h7><?php echo WORDING_REGISTER; ?></h7></button>
                </div>

            </form>
        </div>

        <div class="row">
           <div class="col center-block text-center">
                    <h7>
                        <a href="/reset_pass.php">Forgot Password</a>
    		                    &nbsp;|&nbsp;
                        <a href="/index.php">Sign In</a>
                     </h7>
                    <br/>
                    <br/>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-2 d-lg-block d-md-block d-sm-none d-none">
    </div>
 </div>
</div>
<?php
include('_footer.php'); ?>
</body>
</html>