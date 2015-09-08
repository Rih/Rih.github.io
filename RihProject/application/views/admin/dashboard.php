
<div class="main-container">
	 
	<!-- <?php include 'page_info.php'; ?> -->
	<div class="padding-md">
		<div class="row">
			<div class="col-sm-6">
				<div class="page-title">
					Dashboard
				</div>
				<div class="page-sub-header">
			
					
				</div>
			</div>
		</div>

		<div class="row m-top-md">
			<div class="col-lg-3 col-sm-6">
				<div class="statistic-box bg-danger m-bottom-md">
					<div class="statistic-title">empty field</div>
					<div class="m-top-md">CANTIDAD DE NÚMEROS REGISTRADOS</div>
					<div class="statistic-value">
						<i class="fa fa-ticket"></i> <?php if(isset($rifa)){ 
							$str_num1 = number_format( $rifa, 0, ',', '.' ); 
							echo $str_num1; 
							} ?>
					</div>
					<div class="statistic-icon-background">
						<i class="fa fa-ticket"></i>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="statistic-box bg-info m-bottom-md">
					<div class="statistic-title">TOTAL SERVICIOS</div>
					<div class="m-top-md">SERVICIOS CREADOS A LA FECHA</div>
					<div class="statistic-value">
						<i class="fa fa-shopping-cart"></i> <?php if(isset($nservices)){ 
							$str_num2 = number_format( $nservices, 0, ',', '.' ); 
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

			<div class="col-lg-3 col-sm-6">
				<div class="statistic-box bg-success m-bottom-md">
					<div class="statistic-title">empty field</div>
					<div class="m-top-md">TOTAL DE GANANCIA ACUMULADA</div>
					<div class="statistic-value">
						<i class="fa fa-credit-card"></i> <?php if(isset($rifa)){ 
							$str_num4 = number_format( $rifa*$valor_rifa, 0, ',', '.' ); 
							echo '$'.($str_num4); } ?>
					</div>
					<div class="statistic-icon-background">
						<i class="fa fa-credit-card"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-9">
				<div class="row">
					<div class="col-lg-6">
						<div class="smart-widget widget-dark-blue">
							<div class="smart-widget-header">
								TOTAL VISITS
								<span class="smart-widget-option">
									<span class="refresh-icon-animated">
										<i class="fa fa-circle-o-notch fa-spin"></i>
									</span>
		                            <a href="#" class="widget-toggle-hidden-option">
		                                <i class="fa fa-cog"></i>
		                            </a>
		                            <a href="#" class="widget-collapse-option" data-toggle="collapse">
		                                <i class="fa fa-chevron-up"></i>
		                            </a>
		                            <a href="#" class="widget-refresh-option">
		                                <i class="fa fa-refresh"></i>
		                            </a>
		                            <a href="#" class="widget-remove-option">
		                                <i class="fa fa-times"></i>
		                            </a>
		                        </span>
							</div>
							<div class="smart-widget-inner">
								<div class="smart-widget-hidden-section">
									<ul class="widget-color-list clearfix">
										<li style="background-color:#20232b;" data-color="widget-dark"></li>
										<li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
										<li style="background-color:#23b7e5;" data-color="widget-blue"></li>
										<li style="background-color:#2baab1;" data-color="widget-green"></li>
										<li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
										<li style="background-color:#fbc852;" data-color="widget-orange"></li>
										<li style="background-color:#e36159;" data-color="widget-red"></li>
										<li style="background-color:#7266ba;" data-color="widget-purple"></li>
										<li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
										<li style="background-color:#fff;" data-color="reset"></li>
									</ul>
								</div>
								<div class="smart-widget-body no-padding">
									<div class="padding-md">
										<div id="totalSalesChart" class="morris-chart" style="height:250px;"></div>
									</div>
									
									<div class="bg-grey">
										<div class="row">
											<div class="col-xs-4 text-center">
												<h3 class="m-top-sm">999</h3>
												<small class="m-bottom-sm block">Total Visits</small>
											</div>
											<div class="col-xs-4 text-center">
												<h3 class="m-top-sm">102</h3>
												<small class="m-bottom-sm block">New Visits</small>
											</div>
											<div class="col-xs-4 text-center">
												<h3 class="m-top-sm">690</h3>
												<small class="m-bottom-sm block">Bounce Rate</small>
											</div>
										</div>
									</div>
								</div>
							</div><!-- ./smart-widget-inner -->
						</div><!-- ./smart-widget -->
					</div><!-- ./col -->
					<div class="col-lg-6">
							<div class="smart-widget widget-dark-blue">
								<div class="smart-widget-header">
									TOTAL SALES
									<span class="smart-widget-option">
										<span class="refresh-icon-animated">
											<i class="fa fa-circle-o-notch fa-spin"></i>
										</span>
			                            <a href="#" class="widget-toggle-hidden-option">
			                                <i class="fa fa-cog"></i>
			                            </a>
			                            <a href="#" class="widget-collapse-option" data-toggle="collapse">
			                                <i class="fa fa-chevron-up"></i>
			                            </a>
			                            <a href="#" class="widget-refresh-option">
			                                <i class="fa fa-refresh"></i>
			                            </a>
			                            <a href="#" class="widget-remove-option">
			                                <i class="fa fa-times"></i>
			                            </a>
			                        </span>
								</div>
								<div class="smart-widget-inner">
									<div class="smart-widget-hidden-section">
										<ul class="widget-color-list clearfix">
											<li style="background-color:#20232b;" data-color="widget-dark"></li>
											<li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
											<li style="background-color:#23b7e5;" data-color="widget-blue"></li>
											<li style="background-color:#2baab1;" data-color="widget-green"></li>
											<li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
											<li style="background-color:#fbc852;" data-color="widget-orange"></li>
											<li style="background-color:#e36159;" data-color="widget-red"></li>
											<li style="background-color:#7266ba;" data-color="widget-purple"></li>
											<li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
											<li style="background-color:#fff;" data-color="reset"></li>
										</ul>
									</div>
									<div class="smart-widget-body no-padding">
										<div class="padding-md">
											<div id="placeholder" style="height:250px;">												
											</div>
										</div>

										<div class="bg-grey">
											<div class="row">
												<div class="col-xs-4 text-center">
													<h3 class="m-top-sm">3491</h3>
													<small class="m-bottom-sm block">Total Sales</small>
												</div>
												<div class="col-xs-4 text-center">
													<h3 class="m-top-sm">721</h3>
													<small class="m-bottom-sm block">New Orders</small>
												</div>
												<div class="col-xs-4 text-center">
													<h3 class="m-top-sm">$8103</h3>
													<small class="m-bottom-sm block">Total Earnings</small>
												</div>
											</div>
										</div>
									</div>
								</div><!-- ./smart-widget-inner -->
							</div><!-- ./smart-widget -->
					</div><!-- ./col -->
				</div><!-- ./row -->

				<div class="smart-widget widget-green" >
					<div class="smart-widget-header">
						ÚLTIMOS REGISTROS DE VENTAS
						<span class="smart-widget-option">
							<span class="refresh-icon-animated">
								<i class="fa fa-circle-o-notch fa-spin"></i>
							</span>
                            <a href="#" class="widget-toggle-hidden-option">
                                <i class="fa fa-cog"></i>
                            </a>
                            <a href="#" class="widget-collapse-option" data-toggle="collapse">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="#" class="widget-refresh-option">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a href="#" class="widget-remove-option">
                                <i class="fa fa-times"></i>
                            </a>
                        </span>
					</div>
					<div class="smart-widget-inner table-responsive">
						<div class="smart-widget-hidden-section">
							<ul class="widget-color-list clearfix">
								<li style="background-color:#20232b;" data-color="widget-dark"></li>
								<li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
								<li style="background-color:#23b7e5;" data-color="widget-blue"></li>
								<li style="background-color:#2baab1;" data-color="widget-green"></li>
								<li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
								<li style="background-color:#fbc852;" data-color="widget-orange"></li>
								<li style="background-color:#e36159;" data-color="widget-red"></li>
								<li style="background-color:#7266ba;" data-color="widget-purple"></li>
								<li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
								<li style="background-color:#fff;" data-color="reset"></li>
							</ul>
						</div>
						<table class="table table-striped no-margin">
							<thead>
								<tr>
									<th class="text-right">No. Voucher</th>
									<th class="text-right">Fecha Transacción</th>
									<th class="text-right">Cant. Boletos</th>
									<th class="text-right">Total $</th>
									<th class="text-right">Usuario</th>
									
								</tr>
							</thead>
							<tbody>
							<?php 	
								if (isset($last_transaccion)){
									foreach($last_transaccion as $row){
										$mail = $this->crud_model->get_correo_by_id_transaccion($row->idtransaccion);
										$iduser = $this->crud_model->get_id_by_correo($mail);
										$idvoucher = strval($row->idtransaccion);
										$str_monto = number_format( $row->monto, 0, ',', '.' ); 
										while (strlen($idvoucher) < 10){
											$idvoucher = "0".$idvoucher;
										}
										echo '<tr>';
										echo  '<td class="text-right">'.'#'.$idvoucher.'</td>';
										echo  '<td class="text-right">'.$row->fecha_transaccion.'</td>';									
										echo  '<td class="text-right">'.$row->cantidad_numeros.'</td>';
										echo  '<td class="text-right"><small class="badge badge-danger badge-square bounceIn animation-delay5 m-left-xs">'.$str_monto.'</small></td>';
										echo  '<td class="text-right">'.$mail.'</td>';									
										echo '</tr>';
									}
								}
							?>
							
							</tbody>
						</table>
					</div><!-- ./smart-widget-inner -->
				</div><!-- ./smart-widget -->
			</div><!-- ./col -->
			<div class="col-lg-3">
				<div class="task-widget">
					<div class="task-widget-body clearfix">
						<div class="pie-chart-wrapper">
							<img src="<?php echo base_url();?>template/theme/img/socialshare.png">
						</div>
					</div><!-- ./task-widget-body -->
					<div class="task-widget-statatistic">
						<ul class="clearfix">
							<li class="bg-grey border-success">
								<div class="text-muted text-upper font-sm"><i class="fa fa-twitter"></i> TWITTER</div>
								0
							</li>
							<li class="bg-grey border-danger">
								<div class="text-muted text-upper font-sm"><i class="fa fa-google-plus"></i> GOOGLE PLUS</div>
								0
							</li>
							<li class="bg-grey border-purple">
								<div class="text-muted text-upper font-sm"><i class="fa fa-facebook"></i> FACEBOOK</div>
								0
							</li>
						</ul><!-- ./row -->
					</div>
				</div><!-- ./task-widget -->
			</div><!-- ./col -->
		</div><!-- ./row -->
	</div><!-- ./padding-md -->
</div><!-- /main-container -->
			
