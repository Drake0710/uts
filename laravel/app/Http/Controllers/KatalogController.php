<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class KatalogController extends Controller {

	public function index()
	{
		$query = DB::select("
			SELECT *
			FROM D_TREEVIEW
			ORDER BY ID
		");
		
		//$output = array();
        foreach ($query as $row) {
			$row=(array)$row;
            $sub_data["id"] = $row["ID"];
            $sub_data["name"] = $row["TEXT"];
            $sub_data["text"] = $row["TEXT"];
            $sub_data["parent_id"] = $row["PARENT"];
            $data[] = $sub_data;

        }


        foreach ($data as $key => &$value) {
            $output[$value["id"]] = &$value;
        }

        foreach ($data as $key => &$value) {
            if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
                $output[$value["parent_id"]]["nodes"][] = &$value;
            }
        }

        foreach ($data as $key => &$value) {
            if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
                unset($data[$key]);
            }
        }

        echo json_encode($data);
	}

	public function getKatalog($id)
	{
		if($id<=10){
			$query = DB::select("
			
			select a.* from (
				select id,no_peraturan,tentang
				from t_peraturan
				where is_publish='1' and id_jenis_peraturan='".$id."'
				order by tahun_peraturan desc, id desc) a 

			");
		} else {
			$query = DB::select("
			
			select c.* from (
				select a.id,a.no_peraturan,a.tentang from t_peraturan a
				inner join
				(SELECT text,parent FROM D_TREEVIEW WHERE ID='".$id."') b
				on a.tahun_peraturan=b.text and A.ID_JENIS_PERATURAN=b.parent
				where a.is_publish='1'
				order by id) c
			");
		}
		
		$result='';
		$no=1;
		
		foreach($query as $katalog) {
			
			$result .= '<li class="row">
							<div class="col-lg-1 p-r-0">
								'.$no++.'.
							</div>
							<div class="col-lg-11 p-l-0">
								<a href="search/peraturan/'.$katalog->id.'">
									<p class="judul_peraturan2" class="tooltip" title="'.$katalog->tentang.'">
										'.$katalog->no_peraturan.'
										<!--<span>'.$katalog->tentang.'</span>-->
									</p>
									<!--<p class="tentang_peraturan2">
										'.$katalog->tentang.'
									</p>-->
								</a>
							</div>
						</li>';
			
		}
		
		if(count($query)===0){
			$result .= '<li>Hasil Pencarian Tidak Ditemukan</li>';
		}

		return $result;
		
		
	}
	

}
