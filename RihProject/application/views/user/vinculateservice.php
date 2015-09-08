
<div class="main-container">
	 
	<!-- <?php include 'page_info.php'; ?> -->
	<?php if (isset($flash_message)){		
		echo '<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs">'.$flash_message.'</small>';
	} ?>
	<!-- <?php if(isset($idserv)){ echo "<h1>".$idserv."</h1>"; } ?> -->
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>VINCULATE</li>	 
			<li>NEW SERVICE</li>			
			<li style="float:right;color:green"><a href="<?php echo site_url('?user/vinculate_service_form');?>"><i class="fa fa-plus"></i></a></li>
			<li style="float:right;color:red"><a href="<?php echo site_url('?user/request_service_form');?>"><i class="fa fa-plus-square"></i></a></li>
			<li style="float:right;"><a href="javascript:window.print(); void 0;"><i class="fa fa-print"></i></a></li> 
		</ul>
		<div class="login-brand text-center">	
			<div class="col-md-6">					
					<?php echo form_open('?user/vinculate_service',array('id' => 'formValidate1'));?>   

						<div class="form-group m-bottom-md">
							<select name="service_id" data-parsley-required="true" class="form-control" style="width:100%;">
                            <?php                             
                            foreach($services as $s):
                            ?>
                                <option value="<?php echo $s['id'];?>" >
                                    <?php echo $s['name'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
						</div>
						<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="username" class="form-control" placeholder="Username..." autocomplete="off">
						</div>
						<div class="form-group m-bottom-md">							
							<div class="col-md-11">
								<input id="pwd" type="password" data-parsley-required="true" name="password" class="form-control" placeholder="Password here!..." autocomplete="off">
							</div>
							<div class="col-md-1">
								<div id="btnpwd" class="btn">
									<i id ="iconeye" class="fa fa-eye"></i>
								</div>
							</div>							
						</div>
						<div class="form-group m-bottom-md">
							<label value="Valuation (1..10)">Valuation [1..10] How often shall I renew pwd</label>
							<input name="valuation" data-parsley-required="true" type="range" min="1" max="10" value="5" step="1" onmousemove="showValue(this.value)"/>
							<span id="range">5</span>
							<!-- <select name="valuation" data-parsley-required="true" class="form-control" style="width:100%;">
                            <?php                             
	                            for($i=10;$i>=1;$i--):
	                            ?>
	                                <option value="<?php echo $i;?>" >
	                                    <?php echo $i;?></option>
	                            <?php
	                            endfor;
	                            ?>
                        	</select> -->
						</div>
						<div class="form-group">
							<input type="textarea" maxlength="200" wrap="soft" rows="4" cols="50" data-parsley-required="true" name="notes" class="form-control" placeholder="Notes (optional relevant info to this vinculation...)" autocomplete="off">
						</div>
						<div class="m-top-md p-top-sm">
							<input type="submit" value="Vinculate" class="btn btn-success block" style="width:100%; font-size:10px;"/>
						</div>
					<?php echo form_close();?>
				
			</div> <!-- col-md -->
			<div class="col-md-6">
					<?php
					if (isset($registry)){
						echo form_open('?user/vinculate_service_registry');  
						foreach ($registry as $row) {
							echo '<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="'.$row['field'].'" class="form-control" placeholder="'.$row['field'].' here!...">
						</div>'; 	
						}
						echo '<div class="m-top-md p-top-sm">
							<input type="submit" value="Registrar" class="btn btn-success block" style="width:100%; font-size:10px;"/>
						</div>';
						echo form_close();
						
					}
					?>


						
				
			</div> <!-- col-md -->
		</div>	<!-- login-brand -->
	</div><!-- ./padding-md -->
</div><!-- /main-container -->
			
<script type="text/javascript">


function showValue(newValue)
{
	document.getElementById("range").innerHTML=newValue;
}


</script>
		
