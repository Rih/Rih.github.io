			
<div class="main-container">
	<?php include 'page_info.php'; ?>
	<div class="padding-md">
		<ul class="breadcrumb" style="font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REGISTROS</li>	 
			<li>USUARIOS</li>
			<li style="float:right;"><a href="<?php echo site_url('?admin/user_excel');?>"><i class="fa fa-table"></i></a></li>
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
					<th>Nombres</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Fecha Nacimiento</th>					
					<th>Telefono personal</th>
					<th>Ciudad</th>
					<th>Perfil</th>
				</tr>
			</thead>
			<tbody>
				
				<?php 
					$num = 1;
					 $mes = array(1 => 'Ene', 2 => 'Feb', 3=> 'Mar', 4 =>'Abr', 5 => 'May', 6 => 'Jun',
				                            7 => 'Jul',8 => 'Ago',9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dic');

					foreach($users as $row){
				         $dia = $row->day;
                         $m = $row->month;
                         $year =$row->year;
						$url = "?admin/user/".$row->iduser;
						echo '<tr>';
						echo  '<td>'.'#'.($num++).'</td>';
						echo  '<td>'.$row->rut.'</td>';									
						echo  '<td>'.$row->correo.'</td>';
						echo  '<td>'.$row->nombres.'</td>';
						echo  '<td>'.$row->apellido_paterno.'</td>';
						echo  '<td>'.$row->apellido_materno.'</td>';
						echo  '<td>'.$dia.' / '.$mes[$m].' / '.$year.'</td>';						
						echo  '<td>'.$row->telefono_personal.'</td>';
						echo  '<td>'.$row->ciudad.'</td>';
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

		