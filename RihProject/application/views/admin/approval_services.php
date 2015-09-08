
<div class="main-container">
	<!-- <?php include 'page_info.php'; ?> -->
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REGISTROS</li>	 
			<li>SERVICIOS</li>
			<li style="float:right;"><a href="<?php echo site_url('?admin/services_excel');?>"><i class="fa fa-table"></i></a></li>
			<li style="float:right;"><a href="<?php echo site_url('?admin/create_service_form');?>"><i class="fa fa-plus"></i></a></li>
			<li style="float:right;"><a href="javascript:window.print(); void 0;"><i class="fa fa-print"></i></a></li> 
		</ul>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		<table class="table table-striped" id="dataTable1">
			<thead>
				<tr>
					<th>No. ID</th>
					<th>Name</th>					
					<th>Topic</th>
					<th>Description</th>
					<th>url</th>					
					<th style="width:76px;">Option</th>
				</tr>
			</thead>
			<tbody>
				 <?php 		
				 	if(isset($services) && $services != false){
						foreach($services as $row){							
							//$url1 = "?admin/visitservice/".$row['id']; //FOR USER
							$url2 = "?admin/check_service/".$row['id'];	
							echo '<tr>';
							echo  '<td>'.'#'.$row['id'].'</td>';
							echo  '<td>'.$row['name'].'</td>';							
							echo  '<td>'.$row['topic'].'</td>';
							echo  '<td>'.$row['desc'].'</td>';
							echo "<td><div class'font-12'> <a href=".$row['url']."  style='font-size:10px;'><i class='fa fa-caret-right'></i>".$row['url']."</a></div></td>";
							echo "<td><div class'font-12'> 
							<a href=".site_url($url2."/approve")."  class='btn btn-success block' style='font-size:10px;'><i class='fa fa-caret-right'></i>Approve</a>
							<a href=".site_url($url2."/deny")."  class='btn btn-danger block' style='font-size:10px;'><i class='fa fa-caret-right'></i>Deny</a>
							</div>
							</td>";
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
