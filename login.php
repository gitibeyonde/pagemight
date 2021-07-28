<?php
if (!defined('__ROOT__')) define ( '__ROOT__', dirname ( __FILE__ ) ) ;
include (__ROOT__ . '/views/_header.php');
?>
<link rel="stylesheet" href="/css/login.css">
<section class="container-fluid h-100 my-login-page">
	<div class="container h-100">
		<div class="row justify-content-md-center h-100">
			<div class="card-wrapper">
				<div class="brand">
					<img src="/img/html.png" alt="pagemight html builder login page">
				</div>
				<div class="card fat">
					<div class="card-body">
						<h4 class="card-title">Login</h4>
                      	<form role="form" method="post" class="my-login-validation" novalidate="" action="/redirect.php?<?php echo $_SERVER['QUERY_STRING'] == "view=logout_view" ? "" : $_SERVER['QUERY_STRING']; ?>" name="loginform">
							<div class="form-group">
								<label for="email">E-Mail Address</label>
                                <input id="email" type="email" name="user_email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required autofocus>
								<div class="invalid-feedback">
									Email is invalid
								</div>
							</div>

							<div class="form-group">
								<label for="password">Password
									<a href="/reset_pass.php" class="float-right">
										Forgot Password?
									</a>
								</label>
                               <input type="password" name="user_password" class="form-control" placeholder="Password" aria-label="Recipient's username"
                               			aria-describedby="basic-addon2" required data-eye="" autocomplete>
							    <div class="invalid-feedback">
							    	Password is required
						    	</div>
							</div>

							<div class="form-group">
								<div class="custom-checkbox custom-control">
									<input type="checkbox" name="remember" id="remember" class="custom-control-input">
									<label for="remember" class="custom-control-label">Remember Me</label>
								</div>
							</div>

							<div class="form-group m-0">
                                <button type="submit" name="login" value="login" class="btn btn-warning btn-block">
									Login
								</button>
							</div>
							<div class="mt-4 text-center">
								Don't have an account? <a href="/register.php">Create One</a>
							</div>
						</form>
					</div>
				</div>
				<div class="footer">
					Copyright &copy; 2021 &mdash; PageMight.com
				</div>
			</div>
		</div>
	</div>
</section>
<br/>
<br/>
<br/>
<!--
<section class="container">
<div class="row my-cards">
	<div class="col-md-3 col-sm-12">
    	<div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="ti-write icon-blue"></i></h5>
            <h6 class="card-subtitle mb-2 text-muted">Online HTML editor</h6>
            <p class="card-text">Create Landing Pages, Catalogs and Flyers. Lightening fast load time !</p>
            <a href="#" class="card-link"></a>
          </div>
        </div>
	</div>
	<div class="col-md-3 col-sm-12">
    	<div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="ti-share icon-blue"></i></h5>
            <h6 class="card-subtitle mb-2 text-muted">Page Analytics</h6>
            <p class="card-text">Gather page access analytics. Compare pages and find out what content does better.</p>
            <a href="#" class="card-link"></a>
          </div>
        </div>
	</div>
	<div class="col-md-3 col-sm-12">
    	<div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="ti-cloud-up icon-blue"></i></h5>
            <h6 class="card-subtitle mb-2 text-muted">Cloud Hosting</h6>
            <p class="card-text">Host and embed Images, css, js and forms. Flexible forms to capture information.</p>
            <a href="#" class="card-link"></a>
          </div>
        </div>
	</div>
	<div class="col-md-3 col-sm-12">
    	<div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="ti-server icon-blue"></i></h5>
            <h6 class="card-subtitle mb-2 text-muted">Gather Customer Data</h6>
            <p class="card-text">Manage form submission data. Get customer data and respond to them.</p>
            <a href="#" class="card-link"></a>
          </div>
        </div>
	</div>
</div>

</section>

<br/>
<section class="container"><div class="row my-cards">
	<div class="col-md-3 col-sm-none">
	</div>
	<div class="col-md-6 col-sm-none">
    	<div class="card">
          <div class="card-body">
            <h5 class="card-title icon-info">Keep your page updated</h5>
            <img src="/img/mobile-to-webpage.png" height="200px">
            <h6 class="card-subtitle mb-2 text-muted">PageMight Android App</h6>
            <p class="card-text">With PageMight Android App you can keep the images, videos and other elements updated while on the move.</p>
            <a href="#" class="card-link">Get me the PageMight App</a>
          </div>
        </div>
	</div>
	<div class="col-md-3 col-sm-none">
	</div>
</div>
</section>

<br/>
<br/>
<br/>
<section class="container">
<div class="row my-cards">
	<div class="col-md-1 col-sm-none">
	</div>
	<div class="col-md-4 col-sm-12">
    	<div class="card">
          <div class="card-body">
            <h5 class="card-title icon-info">Shorten url</h5>
            <img src="/img/tinyurl.png" width="100%">
            < h6 class="card-subtitle mb-2 text-muted">-</h6>
            <p class="card-text">Create tiny URL from partner website. Tiny URL allows you to collect access stats.</p>
            <a href="https://tiny.cc" class="card-link">Get me the tiny url</a>
          </div>
        </div>
	</div>
	<div class="col-md-2 col-sm-none">
	</div>
	<div class="col-md-4 col-sm-12">
    	<div class="card">
          <div class="card-body">
            <h5 class="card-title icon-info">Qr-code generator</h5>
            <img src="/img/qr-code.png" height="100px">
            < h6 class="card-subtitle mb-2 text-muted">-</h6>
            <p class="card-text">Create custom QR code for your page - presented by our online partner.</p>
            <a href="https://www.the-qrcode-generator.com" class="card-link">Get me the QR code</a>
          </div>
        </div>
	</div>
	<div class="col-md-1 col-sm-none">
	</div>
</div>
</section>
 -->
<br/>
<br/>
<br/>

<br/>
<br/>
<br/>
<script src="/js/login.js"></script>

<?php
include (__ROOT__ . '/views/_footer.php');
?>
