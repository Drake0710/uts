<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class GuestController extends BaseController
{
    public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		/* $query = DB::select("
			select b.* from (
				select rownum as no,a.* from (
					select x.id,x.no_peraturan,x.tentang,f.nm_status,i.id_peraturan2,h.peraturan2
					from t_peraturan x
					left outer join (SELECT a.id_peraturan,
                                           SUBSTR (REPLACE (wm_concat ('%' || b.status), ',%', '|'), 2) AS nm_status
                                    FROM t_relasi_peraturan a
                                    LEFT OUTER JOIN r_status_peraturan b ON(a.id_status_peraturan=b.id)
                                    GROUP BY a.id_peraturan) f on (x.id=f.id_peraturan)
					left outer join (SELECT a.id_peraturan,
                                           NVL(SUBSTR (REPLACE (wm_concat ('%' || a.id_peraturan2), ',%', '|'), 2),'') AS id_peraturan2
                                    FROM t_relasi_peraturan a
                                    GROUP BY a.id_peraturan) i on (x.id=i.id_peraturan)
					left outer join (SELECT a.id_peraturan,
                                           NVL(SUBSTR (REPLACE (wm_concat ('%' || b.no_peraturan), ',%', '|'), 2),'') AS peraturan2
                                    FROM t_relasi_peraturan a
                                    LEFT OUTER JOIN t_peraturan b ON(a.id_peraturan2=b.id)
                                    GROUP BY a.id_peraturan) h on (x.id=h.id_peraturan)
					where x.is_publish='1'
					order by x.tahun_peraturan desc, x.id desc) a ) b
			where no < 11
		"); */
		
		/* $query = DB::select("
			select b.* from (
                select rownum as no,a.* from (
                    select x.id,x.no_peraturan,x.tentang,NVL(f.nm_status,'Aktif') as nm_status,i.id_peraturan2,h.peraturan2
                    from t_peraturan x
                    left outer join (SELECT z.* FROM (SELECT rownum as no, y.* FROM
                                        (SELECT a.id, a.id_peraturan,
                                            b.status AS nm_status
                                            FROM t_relasi_peraturan a
                                            LEFT OUTER JOIN r_status_peraturan b ON(a.id_status_peraturan=b.id)
                                            ORDER BY a.id desc)y) z
                                            WHERE no='1') f on (x.id=f.id_peraturan)
                    left outer join (SELECT z.* FROM (SELECT rownum as no, y.* FROM
                                        (SELECT a.id, a.id_peraturan,
                                            NVL(a.id_peraturan2,'') AS id_peraturan2
                                            FROM t_relasi_peraturan a
                                            LEFT OUTER JOIN r_status_peraturan b ON(a.id_status_peraturan=b.id)
                                            ORDER BY a.id desc)y) z
                                            WHERE no='1') i on (x.id=i.id_peraturan)
                    left outer join (SELECT z.* FROM (SELECT rownum as no, y.* FROM
                                        (SELECT a.id, a.id_peraturan,
                                            NVL(b.no_peraturan,'') AS peraturan2
                                            FROM t_relasi_peraturan a
                                            LEFT OUTER JOIN t_peraturan b ON(a.id_peraturan2=b.id)
                                            ORDER BY a.id desc)y) z
                                            WHERE no='1') h on (x.id=h.id_peraturan)
                    where x.is_publish='1'
                    order by x.tahun_peraturan desc, x.id desc) a ) b
            where no < 11
		"); */
		
		$query = DB::select("
			select b.* from (
                select a.* from (
                    select x.id,x.no_peraturan,x.tentang,IFNULL(f.nm_status,'Aktif') as nm_status,i.id_peraturan2,h.peraturan2
                    from t_peraturan x
                    left outer join (SELECT z.* FROM (SELECT y.* FROM
                                        (SELECT a.id, a.id_peraturan,
                                            b.status AS nm_status
                                            FROM t_relasi_peraturan a
                                            LEFT OUTER JOIN r_status_peraturan b ON(a.id_status_peraturan=b.id)
                                            ORDER BY a.id desc)y) z
                                            LIMIT 1) f on (x.id=f.id_peraturan)
                    left outer join (SELECT z.* FROM (SELECT y.* FROM
                                        (SELECT a.id, a.id_peraturan,
                                            IFNULL(a.id_peraturan2,'') AS id_peraturan2
                                            FROM t_relasi_peraturan a
                                            LEFT OUTER JOIN r_status_peraturan b ON(a.id_status_peraturan=b.id)
                                            ORDER BY a.id desc)y) z
                                            LIMIT 1) i on (x.id=i.id_peraturan)
                    left outer join (SELECT z.* FROM (SELECT y.* FROM
                                        (SELECT a.id, a.id_peraturan,
                                            IFNULL(b.no_peraturan,'') AS peraturan2
                                            FROM t_relasi_peraturan a
                                            LEFT OUTER JOIN t_peraturan b ON(a.id_peraturan2=b.id)
                                            ORDER BY a.id desc)y) z
                                           LIMIT 1) h on (x.id=h.id_peraturan)
                    where x.is_publish='1'
                    order by x.tahun_peraturan desc, x.id desc) a ) b
            LIMIT 10
		");

		$html_out='<li></li>';
		
		foreach($query as $terbaru) {
			
			$terbaru=(array)$terbaru;

			//create list status
			$arr_status = explode("|", $terbaru['nm_status']);
			$arr_peraturan2 = explode("|", $terbaru['peraturan2']);
			$arr_id_peraturan2 = explode("|", $terbaru['id_peraturan2']);
			$status = '<ul style="font-size:12px;">';
			for($j=0; $j<count($arr_status); $j++){
				if($arr_status[$j]=='Aktif'){
					$status .= '<li style="padding:0;"><span class="label label-success" style="padding: 2px 20px;">'.$arr_status[$j].'</span></li>';
				}
				elseif ($arr_status[$j]==''){
					$status .= '<li style="padding:0;"><span class="label label-danger">Tidak Aktif</span></li>';
				}
				else {
					$arr[] = array($arr_status[$j] => $arr_id_peraturan2[$j]);
					$arr2[] = array($arr_id_peraturan2[$j] => $arr_peraturan2[$j]);
					if($arr_status[$j]=='Mencabut Sebagian'){
						$status .= '<li style="padding:0;"><span class="label label-inverse" style="padding: 2px 3px;">'.$arr_status[$j].'</span><a href="search/peraturan/'.$arr_id_peraturan2[$j].'"><p class="status_peraturan2">'.$arr_peraturan2[$j].'</p></a></li>';
					} else {
						$status .= '<li style="padding:0;"><span class="label label-inverse">'.$arr_status[$j].'</span><a href="search/peraturan/'.$arr_id_peraturan2[$j].'"><p class="status_peraturan2">'.$arr_peraturan2[$j].'</p></a></li>';
					}
					//dd($arr2);
					
				}	
			}
			$status .= '</ul>';
			
			$html_out .= '<li class="row" style="margin-bottom:15px;">
							<div class="col-md-7">
								<a href="search/peraturan/'.$terbaru['id'].'">
									<!--<p class="waktu_peraturan">
										1 Maret 2018 17.54 WIB
									</p>-->
									<p class="judul_peraturan">
										'.$terbaru['no_peraturan'].'
									</p>
									<p class="tentang_peraturan">
										'.$terbaru['tentang'].'
									</p>
								</a>
							</div>
							<div class="col-md-5">
								<p class="tentang_peraturan">--STATUS--</p>
								'.$status.'
							</div>
						</li>';
			
		}
		//dd($query);
		
		return view('landing',
			[
				'terbaru' => $html_out
			]
		);
	}

	/*public function login()
	{
		return view('login');
	}*/
}
