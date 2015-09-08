        
        <!-- ------FLASH MESSAGES Nulled by vokey --->
        
		<!--<?php if($this->session->flashdata('flash_message') != ""):?>
        <div class="container-fluid padded">
        	<div class="alert alert-info">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?php echo $this->session->flashdata('flash_message');?>
            </div>
        </div>
        <?php endif;?>-->
        
   <!--     
        <?php if($this->session->flashdata('flash_message') != ""):?>
 		<script>
			$(document).ready(function() {
				Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "})
			});
		</script>
        <?php endif;?>
    -->
        <?php if(isset($flash_message) && $flash_message != ""):?>
        
     <!--   <script>
        $(document).ready(function() {
            //Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "});

            alert("HOLAAAAAA <?php echo $flash_message; ?>");
        });
        </script>
    -->
        <center>
            <small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"> 
                <?php echo $flash_message; ?>
            </small>
        </center>
    
        <?php endif; ?>