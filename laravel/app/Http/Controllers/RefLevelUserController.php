<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class RefLevelUserController extends Controller {

	public function index()
	{
		$rows = DB::select("
			SELECT *
			FROM r_level
			WHERE kdlevel <> '99'
			ORDER BY kdlevel
		");
		
		$data=array();
		$i=1;
		foreach($rows as $row){
			$row=(array)$row;
			$data['data'][] = array(
				'<center>'.$i.'</center>',
				$row['kdlevel'],
				$row['nmlevel']
			);
			$i++;
		}

		return response()->json($data);
	}

}
