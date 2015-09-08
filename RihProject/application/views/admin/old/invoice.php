
<div class="main-container">
	<div class="padding-md">
		<div class="clearfix">
			<div class="pull-left">
				<div class="pull-left m-left-sm">
					<img src="<?php echo base_url();?>template/theme/img/logo-voucher.png">
				</div>
			</div>
			<div class="pull-right" style="text-align:right; line-height:12px;">
				<?php 
				$idvoucher = strval($idtransaccion);
				while (strlen($idvoucher) < 10){
					$idvoucher = "0".$idvoucher;
				}
				?>
				<h4 style="line-height:10px;"><strong>Voucher No.<?php echo $idvoucher; ?></strong></h5>
				<strong> <?php echo $fecha_transaccion; ?></strong>
			</div>
		</div>
		<hr>
		<div class="clearfix">
			<div class="pull-left"> 
				<h4>Información de la Empresa</h4> 
				<address style="line-height:14px;"> 
					<strong>Rifo Mis Parcelas en Paine</strong><br> 
					Avda. Los Manzanos S/N<br> 
					Paine, Región Metropolitana, CHILE <br> 
					info@unavezenlavida.cl<br>
					<abbr title="Teléfono"><i class="fa fa-phone"></i></abbr> +56 (2) 2551 3213
				</address> 
			</div>
			<div class="pull-right text-right">
				<h4>Información del Cliente </h4> 
				<address style="line-height:14px;"> 
					<strong><?php echo $personal_userdata->nombres; ?> <?php echo $personal_userdata->apellido_paterno; ?> <?php echo $personal_userdata->apellido_materno; ?></strong><br> 
					<?php echo $personal_userdata->rut; ?><br> 
					<?php echo $personal_userdata->ciudad; ?>, CHILE<br> 					
					<?php echo $personal_userdata->correo; ?><br> 
					<abbr title="Teléfono"><i class="fa fa-phone"></i></abbr>+56 <?php echo $personal_userdata->telefono_personal; ?><br> 
				</address> 
			</div>
		</div>
		
		<table class="table table-striped table-bordered m-top-md" id="dataTable">
			<thead>
				<tr class="bg-dark-blue">
					<th>NO.</th>
					<th>DESCRIPCIÓN</th>
					<th>VALOR UNITARIO</th>										
				</tr>
			</thead>
			<tbody>
				<?php 								
					foreach($venta_user as $row){						
						echo '<tr>';
						echo  '<td>'.$row->rifa_codigo.'</td>';
						echo  '<td>BOLETO DE RIFA VIRTUAL</td>';	
						$num_rifa = number_format( $valor_rifa, 0, ',', '.' ); 
						echo  '<td> <small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs">$'.$num_rifa.'</small></td>';
						echo '</tr>';
					}
				?>
				
			</tbody>
		</table>
		
		<div class="clearfix">
			<div class="pull-right">
				<table class="table m-top-md">	
					<tbody>
										
						<tr class="no-border">
							<td class="no-border"></td>
							<td class="no-border"></td>
							<td class="no-border"></td>
							<td class="text-right no-border" style="font-size:16px;"><strong><i class="fa fa-credit-card"></i> TOTAL</strong></td>
							<?php $monto_total = number_format( $cantidad*$valor_rifa, 0, ',', '.' );  ?>
							<td><strong class="text-danger" style="font-size:16px;">$<?php echo $monto_total; ?></strong></td>
							
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="padding-sm bg-grey m-top-lg" style="margin-top:10px;">
			<h4 class="text-danger">Aviso de Pago</h4>
			<p style="font-size:11px; line-height:12px; text-align:justify;">
			Nota: ¡Felicidades! Rifo Mis Parcelas en Paine (unavezenlavida.cl) ha registrado en el sistema el siguiente voucher con todos los datos de la transacción, 
			del cual el usuario podrá hacer uso como comprobante legal de la compra de números de rifa "virtuales". En ningún caso Rifo Mis Parcelas en Paine (unavezenlavida.cl) entregará 
			personalmente o enviará de forma tangible un documento que acredite la compra o los números adquiridos. El usuario podrá ver el presente voucher desde su Panel de Control las 
			veces que estime conveniente sin limitancia, como tambien imprimir el documento si así lo desea pudiendo hacer uso de él como crea conveniente ante cualquier eventualidad.
			El usuario no presenta recargos a la hora de registrarse, solo se cobra el valor del boleto al momento de la compra. Se deja estipulado que posterior al pago realizado por 
			la plataforma de comercio Webpay no habrá devolución.</p>
		</div>

		<div class="m-top-lg text-right" style="margin-top:10px;">
			<a class="btn btn-success hidden-print" style="font-size:10px; color:#FFF" id="invoicePrint"><i class="fa fa-print"></i> IMPRIMIR</a>			
		</div>
	</div>
</div><!-- /main-container -->
