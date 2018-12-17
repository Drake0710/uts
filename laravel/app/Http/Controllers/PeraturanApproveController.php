<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class PeraturanApproveController extends Controller {

	public function index()
	{
			
		$error='';
	
		$aColumns = array('id','no_peraturan','tahun_peraturan','tentang','id_unitdtl','abstrak','is_publish','jenis_peraturan','sifat_peraturan','nm_status','publish');
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		/* DB table to use */
		$sTable = " select  a.id,
                            a.no_peraturan,
                            a.tahun_peraturan,
                            a.tentang,
                            a.id_unitdtl,
                            nvl(a.abstrak,'-') as abstrak,
                            a.is_publish,
                            decode(a.is_publish,'1','Ya','Tidak') as publish,
                            b.jenis_peraturan,
                            nvl(c.sifat_peraturan,'-') as sifat_peraturan,
                            f.nm_status
                    from t_peraturan a
                    left outer join r_jenis_peraturan b on(a.id_jenis_peraturan=b.id)
                    left outer join r_sifat_peraturan c on(a.id_sifat_peraturan=c.id)
                    left outer join (SELECT a.id_peraturan,
                                           SUBSTR (REPLACE (wm_concat ('%' || b.status), ',%', '|'), 2) AS nm_status
                                    FROM t_relasi_peraturan a
                                    LEFT OUTER JOIN r_status_peraturan b ON(a.id_status_peraturan=b.id)
                                    GROUP BY a.id_peraturan) f on (a.id=f.id_peraturan)
                    order by a.id desc";
		
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
				$sWhere=" where no_peraturan like '".$sSearch."%' or tentang like '".$sSearch."%' or abstrak like '".$sSearch."%' or jenis_peraturan like '".$sSearch."%'  or sifat_peraturan like '".$sSearch."%' or jenis_peraturan like '".$sSearch."%' or publish like '".$sSearch."%'";
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

			//create list status
			$arr_status = explode("|", $row['nm_status']);
			$status = '<ul style="list-style-position:inside;margin:0;padding:0;list-style: none;">';
			for($j=0; $j<count($arr_status); $j++){
				if($arr_status[$j]=='Aktif'){
					$status .= '<li><span class="label label-primary">'.$arr_status[$j].'</span></li>';
				}
				elseif ($arr_status[$j]==''){
					$status .= '<li><span class="label label-danger">Tidak Aktif</span></li>';
				}
				else {
					$status .= '<li><span class="label label-inverse">'.$arr_status[$j].'</span></li>';
				}	
			}
			$status .= '</ul>';
			
			if(session('kdlevel')=='01' || session('kdlevel')=='99' || session('kdlevel')=='77'){
				if($row['is_publish']=='1'){
					$checked='checked';
				} else {
					$checked='';
				}
				$publish='<center>
							<div class="switch">
								<label>Tidak
									<input type="checkbox" id="'.$row['id'].'" class="publish" name="'.$row['is_publish'].'" '.$checked.'><span class="lever switch-col-deep-purple"></span>Ya</label>
							</div>
						</center>';
			}

			$output['aaData'][] = array(
				$row['id'],
				'<center>'.$row['no'].'</center>',
				$row['no_peraturan'],
				'<center>'.$row['tahun_peraturan'].'</center>',
				$publish,
				$row['jenis_peraturan'],
				$row['sifat_peraturan'],
				$status,
				$row['tentang'],
				$row['abstrak']
			);
		}
		return response()->json($output);
			
	}

	public function store(Request $request)
	{
		if($request->input('is_publish')=='0'){
			$update=DB::update('update t_peraturan
							set is_publish=1,
								UPDATED_AT=SYSDATE
							where id=?',
							[
								$request->input('id')
							]
			);
		}
		
		if($request->input('is_publish')=='1'){
			$update=DB::update('update t_peraturan
							set is_publish=0,
								UPDATED_AT=SYSDATE
							where id=?',
							[
								$request->input('id')
							]
			);
		}		
		
		if($update==1){
			return 'success';
		}
		else{
			return 'Proses ubah gagal. Hubungi Developer.';
		}			

	}
	
}
