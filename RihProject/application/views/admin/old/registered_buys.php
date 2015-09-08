

<div class="main-container">
	<?php include 'page_info.php'; ?>
	<div class="padding-md">
		<ul class="breadcrumb" style="font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REGISTROS</li>	 
			<li>PAGOS PENDIENTES</li>			
			<li style="float:right;"><a href="javascript:window.print(); void 0;"><i class="fa fa-print"></i></a></li>	 
		</ul>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		<table class="table table-striped" id="dataTable2">
			<thead>
				<tr>
					<th>No.</th>
					<th>RUT</th>
					<th>Correo Electrónico</th>
					<th>Fecha Petición</th>
					<th>Cant. Boletos</th> 
					<th>Total a Pagar</th>
					<th>Confirmar</th>
					<th>Rechazar</th>
				</tr>
			</thead>
			<tbody>
				
				<?php 
					$num = 1;
					 $mes = array(1 => 'Ene', 2 => 'Feb', 3=> 'Mar', 4 =>'Abr', 5 => 'May', 6 => 'Jun',
				                            7 => 'Jul',8 => 'Ago',9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dic');

					foreach($users as $row){
				         
						$url = "?admin/confirmar_venta/".$row->iduser."/".$row->hash;
						$urldeny = "?admin/denegar_venta/".$row->iduser;
						$monto = $row->cantidad*$valor_rifa;
						$dia = $row->day;
                        $m = $row->month;
                        $year =$row->year;
                        $hour = $row->hour;
                        $min = $row->minute;
                        if (strlen($hour) < 2) $hour ="0".$hour;
                        if (strlen($min) < 2) $min ="0".$min;
						echo '<tr>';
						echo  '<td>'.'#'.($num++).'</td>';
						echo  '<td>'.$row->rut.'</td>';									
						echo  '<td>'.$row->correo.'</td>';
						echo  '<td>'.$dia.'/'.$mes[$m].'/'.$year.'   '.$hour.':'.$min.'</td>';
						echo  '<td>'.$row->cantidad.'</td>';
						$str_monto = number_format( $monto, 0, ',', '.' ); 
						echo  '<td><small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs">$'.$str_monto.'</small></td>';	

						echo  '<td>';
						echo '<div class"font-12"> <a href='.site_url($url).' class="btn btn-success block" style="font-size:10px;"><i class="fa fa-check-circle"></i> CONFIRMAR</a></div>';
						echo '</td>';
						echo "<td>";
						 //echo "<div class'font-12'> <a href=".site_url($urldeny)."  class='btn btn-danger block' style='font-size:10px;'><i class='fa fa-times-circle'></i> RECHAZAR</a></div>";
						//echo "<div id='confirm-dialog'>";
						echo "<div class'font-12'> <a  name=".site_url($urldeny)." class='confirm btn btn-danger block' style='font-size:10px;'><i class='fa fa-times-circle'></i> RECHAZAR</a></div>";
						//echo "</div>";
						echo "</td>";
						echo '</tr>';

						/*echo "<td>";
							echo "<div class'font-12'> <a href='#'  class='btn btn-danger block widget-remove-option del' name='delete-".$row->iduser."' style='font-size:10px;'><i class='fa fa-times'></i> RECHAZAR</a></div>";
						echo "</td>";
						echo '</tr>';*/
					}
				?>

			</tbody>
		</table>


		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
	</div><!-- ./padding-md -->

	  
	 
	  	<script type="text/javascript">

		
		$('#btn_to_check').on('click', function(){
		  confirmationWindow();
		});

		function confirmationWindow(){
		    $('#btn_confirmation_window').fadeIn(); //or show() or css('display','block')
		    $('#btn_confirmation_window button').on('click', function(){
		          var confirm= $(this).attr('value');
		          if (confirm=='true') {   
		                 //Code if true e.g. ajax
		                 alert("TRUE");
		          } else if (confirm=='false'){
		                //Code if false
		                alert("FALSE");
		          }
		      }
		}
		</script>
</div><!-- /main-container -->

<!--
<?php 
	foreach($users as $row){
	$url = "?admin/confirmar_venta/".$row->iduser."/".$row->hash;
	$urldeny = "?admin/denegar_venta/".$row->iduser;

	// Delete Widget Confirmation //
	echo'<div class="custom-popup delete-widget-popup delete-confirmation-popup" id="deleteWidgetConfirm">';
	echo'	<div class="popup-header text-center">';
	echo'		<span class="fa-stack fa-4x">';
	echo'			<i class="fa fa-circle fa-stack-2x"></i>';
	echo'			<i class="fa fa-lock fa-stack-1x fa-inverse"></i>';
	echo'		</span>';
	echo'	</div>';
	echo'	<div class="popup-body text-center">';
	echo'		<h5>¿Estas seguro de cancelar esta transacción?</h5>';
	echo'		<strong class="block m-top-xs" style="line-height:13px;"><i class="fa fa-exclamation-circle m-right-xs text-danger"></i>¡Recuerda! Esta acción borrará el registro permanentemente</strong>';
	echo'		<div class="text-center m-top-lg">';
	echo'			<a class="btn btn-danger m-right-sm remove-widget-btn" style="font-size:10px;" href='.site_url($urldeny).'>BORRAR</a>';
	echo'			<a class="btn btn-default deleteWidgetConfirm_close" style="font-size:10px;">CANCELAR</a>';
	echo'		</div>';
	echo'	</div>';
	echo'</div>';
	}
?>
-->

<div id='container'>

		<!-- modal content -->
		<div id='confirm'>
			<div class='header'><span>Confirmar</span></div>
			<div class='message'></div>
			<div class='buttons' style="text-align:center;">
				<a class='no simplemodal-close btn btn-success m-right-sm'>Cancelar</a>
				<a class='yes btn btn-danger m-right-sm'>Si, Rechazar</a>
			</div>
		</div>
	
</div>