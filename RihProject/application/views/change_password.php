<!DOCTYPE html>
<html lang="en">
  	
<!-- Mirrored from minetheme.com/simplify1.0/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:41:50 GMT -->
<head>
	    <meta charset="utf-8">
	    <title>Simplify Admin</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <!-- Bootstrap core CSS -->
	    <link href="<?php echo base_url();?>template/theme/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Font Awesome -->
		<link href="<?php echo base_url();?>template/theme/css/font-awesome.min.css" rel="stylesheet">

		<!-- ionicons -->
		<link href="<?php echo base_url();?>template/theme/css/ionicons.min.css" rel="stylesheet">
		
		<!-- Simplify -->
		<link href="<?php echo base_url();?>template/theme/css/simplify.min.css" rel="stylesheet">
	
  	</head>

  	<body class="overflow-hidden light-background">
		<div class="wrapper no-navigation preload">
			<div class="sign-in-wrapper">
				<div class="sign-in-inner">
					<div class="login-brand text-center">
						<i class="fa fa-database m-right-xs"></i> Simplify <strong class="text-skin">Admin</strong>

					</div>

					<?php echo form_open('?account/change_password',array('id' => 'formValidate4'));?>              
						<div class="form-group m-bottom-md">
							<input type="password" name="oldpassword" class="form-control" placeholder="Su Contraseña actual...">
						</div>
						<div class="form-group m-bottom-md">
							<input type="password" id="textpass1" data-parsley-required="true" data-parsley-minlength="8" name="password" class="form-control" placeholder="Nueva Contraseña...">
						</div>
						<div class="form-group m-bottom-md">
							<input type="password" data-parsley-required="true" data-parsley-minlength="8" data-parsley-equalto="#textpass1" name="repassword" class="form-control" placeholder="Confirme Contraseña...">
						</div>
						
						<div class="form-group">														
							<div class="m-top-md p-top-sm">
								<input type="submit" value="Cambiar"  class="btn btn-success block"/>
							</div>
							
						</div>
						
					<?php echo form_close();?>

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
				 
				$('#formValidate4').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Registration Complete');
							return false;
						}
			        }
			    }}); 
				
				$('#formValidateyy2').parsley( { listeners: {
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
  	</body>

<!-- Mirrored from minetheme.com/simplify1.0/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:41:50 GMT -->
</html>
