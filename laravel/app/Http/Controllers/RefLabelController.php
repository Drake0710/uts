<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class RefLabelController extends Controller {

	public function index()
	{
			
		$error='';
	
		$aColumns = array('id','label');
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		/* DB table to use */
		$sTable = " select * from r_label
					order by id";
		
		/*
		 * Paging
		 */ 
		$sLimit = " ";
		if((isset($_GET['iDisplayStart']))&&(isset($_GET['iDisplayLength']))){
			$iDisplayStart=$_GET['iDisplayStart']+1;
			$iDisplayLength=$_GET['iDisplayLength'];
			$sSearch=$_GET['sSearch'];
			if (($sSearch=='') && (isset( $iDisplayStart )) &&  ($iDisplayLength != '-1' )) 
			{
				$iDisplayEnd=$iDisplayStart+$iDisplayLength-1;
				$sLimit = " WHERE NO BETWEEN '$iDisplayStart' AND '$iDisplayEnd'";
			}
		}
		
		/*
		 * Ordering
		 */
		$sOrder = " ";
		if((isset($_GET['iSortCol_0']))&&(isset($_GET['sSortDir_0']))){
			$iSortCol_0=$_GET['iSortCol_0'];
			$iSortDir_0=$_GET['sSortDir_0'];
			if ( isset($iSortCol_0  ) )
			{		
				//modified ordering
				for($i=0;$i<count($aColumns);$i++){
					if($iSortCol_0==$i){
						if($iSortDir_0=='asc'){
							$sOrder = " ORDER BY ".$aColumns[$i]." DESC ";
						}
						else{
							$sOrder = " ORDER BY ".$aColumns[$i]." ASC ";
						}
					}
				}
			}
		}
		
		//modified filtering
		$sWhere="";
		if(isset($_GET['sSearch'])){
			$sSearch=$_GET['sSearch'];
			if((isset($sSearch))&&($sSearch!='')){
				$sWhere=" where label like '%".$sSearch."%' ";
			}
		}
		
		/* Data set length after filtering */
		$iFilteredTotal = 0;
		$rows = DB::select("
			SELECT COUNT(*) as JUMLAH FROM (".$sTable.") qry
		");
		$result = (array)$rows[0];
		if($result){
			$iFilteredTotal = $result['jumlah'];
		}
		
		/* Total data set length */
		$iTotal = 0;
		$rows = DB::select("
			SELECT COUNT(".$sIndexColumn.") as JUMLAH FROM (".$sTable.") qry
		");
		$result = (array)$rows[0];
		if($result){
			$iTotal = $result['jumlah'];
		}

		/*
		 * Format Output
		 */
		$sEcho="";
		if(isset($_GET['sEcho'])){
			$sEcho=$_GET['sEcho'];
		}
		$output = array(
			"sEcho" => intval($sEcho),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		
		$str=str_replace(" , ", " ", implode(", ", $aColumns));
		
		$sQuery = "SELECT * FROM ( SELECT ROWNUM AS NO,".$str." FROM ( SELECT * FROM (".$sTable.") ".$sOrder.") ".$sWhere." ) a ".$sLimit." ";
		
		$result = DB::select($sQuery);
		
		foreach($result as $row)
		{
			$row=(array)$row;
			if(session('kdlevel')=='00' || session('kdlevel')=='99' || session('kdlevel')=='77'){
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
				$row['label'],
				$pilih
			);
		}
		return response()->json($output);
			
	}
	
	public function getLabelById($id)
	{
		$rows = DB::select("
			select *
			from r_label
			where id=".$id."
		");
		
		if(isset($rows[0])){
			return response()->json($rows[0]);
		}
	}
	
	public function update(Request $request)
	{
		$update=DB::update('
			UPDATE r_label
			SET label=?
			WHERE id=?',
			[
				$request->input('label'),
				$request->input('inp-id')
			]
		);
		if($update==true){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Developer.';
		}			

	}
	
	public function store(Request $request)
	{
		$update=DB::update('
			INSERT INTO r_label (label)
			VALUES (?)
			',
			[
				$request->input('label')
			]
		);
		if($update==true){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Developer.';
		}			

	}
	
	public function destroy(Request $request)
	{
		$delete=DB::delete('DELETE FROM r_label where id='.$request->input('id'));
		if($delete==true){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Administrator.';
		}			

	}
}
