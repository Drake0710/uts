<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;
use Yajra\Datatables\Facades\Datatables;
use FTP;

class MonPeraturanController extends Controller {

	public function index()
	{
		$where="";
		if(isset($_GET['jenis']) && $_GET['jenis']!=''){
			$where = " WHERE a.id_jenis_peraturan=".$_GET['jenis']." ";
		}
		if(isset($_GET['tahun']) && $_GET['tahun']!=''){
			$where = " WHERE a.tahun_peraturan=".$_GET['tahun']." ";
		}
		if( (isset($_GET['jenis']) && $_GET['jenis']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='') ){
			$where = " WHERE a.id_jenis_peraturan=".$_GET['jenis']." AND a.tahun_peraturan=".$_GET['tahun']." ";
		}

		$rows = DB::select("
			select 	a.id,
			        a.no_peraturan,
			        a.tahun_peraturan,
			        a.tentang,
			        a.id_unitdtl,
			        NVL (a.abstrak, '-') AS abstrak,
			        DECODE (a.is_publish, '1', 'Ya', 'Tidak') AS publish,
			        b.jenis_peraturan,
			        NVL (c.sifat_peraturan, '-') AS sifat_peraturan,
			        f.nm_status,
			        g.nm_label
			from t_peraturan a
			left outer join r_jenis_peraturan b ON (a.id_jenis_peraturan = b.id)
			left outer join r_sifat_peraturan c ON (a.id_sifat_peraturan = c.id)
			left outer join(
				SELECT 	a.id_peraturan,
                        SUBSTR(REPLACE (wm_concat ('%' || b.status), ',%', '|'), 2) AS nm_status
                FROM t_relasi_peraturan a
                LEFT OUTER JOIN r_status_peraturan b ON (a.id_status_peraturan = b.id)
                GROUP BY a.id_peraturan
            ) f ON (a.id = f.id_peraturan)
			left outer join(
				SELECT 	a.id_peraturan,
			            SUBSTR(REPLACE(wm_concat ('%' || b.label), ',%', ', '), 2) AS nm_label
			    FROM t_peraturan_label a
			    LEFT OUTER JOIN r_label b ON (a.id_label = b.id)
			    GROUP BY a.id_peraturan
			) g ON (a.id = g.id_peraturan)
			".$where."
			order by a.id DESC,
			         a.created_at DESC,
			         a.tahun_peraturan DESC,
			         a.id_jenis_peraturan,
			         publish,
			         a.no_peraturan
		");
		$rows=collect($rows);

		$datatables = Datatables::of($rows)
			->setRowId(function($row) { return $row->id; })
			->addIndexColumn()
			//create list status
			->addColumn('status', function($row){
				$arr_status = explode("|", $row->nm_status);
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

				return $status;
			})
			->addColumn('label', function($row){
				$label='-';
				if($row->nm_label != null){
					$label=$row->nm_label;
				}
				return $label;
			})
			->addColumn('action', function($row){
				return view('action.mon-peraturan',[
					'id'=>$row->id,
					'kdlevel'=>session('kdlevel'),
					'publish'=>$row->publish,
					'unit'=>$row->id_unitdtl
				]);
			})
			->make(true);

		return $datatables;
	}

	public function file_peraturan($id)
	{
		try {
			$row = DB::select("
				SELECT 	id_jenis_peraturan,
						tahun_peraturan,
						file_peraturan
				FROM t_peraturan
				WHERE id=?
			", [$id]);

			if(count($row)>0){

				$jenis=$row[0]->id_jenis_peraturan;
				$tahun=$row[0]->tahun_peraturan;
				$nmfile=preg_replace("/[\n\r]/", "", $row[0]->file_peraturan);
				$nmftp=str_replace(' ', '%20', $nmfile);

				$pathFTP='peraturan/'.$jenis.'/'.$tahun.'/';
				$downloadftp = FTP::connection()->readFile($pathFTP.$nmfile);

				if($downloadftp){
					return (new Response($downloadftp))->header('Content-Type', 'application/pdf');
				}
				else{
					return 'Gagal mendownload data dari server.';
				}
			}
			else{
				return 'Data tidak ditemukan!';
			}
		} catch (\Exception $e) {
			return 'Terdapat kesalahan pada parameter query URL!';
			//return $e;
		}
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
						<a href="javascript:;" id="'.$row['id'].'" class="btn btn-xs btn-primary pilih-peraturan" title="Pilih Data"><i class="fa fa-check"></i></a>
					</center>';

			$output['aaData'][] = array(
				/*'<center>'.$row['no'].'</center>',*/
				$row['no_peraturan'],
				$pilih
			);
		}
		return response()->json($output);		
	}

	public function searchPeraturanById($id)
	{
		$rows = DB::select("SELECT id AS id_peraturan,no_peraturan FROM t_peraturan WHERE id=?",[$id]);

		return json_encode($rows[0]);
	}

	public function simpan(Request $request)
	{
		try {
			if(session('nm_file_peraturan')!=null && session('nm_file_peraturan')!=''){
				$arr_relasi 	= $request->input('relasi');
				if($arr_relasi!=null){
					$arr_relasi_key = array_keys($arr_relasi);
				}
				$arr_label 		= $request->get('labels');
				$arr_label_key  = array_keys($arr_label);
				$note = $request->input('note');

				DB::beginTransaction();

				$peraturan_id=DB::table('t_peraturan')->insertGetId([
					'no_peraturan'			=>$request->input('no_peraturan'),
					'tahun_peraturan'		=>$request->input('tahun_peraturan'),
					'tentang'	 			=>$request->input('tentang'),
					'abstrak'				=>$request->input('abstrak'),
					'id_jenis_peraturan'	=>$request->input('jenis_peraturan'),
					'id_sifat_peraturan'	=>$request->input('sifat_peraturan'),
					'is_publish'			=>'0',
					'id_user'				=>session('user_id'),
					'id_unitdtl'			=>session('id_unitdtl'),
					'file_peraturan'		=>session('nm_file_peraturan'),
					'created_at'			=>DB::raw('SYSDATE'),
					'updated_at'			=>DB::raw('SYSDATE'),
					'note' 					=>$note,
				]);

				if($peraturan_id){
					
					if($arr_relasi!=null){
						for($i=0;$i<count($arr_relasi_key);$i++){
							$arr_data_relasi[]="
								SELECT
									'".$peraturan_id."',
									'".$arr_relasi[$arr_relasi_key[$i]]['id_peraturan2']."',
									'".$arr_relasi[$arr_relasi_key[$i]]['id_status_peraturan']."'
								FROM DUAL
							";
						}
						
						$query_union_relasi = implode(" union all ", $arr_data_relasi);
						$query_insert_relasi="
							INSERT INTO t_relasi_peraturan(id_peraturan,id_peraturan2,id_status_peraturan)"
							.$query_union_relasi." ";
						$insert_relasi=DB::insert($query_insert_relasi);
					} else {
						$arr_data_relasi[]="
							SELECT
								'".$peraturan_id."',
								'',
								'1'
							FROM DUAL
						";
						$query_union_relasi = implode(" union all ", $arr_data_relasi);
						$query_insert_relasi="
							INSERT INTO t_relasi_peraturan(id_peraturan,id_peraturan2,id_status_peraturan)"
							.$query_union_relasi." ";
						$insert_relasi=DB::insert($query_insert_relasi);
					}

					//Insert Label Peraturan
					for($i=0;$i<count($arr_label_key);$i++){
						$arr_data_label[]="
							SELECT
								'".$peraturan_id."',
								'".$arr_label[$arr_label_key[$i]]."'
							FROM DUAL
						";
					}
					$query_union_label = implode(" union all ", $arr_data_label);
					$query_insert_label="
						INSERT INTO t_peraturan_label(id_peraturan,id_label) "
						.$query_union_label." ";
					$insert_label=DB::insert($query_insert_label);


					if($insert_relasi==true && $insert_label==true){
						DB::commit();
						return 'success';
					}
					else{
						return 'Proses insert child gagal!';
					}
				}
				else{
					return 'Proses insert parent gagal!';
				}
			} else {
				return 'File Peraturan belum diupload';
			}
		} catch (\Exception $e) {
			//return 'Terjadi kesalahan lainnya. Hubungi Administrator!';
			return $e;
		}
	}
	
	public function getPeraturanById($id)
	{
		$rows = DB::select("
			SELECT a.*, b.id_status_peraturan
			FROM t_peraturan a
			LEFT OUTER JOIN t_relasi_peraturan b on a.id=b.id_peraturan
			WHERE a.id=".$id."
		");
		
		if(isset($rows[0])){
			session(['nm_file_peraturan'=>$rows[0]->file_peraturan]);
			return response()->json($rows[0]);
		}
	}
	
	public function getLabelByPeraturan($id)
	{
		$rows_selected = DB::select("
			SELECT *
			FROM r_label
			WHERE id IN(
			    SELECT id_label
			    FROM t_peraturan_label
			    WHERE id_peraturan=?
			) ORDER BY label
		", [$id]);
		$rows = DB::select("
			SELECT *
			FROM r_label
			WHERE id NOT IN(
			    SELECT id_label
			    FROM t_peraturan_label
			    WHERE id_peraturan=?
			) ORDER BY label
		", [$id]);
		
		$data = '';
		foreach($rows_selected as $row_selected){
			$data .= '<option value="'.$row_selected->id.'" selected>'.$row_selected->label.'</option>';
		}
		foreach($rows as $row){
			$data .= '<option value="'.$row->id.'">'.$row->label.'</option>';
		}
		
		return json_encode($data);
	}
	
	public function ubah(Request $request)
	{
		try{
			$arr_relasi 	= $request->input('relasi');
			if($arr_relasi!=null){
				$arr_relasi_key = array_keys($arr_relasi);
			}
			$arr_label 		= $request->input('labels');
			$arr_label_key  = array_keys($arr_label);

			DB::beginTransaction();
			
			$update=DB::update('
				UPDATE t_peraturan
				SET no_peraturan=?,
					tahun_peraturan=?,
					tentang=?,
					abstrak=?,
					id_jenis_peraturan=?,
					id_sifat_peraturan=?,
					file_peraturan=?,
					note=?
				WHERE id=?',
				[
					$request->input('no_peraturan'),
					$request->input('tahun_peraturan'),
					$request->input('tentang'),
					$request->input('abstrak'),
					$request->input('jenis_peraturan'),
					$request->input('sifat_peraturan'),
					session('nm_file_peraturan'),
					$request->input('note'),
					$request->input('inp-id')
				]
			);

			if($update){
				
				$del_relasi=DB::delete('DELETE FROM t_relasi_peraturan WHERE id_peraturan='.$request->input('inp-id'));
				//Insert Relasi Peraturan
				if($arr_relasi!=null){
					for($i=0;$i<count($arr_relasi_key);$i++){
						$arr_data_relasi[]="
							SELECT
								'".$request->input('inp-id')."',
								'".$arr_relasi[$arr_relasi_key[$i]]['id_peraturan2']."',
								'".$arr_relasi[$arr_relasi_key[$i]]['id_status_peraturan']."'
							FROM DUAL
						";
					}
					
					$query_union_relasi = implode(" union all ", $arr_data_relasi);
					$query_insert_relasi="
						INSERT INTO t_relasi_peraturan(id_peraturan,id_peraturan2,id_status_peraturan)"
						.$query_union_relasi." ";
					$insert_relasi=DB::insert($query_insert_relasi);
				} else {
					$arr_data_relasi[]="
						SELECT
							'".$request->input('inp-id')."',
							'',
							'1'
						FROM DUAL
					";
					$query_union_relasi = implode(" union all ", $arr_data_relasi);
					$query_insert_relasi="
						INSERT INTO t_relasi_peraturan(id_peraturan,id_peraturan2,id_status_peraturan)"
						.$query_union_relasi." ";
					$insert_relasi=DB::insert($query_insert_relasi);
				}
				
				$del_label=DB::delete('DELETE FROM t_peraturan_label WHERE id_peraturan='.$request->input('inp-id'));
				//Insert Label Peraturan
				for($i=0;$i<count($arr_label_key);$i++){
					$arr_data_label[]="
						SELECT
							'".$request->input('inp-id')."',
							'".$arr_label[$arr_label_key[$i]]."'
						FROM DUAL
					";
				}
				$query_union_label = implode(" union all ", $arr_data_label);
				$query_insert_label="
					INSERT INTO t_peraturan_label(id_peraturan,id_label) "
					.$query_union_label." ";
				$insert_label=DB::insert($query_insert_label);
				
				if($insert_relasi==true && $insert_label==true){
					DB::commit();
					return 'success';
				}
				else{
					return 'Proses insert child gagal!';
				}
			}
			else{
				return 'Proses insert parent gagal!';
			}
		}
		catch(\Exception $e){
			//return 'Koneksi pada sistem terputus!';
			return $e;
		}			
	}

	public function getRelasiByPeraturan($id)
	{
		$rows = DB::select("
			SELECT  rownum AS detil,
			        id,
			        id_peraturan,
			        no1,
			        id_status_peraturan,
			        id_peraturan2,
			        no2
			FROM(
			    SELECT 	a.*,
			    		b.no_peraturan as no1,
			    		c.no_peraturan as no2
			    FROM t_relasi_peraturan a
			    LEFT OUTER JOIN t_peraturan b ON(a.id_peraturan=b.id)
			    LEFT OUTER JOIN t_peraturan c ON(a.id_peraturan2=c.id)
			    WHERE a.id_peraturan=?
			    ORDER BY a.id
			)
			WHERE id_status_peraturan <> '1'
			ORDER BY detil DESC
		",[
			$id
		]);
		
		if(count($rows)>0){
			return response()->json($rows);
		}
	}
	
	public function peraturan_upload(Request $request)
	{		
		$jenis_peraturan = $request->input('jenis_peraturan');
		$tahun_peraturan = $request->input('tahun_peraturan');
		$no_peraturan = $request->input('no_peraturan');
		$no_peraturan2 = str_replace('/','_',$no_peraturan);
		//$tentang = $request->input('tentang');
		//$targetFolder = 'data\peraturan\\'; // Relative to the root
		$pathFTP='peraturan/'.$jenis_peraturan.'/'.$tahun_peraturan.'/';
		if($jenis_peraturan!=null){
			if($tahun_peraturan!=null){
				if($no_peraturan!=null){
					if (!empty($_FILES)) {
						$jenis = DB::select("
							SELECT *
							FROM r_jenis_peraturan
							WHERE id=".$jenis_peraturan."");
						$jenis_peraturan2=$jenis[0]->singkatan;
						$file_name = $_FILES['files']['name'];
						$tempFile = $_FILES['files']['tmp_name'];
						//$targetFile = $targetFolder.$file_name;
						$fileTypes = array('PDF', 'pdf', 'RAR', 'rar', 'ZIP', 'zip'); // File extensions
						$fileParts = pathinfo($_FILES['files']['name']);
						$fileSize = $_FILES['files']['size'];
						$errorCode = $_FILES['files']['error'];
						
						//type file sesuai..??	
						if (in_array($fileParts['extension'],$fileTypes)) {
							
							//isi kosong..??
							if($fileSize>0){
								if($fileSize>20000000){
									echo 'File size melebihi 20 MB.';
								} else {
									if($errorCode === UPLOAD_ERR_OK){
										$file_name = $no_peraturan2.'.'.$fileParts['extension'];
										//$file_name = $jenis_peraturan2.'_Tentang_'.$tentang.'.'.$fileParts['extension'];
										//echo $file_name;
										
										//move_uploaded_file($tempFile,$targetFolder.$file_name);
										
										$upload = FTP::connection()->uploadFile($tempFile,$pathFTP.$file_name);
										if($upload){
											session(['nm_file_peraturan'=>$file_name]);	
											return '1';
										} else {
											return 'File gagal diupload!';
										}
									} else {
										echo 'File Upload error code ' . $errorCode;
									}
								}
							}
							else{
								echo 'Isi file kosong, periksa data anda.';
							}
						}
						else{
							echo 'Tipe file yang diperbolehkan hanya .PDF, .RAR, .ZIP';
						}
					}
					else{
						echo 'Tidak ada file yang diupload.';
					}
				}
				else {
					echo 'Nomor Peraturan belum Diisi';
				}
			}
			else {
				echo 'Tahun Peraturan belum Diisi';
			}
		}
		else {
			echo 'Jenis Peraturan belum Diisi.';
		}
		
	}
	
}
