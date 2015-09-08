<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hyper Mega RihSlash  - Project • Panel de Control</title>
	<meta name="robots" content="noindex, nofollow">

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>template/theme/bootstrap/css/bootstrap.min.css?nocache=" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!-- ionicons -->
	<link href="<?php echo base_url();?>template/theme/css/ionicons.min.css?nocache=" rel="stylesheet">
	<!-- Simplify -->
	<link href="<?php echo base_url();?>template/theme/css/simplify.min.css?nocache=" rel="stylesheet">
	<link href="<?php echo base_url();?>template/datepicker/css/datepicker.css?nocache=" rel="stylesheet">
	<link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />	
	<!-- Login Form Style -->
	<link href="<?php echo base_url();?>template/login_form/login_style.css?nocache=" rel="stylesheet">	
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  	</head>

  	<body>
  		<?php if($this->session->flashdata('flash_message') != ""):?>
        <script>
            $(document).ready(function() {
                Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "})
            });
        </script>
        <?php endif;?>

         <!--
		##############################
		           HEADER
		##############################
		-->
  		<header class="top-nav">
			<div class="top-nav-inner">
				<div class="nav-container">
					<div class="pull-right m-right-sm">
						<div class="user-block hidden-xs">
							<a href="#" id="userToggle" data-toggle="dropdown">
								<div class="user-detail inline-block" style="font-size:10px;"><i class="fa fa-bars"></i> BIENVENIDO <i class="fa fa-angle-down"></i></div>
							</a>
							<div class="panel border dropdown-menu user-panel">
								<div class="panel-body paddingTB-sm">
									<ul>
										<li style="font-size:10px;"><a href=""><i class="fa fa-edit fa-lg"  style="width:15px;"></i><span class="m-left-xs">REGISTRARSE</span></a></li>
										<li style="font-size:10px;"><a href=""><i class="fa fa-inbox fa-lg" style="width:15px;"></i><span class="m-left-xs">INGRESAR</span></a></li>
									</ul>
								</div>
							</div>
						</div>
						<ul class="nav-notification" style="padding-right:20px;">
							<!--
							<li>
								<a href="#" data-toggle="dropdown"><i class="fa fa-envelope fa-lg"></i></a>
								<div class="chat-alert">Contacto</div>				
							</li>
							<li>
								<a href="#" data-toggle="dropdown"><i class="fa fa-list fa-lg"></i></a>
								<div class="chat-alert">Bases</div>
							</li>
							-->
							<!--<li class="chat-notification">
								<a href="#" class="sidebarRight-toggle"><i class="fa fa-power-off fa-lg"></i></a>
								
								<div class="chat-alert">Salir</div>
								
							</li>
							-->
						</ul>
					</div>
				</div>
			</div>
		</header>

		<div class="wrapper no-navigation preload">
			<div class="sign-in-wrapper">
				<div class="row">
					<div class="col-sm-6">
						<div class="sign-in-inner">						
							<div class="login-brand text-center">
								<!-- <img src="<?php echo base_url();?>template/theme/img/logo-account.png"></br> -->
								<img src="<?php echo base_url();?>template/theme/img/account-text-login2.png">
							</div>
							<?php include 'page_info.php'; ?>
							<?php echo form_open('?login',array('id' => 'formValidate2', 'class' => 'login'));?>
								<p>					      
							      <input type="text" data-parsley-required="true" name="email" id="login" placeholder="Correo Electrónico">
							    </p>
							    <p>					      
							      <input type="password" data-parsley-required="true" name="password" id="password" placeholder="Contraseña">
							    </p>
							    <p class="login-submit">
							      <button type="submit" class="login-button">LOG IN</button>
							    </p>
							    
							    <?php // Captcha is only shown if not already solved
								/*if (!$captchaSolved) {
									echo '<h5>Captcha</h5>';
									echo '<div>';
									echo $captchaHtml;
									echo form_input(
										array(
											'name'        => 'CaptchaCode',
											'id'          => 'CaptchaCode',
											'value'       => '',
											'maxlength'   => '100',
											'size'        => '35',
											'style'		  => 'height: 25px'
										)
									);
									echo '</div>';
									echo form_error('CaptchaCode');
								};*/ // end if(!$captchaSolved) ?>
								
								<br>
							    <a href="<?php echo site_url('?account/create');?>" class="btn btn-success">Register</a>
							    <a href="<?php echo site_url('?account/recover');?>">Forgot your password?</a>


							<?php echo form_close();?>
						</div><!-- ./sign-in-inner -->
					</div> <!-- ./col-sm -->
					<div class="col-sm-6">
						<div class="sign-in-inner">
							<canvas id="myCanvas" width="300" height="300" style="background-color:white">
						  		<p>Su navegador no soporta HTML5</p>
							</canvas> 	
							<div class="col-sm-8">							
								<input id="sizeCanvas" name="valcanvas" data-parsley-required="true" class="input-sm" type="range" min="3" max="9" value="3" step="1" onchange="changeCanvasSize(this.value)"/>							
							</div>
							<div class="col-sm-4">
								<span class='btn-xs btn-success' id='valrange'>value => 3x3</span>
							</div>
						</div><!-- ./sign-in-inner -->
					</div> <!-- ./col-sm -->
				</div> <!-- ./row -->
			</div><!-- ./sign-in-wrapper -->
		</div><!-- /wrapper -->

		<a href="#" id="scroll-to-top" class="hidden-print"><i class="icon-chevron-up"></i></a>

	    <!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
		
		<!-- Jquery -->
		<script src="<?php echo base_url();?>template/theme/js/jquery-1.11.1.min.js"></script>
		
		<!-- Bootstrap -->
	    <script src="<?php echo base_url();?>template/theme/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll -->
		<script src='<?php echo base_url();?>template/theme/js/jquery.slimscroll.min.js'></script>
		
		<!-- Popup Overlay -->
		<script src='<?php echo base_url();?>template/theme/js/jquery.popupoverlay.min.js'></script>

		<!-- Modernizr -->
		<script src='<?php echo base_url();?>template/theme/js/modernizr.min.js'></script>
		
		<!-- Simplify -->
		<script src="<?php echo base_url();?>template/theme/js/simplify/simplify.js"></script>
		
		<script src="<?php echo base_url();?>template/theme/js/parsley.min.js"></script>
		<!-- Point JS -->
		<script src="<?php echo base_url();?>template/js/Point.js"></script>
		<script>
			
			$(function()	{
				//Delete Widget Confirmation
				$('#deleteWidgetConfirm').popup({
					vertical: 'top',
					pagecontainer: '.container',
					transition: 'all 0.3s'
				});

				//Form Validation
				$('#basic-constraint').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							return false;
						}
			        }
			    }}); 
				
				$('#type-constraint').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							return false;
						}
			        }
			    }}); 
				 
				$('#formValidate2').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Registration Complete');
							return false;
						}
			        }
			    }}); 
				
				$('#formValidatex2').parsley( { listeners: {
					onFieldValidate: function ( elem ) {
						// if field is not visible, do not apply Parsley validation!
						if ( !$( elem ).is( ':visible' ) ) {
							return true;
						}

						return false;
					},
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Your message has been sent');
							return false;
						}
			        }
			    }}); 
			});   
		</script>

        <script type="application/x-javascript">
            var width = height = 0;
            var path = []; //made by users
            var validpath = [];//positions x,y defined by pattern matrix 
            var positions = "";
            var hovering = [-1, -1];
            var validpositions = []; //same as path, positions i,j of pattern matrix
            var correctpositions = "00110201";
			var addonce = true;
			var xStart = yStart = -1;
            var xFinal = yFinal = -1;
            var maxLengthPath = 50;
            function isCorrectPath(vpath, cpath){
            	var r = true;
            	len = cpath.length;
            	vlen = vpath.length;
            	p = 0;
            	if (len != vlen) return false;
            	return (vpath === cpath);
            	
            }
            function checkValidPath(vpath, x, y, threhold){
            	var r = false;
            	var len = vpath.length;
            	p = 0;
            	while (p < len && r != true){
            		if (Math.abs(vpath[p].x - x) <= threhold && Math.abs(vpath[p].y - y) <= threhold){
            			var pto = new Point;
            			pto.x = vpath[p].x
            			pto.y = vpath[p].y;
            			if(path.length == 0){ 
            				path[0] = pto;
            				positions += (validpositions[p].x).toString()+(validpositions[p].y).toString();
            				hovering[0] = validpositions[p].x;
            				hovering[1] = validpositions[p].y;
            			}else{
            				if(!(path[path.length-1].x == pto.x && path[path.length-1].y == pto.y)){
            					path[path.length] = pto;
            					positions += (validpositions[p].x).toString()+(validpositions[p].y).toString();
            					hovering[0] = validpositions[p].x;
            					hovering[1] = validpositions[p].y;
            					//console.log(path[path.length-1].x + " & "+path[path.length-1].y);
            					console.log(positions);
            				}
            			}
            			r = true;            			            		
            			//for (var k=0;k<path.length;k++) console.log(path[k].x + " ; "+path[k].y);
            			//console.log(Math.abs(vpath[p].y - y));
            		}
            		p++;

            	}
            	return r;
            }
            function basePattern(){
            	var c = document.getElementById("myCanvas");
            	var size = document.getElementById("sizeCanvas").value;
            	
            	var f = 1;
            	if (size > (9-3))	f = 1.5;
            	c.width = f*3*100;
            	c.height = f*3*100;
            	
            	width = c.width;
				height = c.height;
				var ctx = c.getContext("2d");
				var centerX = c.width / 2;
				var centerY = c.height / 2;
				

				// Create gradient						
				
				var ctx = c.getContext("2d");
				var grd = ctx.createRadialGradient(centerX,centerY,1,centerX,centerY,100);
				grd.addColorStop(0, "black");
				grd.addColorStop(0.5, "red");
				grd.addColorStop(1, "white");
				//ctx.fillStyle = grd;
				ctx.shadowBlur=10;
				//ctx.fillRect(20, 20, 150, 100);				

				// Fill with gradient
				//ctx.fillStyle = grd;
				ctx.fillStyle = "#0F0F0F";
				var ctr = [];
				//validpath.splice(0,validpath.length);
				var radio = width/(4+(size-1)*3);
				console.log(radio);
				var pivot = 2*radio;
				var dx = 3*radio;
				previousr = radio;
				for(var i=0;i<size;i++){				    
				    var aux = [];
				    for(var j=0;j<size;j++){				    	  
						ctx.beginPath();
						if (hovering[0] == i && hovering[1] == j) radio = radio*1.2;
						else radio = previousr;
						var x = pivot+i*dx;
						var y = pivot+j*dx;
						grd = ctx.createRadialGradient(x,y,radio/5,x,y,radio);
						grd.addColorStop(0, "black");
						grd.addColorStop(0.5, "red");
						grd.addColorStop(1, "white");
						ctx.fillStyle = grd;
						ctx.arc(x,y,radio,0,2*Math.PI);
						ctx.fill();
						ctx.lineWidth = 2;
						ctx.strokeStyle = '#003300';
						ctx.stroke();
						aux[j] = x+" - "+y;
						if(addonce==true){
							var punto = new Point(x,y);
							var pos = new Point(i,j);
							validpath[i*size+j] = punto;
							validpositions[i*size+j] = pos;
						}
				          
				    }
				    ctr[i] = aux;
				    
				}
				//if(addonce==true) path[0] = new Point(validpath[0].x, validpath[0].y);
				addonce = false;
				//console.log(ctr.toString());
				console.log(validpositions.toString()); 
				//for(var k = 0; k<ctr2.length; k++)
					//console.log(ctr2.toString()+"\n"); 
				//ctx.fillRect(10,10,150,80);

            	
            }
            window.onload = basePattern;
            function drawPattern(color,x,y){
            	var c = document.getElementById("myCanvas");
				var context = c.getContext("2d");
				var xy = c.leftTopScreen ();
				//console.log(checkValidPath(validpath,x - xy[0],y - xy[1],10));
				if (path.length > maxLengthPath) path = [];
				if(path.length > 0){
					if(xStart != -1 && yStart != -1){
						var flip = document.getElementById ("myCanvas");
						var context = flip.getContext ("2d");						
						context.fillStyle = "rgb(255, 0, 0)"; 
                    	context.lineWidth="5";
						context.strokeStyle=color; // blue path  
                       	context.beginPath();
                       	context.moveTo(xStart, yStart);
                       	context.lineTo(path[0].x, path[0].y);
						for (var k=1;k<path.length;k++){
							context.moveTo(path[k-1].x, path[k-1].y);
							context.lineTo(path[k].x, path[k].y);
						}                       
                       context.stroke();
                    }
				}

            }

		   
           Element.prototype.leftTopScreen = function () {
                var x = this.offsetLeft;
                var y = this.offsetTop;

                var element = this.offsetParent;

                while (element !== null) {
                    x = parseInt (x) + parseInt (element.offsetLeft);
                    y = parseInt (y) + parseInt (element.offsetTop);

                    element = element.offsetParent;
                }

                return new Array (x, y);
            }

            document.addEventListener ("DOMContentLoaded", function () {
                var flip = document.getElementById ("myCanvas");

                var xy = flip.leftTopScreen ();

                var context = flip.getContext ("2d");

                context.fillStyle = "rgb(255,255,255)";  
                context.lineWidth="5";
				context.strokeStyle="blue"; // blue path 
                context.fillRect (0, 0, 500, 500);

                flip.addEventListener ("mousemove", function (event) {
                    var x = event.clientX;
                    var y = event.clientY;                    		                    
                    //console.log(validpath.toString());
                    if(xStart != -1 && yStart != -1){
                    	context.clearRect (0, 0, width, height);
                    	basePattern();                    
                    	drawPattern("blue",x,y);
                    	console.log(checkValidPath(validpath,x - xy[0],y - xy[1],10));
                        context.beginPath();
                        context.moveTo(xFinal, yFinal);
                       	context.lineTo(x - xy[0], y - xy[1]);
                       	xFinal = path[path.length-1].x; //last point selected
                       	yFinal = path[path.length-1].y; //last point selected
                       	context.stroke();
                    }
                });

                flip.addEventListener ("mousedown", function (event) {
                    var x = event.clientX;
                    var y = event.clientY;                    
                    var check = checkValidPath(validpath,x - xy[0],y - xy[1],10);                    
                    //context.fillRect (x - xy[0], y - xy[1], 5, 5);
                    if(check){             	
                    	xStart = yFinal = x - xy[0]; 
                    	yStart = yFinal = y - xy[1];	
                    }
                    
                });
                flip.addEventListener ("mouseup", function (event) {
                    var x = event.clientX;
                    var y = event.clientY;

                    context.fillStyle = "rgb(255, 0, 0)";  
                    context.lineWidth="5";
					context.strokeStyle="black"; // blue path 
                    //context.fillRect (x - xy[0], y - xy[1], 5, 5);
                    //console.log(context.toString());
                    hovering[0] = -1; hovering[1] = -1;
                    if(xStart != -1 && yStart != -1){
                       context.beginPath();
                       context.moveTo(xStart, yStart);
                       context.lineTo(x - xy[0], y - xy[1]);
                       context.stroke();
                       if(isCorrectPath(positions,correctpositions)){
                       		context.clearRect (0, 0, width, height);
                    		basePattern();                    
                    		drawPattern("green",x,y);
                       }else{
                       		context.clearRect (0, 0, width, height);
                    		basePattern();                    
                    		drawPattern("red",x,y);
                       }

                    }
                    path = [];
                    positions = "";                    
                    xStart = yStart = xFinal = yFinal = -1;
                });
                
            });  

            function changeCanvasSize(newValue)
			{
				document.getElementById("valrange").innerHTML="value => " +newValue+"x"+newValue;
				validpath = [];
				path = [];
				validpositions = [];
				hovering[0] = -1; hovering[1] = -1;
				positions = "";				
				addonce = true;
				basePattern();

			}           
        </script>

        
  	</body>

<!-- Mirrored from minetheme.com/simplify1.0/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:36:07 GMT -->
</html>
