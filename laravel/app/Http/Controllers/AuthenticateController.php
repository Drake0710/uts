<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class AuthenticateController extends Controller
{
    public function callback()
	{
		try{
			if(!session('authenticated')){//cek sesi lokal
				
				if(isset($_GET['code']) && isset($_GET['state'])){//jika proses code authorization berhasil
				
					$rows = DB::select("
						select	*
						from t_app_oauth2
						where aktif=1
					");
					
					$ip_server=$_SERVER['SERVER_ADDR'];
				
					//cek apakah localhost atau bukan
					if($ip_server=='::1' || $ip_server=='127.0.0.1' || $ip_server=='localhost'){ //local or dev
						$redirect_uri = $rows[0]->redirect_uri_dev;
					}
					else{
						$redirect_uri = $rows[0]->redirect_uri;
					}
					
					$client_id = $rows[0]->client_id;
					$client_secret = $rows[0]->client_secret;
					$url_portal = $rows[0]->auth_server;
					
					$json = '{
						"code":"'.$_GET['code'].'",
						"grant_type":"code",
						"redirect_uri":"'.$redirect_uri.'",
						"client_id":"'.$client_id.'",
						"client_secret":"'.$client_secret.'"
					}';

					$handle = curl_init($url_portal.'/api/access-token');
					curl_setopt($handle, CURLOPT_POST, true);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($handle, CURLOPT_POSTFIELDS, $json);
					curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					$resp = curl_exec($handle);
					
					curl_close($handle);
					
					if(json_decode($resp)){
						
						$json = (array)json_decode($resp);
						$error = $json['error'];
						$code = $json['code'];
						$message = $json['message'];
						
						if($code=='00'){
							
							$id_user = $json['user_id'];
							$tahun = $json['tahun'];
							$access_token = $json['access_token'];
							
							$handle = curl_init($url_portal.'/api/user/'.$id_user);
							curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($handle, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$access_token, 'Content-Type: application/json'));
							$resp = curl_exec($handle);
							
							curl_close($handle);
							
							if(json_decode($resp)){
								
								$data = (array)json_decode($resp);
								
								if($data['error']==false){
									
									$user = (array)$data['data'];
									
									$rows = DB::select("
										SELECT 	a.id,
												a.nama,
												a.nip,
												a.kdlevel,
												b.nmlevel,
												a.foto,
												a.email,
												a.id_unitdtl,
												c.nm_unitdtl,
												a.aktif
										FROM t_user a
										LEFT OUTER JOIN r_level b on(a.kdlevel=b.kdlevel)
										LEFT OUTER JOIN t_unit_dtl c on(a.id_unitdtl=c.id_unit)
										WHERE a.id=?
									",[
										$user['id']
									]);
									
									if(count($rows)>0){
										
										if($rows[0]->aktif=='1'){
											
											session([
												'authenticated' => true,
												'user_id' => $rows[0]->id,
												'nama' => $rows[0]->nama,
												'nip' => $rows[0]->nip,
												'kdlevel' => $rows[0]->kdlevel,
												'nmlevel' => $rows[0]->nmlevel,
												'foto' => $rows[0]->foto,
												'email' => $rows[0]->email,
												'id_unitdtl' => $rows[0]->id_unitdtl,
												'nm_unitdtl' => $rows[0]->nm_unitdtl,
												'tahun' => $tahun
											]);
											
											return redirect('/app');
											
										}
										else{
											return redirect('?error=inactive_user');
										}
										
									}
									else{
										return redirect('registrasi?id='.$user['id'].'&nama='.$user['nama'].'&nip='.$user['nip'].'&email='.$user['email']);
									}
									
								}
								else{
									return redirect('?error=invalid_user_profile2');
								}
								
							}
							else{
								return redirect('?error=invalid_user_profile1');
							}
							
						}
						else{
							return redirect('?error=invalid_auth_code2');
						}
						
					}
					else{
						return redirect('?error=invalid_auth_code1');
					}
					
				}
				elseif(isset($_GET['error'])){ //error
					return redirect('?error='.$_GET['error']);
				}
				else{
					return redirect('/');
				}
				
			}
			else{
				return redirect('/');
			}
		}
		catch(\Exception $e){
			return $e;
		}
	}

	public function registrasi()
	{
		try{
			if(isset($_GET['id']) && isset($_GET['nama']) && isset($_GET['nip']) && isset($_GET['email'])){
				
				return view('registrasi', [
					'id' => $_GET['id'],
					'nama' => $_GET['nama'],
					'nip' => $_GET['nip'],
					'email' => $_GET['email']
				]);
				
			}
			else{
				return 'Parameter tidak valid!';
			}
		}
		catch(\Exception $e){
			return $e;
		}
	}

	public function registrasi_simpan(Request $request)
	{
		try{
			$insert = DB::insert("
				INSERT INTO t_user(id,nama,nip,kdlevel,email,id_unitdtl,aktif,created_at,updated_at)
				VALUES(?,?,?,?,?,?,?,SYSDATE,SYSDATE)
			",[
				$request->input('id'),
				$request->input('nama'),
				$request->input('nip'),
				$request->input('kdlevel'),
				$request->input('email'),
				$request->input('id_unitdtl'),
				'0'
			]);
			
			if($insert){
				return 'success';
			}
			else{
				return 'Proses simpan gagal!';
			}
		} catch(\Exception $e){
			//return $e;
			return 'Koneksi terputus!';
		}
	}
	
	public function logout()
	{
		Session::flush();
		return redirect()->guest('/');
	}
	
	public function token()
	{
		return csrf_token();
	}

	public function hapus_sesi_upload(Request $request)
	{
		session(['nm_file_peraturan' => null]);
		setcookie('upload_attachment', '', time() + 3600, "/");
		
		return 'Sesi upload berhasil dihapus!';
	}
}
