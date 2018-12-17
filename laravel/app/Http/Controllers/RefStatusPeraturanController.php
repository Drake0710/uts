<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class RefStatusPeraturanController extends Controller
{
	
	public function index()
	{
		$error='';

		$aColumns = array('id','status');
		//indexed column
		$sIndexColumn = "id";
		//DB yang digunakan
		$sTable = " select * from r_status_peraturan
					order by id";

		//paging
		$sLimit = " ";
		if((isset($_GET['iDisplayStart']))&&(isset($_GET['
			iDisplayLength']))){
			$iDisplayStart=$_GET['iDisplayStart']+1;
			$iDisplayLength=$_GET['iDisplayLength'];
			$sSearch=$_GET['sSearch'];
			if (($sSearch=='') && (isset($iDisplayStart)) && ($iDisplayLength != '-1'))
			{
				$iDisplayEnd=$iDisplayStart+$iDisplayLength-1;
				$sLimit = " WHERE NO BETWEEN '$iDisplayStart' AND '$iDisplayEnd'";

			}
		}

		//Ordering
		$sOrder = " ";
		if ((isset($_GET['iSortCol_0']))&&(isset($_GET['iSortDir_0']))) {
			$iSortCol_0=$_GET['iSortCol_0'];
			$iSortDir_0=$_GET['iSortDir_0'];
			if (isset($iSortCol_0))
			{
				//modified ordering
				for ($i=0; $i < count($aColumns); $i++) { 
					if ($iSortCol_0==$i) {
						if ($iSortDir_0=='asc') {
							$sOrder = "ORDER BY".$aColumns[$i]."DESC";
						}
						else{
							$sOrder = "ORDER BY".$aColumns[$i]."ASC";
						}
					}
				}
			}
		}

		//modified filtering
		$sWhere=" ";
		if (isset($_GET['sSearch'])) {
			$sSearch=$_GET['sSearch'];
			if ((isset($sSearch))&&($sSearch != '')) {
				$sWhere="WHERE upper(STATUS) LIKE upper('%".$sSearch."%') ";
			}
		}

		//data set length after filtering
		$iFilteredTotal = 0;
		$rows = DB::select("
			SELECT count(*) as JUMLAH from (".$sTable.") qry");
		$result = (array)$rows[0];
		if ($result) {
			$iFilteredTotal = $result['jumlah'];
		}

		//total data set length
		$iTotal = 0;
		$rows = DB::select("
			SELECT count(".$sIndexColumn.") as JUMLAH from (".$sTable.") qry");
		$result = (array)$rows[0];
		if ($result) {
			$iTotal = $result['jumlah'];
		} 

		//format output
		$sEcho=" ";
		if (isset($_GET['sEcho'])) {
			$sEcho=$_GET['sEcho'];
		}
		$output = array(
			"sEcho" => intval($sEcho),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);

		$str=str_replace(" , ", " ", implode(",", $aColumns));

		$sQuery = "SELECT * FROM ( SELECT ROWNUM AS NO, ".$str." FROM ( SELECT * FROM (".$sTable.") ".$sOrder.")".$sWhere.") a ".$sLimit." ";

		$result = DB::select($sQuery);

		foreach ($result as $row) 
		{
			$row=(array)$row;
			if(session('kdlevel')=='00' || session('kdlevel')=='99'){
				$pilih='<center>
							<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-primary ubah-data" title="Ubah Data"><i class="fa fa-pencil"></i></a>
							<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-danger hapus-data" title="Hapus Data"><i class="fa fa-trash"></i></a>
						</center>';
			} else {
				$pilih='<center>
							-
						</center>';
			}

			$output['aaData'][] = array(
				'<center>'.$row['no'].'</center>',
				$row['status'],
				$pilih
			);
		}
		return response()->json($output);
	}

	//tampilkan status peraturan
	public function getStatusPeraturanById($id)
	{
		$rows = DB::select("
			select * 
			from r_status_peraturan
			where id=".$id."
		");

		if (isset($rows[0])) {
			return response()->json($rows[0]);
		}
	}

	//simpan status peraturan baru
	public function store(Request $request)
	{
		// $status= preg_replace('/[^a-zA-Z0-9]/', '', $request->input('status-peraturan'));
		$update=DB::update('
			INSERT INTO r_status_peraturan (status)
			VALUES (?)
			',
			[
				$request->input('status-peraturan')
				// $status
			]
		);
		if($update==true){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Developer.';
		}			

	}

	//rekam ubah status peraturan
	public function update(Request $request)
	{
		$update=DB::update('
			UPDATE r_status_peraturan
			SET status=?
			WHERE id=?',
			[
				$request->input('status-peraturan'),
				$request->input('inp-id')
			]
		);
		if ($update==true) {
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi administrator.';
		}
	}

	//hapus status peraturan
	public function destroy(Request $request)
	{
		$delete=DB::delete('
			DELETE
			FROM r_status_peraturan
			WHERE id='.$request->input('id'));
		if ($delete==true) {
			return 'success';
		}
		else{
			return 'Proses hapus gagal. Hubungi administrator.';
		}
	}
}