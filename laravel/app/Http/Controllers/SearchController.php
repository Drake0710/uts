<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;
use FTP;

class SearchController extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(Request $request)
	{		
		//Kata Kunci
		$q = str_replace("'", "", trim($request->get('q')));
		$search = htmlspecialchars($q);

		//Construct
		$search_exploded = explode(" ", $search);
		$firsttime=true;
		$keyword="";
		$labels="";
		foreach ($search_exploded as $search_each) {
			if($firsttime){
				$keyword .= "";
				$labels .= "OR";
				$firsttime = false;
			}
			else{
				$keyword .= "AND";
				$labels .= "AND";
			}
			$keyword .= " ".$search_each." ";
			$labels .= " UPPER(b.labels) LIKE UPPER('%".$search_each."%') ";
		}

		//FILTERING
		$jenis = $request->get('jenis_peraturan');
		$tahun = $request->get('tahun');

		$filter="";
		if(isset($tahun) && $tahun!=""){
			$filter =" AND tahun_peraturan='".$tahun."' "; 
		}
		if(isset($jenis) && $jenis!=""){
			$filter =" AND id_jenis_peraturan='".$jenis."' "; 
		}
		if( (isset($tahun) && $tahun!="") && (isset($jenis) && $jenis!="") ){
			$filter =" AND tahun_peraturan='".$tahun."' AND id_jenis_peraturan='".$jenis."' "; 
		}

		
		//ORDERING
		$sort_jenis = $request->get('sort_jenis');
		$sort_tahun = $request->get('sort_tahun');

		$order_jenis="";
		if(isset($sort_jenis) && $sort_jenis!=""){
			$order_jenis = $sort_jenis; 
		}
		$order_tahun="";
		if(isset($sort_tahun) && $sort_tahun!=""){
			$order_tahun = $sort_tahun;
		}

		
		/*
		|--------------------------------------------------------------------------
		| TAMPILKAN PERATURAN DENGAN IS_PUBLISH = 1
		|--------------------------------------------------------------------------
		*/
		$query = "	select 	score(1),
							a.id,
							a.no_peraturan,
							a.tentang
		    		from(
						SELECT *
						FROM t_peraturan
						WHERE is_publish='1' ".$filter."
		    		) a
		    		left outer join(
		    			SELECT 	z.id_peraturan,
		          				LISTAGG (y.label, ' ') WITHIN GROUP (ORDER BY z.id_label) AS labels
		     			FROM t_peraturan_label z
		     			LEFT OUTER JOIN r_label y ON (z.id_label = y.id)
						GROUP BY z.id_peraturan
					) b ON (a.id = b.id_peraturan)
		   			where contains (a.no_peraturan, '".$keyword."', 1) > 0 ".$labels."
					order by 	a.id_jenis_peraturan ".$order_jenis.",
								a.tahun_peraturan ".$order_tahun.",
								a.no_peraturan,
								score(1) desc";
		//dd($query);
		$rows = DB::select($query);
		$jml=count($rows);

		return view('peraturan.index', compact('rows','jml'));
	}
	
	public function keyword()
	{
		try {
			/* DB table to use */
			$query = DB::select("SELECT label FROM r_label
				WHERE aktif='1'");
			
			return json_encode($query);
			
		} catch (\Exception $e) {
			return 'Terdapat kesalahan pada parameter query URL!';
			//return $e;
		}
	}
	
	public function getAturan($id)
	{
		try {

			$rows = DB::select("
				SELECT  a.id,
						a.no_peraturan,
						a.tentang,
						a.file_peraturan,
						a.note,
	                    NVL(a.abstrak,'-') AS abstrak,
	                    b.jenis_peraturan,
	                    d.status,
	                    c.id_peraturan2,
	                    decode(e.no_peraturan,null,null,e.no_peraturan) as no2,
	                    decode(c.id_status_peraturan,'1',null,CONCAT(' Tentang ', e.tentang)) as tentang2
	            FROM t_peraturan a
	            LEFT OUTER JOIN r_jenis_peraturan b ON(a.id_jenis_peraturan=b.id)
	            LEFT OUTER JOIN t_relasi_peraturan c ON(a.id=c.id_peraturan)
	            LEFT OUTER JOIN r_status_peraturan d ON(c.id_status_peraturan=d.id)
	            LEFT OUTER JOIN t_peraturan e ON(c.id_peraturan2=e.id)
	            WHERE a.id=? AND a.is_publish='1'
	            ORDER by c.id
			",[
				$id
			]);

			if(count($rows)>0){
				return view('peraturan.detil', compact('rows'));
			}
			else{
				return 'Data tidak ditemukan!';
			}
		} catch (\Exception $e) {
			//return $e;
			return 'Terdapat kesalahan lainnya. Hubungi Administrator!';
		}
	}

	public function file_peraturan($id)
	{
		try {
			$row = DB::select("
				SELECT 	id_jenis_peraturan,
						tahun_peraturan,
						file_peraturan
				FROM t_peraturan
				WHERE id=? AND is_publish='1'
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

	public function file_peraturan1($id)
	{
		try {
			$row = DB::select("
				SELECT 	id_jenis_peraturan,
						tahun_peraturan,
						file_peraturan
				FROM t_peraturan
				WHERE id=? AND is_publish='1'
			", [$id]);

			if(count($row)>0){

				$jenis=$row[0]->id_jenis_peraturan;
				$tahun=$row[0]->tahun_peraturan;
				$nmfile=preg_replace("/[\n\r]/", "", $row[0]->file_peraturan);
				$nmftp=str_replace(' ', '%20', $nmfile);

				$pathFTP='peraturan/'.$jenis.'/'.$tahun.'/';
				$downloadftp = FTP::connection()->readFile($pathFTP.$nmfile);

				if($downloadftp){

					header('Content-Description:FILE PERATURAN');
					header('Content-Type:application/pdf');
					header('Content-Disposition:attachment;filename='.$nmftp);
					header('Content-Transfer-Encoding:binary');
					header('Accept-Ranges:bytes');
				    header('Cache-Control:public');
				    header('Pragma:public');
					header('Expires:0');
					
					return $downloadftp;
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

}
