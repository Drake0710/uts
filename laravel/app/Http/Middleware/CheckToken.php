<?php namespace App\Http\Middleware;

use Closure;

class CheckToken {

    public function handle($request, Closure $next)
    {
        $JWT = new \App\Libraries\jwtphp\JWT;
		$key = '46196053844814367107123';
		$headers = apache_request_headers();
		
		if(isset($headers['Authorization'])){
			$token = str_replace(" ","", str_replace("Bearer ", "", $headers['Authorization']));
			$json = $JWT->decode($token, $key);
			return $next($request);
		}
		else{
			if(isset($_GET['token'])){
				$token = $_GET['token'];
				$json = json_decode($JWT->decode($token, $key));
				$id_user = $json->iss;
				$kdlevel = $json->kdlevel;
				return $next($request);
			}
			else{
				return response(json_encode(array('error' => true,'message' => 'Token tidak ada!')), 401);
			}
		}
    }
	
}