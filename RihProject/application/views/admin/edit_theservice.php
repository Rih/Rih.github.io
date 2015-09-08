
<div class="main-container">
	
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?user/dashboard'); ?>"> DASHBOARD</a></li>
			<li>ENTRY</li>	 
			<?php if(isset($service)){
				echo '<li style="text-transform: uppercase;">SERVICE '.$service['name'].'</li>';			
				$id = $service['id'];							
				$uriback = "?admin/services";
				echo '<li style="float:right;"><a href="'.site_url($uriback).'"><i class="fa fa-backward"></i></a></li>';
				}
			?>
			
		</ul>
		
		<?php if(isset($csrf_hash)){ echo 'HASH CSRF: '.$csrf_hash; } ?>

		<?php if(isset($service)){
						
			$id = $service['id'];							
			$uri = "?admin/renew_service/".$id;	
			echo form_open($uri);	
			}
		?>			
		<table class="table table-striped" id="dataTable1">
		<div id="output">this element will be accessed by jquery and this text replaced</div>
			<thead>
				<tr>
					<th style="width:29%">Field</th>									
					<th style="width:40%;">Value</th>					
					<th style="width:29%;">Option</th>
				</tr>
			</thead>
			<tbody>
				 <?php 	

				 	if(isset($service)){
						
							$id = $service['id'];							
							$mes = array(1 => 'Ene', 2 => 'Feb', 3=> 'Mar', 4 =>'Abr', 5 => 'May', 6 => 'Jun',
				                            7 => 'Jul',8 => 'Ago',9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dic');						
							$uri = "?admin/renew_service/".$id;	
							//echo form_open($uri);															
							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>ID</td>';							
							echo  '<td>'.$service['id'].'</td>';							
							echo "<td>";							
							echo "</td>";							
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';
							
							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Service</td>';
							echo  '<td>';
							echo form_input(
							array(
								'name'        => 'name',								
								'value'       => $service['name'],
								'maxlength'   => '50',
								'style' 	  => 'width:100%'
								)
							);	
							echo '</td>';							
							echo "<td>";
							echo '<div class="col-md-5">';
							echo "<input type='submit' name='edit' id='editname' class='btn btn-success inline-block' value='Edit Name'></input>";
							echo '</div>';
							echo "</td>";							
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Topic</td>';																		
							echo  '<td>';
							echo form_input(
							array(
								'name'        => 'topic',								
								'value'       => $service['topic'],
								'maxlength'   => '50',
								'style' 	  => 'width:100%'
								)
							);	
							echo '</td>';					
							echo "<td>";
							echo '<div class="col-md-5">';
							echo "<input type='submit' name='edit' id='edittopic' class='btn btn-success inline-block' value='Edit Topic'></input>";
							echo '</div>';
							echo "</td>";							
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Description</td>';							
							echo  '<td>';	
							echo form_textarea(
							array(
								'name'        => 'desc',								
								'value'       => $service['desc'],
								'maxlength'   => '200',
								'rows' 		  => '5',
								'cols' 		  => '50',
								//'size'        => '35',
								'style'		  => 'resize: vertical'
							)
							);						
							//echo '<input style="resize:vertical;" class="col-sm-12"  type="textarea" name="notes" maxlength="200" rows="4" value="'.$service['notes'].'"/>';									
							//echo "<a href=".site_url($uri4)."  class='btn-xs btn-success block'><i class='fa fa-refresh'></i> Renew <span id='range".$id."'>length => 12</span></a>";
							echo '</td>';
							echo "<td>";
							echo '<div class="col-md-5">';
							echo "<input type='submit' name='edit' id='editdesc' class='btn btn-success inline-block' value='Edit Description'></input>";
							echo '</div>';
							echo "</td>";							
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';


							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Url</td>';							
							echo  '<td>';
							echo form_input(
							array(
								'name'        => 'url',								
								'value'       => $service['url'],
								'maxlength'   => '50',
								'style' 	  => 'width:100%'
								)
							);	
							echo '</td>';
							echo "<td>";
							echo '<div class="col-md-5">';
							echo "<input type='submit' name='edit' id='editurl' class='btn btn-success inline-block' value='Edit Url'></input>";
							echo '</div>';
							echo "</td>";							
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';
	
					}
					
				?>
			</tbody>
		</table>
		<?php 
		echo '<div class="row" style="text-align:center">';
		echo "<input type='submit' name='edit' id='editall' class='btn btn-success inline-block' value='Edit All'></input>";
		echo '</div>';				
		echo form_close(); 
		?>
		
	</div><!-- ./padding-md -->
	
</div><!-- /main-container -->