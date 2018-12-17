<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class UserManajemenController extends Controller {

	public function index()
	{
		if(session('kdlevel')=='00' || session('kdlevel')=='99'){
			
			$where = "";
			if(session('kdlevel')=='99'){
				$where = " where a.kdlevel not in('99') ";
			}
			elseif(session('kdlevel')=='00'){
				$where = " where a.kdlevel not in('00','99') ";
			}
			
			$error='';
		
			$aColumns = array('id','nama','nip','nm_unitdtl','nmlevel','email','aktif','status');
			/* Indexed column (used for fast and accurate table cardinality) */
			$sIndexColumn = "id";
			/* DB table to use */
			$sTable = " select  a.id,
								a.nama,
								a.nip,
								c.nm_unitdtl,
								b.nmlevel,
								a.email,
								a.aktif,
								decode(a.aktif,'1','Aktif','Tidak Aktif') as status
						from t_user a
						left outer join r_level b on(a.kdlevel=b.kdlevel)
						left outer join t_unit_dtl c on(a.id_unitdtl=c.id_unit)
						".$where."
						order by id desc";
			
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
					$sWhere=" where nama like '".$sSearch."%' or nip like '".$sSearch."%' or nm_unitdtl like '".$sSearch."%' or nmlevel like '".$sSearch."%'  or email like '".$sSearch."%'";
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
				if($row['aktif']=='1'){
					$pilih='<center>
								<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-warning waves-effect waves-light non-aktif" title="Non Aktifkan User"><i class="fa fa-remove"></i></a>
							</center>';
				} else {
					$pilih='<center>
								<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-info waves-effect waves-light aktif" title="Aktifkan User"><i class="fa fa-check"></i></a>
								<!--<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-danger hapus-data" title="Hapus Data User"><i class="fa fa-trash-o"></i></a>-->
							</center>';
				}

				$output['aaData'][] = array(
					'<center>'.$row['no'].'</center>',
					$row['nama'],
					$row['nip'],
					$row['nmlevel'],
					$row['nm_unitdtl'],
					'<center>'.$row['status'].'</center>',
					$pilih
				);
			}
			return response()->json($output);
			
		}
		else{
			return 'Anda tidak memiliki akses ini!';
		}
	}
	
	public function aktif(Request $request)
	{
		$update=DB::update('update t_user
							set AKTIF=?,
								UPDATED_AT=SYSDATE
							where id=?',
							[
								'1',
								$request->input('id')
							]
		);
		if($update==1){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Developer.';
		}			

	}
	
	public function nonaktif(Request $request)
	{
		$update=DB::update('update t_user
							set AKTIF=?,
								UPDATED_AT=SYSDATE
							where id=?',
							[
								'0',
								$request->input('id')
							]
		);
		if($update==1){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Developer.';
		}			

	}
	
	public function hapus(Request $request)
	{
		$delete=DB::delete('DELETE FROM t_user where id='.$request->input('id'));
		if($delete==true){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Administrator.';
		}			

	}

}
