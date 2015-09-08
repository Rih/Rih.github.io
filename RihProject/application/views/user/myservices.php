<script type="text/javascript">;
    //setInterval("my_function();",10000); 
    function my_function(){
      $('#refresh').load(location.href + '#dataTable1');
    }
  </script>
  
 
<div id="refresh" class="main-container">
	<?php

$password = 'McF-GU*".k9B[';

require 'class.password-entropy-estimator.php';
$ent = new password_entropy_estimator;
//echo $ent->entropy($password); // 85 bits

?>

	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>ENTRY</li>	 
			<li>MY SERVICES</li>
			<li style="float:right;"><a href="<?php echo site_url('?user/myservices_to_xml');?>"><i class="fa fa-eye"></i></a></li>
			<li style="float:right;"><a href="<?php echo site_url('?user/myservices_to_excel');?>"><i class="fa fa-table"></i></a></li>
			<li style="float:right;color:green"><a href="<?php echo site_url('?user/vinculate_service_form');?>"><i class="fa fa-plus"></i></a></li>
			<li style="float:right;color:red"><a href="<?php echo site_url('?user/request_service_form');?>"><i class="fa fa-plus-square"></i></a></li>			
		</ul>
		
		<?php if(isset($csrf_hash)){ echo 'HASH CSRF: '.$csrf_hash; } ?>
		<div class="row">
			<!--<div class="pull-center col-xs-6">			
			<div class="bg-danger padding-md">
				<h2 class="m-top-lg m-bottom-none">
					Simplify Admin
				</h2>
				<div class="bg-danger padding-md">
					<h2 class="m-top-lg m-bottom-none">
						Simplify Admin
					</h2>
					<div class="owl-carousel custom-carousel3 no-controls m-bottom-lg owl-theme owl-loaded">
					    
					    
						
					<div class="owl-stage-outer" style="padding-left: 0px; padding-right: 0px;"><div class="owl-stage" style="width: 3640px; transform: translate3d(-1456px, 0px, 0px); transition: 0s;"><div class="owl-item cloned" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>Easy to Customize</h4>
						</div></div><div class="owl-item" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>Responsive Admin Theme</h4>
					    </div></div><div class="owl-item active" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>More awesome elements</h4>
						</div></div><div class="owl-item" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>Easy to Customize</h4>
						</div></div><div class="owl-item cloned" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>Responsive Admin Theme</h4>
					    </div></div></div></div><div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style="display: none;">prev</div><div class="owl-next" style="display: none;">next</div></div><div class="owl-dots" style=""><div class="owl-dot"><span></span></div><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div></div></div></div>
				</div>
				
			</div>
			</div> -->
			
			<div class="col-xs-12">		
				<label>Filters:				
				<?php 
				$uri_search = "?user/myservices/search/";
				//65 a 90 ASCII alphabet
				for ($k=65;$k<=90;$k++){	
					$uri_se = $uri_search.chr($k);
					echo anchor(site_url($uri_se),chr($k),'class="btn fa fa-search"');
				}
				?>
				</label>
			</div>
			<div class="col-xs-6">				
								
				<div class="input-group">
				<label>
					Others:					
					<?php 
					$uriuser1 = "?user/myservices/vulnerable";
					$uriuser2 = "?user/myservices/async";
					$uriuser3 = "?user/myservices/all";
					echo '<a  href="'.site_url($uriuser1).'" class="btn btn-danger inline-block" value="Filtrar1">Vulnerables</a>';
					echo '<a  href="'.site_url($uriuser2).'" class="btn btn-warning" value="Filtrar2">Asynchronous</a>';
					echo '<a  href="'.site_url($uriuser3).'" class="btn btn-primary" value="Filtrar3">All</a>';					
					//lpCreatePass(length, upper, lower, digits, special, mindigits, ambig, reqevery)
					?>
					</label>
				</div>
				
			</div>
			<div class="col-xs-6">
				<div id="dataTable_filter" class="dataTables_filter">
					<label>Search:
						<input type="search" class="form-control input-sm" aria-controls="dataTable">
					</label>
				</div>
			</div>
		</div>
		
		
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>

		<table class="table table-striped" id="dataTable1">
		<!-- <div id="output">this element will be accessed by jquery and this text replaced</div> -->
			<thead>
				<tr>
					<th>No. ID</th>									
					<th>Service</th>					
					<th>Username</th>
					<?php $uri2all = "?user/check_password/-1"; ?>
					<th style="width:180px;">
					<div class="col-md-1">
					<?php
						echo '<a href="'.site_url($uri2all."/hide").'"  class="btn-xs btn-success inline-block"><i class="fa fa-eye-slash"></i></a>';						
					?>
					</div>
					<div class="col-md-8">
					Cur. Password
					</div>
					<div class="col-md-1">
					<?php
						echo '<a href="'.site_url($uri2all."/show").'"  class="btn-xs btn-danger inline-block"><i class="fa fa-eye"></i></a>';
					?>
					</div>
					</th>										
					<th>Pwd Status</th>					
					<th>Visited</th>					
					<th style="width:10%;">Options</th>
				</tr>
			</thead>
			<tbody style='font-size:20px;'>
				 <?php 		
				 	if(isset($services)){
				 		$csrf = array(
  				  		        'name' => $this->security->get_csrf_token_name(),
        						'hash' => $this->security->get_csrf_hash()
							);
						foreach($services as $row){							
							//$uri1 = "?admin/visitservice/".$row['id']; //FOR USER

							$id = $row['id'];							
							$uri1 = "?user/renewpasswordservice/".$id;
							$uri2 = "?user/check_password/".$id;	
							//$uri3 = base_url()."?user/viewpassword/".$id;
							$uri3 = "?user/goservice/".$id;
							$uri4 = "?user/viewservice/".$id;
							$uri5 = "?user/syncservice/".$id;
							//<a href=".." >Go</a>
							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>'.$row['id'].'</td>';							
							echo  '<td>'.$row['servname'].'</td>';																					
							echo  '<td>'.$row['username'].'</td>';
							echo  '<td>';
							echo '<div style="display:inline-block">';
							echo $row['password'];
							echo '</div>';							
							echo form_open($uri1);
							echo '<div class="col-md-7">';
							echo '<input name="passwordlen" data-parsley-required="true" class="input-sm" type="range" min="8" max="30" value="'.strlen($row['password']).'" step="1" onmousemove="showValue(this.value,'.$id.')"/>';
							echo '</div>';
							echo '<div class="col-md-5">';
							echo "<button type='submit'  class='btn-xs btn-success inline-block'><i class='fa fa-refresh'></i><span id='range".$id."'> len => ".strlen($row['password'])."</span></button>";
							echo '</div>';
							//echo "<a href=".site_url($uri4)."  class='btn-xs btn-success block'><i class='fa fa-refresh'></i> Renew <span id='range".$id."'>length => 12</span></a>";
							echo form_close();
							echo '</td>';														
							echo  '<td> <small class="badge badge-'.$stylestatus[$row['stats'][1]].' badge-round bounceIn animation-delay3 m-left-xs">'.$row['stats'][1].'</small> | ';
							echo  '<small class="badge badge-'.$stylestatus[$row['stats'][0]].' badge-round bounceIn animation-delay4 m-left-xs">'.$row['stats'][0].'</small> => ';
							if($row['stats'][0]=="Visible"){
								echo '<a href="'.site_url($uri2."/hide").'"  class="btn-xs btn-success inline-block"><i class="fa fa-eye-slash"></i> Hide</a>';
							}elseif($row['stats'][0]=="Hidden"){							
								echo '<a href="'.site_url($uri2."/show").'"  class="btn-xs btn-danger inline-block"><i class="fa fa-eye"></i> Show</a>';
							}
							echo ' <br> | ';
							echo  '<small class="badge badge-'.$stylestatus[$row['stats'][2]].' badge-round bounceIn animation-delay5 m-left-xs">'.$row['stats'][2].'</small>';
							if($row['stats'][2] == "Asynchronous"){
								echo " => <a href=".site_url($uri5)."  class='btn-xs btn-success' tooltip='que es esto?'><i class='fa fa-refresh'></i> Sync</a>";
							}
							echo'</td>';							
							echo  '<td>'.$row['times'].' times</td>';								
							echo "<td>";
							echo '<div class="btn-toolbar" role="toolbar" aria-label="...">';
							echo '<div class="btn-group" role="group" aria-label="...">';							
							echo "<a href=".site_url($uri4)."  class='btn btn-success'><i class='fa fa-eye'></i>View</a>";							
							echo '</div>';
							echo '<div class="btn-group" role="group" aria-label="...">';							
							
							echo '</div>';
							echo '<div class="btn-group" role="group" aria-label="...">';							
							echo anchor($uri3, 'Go','target="_blank" class="btn fa fa-external-link-square"');
							echo '</div>';
							echo '</div>'; //toolbar div
							echo "</td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
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
	<script type="text/javascript">

		function showValue(newValue, idserv)
		{
			document.getElementById("range"+idserv).innerHTML=" len => " +newValue;
		}
		
	</script>
	


</div><!-- /main-container -->
