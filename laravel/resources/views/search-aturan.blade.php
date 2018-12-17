<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template/img/logodbp.ico') }}">
    <title>DB Peraturan</title>
	<link href="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/MaterialAdminPro/landing/assets/owl.carousel/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/MaterialAdminPro/landing/assets/owl.carousel/owl.theme.default.css') }}" rel="stylesheet" />

    <!-- Plugins -->
    <link href="{{ asset('plugins/chosen/chosen.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/alertify/themes/alertify.default.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/switch/bootstrap-switch.min.css') }}" rel="stylesheet">

    <!-- Angular -->
    <link href="{{ asset('template/angular/loading-bar.css') }}" rel="stylesheet" media='all'>
    
    <link href="{{ asset('template/MaterialAdminPro/landing/css/landing.css') }}" rel="stylesheet">
    <link href="{{ asset('template/MaterialAdminPro/landing/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('template/MaterialAdminPro/css/style.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.btn-menu{
			margin-right:10px;
			background:transparent !important;
			border: solid 1px #007dc6;
			color:#007dc6 !important;
		}
		.btn-success:hover, .btn-success:focus, .btn-success:active{
			color:#007dc6 !important;
		}
		.btn-masuk{
			padding: 7px 40px;
			border-radius: 40px;
			background-color: #00c749 !important;
			border: none;
		}
		.footer-text{
			margin-bottom:0;
			font-size:10px;
			color:black;
			font-weight:400;
		}
		.footer{
			padding: 70px 0 10px;
		}
		.banner-text{
			min-height:425px;
		}
		.btn-detil{
			border-radius: 40px;
			background-color: #ffed00;
			border:none;
		}
		.kolom-cari{
			border-radius: 40px;
			box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.09);
			background-color: #ffffff;
			border: solid 1px #f1f1f1;
		}
		.btn-cari{
			background-color:transparent !important;
			border-radius:40px;
			color:#007dc6;
		}
		.input-group-btn:not(:first-child)>.btn{
			border-top-left-radius: 40px;
			border-bottom-left-radius: 40px;
		}
		.detil2{
			background-color: #ffed00;
			padding: 15px;
			border-radius: 40px;
		}
		.input-group .form-control:not(:last-child){
			border-top-right-radius: 40px;
			border-bottom-right-radius: 40px;
		}
		.icon-cari{
			position: absolute;
			right: 6px;
			z-index: 9999;
		}
		.bootstrap-select  li.selected a{
			background: #3086E4;
			color: white;
		}
		.bootstrap-select  li.selected a:hover{
			background: #256CB8;
		}
		.judul_peraturan{
			margin:0;
			font-weight:600;
			color:black;
		}
		.tentang_peraturan{
			padding-left:30px;
			font-size:12px;
			word-wrap:break-word;
		}
	</style>
    <script>
    /*(function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-85622565-1', 'auto');
    ga('send', 'pageview');*/
    </script>
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topheader" id="top">
            <div class="fix-width" style="max-width:none;">
                <nav class="navbar navbar-expand-md navbar-light p-l-0">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <!-- Logo will be here -->
                    <a class="navbar-brand" href="/dbperaturan/"><img src="{{ asset('template/img/logodbp.png') }}" height="70px;"></img></a>
                    <!-- This is the navigation menu -->
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto stylish-nav">
                            <li class="nav-item">
								<button class="btn btn-rounded btn-success btn-menu right-side-toggle terbaru2">Terbaru</button>
							</li>
							<li class="nav-item">
								<button class="btn btn-rounded btn-success btn-menu right-side-toggle katalog2">Katalog</button>
							</li>
							<li class="nav-item">
								<a href="https://hai.djpbn.kemenkeu.go.id" target="_blank" class="btn btn-rounded btn-success btn-menu">HaiDJPb</a>
							</li>
							<li class="nav-item">
								<a href="{{ url('/app/#') }}" class="btn btn-primary btn-masuk">Kembali</a>
							</li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="margin:0;">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
				<div class="row light-blue" style="padding:10px 0px;">
                    <div class="col-md-12">
                        <div class="row justify-content-md-center">
							<div class="col-lg-6">
								<form class="input-form">
									<div class="input-group">
										<input type="text" class="form-control kolom-cari" placeholder="Masukkan kata kunci peraturan yang Anda cari...">
										<span class="input-group-btn icon-cari">
										  <button class="btn btn-info btn-cari" type="button" style="padding: 6px 8px; margin-top: 3px;"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</form>
							</div>
						</div>
                    </div>
					<!--<div class="col-md-12">
                        <div class="row justify-content-md-center">
							<div class="col-lg-2">
								<select id="jenis_peraturan" class="select2 form-control" data-placeholder="Jenis Peraturan" style="width: 100%">
								  <option>Jenis Peraturan</option>
								  <option>Undang-undang</option>
								  <option>Peraturan Perpres</option>
								  <option>Peraturan Menteri Keuangan</option>
								  <option>dst</option>
								</select>
							</div>
							<div class="col-lg-1">
								<select id="tahun" class="select2 form-control" data-placeholder="Tahun" style="width: 100%">
								  <option>Tahun</option>
								  <option>2015</option>
								  <option>2016</option>
								  <option>2017</option>
								  <option>dst</option>
								</select>
							</div>
						</div>
                    </div>-->
                </div>
				<div class="row">
                    <div class="col-12">
                        <div class="card">
							<div class="card-header">
                                Detil Peraturan
                            </div>
                            <div class="card-body">
								<div class="row align-items-center">
									<div class="col-lg-2">
										Nomor Peraturan
									</div>
									<div class="col-lg-10">
										: 001 Tahun 2015
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-lg-2">
										Tahun Peraturan
									</div>
									<div class="col-lg-10">
										: 2015
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-lg-2">
										Tentang
									</div>
									<div class="col-lg-10">
										: Percobaan
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-lg-2">
										Abstrak
									</div>
									<div class="col-lg-10">
										: oiwoidoiwaueoiwqjdlksnadksajldkjj
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-lg-2">
										Jenis Peraturan
									</div>
									<div class="col-lg-10">
										: Undang-undang
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-lg-2">
										Sifat Peraturan
									</div>
									<div class="col-lg-10">
										: Publik
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-lg-2">
										Peraturan Terkait
									</div>
									<div class="col-lg-10">
										: 002 Tahun 2015
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-lg-2">
										Tag Label
									</div>
									<div class="col-lg-10">
										: Percobaan
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-lg-2">
										File Peraturan
									</div>
									<div class="col-lg-10">
										: <a href="#">
											<span class="mdi mdi-file-pdf" style="font-size:40px; color:red;"></span>
											<span>file-peraturan.pdf</span>
										</a>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
               	<!-- ============================================================== -->
                <!-- Katalog -->
                <!-- ============================================================== -->
                <!-- Katalog -->
                <div class="right-sidebar2 katalog2">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Katalog <span><i class="ti-close right-side-toggle katalog2"></i></span> </div>
                        <div class="r-panel-body">
                            <div id="treeview4" class=""></div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Katalog -->
                <!-- ============================================================== -->
				<!-- ============================================================== -->
                <!-- Terbaru -->
                <!-- ============================================================== -->
                <!-- Terbaru -->
                <div class="right-sidebar2 terbaru2">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> 10 Peraturan Terbaru <span><i class="ti-close right-side-toggle terbaru2"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="peraturan_terbaru" class="m-t-20">
                                <li>
									<p class="judul_peraturan">
										1. PMK 177
									</p>
									<p class="tentang_peraturan">
										Tentang eSPMalkshdlkjsahdjsahdsakjdhsakjhdkjahkjsahskjhdkjshdsadkjsahdakjs
									</p>
								</li>
                                <li>
									<p class="judul_peraturan">
										2. PMK 177
									</p>
									<p class="tentang_peraturan">
										Tentang eSPM
									</p>
								</li>
								 <li>
									<p class="judul_peraturan">
										3. PMK 177
									</p>
									<p class="tentang_peraturan">
										Tentang eSPM
									</p>
								</li>
								 <li>
									<p class="judul_peraturan">
										4. PMK 177
									</p>
									<p class="tentang_peraturan">
										Tentang eSPM
									</p>
								</li>
								 <li>
									<p class="judul_peraturan">
										5. PMK 177
									</p>
									<p class="tentang_peraturan">
										Tentang eSPM
									</p>
								</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Terbaru -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- footer -->
			<!-- ============================================================== -->
			 <footer class="footer row" style="background:transparent; left:0px;">
				<div class="fix-width">
					<div class="col-lg-12 col-md-12 text-center">
						<img src="{{ asset('template/img/logo_dsp.png') }}" width="120px;"></img>
						<p class="m-t-10 footer-text">
							Copyright 2017
						</p>
						<p class="footer-text">
							Direktorat Sistem Informasi dan Teknologi Perbendaharaan, Direktorat Sistem Perbendaharaan
						</p>
						<p class="footer-text">
							Ditjen Perbendaharaan, Kementerian Keuangan RI
						</p>
					</div>
				</div>
			</footer>
			<!-- ============================================================== -->
			<!-- End footer -->
			<!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
   <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('template/MaterialAdminPro/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/js/waves.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap-treeview-master/dist/bootstrap-treeview.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap-treeview-master/dist/bootstrap-treeview-init.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/landing/assets/owl.carousel/owl.carousel.min.js') }}"></script>
    
    <script src="{{ asset('template/MaterialAdminPro/landing/js/custom.js') }}"></script>
    
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="{{ asset('plugins/alertify/src/alertify.js') }}"></script>
	<script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}"></script>

    <!-- load angular -->
    <script src="{{ asset('template/angular/angular.min.js') }}"></script>
    <script src="{{ asset('template/angular/angular-ui-router.min.js') }}"></script>
    <script src="{{ asset('template/angular/ngStorage.js') }}"></script>
    <script src="{{ asset('template/angular/loading-bar.js') }}"></script>
</body>

</html>

<script>
	jQuery(document).ready(function(){
		//tampilan default
		function form_default() {
			jQuery('#detil2').hide();
			jQuery('#detil1').show();
		}
		
		//aktivasi tampilan default
		form_default();
		
		//klik detil
		jQuery('body').off('click', '.detil1').on('click', '.detil1', function(){
			jQuery('#detil2').show();
			jQuery('#detil1').hide();
		});
		
		jQuery('body').off('click', '.detilx').on('click', '.detilx', function(){
			jQuery('#detil2').hide();
			jQuery('#detil1').show();
		});
		
		$(".select2").select2();

	});
</script>