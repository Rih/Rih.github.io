
<div class="main-container">
	<div class="padding-md">
		<h3 class="header-text m-bottom-md">
			<div class="page-title">
				COMPRA DE BOLETO DE RIFA
				</div>
			<span class="sub-header">
			<?php $data = $personal_data; ?>
				<p style="font-family: 'Century Gothic Bold'; font-size:13px; letter-spacing:-0.4px; color:#1c2b36; text-transform: uppercase; margin-top:-5px; font-style: normal;">
				¡Gracias <?php echo $data->nombres.' '.$data->apellido_paterno.' '.$data->apellido_materno; ?>!
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
										CONFIRMAR COMPRA
									</h4>
									<div class="row">
										<div class="col-md-12" style="font-size:11px; line-height:12px; text-align:justify;">
											
											<div class="m-top-md p-top-sm">
												<p style="font-size:11px; line-height:12px; border-bottom: dotted 1px #000; padding-bottom:10px; text-align:justify;">
												¡Atención! Estás apunto de generar una petición de pago y asignación de boletos a tu cuenta personal de usuario, porfavor verifiqua que los datos
												sean correctos.	Si está todo en ordensolo debes hacer click en el botón de "confirmar". Luego podrás elegir entre las formas 
												de pago disponibles y depositar a la cuenta asiganada o pagar de manera online, de esta manera se registrará de forma efectiva esta compra. 
												Recuerda que cada vez que desees comprar un boleto, tendrás que realizar estos mismos pasos.</br></br></br>
												<img src="<?php echo base_url();?>template/theme/img/payment.jpg">
												</p>

												<table class="table table-striped" id="dataTable1">
													
													<tbody>
														<?php
							                            echo '<tr>';                                                        
							                                echo '<td style="width:29%; padding-left: 16px; font-weight:bold"> Nombre: </td>';
							                                echo '<td style="width:69%">'.$data->nombres.'</td>';                                
							                            echo '</tr>';
							                            echo '<tr>';                                                        
							                                echo '<td style="width:29%; padding-left: 16px; font-weight:bold"> Correo: </td>';
							                                echo '<td style="width:69%">'.$data->correo.'</td>';                                
							                            echo '</tr>';
							                            echo '<tr>';                                                        
							                                echo '<td style="width:29%; padding-left: 16px; font-weight:bold"> Cantidad Boletos: </td>';
							                                echo '<td style="width:69%">'.$cantidad.'</td>';                                
							                            echo '</tr>';
							                            echo '<tr>';                                                        
							                                echo '<td style="width:29%; padding-left: 16px; font-weight:bold"> Valor Unitario: </td>';
							                                $str_num1 = number_format( $valor_rifa, 0, ',', '.' ); 
							                                echo '<td style="width:69%">$'.$str_num1.'</td>';                                
							                            echo '</tr>';
							                            echo '<tr style="font-size: 17px; font-weight: bold;">';                                                        
							                                echo '<td style="width:29%; padding-left: 16px;"> Total a Pagar:</td>';
							                                $str_num2 = number_format( $cantidad*$valor_rifa, 0, ',', '.' ); 
							                                echo '<td style="width:69%">$'.$str_num2.'</td>';                                
							                            echo '</tr>';
						                        	?>
													</tbody>
												</table>
												<?php 
													$url = "?user/confirmar_compra";
													//$url = "?user/comprar_numero";
													echo "<a href=".site_url($url)."  class='btn btn-success block' style='font-size:10px;'>CONFIRMAR</a>";
													echo "</br></br>";
													$urlerr = "?user/profile/error";
													echo "<a href=".site_url($urlerr)."  class='btn btn-danger block' style='font-size:10px;'>CANCELAR</a>";
												?>						
											</div>
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

	
					
					