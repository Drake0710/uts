
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DB Peraturan</title>
	<link href="{{ asset('template/img/perpus_DBP_DSP.ico') }}" rel="icon" type="image/x-icon">

    <!-- Fonts -->
	<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

	<link href="{{ asset('template/css/dbperaturan/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/dbperaturan/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/dbperaturan/components.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/dbperaturan/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css"/>
    
    {{--
    <link href="{{ asset('template/css/dbperaturan/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/dbperaturan/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/dbperaturan/jquery-ui-timepicker-addon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/dbperaturan/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet">
    --}}

    <!-- Plugins -->
	<link href="{{ asset('plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet">
  	<link href="{{ asset('plugins/alertify/themes/alertify.default.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
		<section id="home">
			<nav role="navigation" class="navbar">
				<div class="navbar-header">
					<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle collapsed">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand"><img src="{{ asset('template/img/APK.png') }}" height="165%" top="10" alt="logo"></a>
				</div>
				<ul class="nav nav-pills">
					<div class="col-md-offset-1 col-md-12">
						<li role="presentation" class="active col-md-2" style="margin-left:-20px;">
							<div class="col-md-6 no-padding">
							
							@if(!session('authenticated'))
								{!! $data['login'] !!}
							@else
								<a href="{{ url('/app/#') }}" class="btn btn-success btn-masuk">App</a>
							@endif

							</div>
						</li>
					</div>
				</ul>
			</nav>
            
			<div class="row">
				<div class="col-lg-6">
					<div>
						<a href="#"><img src="{{ asset('template/img/perpus_DBP_DSP.png') }}" height="100px" width="auto" top="10" alt="book"></a>
					</div>
					<div class="font-group1">
						<div><p class="font1 minus-margin-bottom">Perpustakaan</p></div>
						<div><p class="font1 minus-margin-bottom">Daring</p></div>
						<div><p class="font2 minus-margin-bottom">Peraturan</p></div>
						<div><p class="font2">Perbendaharaan</p></div>
					</div>
					<div class="pull-right" style="margin-bottom:10px; margin-right:30px;">
						<a href="#"><img src="{{ asset('template/img/logo_dsp.png') }}" height="auto" width="142px" top="10" alt="logo-dsp"></a>
					</div>
				</div>
				<form method="POST" action="" accept-charset="UTF-8" id="form-with-validation" class="form-horizontal" enctype="multipart/form-data">
					<input id="_token" name="_token" type="hidden">
					
				<fieldset class="col-lg-6">
					<nav>
						<ul class="nav nav-tabs">
							<li class="col-md-3 active"><a href="">Peraturan</a></li>
							<li class="col-md-3"><a href="http://hai.djpbn.kemenkeu.go.id/" target="_blank">Diskusi</a></li>
						</ul>
					</nav>
					<div class="kriteria">Silahkan masukkan kriteria pencarian Anda</div>
					<div class="form-group">
						<div class="col-lg-4">
							<input class="form-control round yearpicker" name="tahun_peraturan" type="text" id="tahun_peraturan">
						</div>
						<div class="col-lg-8">
							<input class="form-control round" placeholder="NOMOR PERATURAN" name="nomor_peraturan" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<input class="form-control round" placeholder="TENTANG" name="tentang" type="text" id="tentang">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<select class="form-control round" id="jenisperaturans_id" name="jenisperaturans_id">
								<option value="">Pilih Bentuk Peraturan</option>
								<option value="1">Undang-undang (UU)</option>
								<option value="2">Peraturan Pemerintah (PP)</option>
								<option value="3">Peraturan Presiden (Perpres)</option>
								<option value="4">Keputusan Presiden (Keppres)</option>
								<option value="5">Peraturan Menteri Keuangan (PMK)</option>
								<option value="6">Keputusan Menteri Keuangan (KMK)</option>
								<option value="7">Peraturan Direktur Jenderal (Perdirjen)</option>
								<option value="8">Keputusan Direktur Jenderal (Kepdirjen)</option>
								<option value="9">Surat Edaran (SE)</option>
								<option value="10">Surat</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
						  <input class="btn btn-primary btn-cari pull-right" type="submit" value="Cari">
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="col-sm-12 tombol">
						  <a href="#terbaru"> <button class="btn btn-primary btn-cari pull-right" type="button">Lihat Hasil Pencarian Peraturan</button></a>
						</div>
					</div> -->
				</fieldset>
				
				</form>
			</div>
			
			<div class="row no-padding" style="background-color:#337AB7; height:90px;">
				<div class="col-md-offset-1 col-md-1" style="line-height:90px;">
					<a href="#"><img src="{{ asset('template/img/logo_dsp.png') }}" height="auto" width="115px" alt="logo-dsp"></a>
				</div>
				<div class="col-md-10" style="left:20px; top:22px;">
					<p class="no-padding no-margin" style="font-size:8px; color:#4A4A4A;">copyright 2017</p>
					<p class="no-padding no-margin" style="font-size:8px; color:#4A4A4A;">Direktorat Sistem Informasi dan Teknologi Perbendaharaan</p>
					<p class="no-padding no-margin" style="font-size:8px; color:#4A4A4A;">Direktorat Sistem Perbendaharaan</p>
					<p class="no-padding no-margin" style="font-size:8px; color:#000; font-weight:700;">Ditjen Perbendaharaan, Kementerian Keuangan RI</p>	
				</div>
			</div>
		</section>
			
		<!-- <section id="terbaru" style="background-color:#337AB7;">
			<nav role="navigation" class="navbar">
				<div class="navbar-header">
					<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle collapsed">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand"><img src="{{-- asset('template/img/APK.png') --}}" height="165%" top="10" alt="logo"></a>
				</div>
					
				<ul class="nav nav-pills">
					<li role="presentation" class="active pull-right">
						<a href="https://hai.djpbn.kemenkeu.go.id/faq/login">Masuk</a>
					</li>
					<form class="form-horizontal" role="form" method="POST" action="">
						<input type="hidden" name="_token" value="WQGYxszmfBRzXnZkIxv3vn640yphENCebDh7qD7k">
						<div class="col-md-offset-1 col-md-12">
						
							<li role="presentation" class="active col-md-2" style="margin-left:-20px;">
								<div class="col-md-6 no-padding">
									<button type="submit" class="btn btn-primary btn-masuk">Masuk</button>
								</div>
							</li>
						</div>
					</form>
				</ul>
			</nav>
		
			<div style="min-height:490px">
				<div class="row" style="background-color:#337AB7; padding-top:0px;">
					<div class="col-lg-12 tombol">
						<a href="#home"><h3 class="panel-heading">Menu Pencarian</h3></a>
					</div>
				</div>
				<div class="row" style="background-color:#337AB7;">
					<div class="col-lg-12">
						<div class="panel-heading col-md-12">
							<div class="col-md-6" style="text-align:left;">
								<div style="color:#fff;"><h3 class="no-margin">Peraturan Terbaru</h3></div>
								<div style="color:#10BC9A;"><h3 class="no-margin">Berdasarkan Waktu Unggah</h3></div>
							</div>
							<div class="col-md-6">
								<input class="btn btn-success btn-cari2 pull-right col-md-4" type="submit" value="Semua Peraturan">
							</div>
						</div>
						</br>
						<div class="panel-body list-aturan" style="margin-top:40px; margin-left:-22px;">
							<ol>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1506596859-91~PMK.01~2017Per.pdf" target="_blank">91/PMK.01/2017</a></strong>
									<br>
									<span style="font-weight:300;">tentang ORGANISASI DAN TATA KERJA PUSAT INVESTASI PEMERINTAH</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505213601-77-PMK.05-2017Per.pdf" target="_blank">77/PMK.05/2017</a></strong>
									<br>
									<span style="font-weight:300;">tentang Petunjuk Teknis Pelaksanaan Pemberian Tunjangan Hari Raya Dalam Tahun Anggaran 2017 Kepada Pimpinan Dan Pegawai Nonpegawai Negeri Sipil Pada Lembaga Nonstruktural</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505213564-76-PMK.05-2017Per.pdf" target="_blank">76/PMK.05/2017</a></strong>
									<br>
									<span style="font-weight:300;">tentang Petunjuk Teknis Pelaksanaan Pemberian Tunjangan Hari Raya Dalam Tahun Anggaran 2017 Kepada Pegawai Negeri Sipil, Prajurit Tentara Nasional Indonesia, Anggota Kepolisian Negara Republik Indonesia, Dan Pejabat Negara</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505213524-75-PMK.05-2017Per.pdf" target="_blank">75/PMK.05/2017
									</a></strong>
									<br>
									<span style="font-weight:300;">tentang Petunjuk Teknis Pelaksanaan Pemberian Penghasilan Ketiga Belas kepada Pimpinan dan Pegawai Nonpegawai Negeri Sipil pada Lembaga Nonstruktural.</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505213435-74-PMK.05-2017Per.pdf" target="_blank">74/PMK.05/2017
									</a></strong>
									<br>
									<span style="font-weight:300;">tentang Perubahan Atas Peraturan Menteri Keuangan Nomor 96/PMK.05/2016 tentang Petunjuk Teknis Pelaksanaan Pemberian Gaji, Pensiun, Atau Tunjangan Ketiga Belas Kepada Pegawai Negeri Sipil, Prajurit Tentara Nasional Indonesia, Anggota Kepolisian Negara Republik Indonesia, Pejabat Negara, Dan Penerima Pensiun Atau Tunjangan.</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505213326-PMK_99_2017_adm Hibah.pdf" target="_blank">99/PMK.05/2017</a></strong>
									<br>
									<span style="font-weight:300;">tentang Administarasi Pengelolaan Hibah</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505213230-PMK_85_2017_uang lembur satpam, pramubakti, dan pegawai non asn.pdf" target="_blank">85/PMK.05/2017</a></strong>
									<br>
									<span style="font-weight:300;">tentang Tata Cara Pembayaran Uang Lembur Dan Uang Makan Lembur Bagi Pegawai Non-Aparatur Sipil Negara, Satuan Pengaman, Pengemudi, Petugas Kebersihan, Dan Pramubakti</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505213107-PMK_80_2017_Tata Cara Pembayaran Tunjangan Kinerja.pdf" target="_blank">80/PMK.05/2017</a></strong>
									<br>
									<span style="font-weight:300;">tentang Tata Cara Pembayaran Tunjangan Kinerja Pegawai Pada Kementerian Negara/Lembaga</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505210152-84-PMK.05-2017Per.pdf" target="_blank">84/PMK.05/2017</a></strong>
									<br>
									<span style="font-weight:300;">tentang PENGGUNAAN DANA PEREMAJAAN PERKEBUNAN KELAPA SAWIT BADAN LAYANAN UMUM BADAN PENGELOLA DANA PERKEBUNAN KELAPA SAWIT</span>
								</li>
								<li style="min-height:30px; margin-bottom:30px; color:#fff; font-size:9px; font-weight:700;">
									<strong>Peraturan <a href="https://hai.djpbn.kemenkeu.go.id/faq/uploads/1505208474-Per_10_PB_2017.pdf" target="_blank">PER-10/PB/2017</a></strong>
									<br>
									<span style="font-weight:300;">tentang PETUNJUK TEKNIS MONITORING DAN EVALUASI PEMBIAYAAN ULTRA MIKRO OLEH INSTANSI VERTIKAL DIREKTORAT JENDERAL PERBENDAHARAAN</span>
								</li>
							</ol>
						</div>
					</div>
				</div>
					
				<div class="clearfix"></div>
				<div class="row" id="hasilcari">
					<div class="col-lg-1"></div>
					<div class="col-lg-10"></div>
					<div class="col-lg-1"></div>
				</div>
			</div>
			<div class="row no-padding" style="background-color:#EDEDED; height:90px;">
				<div class="col-md-offset-1 col-md-1" style="line-height:90px;">
					<a href="#"><img src="{{-- asset('template/img/logo_dsp.png') --}}" height="auto" width="115px" alt="logo-dsp"></a>
				</div>
				<div class="col-md-10" style="left:20px; top:22px;">
					<p class="no-padding no-margin" style="font-size:8px; color:#4A4A4A;">copyright 2017</p>
					<p class="no-padding no-margin" style="font-size:8px; color:#4A4A4A;">Direktorat Sistem Informasi dan Teknologi Perbendaharaan</p>
					<p class="no-padding no-margin" style="font-size:8px; color:#4A4A4A;">Direktorat Sistem Perbendaharaan</p>
					<p class="no-padding no-margin" style="font-size:8px; color:#000; font-weight:700;">Ditjen Perbendaharaan, Kementerian Keuangan RI</p>	
				</div>
			</div>
		</section> -->

    </div><!--/container-->
		
		<!-- PRELOADER -->
    <div class="preloader-body">
      <div class="cube-wrapper">
        <div class="cube-folding">
          <span class="leaf1"></span>
          <span class="leaf2"></span>
          <span class="leaf3"></span>
          <span class="leaf4"></span>
        </div>
        <span class="loading" data-name="Loading">Loading</span>
      </div>
    </div>

	<script src="{{ asset('template/js/dbperaturan/jquery-1.11.3.min.js') }}"></script>
	<script src="{{ asset('template/js/dbperaturan/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('template/js/dbperaturan/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('template/js/dbperaturan/timepicker.js') }}"></script>
	<script src="{{ asset('template/js/dbperaturan/jquery-ui-timepicker-addon.min.js') }}"></script>
	<script src="{{ asset('template/js/dbperaturan/ckeditor.js') }}"></script>
	<script src="{{ asset('template/js/dbperaturan/bootstrap.min.js') }}"></script>
	<script src="{{ asset('template/js/dbperaturan/main.js') }}"></script>
	<script src="{{ asset('template/js/dbperaturan/main2.js') }}"></script>

	<script src="{{ asset('plugins/alertify/lib/alertify.min.js') }}"></script>

	<script>
	    $('.datepicker').datepicker({
	        autoclose: true,
	        dateFormat: "yy-mm-dd"
	    });

	    $('.datetimepicker').datetimepicker({
	        autoclose: true,
	        dateFormat: "yy-mm-dd",
	        timeFormat: "HH:mm:ss"
	    });

	    $('.yearpicker').datepicker({
	        autoclose: true,
	        changeYear: true,
	        dateFormat: 'yy',
	        showButtonPanel: true,
	        
	        onClose: function(dateText, inst){
	            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	            $(this).val($.datepicker.formatDate('yy', new Date(year, 1, 1)));
	        }
	    });
	    
	    $('.yearpicker').focus(function(){
	        $(".ui-datepicker-calendar").hide();
	        $(".ui-datepicker-month").hide();
	    });

	    /*$('#datatable').dataTable( {
	        "language": {
	            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/English.json"
	        }
	    }).fnSetFilteringDelay(250);

	    $('#dttable').dataTable( {
	        "paging":   false,
	        "ordering": false,
	        "language": {
	            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/English.json"
	        }
	    }).fnSetFilteringDelay(250);*/

	    <?php
	    if(isset($data['error'])){
	        echo 'alertify.log("'.$data['error'].'");';
	    }
	    ?>
	</script>

</body>
</html>