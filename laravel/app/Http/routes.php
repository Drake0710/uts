<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Portal routes */
/* authenticate routes */
Route::get('/', 'GuestController@index');

/* Searching routes */
Route::group(['prefix' => 'search'], function(){

	Route::get('', 'SearchController@index');
	Route::get('keyword', 'SearchController@keyword');
	Route::get('peraturan/{id}', 'SearchController@getAturan');
	Route::get('download/peraturan/{id}', 'SearchController@file_peraturan');
	Route::get('download1/peraturan/{id}', 'SearchController@file_peraturan1');

});

//Route::get('/dashboard', 'AppController@dashboard');
Route::get('/logout', 'AuthenticateController@logout');
Route::get('oauth2callback', 'AuthenticateController@callback');

Route::group(['prefix' => 'registrasi'], function(){
	
	Route::get('', 'AuthenticateController@registrasi');
	Route::post('', 'AuthenticateController@registrasi_simpan');
	Route::get('dropdown-level', 'DropdownController@getLevel');
	Route::get('dropdown-unit-dtl', 'DropdownController@getUnitRegis');
	
});

/*
|--------------------------------------------------------------------------
| DROPDOWN
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'dropdown'], function(){	
	Route::get('jenis-peraturan', 'DropdownController@getJenisPeraturan');
	Route::get('jenis-search', 'DropdownController@getJenisSearch');
	Route::get('tahun', 'DropdownController@getTahun');
});

/*
|--------------------------------------------------------------------------
| KATALOG
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'katalog'], function(){
	Route::get('/', 'KatalogController@index');
	Route::get('/pilih/{id}', 'KatalogController@getKatalog');
});


/* App routes */
Route::group(['prefix'=>'app','middleware'=>'auth'], function(){
	
	/* Get App for angular */
	Route::get('/', 'AppController@index');
	Route::get('token', 'AuthenticateController@token');

	/*Route::group(['prefix' => 'mon'], function(){
		
		Route::get('peraturan', 'PeraturanController@index');
		
	});*/
	Route::get('hapus/sesi/upload', 'AuthenticateController@hapus_sesi_upload');
	
	Route::get('cek/level', 'CekController@cekLevel');
	
	/*
	|--------------------------------------------------------------------------
	| Peraturan
	|--------------------------------------------------------------------------
	*/
	
	Route::group(['prefix'=>'peraturan'], function(){

		/*Route::get('inisiasi', 'InisiasiPeraturanController@get_inisiasi');
		Route::get('inisiasi-status/{id}', 'InisiasiPeraturanController@getInisiasiByStatus');
		Route::post('inisiasi', 'InisiasiPeraturanController@store');
		Route::get('inisiasi/view/{id}', 'InisiasiPeraturanController@view');
		Route::get('inisiasi/edit/{id}', 'InisiasiPeraturanController@edit');
		Route::put('inisiasi', 'InisiasiPeraturanController@update');
		Route::delete('inisiasi', 'InisiasiPeraturanController@delete');
		Route::post('inisiasi/file-upload', 'InisiasiPeraturanController@uploadFile');*/
		
		Route::get('final', 'PeraturanFinalController@index');
		Route::post('final', 'PeraturanFinalController@store');
		Route::post('final/file-upload', 'PeraturanFinalController@uploadFile');
		
		Route::get('approve', 'PeraturanApproveController@index');
		Route::put('approve', 'PeraturanApproveController@store');

	});
	
	

	/*
	|--------------------------------------------------------------------------
	| MONITORING
	|--------------------------------------------------------------------------
	*/
	Route::group(['prefix'=>'mon'], function(){

		//User Monitoring
		Route::get('peraturan', 'MonPeraturanController@index');
		Route::get('peraturan-modal', 'MonPeraturanController@getModalPeraturan');
		Route::get('relasi-modal', 'MonPeraturanController@getModalRelasi');
		Route::get('peraturan-search/{id}', 'MonPeraturanController@searchPeraturanById');
		Route::get('label/{id}', 'MonPeraturanController@getLabelByPeraturan');
		Route::post('peraturan', 'MonPeraturanController@simpan');
		Route::post('/upload', 'MonPeraturanController@peraturan_upload');

		Route::get('peraturan/{id}', 'MonPeraturanController@getPeraturanById');
		Route::get('peraturan-relasi/{id}', 'MonPeraturanController@getRelasiByPeraturan');
		Route::put('peraturan', 'MonPeraturanController@ubah');
		Route::get('jenis-peraturan', 'DropdownController@getJenisPeraturan');
		Route::get('sifat-peraturan', 'DropdownController@getSifatPeraturan');

		Route::get('peraturan/download/{id}', 'MonPeraturanController@file_peraturan');

	});
	
	/*
	|--------------------------------------------------------------------------
	| DROPDOWN
	|--------------------------------------------------------------------------
	*/

	Route::group(['prefix'=>'dropdown'], function(){
		Route::get('alur-peraturan', 'DropdownController@getAlurPeraturan');
		Route::get('jenis-peraturan', 'DropdownController@getJenisPeraturan');
		Route::get('jenis-search', 'DropdownController@getJenisSearch');
		Route::get('sifat-peraturan', 'DropdownController@getSifatPeraturan');
		Route::get('status-alur', 'DropdownController@getStatusAlur');
		Route::get('status-peraturan', 'DropdownController@getStatusPeraturan');
		Route::get('label', 'DropdownController@getLabel');
		Route::get('tahun', 'DropdownController@getTahun');
	});
	
	/*
	|--------------------------------------------------------------------------
	| MANAJEMEN USER
	|--------------------------------------------------------------------------
	*/
	
	Route::group(['prefix'=>'user'], function(){

		Route::put('aktif', 'UserManajemenController@aktif');
		Route::delete('hapus', 'UserManajemenController@hapus');
		Route::put('non-aktif', 'UserManajemenController@nonaktif');

		//User Monitoring
		Route::get('manajemen', 'UserManajemenController@index');
		/*Route::get('manajemen/{id}', 'UserManajemenController@getUserById');
		Route::post('manajemen', 'UserManajemenController@store');
		Route::post('manajemen/upload-foto', 'UserManajemenController@uploadFoto');
		Route::get('status', 'UserManajemenController@getStatus');
		Route::get('status/{id}', 'UserManajemenController@getUserByStatus');
		Route::get('level', 'UserManajemenController@getLevel');*/

	});
	
	/*
	|--------------------------------------------------------------------------
	| REFERENSI
	|--------------------------------------------------------------------------
	*/
	
	Route::group(['prefix'=>'ref'], function(){

		//Label
		Route::get('label', 'RefLabelController@index');
		Route::post('label', 'RefLabelController@store');
		Route::get('label/{id}', 'RefLabelController@getLabelById');
		Route::put('label', 'RefLabelController@update');
		Route::delete('label', 'RefLabelController@destroy');
		
		//Jenis Peraturan
		Route::get('jenis-peraturan', 'RefJenisPeraturanController@index');
		Route::post('jenis-peraturan', 'RefJenisPeraturanController@store');
		Route::get('jenis-peraturan/{id}', 'RefJenisPeraturanController@getJenisPeraturanById');
		Route::put('jenis-peraturan', 'RefJenisPeraturanController@update');
		Route::delete('jenis-peraturan', 'RefJenisPeraturanController@destroy');
		
		//Status Peraturan
		Route::get('status-peraturan', 'RefStatusPeraturanController@index');
		Route::post('status-peraturan', 'RefStatusPeraturanController@store');
		Route::get('status-peraturan/{id}', 'RefStatusPeraturanController@getStatusPeraturanById');
		Route::put('status-peraturan', 'RefStatusPeraturanController@update');
		Route::delete('status-peraturan', 'RefStatusPeraturanController@destroy');
		
		//Sifat Peraturan
		Route::get('sifat-peraturan', 'RefSifatPeraturanController@index');
		Route::post('sifat-peraturan', 'RefSifatPeraturanController@store');
		Route::get('sifat-peraturan/{id}', 'RefSifatPeraturanController@getSifatPeraturanById');
		Route::put('sifat-peraturan', 'RefSifatPeraturanController@update');
		Route::delete('sifat-peraturan', 'RefSifatPeraturanController@destroy');
		
		//Label
		/*Route::get('alur-dokumen', 'RefAlurDokumenController@index');
		Route::post('alur-dokumen', 'RefAlurDokumenController@store');
		Route::get('alur-dokumen/{id}', 'RefAlurDokumenController@edit');
		Route::put('alur-dokumen', 'RefAlurDokumenController@update');
		Route::delete('alur-dokumen', 'RefAlurDokumenController@destroy');*/
		
		//Status Alur
		/*Route::get('status-alur', 'RefStatusAlurController@index');*/
		
		//Level User
		Route::get('level-user', 'RefLevelUserController@index');

	});
	
});
