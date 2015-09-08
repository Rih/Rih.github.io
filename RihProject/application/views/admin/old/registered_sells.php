
<div class="main-container">
	<?php include 'page_info.php'; ?>
	<div class="padding-md">
		<ul class="breadcrumb" style="font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REGISTROS</li>	 
			<li>VENTAS</li>
			<li style="float:right;"><a href="<?php echo site_url('?admin/sell_excel');?>"><i class="fa fa-table"></i></a></li>
			<li style="float:right;"><a href="javascript:window.print(); void 0;"><i class="fa fa-print"></i></a></li> 
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
					<th>Correo Electrónico</th>
					<th style="width:76px;">Voucher</th>
				</tr>
			</thead>
			<tbody>
				 <?php 								
					foreach($transaction as $row){
						$mail = $this->crud_model->get_correo_by_id_transaccion($row->idtransaccion);
						$iduser = $this->crud_model->get_id_by_correo($mail);
						$url = "?admin/voucher/".$row->idtransaccion;
						$idvoucher = strval($row->idtransaccion);
						$str_num = number_format( $row->monto, 0, ',', '.' ); 
						while (strlen($idvoucher) < 10){
							$idvoucher = "0".$idvoucher;
						}
						
						echo '<tr>';
						echo  '<td>'.'#'.$idvoucher.'</td>';
						echo  '<td>'.$row->fecha_transaccion.'</td>';									
						echo  '<td>'.$row->cantidad_numeros.'</td>';
						echo  '<td><small class="badge badge-danger badge-square bounceIn animation-delay5 m-left-xs">'.$str_num.'</small></td>';
						echo  '<td>'.$mail.'</td>';
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
