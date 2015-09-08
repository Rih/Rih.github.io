
<div class="main-container">
	 
	<!-- <?php include 'page_info.php'; ?> -->
	<?php if (isset($flash_message)){		
		echo '<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs">'.$flash_message.'</small>';
	} ?>
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REQUEST</li>	 
			<li>NEW SERVICE</li>			
			<li style="float:right;color:green"><a href="<?php echo site_url('?user/vinculate_service_form');?>"><i class="fa fa-plus"></i></a></li>
			<li style="float:right;color:red"><a href="<?php echo site_url('?user/request_service_form');?>"><i class="fa fa-plus-square"></i></a></li>			
		</ul>
		<div class="login-brand text-center">	
			<div class="col-md-6">
				
					<?php echo form_open('?user/request_service');?>   

						<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="name" class="form-control" placeholder="Name">
						</div>
						<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="url" class="form-control" placeholder="URL (ex: www.gmail.com)">
						</div>
						<div class="form-group m-bottom-md">
							<select name="topic" data-parsley-required="true" class="form-control" style="width:100%;">
                            <?php                             
                            $topics = array('Generico','AFP','Almacenamiento en Nube','Base de datos','Bancario',
                            	'Clave SSH','Contrasena Wifi','Educacional','Foro','Framework',
                            	'Gestor de Contrasena','Licencia de conducir',
                            	'Licencia de Software','Membresia','Mensajería Instantánea',
                            	'Juego','Pasaporte','Plataforma Web','Programa','Programming',
                            	'Red Social','Repositorio','Seguros','Seguro de Salud','Seguridad Social',
                            	'Servicio Correo','Servidor','Sistema Operativo','Streaming','Tarjeta de Credito',
                            	'Telefonía'
                            	);
                            foreach($topics as $s):
                            ?>
                                <option value="<?php echo $s;?>" >
                                    <?php echo $s;?></option>
                            <?php
                            endforeach;
                            ?>
                        	</select>
							<!-- <input type="text" data-parsley-required="true" name="topic" class="form-control" placeholder="Topic"> -->
						</div>
						<div class="form-group m-bottom-md">
							<input type="text"  data-parsley-required="true" name="description"  class="form-control input-sm" placeholder="Description (Optional)">
						</div>
						<div class="m-top-md p-top-sm">
							<input type="submit" value="Request" class="btn btn-success block" style="width:100%; font-size:10px;"/>
						</div>
					<?php echo form_close();?>
				
			</div> <!-- col-md -->
			<div class="col-md-6">
					<?php
					if (isset($registry)){
						echo form_open('?user/vinculate_service_registry');  
						foreach ($registry as $row) {
							echo '<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="'.$row['field'].'" class="form-control" placeholder="'.$row['field'].' here!...">
						</div>'; 	
						}
						echo '<div class="m-top-md p-top-sm">
							<input type="submit" value="Registrar" class="btn btn-success block" style="width:100%; font-size:10px;"/>
						</div>';
						echo form_close();
						
					}
					?>


						
				
			</div> <!-- col-md -->
		</div>	<!-- login-brand -->
	</div><!-- ./padding-md -->
</div><!-- /main-container -->
			

		