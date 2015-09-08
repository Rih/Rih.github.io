
<div class="main-container">
	<div class="padding-md">
		<h3 class="header-text m-bottom-md">
			<div class="page-title">
				EN ESPERA DE PAGO
				</div>
			<span class="sub-header">
			<?php $data = $personal_data; ?>
				<p style="font-family: 'Century Gothic Bold'; font-size:13px; letter-spacing:-0.4px; color:#1c2b36; text-transform: uppercase; margin-top:-5px; font-style: normal;">
				¡SOLO ESPERAMOS TU PAGO <?php echo $data->nombres.' '.$data->apellido_paterno.' '.$data->apellido_materno; ?>!
				</p>
			</span>
		</h3>


		<div class="row user-profile-wrapper">
			<?php include 'page_info.php'; ?>
			<div class="col-md-12">
				<div class="smart-widget">
					<div class="smart-widget-inner">
						
						<div class="smart-widget-body">
							<div class="tab-content">
								<div class="tab-pane fade in active" id="profileTab1">
									<h4 class="header-text m-bottom-md">
										DATOS DE DEPOSITO
									</h4>
									<div class="row">
										<div class="col-md-12" style="font-size:11px; line-height:12px; text-align:justify;">
											<div class="alert alert-success alert-custom alert-dismissible" role="alert">
									    	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
									     	<i class="fa fa-exclamation-circle m-right-xs"></i><strong>¡Atención!</strong> Estamos a la espera de tu deposito para asignar los boletos a tu cuenta.
									   		</div>
									   		<div class="alert alert-danger alert-custom alert-dismissible" role="alert">
									    	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
									     	<i class="fa fa-exclamation-circle m-right-xs"></i><strong>¡Recuerde!</strong> Si deposita desde otra cuenta, no personal, deberá confirmar su deposito mediante un correo electrónico a info@unavezenlavida.cl
									   		</div>
											<div class="m-top-md p-top-sm col-md-6">
												<?php $str_total = number_format( $cantidad*$valor_rifa, 0, ',', '.' );  ?>
												<p style="font-size:11px; line-height:12px; padding-bottom:10px;">
												¡Muchas gracias <?php echo $data->nombres.' '.$data->apellido_paterno.' '.$data->apellido_materno; ?>! Se ha realizado una petición de pago de 
												tu cuenta de usuario, solo quedamos a la espera de tu deposito o transferencia a nuestra cuenta bancaria para asignarte los boletos de rifa válidos 
												que estarán participando en este sorteo. </br></br>
												<strong>Total a Depositar:</strong> <small class="badge badge-success badge-square bounceIn animation-delay2 m-left-xs"><strong>$<?php echo $str_total; ?></strong></small>
												</p>
											
												<p style="font-size:11px; line-height:12px; padding-bottom:10px;">
												Una vez realizado y verificado el depósito, te asignaremos los boletos de rifa a tu cuenta de usuarios en un plazo de 48 horas. Estos boletos virtuales
												aparecerán al lado derecho del perfil, además recibirás un correo de confirmación con un enlace al comprobante de tu compra ante cualquier eventualidad.
												¡Te agradecemos tu intención de participar y te deseamos la mejor de las suerte! 
												</p>
											</div> <!-- ./m-top -->

											<div class="m-top-md p-top-sm col-md-6">
												<div class="m-top-md p-top-sm col-md-4" style="margin-top:-10px;">
													<img src="<?php echo base_url();?>template/theme/img/bcoestado.jpg">
												</div>
												<div class="m-top-md p-top-sm col-md-8" style="margin-top:-10px;">
													<table class="table table-striped" id="dataTable1">
														<tbody>
															<tr>
																<td style="width:29%; padding-left: 16px; font-weight:bold"> NOMBRE: </td>
							                                	<td style="width:69%">MARCO ANTONIO ESPINOZA HIDALGO</td>     
							                                </tr>
							                                <tr>
																<td style="width:29%; padding-left: 16px; font-weight:bold"> RUT: </td>
							                                	<td style="width:69%">11.754.970-4</td>     
							                                </tr>
							                                <tr>
																<td style="width:29%; padding-left: 16px; font-weight:bold"> NO. DE CUENTA: </td>
							                                	<td style="width:69%">047-6-007884-6</td>     
							                                </tr>
							                                <tr>
																<td style="width:29%; padding-left: 16px; font-weight:bold"> TIPO DE CUENTA: </td>
							                                	<td style="width:69%">CUENTA DE AHORRO</td>
							                                </tr>
							                                <tr>
																<td style="width:29%; padding-left: 16px; font-weight:bold"> BANCO: </td>
							                                	<td style="width:69%"><span class="label label-danger" style="font-size:10px;">BANCO ESTADO</span></td>     
							                                </tr>
							                                <tr>
																<td style="width:29%; padding-left: 16px; font-weight:bold"> CORREO DE CONFIRMACIÓN: </td>
							                                	<td style="width:69%">info@unavezenlavida.cl</td> 
							                                </tr>
														</tbody>
													</table>
												</div>
											</div> <!-- ./m-top -->

											<div class="col-md-12">
											<?php $url = "?user/profile";
												//$url = "?user/comprar_numero";
												echo "<a href=".site_url($url)."  class='btn btn-primary block' style='font-size:10px;'>VOLVER</a>";
											?>
											</div>

										</div><!-- ./col -->										
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