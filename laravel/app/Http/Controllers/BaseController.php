<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use View;

class BaseController extends Controller
{
    public $data;

	public function __construct()
	{
		try{
			if(session('authenticated')==null){
				
				$error = '';
				if(isset($_GET['error'])){
					$error = $_GET['error'];
				}
				
				if($error=='unsupported_response_type'){
					$this->data['error'] = 'Proses OAuth2 gagal!';
				}
				elseif($error=='invalid_auth_code1'){
					$this->data['error'] = 'Proses otorisasi gagal! (code : 1)';
				}
				elseif($error=='invalid_auth_code2'){
					$this->data['error'] = 'Proses otorisasi gagal! (code : 2)';
				}
				elseif($error=='invalid_user_profile1'){
					$this->data['error'] = 'Proses sinkronisasi user gagal! (code : 1)';
				}
				elseif($error=='invalid_user_profile2'){
					$this->data['error'] = 'Proses sinkronisasi user gagal! (code : 2)';
				}
				elseif($error=='inactive_user'){
					$this->data['error'] = 'User belum diaktifkan oleh Administrator!';
				}
				
				$rows = DB::select("
					SELECT	*
					FROM t_app_oauth2
					WHERE aktif='1'
				");
				
				$ip_server=$_SERVER['SERVER_ADDR'];
			
				//cek apakah localhost atau bukan
				if($ip_server=='::1' || $ip_server=='127.0.0.1' || $ip_server=='localhost'){ //local or dev
					$redirect_uri = $rows[0]->redirect_uri_dev;
				}
				else{
					$redirect_uri = $rows[0]->redirect_uri;
				}
				
				$now = new \DateTime();
				$state = $now->format('YmdHis');
				session(array('state' => $state));
				$url_portal = $rows[0]->auth_server;
				$client_id = $rows[0]->client_id;
				$url = $url_portal.'?response_type=code&client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&state='.$state;
				$login = '<a href="'.$url.'" class="btn btn-primary btn-masuk d-none d-sm-block">Masuk</a>';
				$login2 = '<a href="'.$url.'" class="btn btn-primary btn-rounded btn-masuk2 d-sm-none">Masuk</a>';
			}
			
			$this->data['login'] = $login;
			$this->data['login2'] = $login2;
			
			View::share('data', $this->data);
		}
		catch(\Exception $e){
			return $e;
		}
	}
}
