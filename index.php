<?php
if (!defined('__ROOT__')) define ( '__ROOT__', dirname ( __FILE__ ) ) ;
include (__ROOT__ . '/views/_header.php');
?>


        <!-- Page content-->
        <div class="container">

            <div class="row" style="padding-top: 10vh;">
             <div class="col-lg-1 d-lg-block d-md-none d-sm-none d-none"></div>
        		<div class="col-lg-5 col-md-6 col-12 col-sm-12">
            		<form role="form" method="post" action="/redirect.php?<?php echo $_SERVER['QUERY_STRING'] == "view=logout_view" ? "" : $_SERVER['QUERY_STRING']; ?>" name="loginform">
		               <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0">
		                    <h3 class="card-feature__title"  style="padding: 0vh 0vh 2vh 4vh;">Sign In</h3>
		                    <div class="input-group mb-3">
		                        <div class="input-group-prepend"></div>
		                        <input type="text" name="user_email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
		                    </div>
		                    <div class="input-group mb-3">
		                        <div class="input-group-prepend"></div>
		                        <input type="password" name="user_password" class="form-control" placeholder="Password" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete>
		                    </div>
		                    <div class="row">
		                        <div class="col-md-6 col-12 col-sm-12">
		                            <button type="submit" name="login" class="btn btn-block btn-sim4">
		                                <h7><?php echo WORDING_LOGIN; ?></h7>
		                            </button>
		                        </div>
		                    </div>

		                    <div class="row"  style="padding: 3vh 0vh 0vh 5vh;">
                    			<div class="col-md-12 align-self-md-end col-xs-12 col-sm-12">
        		                    <h7>
        		                    <a href="/password_reset.php">Forgot Password</a>
        		                    &nbsp;|&nbsp;
        		                    <a href="/register.php">SignUp</a>
        		                    </h7>
        		                </div>
		                    </div>
		                </div>
		            </form>
            	</div>
            	<div class="col-lg-1 d-lg-block d-md-none d-sm-none d-none"></div>
        		<div class="col-lg-5 col-md-6 d-lg-block d-md-block d-sm-none d-none">
        			 <h5 class="typewriter" id="app" style="padding: 10vh 0vh 0vh 0vh;"></h5>
            	</div>
            </div>


        </div>


<?php
include (__ROOT__ . '/views/_footer.php');
?>

        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>

  		<script src="/js/type-writer.js"></script>
        <script>
        var app = document.getElementById('app');

        var typewriter = new Typewriter(app, {
            loop: true
        });

        typewriter.typeString('Create online html pages')
        .pauseFor(500)
        .deleteAll()
        .typeString('Share them using minified links')
        .pauseFor(600)
        .deleteAll()
        .start();
        </script>
