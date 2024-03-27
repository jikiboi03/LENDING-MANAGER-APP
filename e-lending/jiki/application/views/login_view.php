<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login page | e-Lending (Lending Manager App)</title>
	<!--STYLESHEET-->
	<!--=================================================-->
	<!-- favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/favicon.ico">
	<!--Open Sans Font [ OPTIONAL ] -->
 	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
	<!--Bootstrap Stylesheet [ REQUIRED ]-->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<!--Nifty Stylesheet [ REQUIRED ]-->
	<link href="assets/css/nifty.min.css" rel="stylesheet">
	<!--Font Awesome [ OPTIONAL ]-->
	<script src="https://kit.fontawesome.com/c0c51e8ea8.js" crossorigin="anonymous"></script>
	<!-- Create your own class to load custum image [ SAMPLE ]-->
	<link href="assets/css/custom.css" rel="stylesheet">
	<style>
		.demo-my-bg{
			background-image : url("assets/img/bg-img.jpg");
		}
	</style>
	<!--Page Load Progress Bar [ OPTIONAL ]-->
	<link href="assets/css/pace.min.css" rel="stylesheet">
	<script src="assets/js/pace.min.js"></script>
</head>
<body>
	<div id="container" class="cls-container">	
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay" class="bg-img demo-my-bg"></div>	
		<!-- HEADER -->
		<!--===================================================-->
		<div class="cls-header cls-header-lg">
			<div class="cls-brand">
				<a class="box-inline" href="<?php echo site_url('/') ?>">
					<!-- <img alt="Nifty Admin" src="img/logo.png" class="brand-icon"> -->
					<span class="brand-title">e-Lending | <span class="text-thin"> Lending Manager App</span></span>
				</a>
			</div>
		</div>
		<!--===================================================-->
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
			<div class="cls-content-sm">
				<div class="panel-body login-panel">
					<img src="assets/img/jikiapps.png" style="width: 50%;">
					<hr>
					<p class="pad-btm h3">Sign in to your account</p>
					<div class="panel-body login-form-panel">
						<form id="login" action="<?php echo base_url();?>login_controller/login_validation" method="post" >
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-user-astronaut"></i></div>
									<input type="text" class="form-control login-input" name="username" id="username" placeholder="Username">
									<span class="text-danger"><?php echo form_error('username');?></span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-key"></i></div>
									<input type="password" class="form-control login-input" name="password" id="password" placeholder="Password">
									<span class="text-danger"><?php echo form_error('password');?></span>
								</div>
							</div>
							<hr>
							<?php echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';?>
							<div class="row">
								<div class="col-xs-8 text-left checkbox">
									<label class="form-checkbox form-icon">
									<input type="checkbox"> Remember me
									</label>
								</div>
								<div class="col-xs-4">
									<div class="form-group text-right">
										<input class="btn btn-primary text-uppercase" name="insert" type="submit" value=" Sign In "/>
									</div>
								</div>
							</div>
							
						</form>
					</div>
				</div>

				<div class="col-md-12">
					<br>
				    eLending - Lending Manager App v1.2 JikiApps Solutions / Jik Torres © 2018
				</div>
			</div>

		</div>
		<!--===================================================-->		
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->		
	<!--JAVASCRIPT-->
	<!--=================================================-->
	<!--jQuery [ REQUIRED ]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!--BootstrapJS [ RECOMMENDED ]-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<!--Nifty Admin [ RECOMMENDED ]-->
	<script src="assets/js/nifty.min.js"></script>
</body>
</html>
