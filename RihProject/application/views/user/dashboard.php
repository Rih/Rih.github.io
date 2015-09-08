
  

<div class="main-container">
	
	<div class="padding-md">
		<div class="row">
			<div class="col-sm-6">
				<div class="page-title">
					Dashboard TOP 10
				</div>
				<div class="page-sub-header">
				</div>
			</div>
		</div>

		<div class="row m-top-md">
			<?php if(isset($favservices)){
				$colors = array('bg-info','bg-danger','bg-info','bg-purple','bg-success');
				$upper_bound_title = '<div class="col-lg-3 col-sm-3">
				<div class="statistic-box ';	
				
				$upper_bound_visitas='<div class="m-top-md">VISITAS ';				
				$upper_bound_value = '<div class="statistic-value">';
				
				$icon = '<i class="fa fa-ticket"></i>';
				$close_div ='</div>';
				$background_icon = '<div class="statistic-icon-background">
						<i class="fa fa-external-link"></i>
					</div>';
				$i = 0;
				foreach ($favservices as $favs){
					$str_num_visitas = number_format( $favs['times'], 0, ',', '.' ); 
					$title = $favs['servname'];
					$id = $favs['id'];
					$uri = "?user/goservice/".$id;
					
					$upper_bound_title_2 = $colors[$i].' m-bottom-md">
					<div class="statistic-title">';
					$echoing ='';
					$i = fmod(($i + 1),5);
					$echoing = $upper_bound_title.$upper_bound_title_2.$title.$close_div;
					$echoing .= $upper_bound_visitas.$str_num_visitas.$close_div;
					$echoing .= $upper_bound_value.$icon.$close_div;
					$echoing .= $background_icon.$close_div.$close_div;					
					echo anchor($uri, $echoing,'target="_blank"','class="block"');
				}
			}
			?>
			
			
			
		</div>

		<div class="row m-top-md">
			<div class="col-lg-3 col-sm-6">
				<div class="statistic-box bg-info m-bottom-md">
					<div class="statistic-title">TOTAL MIS SERVICIOS</div>
					<div class="m-top-md">SERVICIOS CREADOS A LA FECHA</div>
					<div class="statistic-value">
						<i class="fa fa-shopping-cart"></i> <?php if(isset($nmyservices)){ 
							$str_num2 = number_format( $nmyservices, 0, ',', '.' ); 
							echo $str_num2; } ?>
					</div>
					<div class="statistic-icon-background">
						<i class="fa fa-shopping-cart"></i>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="statistic-box bg-purple m-bottom-md">
					<div class="statistic-title">USUARIOS REGISTRADOS</div>
					<div class="m-top-md">CANTIDAD TOTAL DE USUARIOS</div>
					<div class="statistic-value">
						<i class="ion-person-add"></i> <?php if(isset($nusers)){ 
							$str_num3 = number_format( $nusers, 0, ',', '.' ); 
							echo $str_num3; } ?>
					</div>
					<div class="statistic-icon-background">
						<i class="ion-person-add"></i>
					</div>
				</div>
			</div>

		</div>
		
	</div><!-- ./padding-md -->
</div><!-- /main-container -->
			
