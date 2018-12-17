<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class PeraturanFinalController extends Controller {

	public function index()
	{
			
		$error='';
	
		$aColumns = array('id','no_peraturan','tahun_peraturan','tentang','abstrak','jenis_peraturan','sifat_peraturan','publish');
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		/* DB table to use */
		$sTable = " select  a.id,
							a.no_peraturan,
							a.tahun_peraturan,
							a.tentang,
							a.abstrak,
							b.jenis_peraturan,
							c.sifat_peraturan,
							decode(a.is_publish,'1','Ya','Tidak') as publish
					from t_peraturan a
					left outer join r_jenis_peraturan b on(a.id_jenis_peraturan=b.id)
					left outer join r_sifat_peraturan c on(a.id_sifat_peraturan=c.id)
					where id_user=".session('user_id')."
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
				$sWhere=" where no_peraturan like '".$sSearch."%' or tentang like '".$sSearch."%' or abstrak like '".$sSearch."%' or jenis_peraturan like '".$sSearch."%'  or sifat_peraturan like '".$sSearch."%'";
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
			if(session('kdlevel')=='00' || session('kdlevel')=='99'){
				$pilih='<center>
							<!--<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-primary ubah-data" title="Ubah Data"><i class="fa fa-pencil"></i></a>-->
						</center>';
			} else {
				$pilih='<center>
							-
						</center>';
			}

			$output['aaData'][] = array(
				$row['id'],
				'<center>'.$row['no'].'</center>',
				$row['no_peraturan'],
				'<center>'.$row['tahun_peraturan'].'</center>',
				'<center>'.$row['publish'].'</center>',
				$pilih,
				$row['jenis_peraturan'],
				$row['sifat_peraturan'],
				$row['tentang'],
				$row['abstrak']
			);
		}
		return response()->json($output);
			
	}
	
	public function getModalPeraturan()
	{
			
		$error='';
	
		$aColumns = array('id','no_peraturan');
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		/* DB table to use */
		$sTable = " select  a.id,
							a.no_peraturan
					from t_peraturan a
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
				$sWhere=" where no_peraturan like '%".$sSearch."%'";
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
			$pilih='<center>
						<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-primary pilih-data-peraturan" title="Pilih Data"><i class="fa fa-check"></i></a>
					</center>';

			$output['aaData'][] = array(
				'<center>'.$row['no'].'</center>',
				$row['no_peraturan'],
				$pilih
			);
		}
		return response()->json($output);
			
	}
	
	public function getModalRelasi()
	{
			
		$error='';
	
		$aColumns = array('id','status');
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		/* DB table to use */
		$sTable = " select  a.id,
							a.status
					from r_status_peraturan a
					where a.id <> '1'
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
				$sWhere=" where status like '".$sSearch."%'";
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
			$pilih='<center>
						<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-primary pilih-data-relasi" title="Pilih Data"><i class="fa fa-check"></i></a>
					</center>';

			$output['aaData'][] = array(
				'<center>'.$row['no'].'</center>',
				$row['status'],
				$pilih
			);
		}
		return response()->json($output);
			
	}
	
	public function store(Request $request)
	{
		$update=DB::update('
			INSERT INTO t_peraturan (no_peraturan,tahun_peraturan,tentang,abstrak,id_jenis_peraturan,id_sifat_peraturan,is_publish,id_user)
			VALUES (?,?,?,?,?,?,?,?,?)
			',
			[
				$request->input('no_peraturan'),
				$request->input('tahun_peraturan'),
				$request->input('tentang'),
				$request->input('abstrak'),
				$request->input('jenis_peraturan'),
				$request->input('sifat_peraturan'),
				$request->input('publish'),
				session('user_id')
			]
		);
		if($update==true){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Developer.';
		}			

	}
	
}
