
<div class="main-container">
	
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?user/dashboard'); ?>"> DASHBOARD</a></li>
			<li>ENTRY</li>	 
			<?php if(isset($service)){

				echo '<li style="text-transform: uppercase;">SERVICE '.$service['servname'].'</li>';			
				$id = $service['id'];							
				$uridel = "?user/dismiss_service/".$id;
				$uriback = "?user/myservices";
				echo '<li style="float:right;"><a href="'.site_url($uriback).'"><i class="fa fa-backward"></i></a></li>';
				echo '<li style="float:right;"><a href="'.site_url($uridel).'"><i class="fa fa-minus"></i></a></li>';

				}
			?>
			<li style="float:right;"><a href="<?php echo site_url('?user/vinculate_service_form');?>"><i class="fa fa-plus"></i></a></li>			
		</ul>
		
		<?php if(isset($csrf_hash)){ echo 'HASH CSRF: '.$csrf_hash; } ?>
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
							//$uri3 = base_url()."?user/viewpassword/".$id;	
							$mes = array(1 => 'Ene', 2 => 'Feb', 3=> 'Mar', 4 =>'Abr', 5 => 'May', 6 => 'Jun',
				                            7 => 'Jul',8 => 'Ago',9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dic');						
							$uri2 = "?user/check_thepassword/".$id;								
							$uri3 = "?user/goservice/".$id;
							$uri4 = "?user/renewthepassword/".$id;
							$uri5 = "?user/synctheservice/".$id;
							$uri6 = "?user/renewthevaluation/".$id;
							$uri7 = "?user/renewthenotes/".$id;
							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>ID</td>';							
							echo  '<td>'.$service['id'].'</td>';
							echo "<td></td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Service</td>';							
							echo  '<td>'.$service['servname'].'</td>';							
							echo "<td><div class'font-12'> ";
									echo anchor($uri3, 'Go','target="_blank" class="btn fa fa-external-link-square"');
									echo "(".$service['url'].")";
							echo "</div>
								</td>";			
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Valuation (How often renew pwd)</td>';											
							echo  '<td>'.$service['valuation'].' out 10</td>';							
							echo "<td>";									
							echo form_open($uri6);
							echo '<div class="col-md-7">';
							echo '<input name="valuation" data-parsley-required="true" class="input-sm" type="range" min="1" max="10" value="'.$service['valuation'].'" step="1" onmousemove="showLenValuationValue(this.value,'.$id.')"/>';
							echo '</div>';
							echo '<div class="col-md-5">';
							echo "<button type='submit'  class='btn-xs btn-success block'><i class='fa fa-refresh'></i> <span id='valrange".$id."'>value => ".$service['valuation']."</span></button>";
							echo '</div>';
							//echo "<a href=".site_url($uri4)."  class='btn-xs btn-success block'><i class='fa fa-refresh'></i> Renew <span id='range".$id."'>length => 12</span></a>";
							echo form_close();							
							echo "</td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Username</td>';														
							echo  '<td>'.$service['username'].'</td>';							
							echo "<td></td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Old Password</td>';
							if($stats[2]=="Asynchronous"){
								echo  '<td><small class="badge badge-danger badge-square bounceIn m-left-xs">'.$service['oldpassword'].'</small></td>';
							}else{
								echo  '<td><small class="badge badge-success badge-square bounceIn m-left-xs">'.$service['oldpassword'].'</small></td>';
							}
							
							echo "<td></td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Current Password</td>';	

							if($stats[2]=="Asynchronous"){
								echo  '<td><small class="badge badge-danger badge-square bounceIn m-left-xs">'.$service['password'].'</small></td>';
							}else{
								echo  '<td><small class="badge badge-success badge-square bounceIn m-left-xs">'.$service['password'].'</small></td>';
							}
							echo "<td>";							
							
							echo form_open($uri4);
							echo '<div class="col-md-7">';
							echo '<input name="passwordlen" data-parsley-required="true" class="input-sm" type="range" min="8" max="30" value="'.strlen($service['password']).'" step="1" onmousemove="showLenPwdValue(this.value,'.$id.')"/>';
							echo '</div>';
							echo '<div class="col-md-5">';
							echo "<button type='submit'  class='btn-xs btn-success inline-block'><i class='fa fa-refresh'></i> <span id='pwdrange".$id."'>len => ".strlen($service['password'])."</span></button>";
							echo '</div>';
							//echo "<a href=".site_url($uri4)."  class='btn-xs btn-success block'><i class='fa fa-refresh'></i> Renew <span id='range".$id."'>length => 12</span></a>";
							echo form_close();
							
							echo "</td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Entropy level</td>';	
							$str_num0 = number_format( $service['entropy'], 0, ',', '.' );
							$str_num1 = number_format( $service['shann_entropy'], 5, ',', '.' );
							$str_num2 = number_format( $service['mshann_entropy'], 5, ',', '.' );
												
							echo  '<td>'.$str_num0.' bits | '.$str_num1.' bits/char => ratio: '.$str_num2.'</td>';							
							echo "<td></td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Pwd Status</td>';							
							echo  '<td> <small class="badge badge-'.$stylestatus[$stats[1]].' badge-round bounceIn animation-delay3 m-left-xs">'.$stats[1].'</small> | ';
							echo  '<small class="badge badge-'.$stylestatus[$stats[0]].' badge-round bounceIn animation-delay4 m-left-xs">'.$stats[0].'</small> => ';
							if($stats[0]=="Visible"){
								echo '<a href="'.site_url($uri2."/hide").'"  class="btn-xs btn-success"><i class="fa fa-eye"></i> Hide</a>';
							}elseif($stats[0]=="Hidden"){							
								echo '<a href="'.site_url($uri2."/show").'"  class="btn-xs btn-danger"><i class="fa fa-eye"></i> Show</a>';
							}
							echo '<br>| ';
							echo  '<small class="badge badge-'.$stylestatus[$stats[2]].' badge-round bounceIn animation-delay5 m-left-xs">'.$stats[2].'</small> ';
							if($stats[2] == "Asynchronous"){
								echo " => <a href=".site_url($uri5)."  class='btn-xs btn-success'><i class='fa fa-refresh'></i> Sync</a>";
							}														
							echo '</td>';
							echo '<td>';							
							echo "</td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Created</td>';														
							echo  '<td>'.$service['dcreated'].' / '.$mes[$service['mcreated']].' / '.$service['ycreated'].'   '.$service['tcreated'].'</td>';
							echo "<td></td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Last Visited</td>';														
							echo  '<td>'.$service['dlastVisited'].' / '.$mes[$service['mlastVisited']].' / '.$service['ylastVisited'].'   '.$service['tlastVisited'].'</td>';
							echo "<td></td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Times visited</td>';														
							echo  '<td>'.$service['times'].'</td>';							
							echo "<td></td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';

							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Last Changed Password</td>';
							echo  '<td>'.$service['dlastChangedPwd'].' / '.$mes[$service['mlastChangedPwd']].' / '.$service['ylastChangedPwd'].'   '.$service['tlastChangedPwd'].'</td>';
							echo "<td></td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';
							
							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>Notes</td>';
							echo form_open($uri7);
							echo  '<td>';	
							echo form_textarea(
							array(
								'name'        => 'notes',								
								'value'       => $service['notes'],
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
							echo "<button type='submit'  class='btn btn-success inline-block'>Edit</button>";
							echo '</div>';
							echo "</td>";
							echo form_close();
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';
						
					}
				?>
			</tbody>
		</table>
		
	</div><!-- ./padding-md -->
	
	<script type="text/javascript">
		function showLenPwdValue(newValue, idserv)
		{
			document.getElementById("pwdrange"+idserv).innerHTML="len => " +newValue;
		}
		function showLenValuationValue(newValue, idserv)
		{
			document.getElementById("valrange"+idserv).innerHTML="value => " +newValue;
		}
	</script>
	
	

</div><!-- /main-container -->
