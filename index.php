<?php
if (!defined('__ROOT__')) define ( '__ROOT__', dirname ( __FILE__ ) ) ;
include (__ROOT__ . '/views/_header.php');
?>


        <!-- Page content-->
        <div class="container">
            <div class="row" style="padding: 5vh 0 5vh 0;">
              <div class="col" style="text-align: center;">
        	  </div>
            </div>

            <div class="row">
        		<div class="col-md-6 col-12 col-sm-12">
            		<form role="form" method="post" action="/redirect.php?<?php echo $_SERVER['QUERY_STRING'] == "view=logout_view" ? "" : $_SERVER['QUERY_STRING']; ?>" name="loginform">
		               <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0">
		                    <h3 class="card-feature__title"  style="padding: 0vh 4vh 2vh 4vh;">Sign In</h3>
		                    <div class="input-group mb-3">
		                        <div class="input-group-prepend"><i class="ti ti-email card-feature__icon"></i></div>
		                        <input type="text" name="user_email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
		                    </div>
		                    <div class="input-group mb-3">
		                        <div class="input-group-prepend"><i class="ti ti-key card-feature__icon"></i></div>
		                        <input type="password" name="user_password" class="form-control" placeholder="Password" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete>
		                    </div>
		                    <div class="row" style="padding: 0vh 4vh 0vh 4vh;">
		                            <button type="submit" name="login" value="login" class="btn btn-block btn-sim4">
		                                <h7>Sign In</h7>
		                            </button>
		                    </div>

		                </div>
		            </form>
		            <div class="row">
                       <div class="col center-block text-center">
                        <a href="/reset_pass.php">Forgot Password</a>
                        &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        <a href="/register.php">Sign Up</a>
                       </div>
                    </div>
            	</div>
        		<div class="col-md-6 d-lg-block d-md-block d-sm-none d-none m-auto" style="text-align: center;">
            		<h5>build forms pages</h5>
            		<h5>share minified link</h5>
            		<h5>check form submissions</h5>
            	</div>
            </div>


			<!-- -
			Create Pages online

Create online pages using html editor
Many bootstrap html5 templates to choose from
Make them available on minified link
Manage images in online image store
Create and embed forms
Check form submission data in your dashboard

			 -->

        </div>


<?php
include (__ROOT__ . '/views/_footer.php');
?>
<!-- Core theme JS-->
<script src="/js/scripts.js"></script>
</body>
</html>
