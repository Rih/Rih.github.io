<header class="top-nav">
	<div class="top-nav-inner">
		<div class="nav-header">
			<button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleSM">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
			<a href="<?php echo base_url();?>" class="brand">
				<!-- <i class="icon-off"></i><span class="brand-name"><img src="<?php echo base_url();?>template/theme/img/logo-header.png"></span>-->
			</a>

		</div>
		
		<div class="nav-container">
			

			<div class="pull-right m-right-sm">
				<div class="user-block hidden-xs">
					<span href="#" id="userToggle">
						<div class="user-detail inline-block" style="font-size:10px; text-transform:uppercase;"> BIENVENIDO <?php echo $this->session->userdata('email'); ?></div>
					</span>
				</div>
				<ul class="nav-notification">
					<li>
						<a href="#" data-toggle="dropdown"><i class="fa fa-lock" style="font-size:18px;"></i></a>
						<ul class="dropdown-menu message pull-right">
							<li style="text-align:center; font-family:'Century Gothic Bold'; padding: 8px 0px; font-size: 13px;"><i class="fa fa-lock"></i> CAMBIAR CONTRASEÑA</li>					  
							<li style="padding:12px;">
								<p style="line-height:11px; color:#b8b8b8;">
								¿Deseas cambiar la contraseña de tu cuenta? Solo debes ingresar una nueva contraseña en el siguiente campo ¡Guárdala bien!. De todas formas se enviará su nueva contraseña a su correo para futuras referencias.
								</p>

								<?php echo form_open('?account/change_password',array('id' => 'formValidate1'));?>              
								<div class="form-group m-bottom-md">
									<input type="password" id="textpass1" data-parsley-required="true" data-parsley-minlength="8" name="password" class="form-control" placeholder="Nueva Contraseña">
								</div>
							</li>
							<li style="padding:12px;">
								<div class="form-group">							
									<input type="submit" value="CAMBIAR CONTRASEÑA" id="changepass" class="btn btn-success block" style="width:100%; font-size:10px;"/>
								</div>
								<?php echo form_close();?>
							</li>					  
						</ul>
					</li>
					<li class="chat-notification">
						<a href="#" class="sidebarRight-toggle"><i class="fa fa-power-off fa-lg" style="font-size:15px;"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</div><!-- ./top-nav-inner -->	
</header>

<!-- <script type="text/javascript">
	$(document).ready(function() {
	     $('input #changepass').click(function() {
	     	alert("CAMBIADO DE CONTRASEÑA");
	    /*if (window.confirm('Are you sure？')) {
	      $('#content').load($(this).attr('href'));
	    }*/
	  	});
    });
</script>
-->
