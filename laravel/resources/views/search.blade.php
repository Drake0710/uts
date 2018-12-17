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
	<link href="{{ asset('template/MaterialAdminPro/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" />

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
		.btn-cari:hover{
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
			font-family: ptserif;
			font-size: 14px;
			color: #f5f5f5;
		}
		.judul_peraturan2{
			margin:0;
			font-size: 14px;
			font-weight: bold;
			text-decoration:underline;
			color: #f5f5f5;
		}
		.tentang_peraturan{
			word-wrap:break-word;
			font-family: ptserif;
			font-size: 12px;
			color: #ffffff;
		}
		.tentang_peraturan2{
			word-wrap:break-word;
			font-family: ptserif;
			font-size: 11px;
			color: #ffffff;
		}
		.waktu_peraturan{
			font-family: Cabin;
			font-size: 9px;
			color: #f5f5f5;
			margin:0;
		}
		.judul_hasil{
			font-family: Cabin;
			  font-size: 18px;
			  font-weight: bold;
			  color:#ffffff;
		}
		::-webkit-scrollbar { 
			display: none; 
		}
		::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  font-style:italic;
		}
		::-moz-placeholder { /* Firefox 19+ */
		  font-style:italic;
		}
		:-ms-input-placeholder { /* IE 10+ */
		  font-style:italic;
		}
		:-moz-placeholder { /* Firefox 18- */
		  font-style:italic;
		}

        .easyPaginateNav a {
			margin: 0px 0px;
			padding: 3px 10px;
			border: 1px solid #868e96;
		}
		.easyPaginateNav a:hover {
			background-color:#26c6da;
			color:white;
		}
        .easyPaginateNav a.current {
			font-weight:bold;
			text-decoration:underline;
			background-color:#7460ee;
			color:white;
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
                    <!--<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                     Logo will be here -->
                    <a class="navbar-brand" href="/dbperaturan/"><img src="{{ asset('template/img/logodbp.png') }}" height="70px;"></img></a>
                    <!-- This is the navigation menu -->
                    <div class="" style="position:absolute; right:0;">
                        <ul class="navbar-nav ml-auto stylish-nav">
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
				<div class="row light-blue" style="padding:5px 0px;">
                    <div class="col-md-12">
                        <div class="row justify-content-md-center">
                        	<div class="row col-lg-8 m-t-30 text-center"
                        		 style="background-color:#ffed00;padding: 15px;border-radius: 40px;">

								<div class="col-lg-11" style="padding-right:0">
									<form id="form-cari" action="{{ url('/search') }}" method="GET" class="input-form" role="form">
	                                    {{ csrf_field() }}

										<div class="row col-lg-12" style="padding-right:0;margin:0;">
											<div class="input-group">
												<input id="cari2" type="text" name="q" value="{!! isset($_GET['q']) ? $_GET['q'] : null !!}" class="form-control typeahead" placeholder="Masukkan kata kunci peraturan yang Anda cari...">
											</div>
										</div>
										<div class="row col-lg-12" style="padding-right:0;margin:0;">
											<div class="col-lg-1" style="padding:0;font-weight:bold;">Filter</div>
											<div class="col-lg-4" style="padding:0">
												<select class="form-control chosen" id="jenis_peraturan" name="jenis_peraturan">
													<option value="" style="display:none;">Jenis</option>
												</select>
											</div>
											<div class="col-lg-2" style="padding:0">
												<select class="form-control chosen" id="tahun" name="tahun">
													<option value="" style="display:none;">Tahun</option>
												</select>
											</div>
											<div class="col-lg-1" style="padding:0;font-weight:bold;">Sort</div>
											<div class="col-lg-2" style="padding:0">
												<select class="form-control chosen" id="sort_jenis" name="sort_jenis">
													<option value="" style="display:none;">Hierarki</option>
													<option value="ASC"
														{!! isset($_GET['sort_jenis']) && $_GET['sort_jenis']=="ASC"? 'selected' : null !!}>
														Tertinggi
													</option>
													<option value="DESC"
														{!! isset($_GET['sort_jenis']) && $_GET['sort_jenis']=="DESC"? 'selected' : null !!}>
														Terendah
													</option>
												</select>
											</div>
											<div class="col-lg-2" style="padding:0">
												<select class="form-control chosen" id="sort_tahun" name="sort_tahun">
													<option value="" style="display:none;">Tahun</option>
													<option value="ASC"
														{!! isset($_GET['sort_tahun']) && $_GET['sort_tahun']=="ASC"? 'selected' : null !!}>
														Terlama
													</option>
													<option value="DESC"
														{!! isset($_GET['sort_tahun']) && $_GET['sort_tahun']=="DESC"? 'selected' : null !!}>
														Terbaru
													</option>
												</select>
											</div>
										</div>
								</div>
								<div class="col-lg-1" style="padding-left:0;">
									<button type="submit"
											id="btn-cari"
											class="btn waves-effect waves-light btn-info"
											style="height:100%;width:100%;">
										Cari
									</button>
									</form>
								</div>

							</div>
						</div>
                    </div>
                </div>

				@yield('content')

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- footer -->
			<!-- ============================================================== -->
			 <footer class="footer row" style="background:transparent; left:0px; border-top:none; padding-top:10px;">
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
	<script src="{{ asset('template/MaterialAdminPro/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    
    <script src="{{ asset('template/MaterialAdminPro/landing/js/custom.js') }}"></script>
    
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="{{ asset('plugins/alertify/src/alertify.js') }}"></script>
	<script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/trincotPagination/trincotPagination.js') }}"></script>

    @yield('script')
    
    <script>
		jQuery(document).ready(function(){
			
			jQuery('.chosen').chosen();

			jQuery.get('dropdown/jenis-search', function(result){
				jQuery('#jenis_peraturan').html(result).trigger('chosen:updated');
			});
			
			jQuery.get('dropdown/tahun', function(result){
				jQuery('#tahun').html(result).trigger('chosen:updated');
			});

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

	        jQuery('#btn-cari').click(function() {
	            if(jQuery('#cari').val() === ''){
	                alert('Kolom pencarian tidak boleh kosong.');
	                return false;
	            }
	        });

		});
	</script>
</body>

</html>