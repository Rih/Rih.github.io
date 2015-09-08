
<div class="main-container">
	<div class="padding-md">
		<ul class="breadcrumb" style="font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REGISTROS</li>	 
			<li>TRANSACCIONES</li>
		</ul>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		<table class="table table-striped" id="dataTable1">
			<thead>
				<tr>
					<th>No. Voucher</th>
					<th>Fecha Transacción</th>
					<th>Cant. Boletos</th>
					<th>Monto</th>					
					<th style="width:76px;">Voucher</th>
				</tr>
			</thead>
			<tbody>
				 <?php 								
					foreach($transaction as $row){
						$mail = $this->session->userdata('email');
						$iduser = $this->session->userdata('userid');
						$url = "?user/voucher/".$row->idtransaccion;
						$idvoucher = strval($row->idtransaccion);
						while (strlen($idvoucher) < 10){
							$idvoucher = "0".$idvoucher;
						}
						$monto = number_format( $row->monto, 0, ',', '.' ); 	
						echo '<tr>';
						echo  '<td>'.'#'.$idvoucher.'</td>';
						echo  '<td>'.$row->fecha_transaccion.'</td>';									
						echo  '<td>'.$row->cantidad_numeros.'</td>';
						echo  '<td><small class="badge badge-danger badge-square bounceIn animation-delay5 m-left-xs">$'.$monto.'</small></td>';						
						echo "<td><div class'font-12'> <a href=".site_url($url)."  class='btn btn-success block' style='font-size:10px;'><i class='fa fa-caret-right'></i> VER</a></div></td>";
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
	</div><!-- ./padding-md -->
	


</div><!-- /main-container -->
