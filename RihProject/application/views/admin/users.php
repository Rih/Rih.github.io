
<div class="main-container">
	<!-- <?php include 'page_info.php'; ?> -->
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REGISTROS</li>	 
			<li>USUARIOS</li>
			<li style="float:right;"><a href="<?php echo site_url('?admin/services_excel');?>"><i class="fa fa-table"></i></a></li>			
			<li style="float:right;"><a href="javascript:window.print(); void 0;"><i class="fa fa-print"></i></a></li> 
		</ul>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		<table class="table table-striped" id="dataTable1">
			<thead>
				<tr>
					<th>No. ID</th>
					<th>Muser</th>						
					<th style="width:76px;">Options</th>
				</tr>
			</thead>
			<tbody>
				 <?php 		
				 	if(isset($accounts)){
						foreach($accounts as $row){							
							$url1 = "?admin/deleteuser/".$row['id']; //FOR USER							
							echo '<tr>';
							echo  '<td>'.'#'.$row['id'].'</td>';
							echo  '<td>'.$row['Muser'].'</td>';							
							echo "<td><div class'font-12'> <a href=".site_url($url1)."  class='btn btn-danger block' style='font-size:10px;'>Delete <i class='fa fa-caret-right'></i></a></div></td>";
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
	</div><!-- ./padding-md -->
	


</div><!-- /main-container -->
