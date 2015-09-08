
<div class="main-container">
	<?php include 'page_info.php'; ?>
	<div class="padding-md">
		<h3 class="header-text m-bottom-md">
			<div class="page-title">
				PANEL DE USUARIO
				</div>
			<span class="sub-header">
			<?php $data = $personal_userdata; ?>
				<p style="font-family: 'Century Gothic Bold'; font-size:13px; letter-spacing:-0.4px; color:#1c2b36; text-transform: uppercase; margin-top:-5px; font-style: normal;">
				Información de <?php echo $data->nombres.' '.$data->apellido_paterno.' '.$data->apellido_materno; ?>
				</p>
			</span>
		</h3>

		<div class="row user-profile-wrapper">
			
			<div class="col-md-6">
				<div class="smart-widget">
					<div class="smart-widget-inner">
						
						<div class="smart-widget-body">
							<div class="tab-content">
								<div class="tab-pane fade in active" id="profileTab1">
									<h4 class="header-text m-bottom-md">
										Datos Personales
									</h4>												
									
									<div class="row">
										

										<table class="table table-hover table-bordered table-striped" id="dataTable1">

					                        <thead>

				                            </thead>

				                            <tbody>
				                             <?php 
				                             //$data = $personal_data;
				                             //$fecha = strtotime($data->fecha_nacimiento);  
				                             //$formatted = vsprintf('%3$04d/%2$02d/%1$02d', sscanf($fecha,'%02d/%02d/%04d'));
				                             //$fecha = strtotime($formatted); 
				                             //$dia = date("d",$fecha);
				                             //$m = date("m",$fecha);
				                             //$year = date("Y",$fecha);
				                             //echo 'FECHA: ';
				                             //echo $data->fecha_nacimiento. '   -   ';                      
				                             //echo $fecha;
				                             //$f_nac = explode('-',$fecha);
				                             $dia = $data->day;
				                             $m = $data->month;
				                             $year =$data->year;
				                             $mes = array(1 => 'Ene', 2 => 'Feb', 3=> 'Mar', 4 =>'Abr', 5 => 'May', 6 => 'Jun',
				                            7 => 'Jul',8 => 'Ago',9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dic');

				                            echo '<tr>';                                                        
				                                echo '<td style="width:29%; padding-left: 16px;"> Nombres </td>';
				                                echo '<td style="width:69%">'.$data->nombres.'</td>';                                
				                            echo '</tr>';
				                            echo '<tr>';                                                        
				                                echo '<td style="width:29%; padding-left: 16px;"> Apellido paterno </td>';
				                                echo '<td style="width:69%">'.$data->apellido_paterno.'</td>';                                
				                            echo '</tr>';
				                            echo '<tr>';                                                        
				                                echo '<td style="width:29%; padding-left: 16px;"> Apellido materno </td>';
				                                echo '<td style="width:69%">'.$data->apellido_materno.'</td>';                                
				                            echo '</tr>';
				                            echo '<tr>';                                                        
				                                echo '<td style="width:29%; padding-left: 16px;"> RUT </td>';
				                                echo '<td style="width:69%">'.$data->rut.'</td>';                                
				                            echo '</tr>';
				                            echo '<tr>';                                                        
				                                echo '<td style="width:29%; padding-left: 16px;"> Fecha nacimiento </td>';
				                                //echo '<td style="width:69%">'.$f_nac[0].' de '.$mes[$f_nac[1]].' de '.$f_nac[2].'</td>';
				                                echo '<td style="width:69%">'.$dia.' / '.$mes[$m].' / '.$year.'</td>';
				                            echo '</tr>';

				                            echo '<tr>';                                                        
				                                echo '<td style="width:29%; padding-left: 16px;"> Telefono personal </td>';
				                                echo '<td style="width:69%">'.$data->telefono_personal.'</td>';                                
				                            echo '</tr>';
				                            echo '<tr>';                                                        
				                                echo '<td style="width:29%; padding-left: 16px;"> Ciudad </td>';
				                                echo '<td style="width:69%">'.$data->ciudad.'</td>';                                
				                            echo '</tr>';
				                             echo '<tr>';                                                        
				                                echo '<td style="width:29%; padding-left: 16px;"> Correo </td>';
				                                echo '<td style="width:69%">'.$data->correo.'</td>';                                
				                            echo '</tr>';
				                            ?>
				                            </tbody>
					                    </table>	

									</div><!-- ./row -->
								
								</div><!-- ./tab-pane -->

							</div><!-- ./tab-content -->
						</div><!-- ./smart-widget-body -->
					</div><!-- ./smart-widget-inner -->
				</div><!-- ./smart-widget -->
			</div>
			<div class="col-md-6">
				<div class="smart-widget">
					<div class="smart-widget-inner">
						
						<div class="smart-widget-body" style="height: 395px; overflow: scroll; overflow-x: hidden;">
							<div class="tab-content" >
								<div class="tab-pane fade in active" id="profileTab1">
									<h4 class="header-text m-bottom-md">
										Números Comprados													
									</h4>
									<div class="row">
										<table class="table table-hover table-striped" id="dataTable2">

					                        <thead>
					                        <th style="width:19%; padding-left: 17px;">
					                            <strong>Número</strong>
					                        </th>
					                        <th style="width:79%">
					                            <strong>Código</strong>
					                        </th>
					                        </thead>

					                        <tbody>
					                         <?php 
					                         $num = 1;
					                        foreach ($compras as $v_data) {
					                            # code...
					                        echo '<tr>';                                                                                    
					                            echo '<td style="width:19%; padding-left: 17px;">'.($num++).'</td>';                                                            
					                            echo '<td style="width:79%"><i class="fa fa-ticket"></i> '.$v_data->rifa_codigo.'</td>';                                
					                        echo '</tr>';
					                        }
					                        if($num < 2){
					                        	echo '<tr>';  
					                        	echo '<td style="width:50%;text-align:right"> No hay compras</td>';
					                        	echo '<td style="width:50%;text-align:left"> realizadas</td>';
					                        	echo '</tr>';  
					                        }
					                        ?>
					                        </tbody>
					                    </table>													
									</div><!-- ./row -->
								</div><!-- ./tab-pane -->


								
							</div><!-- ./tab-content -->
						</div><!-- ./smart-widget-body -->
					</div><!-- ./smart-widget-inner -->
				</div><!-- ./smart-widget -->
			</div>
		</div>
		<div class="row user-profile-wrapper">
			<div class="col-md-12">
				<div class="smart-widget">
					<div class="smart-widget-inner">
						
						<div class="smart-widget-body">
							<div class="tab-content">
								<div class="tab-pane fade in active" id="profileTab1">
									<h4 class="header-text m-bottom-md">
										Bases del Concurso
									</h4>
									<div class="row">
										<div class="col-md-12" style="font-size:11px; line-height:12px; text-align:justify;">
											<p>
												Los inmuebles a rifar son: Dos parcelas de agrado, ubicadas en la comuna de Paine, resultante de la Subdivisión de la Parcela No54 de la Colonia Presidente Kennedy, formada en el predio denominado “Hacienda Hospital”, antes fundo Paine, ubicado en la comuna de Buin. Vendidas por su dueño a través del sistema RIFA, la cual se gestionará a través del sitio www.unavezenlavida.cl.
												Dichas propiedades están inscritas en el Conservador de Bienes Raíces de Buin según certificados de dominios vigentes conforme al siguiente detalle; La Primera en fs. 166 No 254, del año 2009, y la Segunda: en fs. 192 No 281 del año 2011, ambas en el Conservador de Bienes Raíces de Buin.
											</p>
											<p>
												La rifa se abrirá el 23 de Diciembre del año 2014 y se cerrará en un plazo máximo de 24 meses a contar de la fecha de inicia de esta, con una totalidad de 75.000 números dispuestos en esta venta de Boletos, correspondientes a la rifa, de la cual estará a disposición del concursante por el plazo antes mencionado, la fecha de término será publicada en la página web, el día, hora y lugar donde se sorteará al ganador. Para efectuarse el sorteo se requerirá haber vendido a lo menos el 80% de los boletos dispuestos a la venta. En caso contrario, el propietario podrá retractarse de efectuar el sorteo, restituyendo a cada concursante el valor de la compra del boleto. En el sorteo participarán sólo los boletos válidamente vendidos.
											<p>
												Después de recibir el pago del pago de un boleto y ser registrado, el sistema procede a validar dicho boleto y envía un correo electrónico al participante con confirmación de pago y validación del boleto. Por lo anterior se hace necesario que el participante mencione un correo electrónico al registrarse en el sistema de administración, de manera que pueda recibir información del concurso y detalle de su(s) compra(s). Es de responsabilidad del comprador mantener al día y actualizada esta información. 
											</p>
											<p>
												La rifa se hará en concurso público ante Notario Público y sistema de tómbola electrónica, la cual será certificada por el ministro de fé respectivo. El valor del boleto es de $10.000 (Diez Mil Pesos Chilenos) cada uno. El boleto ganador se adjudicará las dos propiedades ofrecidas, a través del traspaso de la Propiedad por Escritura Pública Notarial e inscripción en Conservador de Bienes Raíces correspondiente. Los gastos del Conservador de Bienes Raíces y de escrituración serán de cargo del adjudicatario.
											</p>
										</div><!-- ./row -->										
									</div><!-- ./row -->
								</div><!-- ./tab-pane -->
							</div><!-- ./tab-content -->
						</div><!-- ./smart-widget-body -->
					</div><!-- ./smart-widget-inner -->
				</div><!-- ./smart-widget -->
			</div>
		</div>
	</div><!-- ./padding-md -->
</div><!-- /main-container -->
