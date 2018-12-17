@extends('search')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
			<div class="card-header">Detil Peraturan</div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-2">Jenis Peraturan</div>
					<div class="col-lg-10">:
						&nbsp;<span class="detil-text">{{ $rows[0]->jenis_peraturan }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">Nomor Peraturan</div>
					<div class="col-lg-10">:
						&nbsp;<span class="detil-text">{{ $rows[0]->no_peraturan }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">Tentang</div>
					<div class="col-lg-10">:
						&nbsp;<span class="detil-text">{{ $rows[0]->tentang }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">Abstrak</div>
					<div class="col-lg-10">:
						&nbsp; <span class="detil-text">{{ $rows[0]->abstrak }}</span></div>
				</div>
				<div class="row">
					<div class="col-lg-2">Keterangan</div>
					<div class="col-lg-10">:
						&nbsp; <span class="detil-text">{!! $rows[0]->note !!}</span></div>
				</div>
				<div class="row">
					<div class="col-lg-2">Status Peraturan</div>
					<div class="col-lg-10">:
					
					@foreach($rows as $row)
						<span class="detil-text">
							- {{ $row->status }}
							<a href="{{ url('/search/peraturan/'.$row->id_peraturan2) }}" target="_blank">{{ $row->no2 }}</a>
							{{ $row->tentang2 }}
						</span>
						<br>
					@endforeach

					</div>
				</div>
				<!-- <div class="row align-items-center">
					<div class="col-lg-2">Peraturan Terkait</div>
					<div class="col-lg-10">: <span class="detil-text">-</span></div>
				</div> -->
				<!--<div class="row align-items-center">
					<div class="col-lg-2">Tag Label</div>
					<div class="col-lg-10">: <span class="detil-text">-</span></div>
				</div>-->
				<div class="row align-items-center">
					<div class="col-lg-2">File Peraturan</div>
					<div class="col-lg-10">:
						<a href="{{ url('search/download/peraturan/'.$rows[0]->id) }}" target="_blank">
							<span class="mdi mdi-file-pdf" style="font-size:40px; color:red;"></span>
							<!--<span>{{ $rows[0]->file_peraturan }}</span>-->
						</a>
						<a href="{{ url('search/download1/peraturan/'.$rows[0]->id) }}" target="_blank">
							<span class="mdi mdi-cloud-download" style="font-size:40px;"></span>
							<!--<span>{{ $rows[0]->file_peraturan }}</span>-->
						</a>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection