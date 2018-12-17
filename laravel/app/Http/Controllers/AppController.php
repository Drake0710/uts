<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class AppController extends Controller
{
    public function index()
	{
		// Create menu....
		$menus = DB::select("
			SELECT *
			FROM d_menu
			WHERE aktif='1'
			  AND parent_id=0
			  AND kdlevel LIKE '%+".session('kdlevel')."+%'
			ORDER BY nourut
		");
		
		//$html_out='<li class="nav-small-cap">MAIN NAVIGATION</li>';
		$html_out='';

		$angular = 'var app = angular.module("spa", ["ui.router","chieffancypants.loadingBar"]);
					app.config(function($stateProvider, $urlRouterProvider){
						$urlRouterProvider.otherwise("/");
						$stateProvider
						.state("app", {
							url: "/app",
							templateUrl: "partials/home.html",
							controller: function($scope){
								$scope.items = ["A", "List", "Of", "Items"];
							}
						})
						.state("/", {
							url: "/",
							templateUrl: "partials/dashboard.html"
						})';

		/*.state("profile", {
			url: "/profile",
			templateUrl: "partials/profile.html"
		})*/

		foreach($menus as $menu) {
			
			//jika is_parent == 0, tidak perlu buat sub menu
			if($menu->url!='#'){
				
				$html_out .= '<li>
								<a ui-sref="'.$menu->url.'">
									<i class="'.$menu->icon.'"></i><span class="hide-menu">'.$menu->title.'</span>
								</a>
							</li>';
				$angular .= '.state("'.$menu->url.'", {
								url: "/'.$menu->url.'",
								templateUrl: "partials/'.$menu->nmfile.'"
							})';
			}
			//jika is_parent != 0, perlu buat sub menu dengan parameter parent_id ybs
			else{
				$html_out .= '<li>
								<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
									<i class="'.$menu->icon.'"></i><span class="hide-menu">'.$menu->title.'</span>
								</a>
								<ul aria-expanded="false" class="collapse">';
				
				$sub_menus = DB::select("
					SELECT *
					FROM d_menu
					WHERE aktif='1'
					  AND kdlevel LIKE '%".session('kdlevel')."%'
					  AND parent_id='".$menu->id."'
					ORDER BY nourut
				");
				
				//bentuk sub menu
				foreach($sub_menus as $sub_menu){
					
					if($sub_menu->new_tab == null){
						$html_out .= '<li>
										<a ui-sref="'.$sub_menu->url.'">'.$sub_menu->title.'</a>
									</li>';
						$angular .= '.state("'.$sub_menu->url.'", {
										url: "/'.$sub_menu->url.'",
										templateUrl: "partials/'.$sub_menu->nmfile.'"
									})';
					}
					else{
						$html_out .= '<li>
										<a href="'.$sub_menu->url.'" target="_blank">'.$sub_menu->title.'</a>
									</li>';
					}
				}
				
				$html_out .= '	</ul>
							</li>';
			}
		}

		$angular .= '});';
		
		return view('app',
			[
				'menu' => $html_out,
				'angular' => $angular,
				'info_unitdtl' => session('id_unitdtl'),
				'info_nmunit' => session('nm_unitdtl'),
				'info_nmlevel' => session('nmlevel'),
				'info_foto' => session('foto'),
				'info_nama' => session('nama'),
				'info_nip' => session('nip'),
				'info_email' => session('email'),
				'info_tahun' => session('tahun')
			]
		);
	}
	
	/*public function dashboard()
	{
		return view('app');
	}*/
}
