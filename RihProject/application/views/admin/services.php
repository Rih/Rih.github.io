
<div class="main-container">
	<!-- <?php include 'page_info.php'; ?> -->
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REGISTRY</li>	 
			<li>SERVICES</li>
			<li style="float:right;"><a href="<?php echo site_url('?admin/services_to_xml');?>"><i class="fa fa-eye"></i></a></li>
			<li style="float:right;"><a href="<?php echo site_url('?admin/services_to_excel');?>"><i class="fa fa-table"></i></a></li>
			<li style="float:right;"><a href="<?php echo site_url('?admin/create_service_form');?>"><i class="fa fa-plus"></i></a></li>			
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
							$url2 = "?admin/edit_service/".$row['id'];	
							echo '<tr>';
							echo  '<td>'.'#'.$row['id'].'</td>';
							echo  '<td>'.$row['name'].'</td>';							
							echo  '<td>'.$row['topic'].'</td>';
							echo  '<td>'.$row['desc'].'</td>';
							echo "<td><div class'font-12'>";
							//echo '<a href=".."  style='font-size:10px;'><i class='fa fa-caret-right'></i>".$row['url']."</a>';
							echo anchor($row['url'], $row['url'],'target="_blank" class="btn fa fa-external-link-square"');
							echo "</div></td>";
							echo "<td><div class'font-12'> <a href=".site_url($url2)."  class='btn btn-success block' style='font-size:10px;'><i class='fa fa-caret-right'></i>Edit</a></div></td>";
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
