<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  	
<!-- Mirrored from minetheme.com/simplify1.0/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:36:07 GMT -->
<head>
	    <meta charset="utf-8">
	    <title>Ingreso Hyper Mega RihSlash  - Project</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <!-- <?php include 'includes.php';?> -->
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
  	         <?php if($this->session->flashdata('flash_message') != ""):?>
            <script>
                $(document).ready(function() {
                    Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "})
                });
            </script>
            <?php endif;?>
		<div class="wrapper no-navigation preload">
			<div class="sign-in-wrapper">
				<div class="sign-in-inner">
					<div class="login-brand text-center">
						<i class="fa fa-database m-right-xs"></i> Ingreso <strong class="text-skin">Mega Rifa</strong>
					</div>

					<?php echo form_open('login' , array('class' => 'separate-sections', 'onsubmit' => 'return check_account_type()'));?>
						<?php echo '<p style="color:red;text-align:center">'.$msg. '</p>'; ?>
						<div class="form-group m-bottom-md">
							<input type="text" name="email" class="form-control" data-parsley-type="email" placeholder="Correo..." autocomplete="off">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Contraseña..." autocomplete="off">
						</div>

						<div class="form-group">
							<div class="custom-checkbox">
								<input type="checkbox" id="chkRemember">
								<label for="chkRemember"></label>
							</div>
							Recordarme
						</div>

						
						<div class="m-top-md p-top-sm">
							<div class="font-12 text-center m-bottom-xs">
								<input type="submit" class="btn btn-success block"  value="Ingresar"/>		
							</div>
							<div class="font-12 text-center m-bottom-xs">
								<a  data-toggle="modal" href="#modal-recover"  class="font-6" >
								Olvidó contraseña ?
								</a>					
							</div>
							<div class="font-12 text-center m-bottom-xs">No tienes una cuenta?</div>
							
							<a  class="btn btn-default block" data-toggle="modal" href="#modal-recover"  class="btn btn-blue btn-block" >
                                Registrarme
                            </a>
						</div>
					<?php echo form_close();?>
				
					
				</div><!-- ./sign-in-inner -->
			</div><!-- ./sign-in-wrapper -->

		</div><!-- /wrapper -->

		<a href="#" id="scroll-to-top" class="hidden-print"><i class="icon-chevron-up"></i></a>



	
  		<!-----------password reset form ------>
        <div id="modal-recover" class="modal hide fade" style="top:30%;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h6 id="modal-tablesLabel">Recuperar Cuenta</h6>
          </div>
          <div class="modal-body" style="padding:20px;">
            <?php echo form_open('login/recover_password',array('id' => 'formValidate1'));?>            	
                <input type="email" name="email"  placeholder="Su Correo..."  style="margin-bottom: 0px !important;"/>
                <input type="submit" value="Recuperar"  class="btn btn-blue btn-medium"/>
            <?php echo form_close();?>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        <!-----------password reset form ------>

         <!-----------password reset form ------>
        <div id="modal-register" class="modal hide fade" style="top:30%;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h6 id="modal-tablesLabel">Crear Cuenta</h6>
          </div>
          <div class="modal-body" style="padding:20px;">
            <?php echo form_open('login/create_account');?>               
                <input type="email" name="email"  placeholder="Ingrese Email"  style="margin-bottom: 0px !important;"/>
                <input type="text" name="password"  placeholder="Ingrese Contraseña..."  style="margin-bottom: 0px !important;"/>
                <input type="text" name="repassword"  placeholder="Repita Contraseña..."  style="margin-bottom: 0px !important;"/>
                <input type="text" name="rut"  placeholder="RUT aqui..."  style="margin-bottom: 0px !important;"/>
                <input type="text" name="fecha_nacimiento"  placeholder="Fecha nacimiento aqui..."  style="margin-bottom: 0px !important;"/>
                <input type="text" name="nombres"  placeholder="Nombres aqui..."  style="margin-bottom: 0px !important;"/>
                <input type="text" name="appaterno"  placeholder="Apellido Paterno aqui..."  style="margin-bottom: 0px !important;"/>
                <input type="text" name="apmaterno"  placeholder="Apellido Materno aqui..."  style="margin-bottom: 0px !important;"/>
                <input type="number" name="telefono_fijo"  placeholder="Opcional..."  style="margin-bottom: 0px !important;"/>
                <input type="number" name="telefono_personal"  placeholder="Opcional..."  style="margin-bottom: 0px !important;"/>
                <input type="text" name="ciudad"  placeholder="Ciudad aqui..."  style="margin-bottom: 0px !important;"/>
                <input type="submit" value="Crear"  class="btn btn-blue btn-medium"/>
            <?php echo form_close();?>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        <!-----------password reset form ------>

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
				 
				$('#formValidate1').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Registration Complete');
							return false;
						}
			        }
			    }}); 
				
				$('#formValidate2').parsley( { listeners: {
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

<!-- Mirrored from minetheme.com/simplify1.0/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:36:07 GMT -->
</html>
