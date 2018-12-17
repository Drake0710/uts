<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class CekController extends Controller {

	protected $kdlevel;

	public function __construct(Request $request)
	{
		$this->kdlevel = session('kdlevel');
	}

	public function cekLevel(Request $request)
	{
		if($this->kdlevel){
			return response()->json(['kdlevel'=>$this->kdlevel]);
		}
	}
}

