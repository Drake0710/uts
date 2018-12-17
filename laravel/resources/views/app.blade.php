<!DOCTYPE html>
<html ng-app="spa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template/img/logodbp.ico') }}">
    <title>DB Peraturan</title>
    
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet">
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
	<!--<link href="{{ asset('template/MaterialAdminPro/assets/plugins/css-chart/css-chart.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('template/MaterialAdminPro/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" /> -->
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />

    <!-- Plugins -->
    <link href="{{ asset('plugins/chosen/chosen.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/alertify/themes/alertify.default.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/switch/bootstrap-switch.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/plugins/jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
	<link href="{{ asset('template/MaterialAdminPro/assets/plugins/summernote/dist/summernote.css') }}" rel="stylesheet">

    <!-- Angular -->
    <link href="{{ asset('template/angular/loading-bar.css') }}" rel="stylesheet" media='all'>
    
    <link href="{{ asset('template/MaterialAdminPro/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('template/MaterialAdminPro/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('template/MaterialAdminPro/css/colors/purple.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        th{text-align: center;}
        .table-center{text-align: center;}
		.mCSB_inside > .mCSB_container{
			margin-right:15px;
		}
    </style>
    <script>
        if(self==top){
            document.documentElement.style.visibility='visible';
        } else{
            top.location=self.location;
        }
    </script>
</head>

<body class="fix-header fix-sidebar card-no-border">
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
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
                        <img src="{{ asset('template/img/logodbp.png') }}" alt="homepage" class="dark-logo" height="40"/>
                        <img src="{{ asset('template/img/logodbp.png') }}" alt="homepage" class="light-logo" height="40"/>
                        {{--<span>
                            <img src="{{ asset('template/img/APK_white.png') }}" alt="homepage" class="dark-logo" height="30" width="175" />
                            <img src="{{ asset('template/img/APK_white.png') }}" alt="homepage" class="light-logo" height="30" width="175" />
                        </span> --}}
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Profile -->
						<li class="nav-item">
							<a class="nav-link text-muted waves-effect waves-dark tahun" href="">T.A {{ $info_tahun }}</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-muted waves-effect waves-dark" href="{{ url('/logout') }}"><i class="mdi mdi-logout"></i></a>
						</li>
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('template/img/avatar5.png') }}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="{{ asset('template/img/avatar5.png') }}" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{ $info_nama }}</h4>
                                                <p class="text-muted">{{ $info_email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>-->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div id="scroll-sidebar" class="scroll-sidebar" class="mCustomScrollbar" data-mcs-theme="dark">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img" style="display:inline-table"><img src="{{ asset('template/img/avatar5.png') }}"  alt="user" /> </div>
					<div class="profile-keterangan hidden-sm-down">
						<p class="m-b-0" style="font-size: 12px; font-weight: bold;">{{ $info_nama }}</p>
						<p class="m-b-0">{{ $info_nip }}</p>
						<p class="m-b-0">{{ $info_nmunit }}</p>
					</div>
                    <!-- User profile text-->
                    <div class="profile-text m-t-10">
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{ $info_nmlevel }}</a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('/logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        
                        {!! $menu !!}

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            
            <div class="sidebar-footer">
                <a href="" class="link" data-toggle="tooltip" title="Call Center 14090"><i class="mdi mdi-phone-in-talk"></i></a>
                <a href="https://hai.djpbn.kemenkeu.go.id" target="_blank" class="link" data-toggle="tooltip" title="Kirim Tiket via HaiDJPb"><i class="mdi mdi-email"></i></a>
                <a href="{{ url('/logout') }}" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid" ui-view>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2018 Direktorat Sistem Informasi dan Teknologi Perbendaharaan
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
    <script src="{{ asset('template/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('template/MaterialAdminPro/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/js/waves.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/js/sidebarmenu.js') }}"></script>
    
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    
    <script src="{{ asset('template/MaterialAdminPro/js/custom.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/c3-master/c3.min.js') }}"></script>
    <!--<script src="{{ asset('template/MaterialAdminPro/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js') }}"></script>-->
    <script src="{{ asset('plugins/alertify/src/alertify.js') }}"></script>
	<script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/plugins/jquery-file-upload/js/jquery.fileupload.js') }}"></script>
    
    <script src="{{ asset('template/MaterialAdminPro/js/dashboard2.js') }}"></script>
	<script src="{{ asset('plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('template/MaterialAdminPro/assets/plugins/summernote/dist/summernote.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('template/MaterialAdminPro/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

    <!-- load angular -->
    <script src="{{ asset('template/angular/angular.min.js') }}"></script>
    <script src="{{ asset('template/angular/angular-ui-router.min.js') }}"></script>
    <script src="{{ asset('template/angular/ngStorage.js') }}"></script>
    <script src="{{ asset('template/angular/loading-bar.js') }}"></script>

    <script>{!! $angular !!}</script>

    <script>
        jQuery(document).ready(function(){
            
            var refresh1,refresh2,refresh3;
            
            jQuery("body").off("keypress",'.val_char').on("keypress",'.val_char',function (e) {
          
                var charcode = e.which;
                if (
                  (charcode === 8) || // Backspace
                  (charcode === 13) || // Enter
                  (charcode === 127) || // Delete
                  (charcode === 32) || // Space
                  (charcode === 0) || // arrow
                  //(charcode === 188) || // Koma
                  //(charcode === 190) || // Titik
                  //(charcode === 173) || // _
                  //(charcode === 9) || // Horizontal Tab
                  //(charcode === 11) || // Vertical Tab
                  //(charcode >= 37 && charcode <= 40) || // arrow
                  //(charcode >= 48 && charcode <= 57) ||// 0 - 9
                  (charcode >= 65 && charcode <= 90) || // a - z
                  (charcode >= 97 && charcode <= 122) // A - Z
                  )
                { 
                  console.log(charcode)
                }
                else
                {
                  e.preventDefault()
                  return
                }
            }); 

            jQuery("body").off("keypress",'.val_name').on("keypress",'.val_name',function (e) {
                var charcode = e.which;
                if (
                  (charcode === 8) || // Backspace
                  (charcode === 13) || // Enter
                  (charcode === 127) || // Delete
                  (charcode === 32) || // Space
                  (charcode === 0) || // arrow
                  (charcode == 188) || // Koma
                  (charcode == 190) || // Titik
                  //(charcode === 173) || // _
                  //(charcode === 9) || // Horizontal Tab
                  //(charcode === 11) || // Vertical Tab
                  //(charcode >= 37 && charcode <= 40) || // arrow
                  //(charcode >= 48 && charcode <= 57) ||// 0 - 9
                  (charcode >= 65 && charcode <= 90) || // a - z
                  (charcode >= 97 && charcode <= 122) // A - Z
                  )
                { 
                  console.log(charcode)
                }
                else
                {
                  e.preventDefault()
                  return
                }
            }); 

            //hanya alpabet
            jQuery("body").off("keypress",'.val_num').on("keypress",'.val_num',function (e) {
                var charcode = e.which;
                if (
                  (charcode === 8) || // Backspace
                  (charcode === 13) || // Enter
                  (charcode === 127) || // Delete
                  (charcode === 0) || // arrow
                  (charcode >= 48 && charcode <= 57)// 0 - 9
                  )
                { 
                  console.log(charcode)
                }
                else
                {
                  e.preventDefault()
                  return
                }
            });
			
			$("#scroll-sidebar").mCustomScrollbar({
				setHeight:"100%",
				alwaysShowScrollbar:1,
				theme:"dark"
			});
			
			/*
            // Get window height and the wrapper height
            var footerHeight  = $(Selector.mainFooter).outerHeight() || 0
            var neg           = $(Selector.mainHeader).outerHeight() + footerHeight
            var windowHeight  = $(window).height()
            var sidebarHeight = $(Selector.sidebar).outerHeight() || 0
            var headerHeight = $(Selector.mainHeader).outerHeight() || 0
            // Set the min-height of the content and sidebar based on the height of the document.
            if ($('body').hasClass(ClassName.fixed)) {
              $(Selector.contentWrapper).css('min-height', windowHeight - footerHeight)
            } else {
              var postSetHeight

              if (windowHeight >= sidebarHeight + headerHeight) {
                $(Selector.contentWrapper).css('min-height', windowHeight - Math.ceil(neg))
                postSetHeight = windowHeight - Math.ceil(neg)
              } else {
                $(Selector.contentWrapper).css('min-height', sidebarHeight - footerHeight)
                postSetHeight = sidebarHeight - footerHeight
              }

              // Fix for the control sidebar height
              var $controlSidebar = $(Selector.controlSidebar)
              setTimeout(function(){
                if (typeof $controlSidebar !== 'undefined') {
                  if ($controlSidebar.height() > postSetHeight)
                    $(Selector.contentWrapper).css('min-height', $controlSidebar.height())
                }
              }, 0);
            }*/
            
        });
    </script>
    
</body>

</html>
