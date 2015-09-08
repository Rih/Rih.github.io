<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hyper Mega RihSlash  - Project • Registro de Usuarios</title>
	<meta name="robots" content="noindex, nofollow">

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>template/theme/bootstrap/css/bootstrap.min.css?nocache=" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!-- ionicons -->
	<link href="<?php echo base_url();?>template/theme/css/ionicons.min.css?nocache=" rel="stylesheet">
	<!-- Simplify -->
	<link href="<?php echo base_url();?>template/theme/css/simplify.min.css?nocache=" rel="stylesheet">
	<link href="<?php echo base_url();?>template/datepicker/css/datepicker.css?nocache=" rel="stylesheet">

	<!-- Login Form Style -->
	<link href="<?php echo base_url();?>template/login_form/login_style.css?nocache=" rel="stylesheet">		

  	</head>

  	<body class="overflow-hidden light-background">
  		

		<!--
		##############################
		           HEADER
		##############################
		-->
  		<header class="top-nav">
			<div class="top-nav-inner">
				<div class="nav-container">


								
					<div class="pull-right m-right-sm">
						<div class="user-block hidden-xs">
							<a href="#" id="userToggle" data-toggle="dropdown">
								<div class="user-detail inline-block" style="font-size:10px;"><i class="fa fa-bars"></i> BIENVENIDO <i class="fa fa-angle-down"></i></div>
							</a>
							<div class="panel border dropdown-menu user-panel">
								<div class="panel-body paddingTB-sm">
									<ul>
										<li style="font-size:10px;"><a href=""><i class="fa fa-edit fa-lg"  style="width:15px;"></i><span class="m-left-xs">REGISTRARSE</span></a></li>
										<li style="font-size:10px;"><a href=""><i class="fa fa-inbox fa-lg" style="width:15px;"></i><span class="m-left-xs">INGRESAR</span></a></li>
									</ul>
								</div>
							</div>
						</div>
						<ul class="nav-notification" style="padding-right:20px;">
							<!--
							<li>
								<a href="#" data-toggle="dropdown"><i class="fa fa-envelope fa-lg"></i></a>
								<div class="chat-alert">Contacto</div>				
							</li>
							<li>
								<a href="#" data-toggle="dropdown"><i class="fa fa-list fa-lg"></i></a>
								<div class="chat-alert">Bases</div>
							</li>
							-->

							<li class="chat-notification">
								<a href="<?php echo base_url();?>" class="fa fa-lg"><i class="fa fa-sign-in"></i></a>
								<!--
								<div class="chat-alert">Salir</div>
								-->
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>

		<!--
		##############################
		           WRAPPER
		##############################
		-->
		

		<div class="wrapper no-navigation preload">
			<div class="sign-in-wrapper">
				<div class="sign-in-inner">
					<div class="login-brand text-center">
						<img src="<?php echo base_url();?>template/theme/img/logo-account.png"></br>						
					</div>
					<?php include 'page_info.php'; ?>					
					<div class="m-top-md p-top-sm">
						<?php echo form_open('?account/recover_password',array('id' => 'formValidate1', 'class' => 'login'));?>
							<h3>Put your email there, and we send you a new password.</h3>
							<p>					      
					      	<input type="text" data-parsley-required="true" name="email" id="login" placeholder="Correo Electrónico">
					    	</p>
					    	<p>					      
						    <input type="range" data-parsley-required="true" name="npassword" id="password" style="width:85%" min="8" max="100" value="12" step="1" onmousemove="showValue(this.value)"/>												      
						    <span id="range">Master Password Length => 12  characters.</span>
						    </p>
					    	<p class="login-submit">
					      	<button type="submit" class="login-button">REGISTER</button>
					    	</p>
							
							<div class="m-top-md p-top-sm">
							<p style="color:#a4a4a4; font-size:11px; line-height:11px; text-align:justify;">
							©Todos los derechos reservados a RihSlash - 2015.</p>
							<!-- <p style="text-align:center;"><a href="http://www.codemakers.cl" target="_blank"><img src="<?php echo base_url();?>template/theme/img/codemakers.png"></a></p> -->
							</div>
						<?php echo form_close();?>
					</div>
				</div><!-- ./sign-in-inner -->
			</div><!-- ./sign-in-wrapper -->
		</div><!-- /wrapper -->

		<a href="#" id="scroll-to-top" class="hidden-print"><i class="icon-chevron-up"></i></a>

	    <!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
		
		<!-- Jquery -->
		<script src="<?php echo base_url();?>template/theme/js/jquery-1.11.1.min.js"></script>
		
		<!-- Bootstrap -->
	    <script src="<?php echo base_url();?>template/theme/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll -->
		<script src='<?php echo base_url();?>template/theme/js/jquery.slimscroll.min.js'></script>
		
		<!-- Popup Overlay -->
		<script src='<?php echo base_url();?>template/theme/js/jquery.popupoverlay.min.js'></script>

		<!-- Modernizr -->
		<script src='<?php echo base_url();?>template/theme/js/modernizr.min.js'></script>
		
		<!-- Simplify -->
		<script src="<?php echo base_url();?>template/theme/js/simplify/simplify.js"></script>

		<script src="<?php echo base_url();?>template/datepicker/js/bootstrap-datepicker.js"></script>

		<script src="<?php echo base_url();?>template/theme/js/parsley.min.js"></script>
		<script>
			$(function()	{
				//Delete Widget Confirmation
				$('#deleteWidgetConfirm').popup({
					vertical: 'top',
					pagecontainer: '.container',
					transition: 'all 0.3s'
				});

				//Form Validation
				$('#basic-constraint').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							return false;
						}
			        }
			    }}); 
				
				$('#type-constraint').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							return false;
						}
			        }
			    }}); 
				 
				$('#formValidate1').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Registration Complete');
							return false;
						}
			        }
			    }}); 
				
				$('#formValidatexy2').parsley( { listeners: {
					onFieldValidate: function ( elem ) {
						// if field is not visible, do not apply Parsley validation!
						if ( !$( elem ).is( ':visible' ) ) {
							return true;
						}

						return false;
					},
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Your message has been sent');
							return false;
						}
			        }
			    }}); 
			});   

		</script>
	<script type="text/javascript">
		function showValue(newValue)
		{
			document.getElementById("range").innerHTML="Master Password Length => " +newValue+" characters.";
		}
	</script>

	
  	</body>

<!-- Mirrored from minetheme.com/simplify1.0/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:41:50 GMT -->
</html>

