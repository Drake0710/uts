<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>INCRIMA - Login</title>
	
	<link rel="icon" href="{{ asset('/template/img/incrima.ico') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/template/css/bootstrap.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('/template/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="{{ asset('/template/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/css/style-responsive.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/plugins/alertify/themes/alertify.core.css') }}">
	<link rel="stylesheet" href="{{ asset('/plugins/alertify/themes/alertify.default.css') }}">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form id="form-ruh" name="form-ruh" class="form-login" onsubmit="return false">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<!--<h2 class="form-login-heading">INCRIMA</h2>-->
		        <div class="login-wrap" id="bounce">
					<div class="row">
						<div class="col-lg-3">
							<img src="{{ asset('/template/asset/imgs/logo-kemenkeu.png') }}" width="70" height="70">
						</div>
						<div class="col-lg-9">
							<span class="pull-left text-danger" style="font-size:15px;">
								Kementerian Keuangan RI</br>
							</span>
							<span class="pull-left text-primary" style="font-size:15px;padding-top:5px;">
								Direktorat Jenderal Perbendaharaan
							</span>
						</div>
					</div>
					<hr>
					<div id="div-username" class="form-group">
						<input id="username" name="username" type="text" class="form-control" placeholder="User ID" autofocus>
					</div>
		            <br>
					<div id="div-password" class="form-group">
						<input id="password" name="password" type="password" class="form-control" placeholder="Password">
					</div>
					<br>
					<div id="div-tahun" class="form-group">
						<select id="tahun" name="tahun" class="form-control chosen">
							<option value="2016">TA 2016</option>
							<option value="2017" selected>TA 2017</option>
							<option value="2018">TA 2018</option>
						</select>
					</div>
		            <button id="btn-login" class="btn btn-theme btn-block"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		            <!--<div class="login-social-link centered">
		            <p>or you can sign in via your social network</p>
		                <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
		                <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
		            </div>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="#">
		                    Create an account
		                </a>
		            </div>-->
		
		        </div>
		
		          <!-- Modal -->
		          <!--<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>-->
		          <!-- modal -->
		
		      </form>
			  </br>
			  <div class="col-lg-12" style="padding-top:100px;">
				<img src="{{ asset('/template/img/logo_incrima.png') }}" width="600" height="200" style="display: table-caption;margin: 0 auto;">
			  </div>
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('/template/js/jquery.js') }}"></script>
    <script src="{{ asset('/template/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/plugins/alertify/lib/alertify.min.js') }}"></script>
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="{{ asset('/template/js/jquery.backstretch.min.js') }}"></script>
    <script>
		jQuery(document).ready(function(){
			$.backstretch("{{ asset('/template/img/login-bg.jpg') }}", {speed: 500});
			
			function doBounce(element, times, distance, speed) {
				for(i = 0; i < times; i++) {
					element.animate({marginTop: '-='+distance},speed)
						.animate({marginTop: '+='+distance},speed);
				}        
			}
			
			jQuery('#btn-login').click(function(){
			
				//bouncing for awhile...
				doBounce(jQuery('#bounce'), 3, '10px', 100);
			
				jQuery(this).html('Loading....');
				jQuery(this).prop('disabled', true);
				var lanjut=true;
				if(jQuery('#username').val()==''){
					jQuery('#div-username').addClass('has-error');
					lanjut=false;
				}
				if(jQuery('#password').val()==''){
					jQuery('#div-password').addClass('has-error');
					lanjut=false;
				}
				/*if(jQuery('#tahun').val()==''){
					jQuery('#div-tahun').addClass('has-error');
					lanjut=false;
				}*/
				if(lanjut==true){
					var data=jQuery('#form-ruh').serialize();
					jQuery.ajax({
						url:'auth',
						data:data,
						method:'POST',
						success:function(result){
							if(result.error==false){
								window.location.href='./';
							}
							else{
								alertify.log(result.message);
								jQuery('#btn-login').html('<i class="fa fa-lock"></i> SIGN IN');
								jQuery('#btn-login').prop('disabled', false);
							}
						},
						error:function(result){
							alertify.log('Sesi telah habis. Silahkan refresh halaman browser Anda.');
							jQuery('#btn-login').html('<i class="fa fa-lock"></i> SIGN IN');
							jQuery('#btn-login').prop('disabled', false);
						}
					});
					
				}
				else{
					alertify.log('Kolom tidak dapat dikosongkan!');
					jQuery('#btn-login').html('<i class="fa fa-lock"></i> SIGN IN');
					jQuery('#btn-login').prop('disabled', false);
				}
			});
		});
    </script>


  </body>
</html>
