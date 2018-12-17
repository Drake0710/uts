<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DB Peraturan</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link href="{{ asset('template/img/perpus_DBP_DSP.ico') }}" rel="icon" type="image/x-icon">

  <link href="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/ionicons-2.0.1/css/ionicons.min.css') }}" rel="stylesheet">
  
  <!-- Plugins -->
  <link href="{{ asset('plugins/chosen/chosen.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/alertify/themes/alertify.default.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/switch/bootstrap-switch.min.css') }}" rel="stylesheet">

  <link href="{{ asset('template/MaterialAdminPro/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('template/MaterialAdminPro/css/colors/blue.css') }}" id="theme" rel="stylesheet">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script>
    if(self==top){
      document.documentElement.style.visibility='visible';
    }else{
      top.location=self.location;
    }
  </script>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="fix-header card-no-border">
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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('template/img/perpus_DBP_DSP.png') }}" alt="logo" class="dark-logo" height="40"/>
                        <img src="{{ asset('template/img/perpus_DBP_DSP.png') }}" alt="homepage" class="light-logo" height="40"/>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            
            <div class="row" style="margin-top:25px;">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Registrasi User DB Peraturan</h4>
                            <!-- <h6 class="card-subtitle"> All bootstrap element classies </h6> -->
                            <form id="form-ruh" name="form-ruh" class="form">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group m-t-40 row">
                                    <label class="col-2 col-form-label">ID</label>
                                    <div class="col-2">
                                        <input class="form-control" type="text" value="<?php echo $id; ?>" id="id" name="id" readonly>
                                    </div>
                                    <!-- <div class="col-2">
										<span id="warning-id" class="label label-warning warning">Required!</span>
									</div> -->
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Nama</label>
                                    <div class="col-5">
                                        <input class="form-control" type="text" value="<?php echo $nama; ?>" id="nama" name="nama" readonly>
                                    </div>
                                    <!-- <div class="col-2">
										<span id="warning-nama" class="label label-warning warning">Required!</span>
									</div> -->
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">NIP</label>
                                    <div class="col-3">
                                        <input class="form-control" type="text" value="<?php echo $nip; ?>" id="nip" name="nip" readonly>
                                    </div>
                                    <!-- <div class="col-2">
										<span id="warning-nip" class="label label-warning warning">Required!</span>
									</div> -->
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Email</label>
                                    <div class="col-5">
                                        <input class="form-control" type="email" value="<?php echo $email; ?>" id="email" name="email" readonly>
                                    </div>
                                    <!-- <div class="col-2">
										<span id="warning-email" class="label label-warning warning">Required!</span>
									</div> -->
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Unit Instansi</label>
                                    <div class="col-5">
                                        <select class="form-control chosen" id="id_unitdtl" name="id_unitdtl">
                                            <option value="" style="display:none;">Pilih Data</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
										<span id="warning-id_unitdtl" class="label label-warning warning">Required!</span>
									</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Level</label>
                                    <div class="col-5">
                                        <select class="form-control chosen" id="kdlevel" name="kdlevel">
                                            <option value="" style="display:none;">Pilih Data</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
										<span id="warning-kdlevel" class="label label-warning warning">Required!</span>
									</div>
                                </div>
                                <div class="form-group row">
                                	<label class="col-2 col-form-label"></label>
                                    <div class="offset-sm-3 col-sm-9">
                                        <button id="simpan" type="button" class="btn btn-primary waves-effect waves-light m-t-10">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
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
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

	<script src="{{ asset('template/MaterialAdminPro/assets/plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
	<script src="{{ asset('template/MaterialAdminPro/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('template/MaterialAdminPro/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
	<script src="{{ asset('template/MaterialAdminPro/js/jquery.slimscroll.js') }}"></script>

	<script src="{{ asset('template/fastclick/lib/fastclick.js') }}"></script>

	<!-- Plugins -->
	<script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/alertify/lib/alertify.min.js') }}"></script>
	<script src="{{ asset('plugins/switch/bootstrap-switch.min.js') }}"></script>

	<script src="{{ asset('template/MaterialAdminPro/js/custom.min.js') }}"></script>

	<script>
		jQuery(document).ready(function(){
			
			jQuery('.warning').hide();
			
			jQuery('.chosen').chosen();
			
			jQuery.get('registrasi/dropdown-level', function(result){
				jQuery('#kdlevel').html(result).trigger('chosen:updated');
			});
			
			jQuery.get('registrasi/dropdown-unit-dtl', function(result){
				jQuery('#id_unitdtl').html(result).trigger('chosen:updated');
			});
			
			function form_valid(str_id){
				var arr_id=str_id.split(',');
				var lanjut=true;
				for(x=0;x<arr_id.length;x++){
					if(jQuery('#'+arr_id[x]).val()==''){
						jQuery('#warning-'+arr_id[x]).show();
						lanjut=false;
					}
				}
				return lanjut;
			}
			
			jQuery('#simpan').click(function(){
				jQuery('#simpan').html('<span class="">Loading.....</span>');
				jQuery('#simpan').prop('disabled', true);
				var lanjut = form_valid('kdlevel,id_unitdtl');
				if(lanjut){
					
					var data = jQuery('#form-ruh').serialize();
					jQuery.ajax({
						url:'registrasi',
						method:'POST',
						data:data,
						success:function(result){
							if(result=='success'){
								alertify.log('Proses simpan berhasil!');
								window.location.href = 'app';
							}
							else{
								alertify.log(result);
								jQuery('#simpan').html('Simpan');
								jQuery('#simpan').prop('disabled', false);
							}
						},
						error:function(result){
							alertify.log('Koneksi terputus!');
							jQuery('#simpan').html('Simpan');
							jQuery('#simpan').prop('disabled', false);
						}
					});
					
				}
				else{
					alertify.log('Kolom tidak dapat dikosongkan!');
					jQuery('#simpan').html('Simpan');
					jQuery('#simpan').prop('disabled', false);
				}
			});
			
		});
	</script>

</body>
</html>