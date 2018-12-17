<center>
	<a href="{{ url('app/mon/peraturan/download/'.$id) }}" target="_blank" class="btn btn-xs btn-warning" title="View PDF">
		<i class="fa fa-eye"></i>
	</a>

@if($kdlevel=='00' || $kdlevel=='03' || $kdlevel=='99' || $kdlevel=='77')
	
	@if($publish=="Tidak")
		<a href="javascript:;" id="{{ $id }}" class="btn btn-xs btn-primary ubah-data" title="Ubah Data">
			<i class="fa fa-pencil"></i>
		</a>
	@endif

@elseif($kdlevel=='02')
	
	@if($row->publish=="Tidak")
		@if($id_unitdtl==session('id_unitdtl'))
			<a href="javascript:;" id="{{ $id }}" class="btn btn-xs btn-primary ubah-data" title="Ubah Data">
				<i class="fa fa-pencil"></i>
			</a>
		@endif
	@endif

@endif

</center>