
<div class="main-container">
	 
	<!-- <?php include 'page_info.php'; ?> -->
	<?php if (isset($flash_message)){		
		echo '<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs">'.$flash_message.'</small>';
	} ?>
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>BACKUP</li>	 								
			<li>DATA</li>					
		</ul>
		<div class="login-brand text-center">	
			<?php echo form_open('?admin/backup/backup');?>   
			<div class="col-md-6">												
						<h2>BACKUP</h2>
						<div class="form-group m-bottom-md">
							<select name="table" data-parsley-required="true" class="form-control" style="width:100%;">
							<option value="all" >all</option>
                            <?php                                                         
                            foreach($tables as $t):
                            ?>
                                <option value="<?php echo $t;?>" >
                                    <?php echo $t;?></option>
                            <?php
                            endforeach;
                            ?>
                        	</select>
							<!-- <input type="text" data-parsley-required="true" name="topic2" class="form-control" placeholder="Topic"> -->
						</div>
						
						<div class="m-top-md p-top-sm">
							<input type="submit" value="Backup" class="btn-lg btn-success block" style="width:100%; font-size:10px;"/>
						</div>
			</div> <!-- col-md -->		
			
			<?php echo form_close();?>
<!--
			<?php echo form_open('?admin/backup/restore',array('enctype' => 'multipart/form-data'));?>   
			<div class="col-md-6">						
						<h2>RESTORE</h2>
						<div class="form-group m-bottom-md">
							<input type="file" data-parsley-required="true" name="userfile" class="form-control" placeholder="Your file here...">
						</div>						
						<div class="m-top-md p-top-sm">
							<input type="submit" value="Restore" class="btn-lg btn-success block" style="width:100%; font-size:10px;"/>
						</div>
			</div> col-md -->		
			
			<!-- <?php echo form_close();?> -->
				
		</div>	<!-- login-brand -->
	</div><!-- ./padding-md -->
</div><!-- /main-container -->
			

<script type="text/javascript">
	$(document).ready(function($){

		$("#addField").click(function(){			
			$("#divaddfield").append('<input type="text" class="form-control" placeholder="Add Field Name..."></input>');
		});
 	});
</script>		