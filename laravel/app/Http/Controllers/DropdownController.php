<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;

class DropdownController extends Controller {

	public function getLevel()
	{
		$rows = DB::select("
			SELECT *
			FROM r_level
			WHERE kdlevel not IN('00','99','77')
			AND aktif='1'
			ORDER BY kdlevel
		");
		
		$data='<option value="" style="display:none;">Pilih Level</option>';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['kdlevel'].'">'.$row['nmlevel'].'</option>';
		}
		echo $data;
	}
	
	public function getUnitRegis()
	{
		$rows = DB::select("
			SELECT *
			FROM t_unit_dtl
			WHERE LENGTH (id_unit) = '13' AND tipe = 'P' AND aktif = '1'
			ORDER BY id_unit
		");
		
		$data='<option value="" style="display:none;">Pilih Unit Instansi</option>';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['id_unit'].'">'.$row['nm_unitdtl'].'</option>';
		}
		echo $data;
	}

	public function getUnit()
	{
		$rows = DB::select("
			SELECT *
			FROM t_unit_dtl
			ORDER BY tipe DESC,id_unit
		");
		
		$data='<option value="" style="display:none;">Pilih Unit Instansi</option>';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['id_unit'].'">'.$row['nm_unitdtl'].'</option>';
		}
		echo $data;
	}
	
	public function getAlurPeraturan()
	{
		$rows = DB::select("
			SELECT *
			FROM r_alur_peraturan
			WHERE aktif='1'
			ORDER BY id
		");
		
		$data='<option value="" style="display:none;">Pilih Alur Peraturan</option>';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['id'].'">'.$row['nama_tipe_peraturan'].'</option>';
		}
		echo $data;
	}
	
	public function getJenisPeraturan()
	{
		$rows = DB::select("
			SELECT *
			FROM r_jenis_peraturan
			WHERE aktif='1'
			ORDER BY id
		");
		
		$data='<option value="" style="display:none;">Pilih Jenis</option>';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['ID'].'">'.$row['JENIS_PERATURAN'].'</option>';
		}
		echo $data;
	}

	public function getJenisSearch()
	{
		$rows = DB::select("
			SELECT *
			FROM r_jenis_peraturan
			WHERE aktif='1'
			ORDER BY id
		");
		
		$data='
			<option value="" style="display:none;">Jenis</option>
			<option value="" style="font-weight:bold;">Semua</option>
		';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['id'].'">'.$row['jenis_peraturan'].'</option>';
		}
		echo $data;
	}
	
	public function getLabel()
	{
		$rows = DB::select("
			SELECT *
			FROM r_label
			WHERE aktif='1'
			ORDER BY id
		");
		
		/*$data='<option value="" style="display:none;">Pilih Label</option>';*/
		$data='';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['id'].'">'.$row['label'].'</option>';
		}
		echo $data;
	}
	
	public function getSifatPeraturan()
	{
		$rows = DB::select("
			SELECT *
			FROM r_sifat_peraturan
			WHERE aktif='1'
			ORDER BY id
		");
		
		$data='<option value="" style="display:none;">Pilih Sifat Peraturan</option>';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['id'].'">'.$row['sifat_peraturan'].'</option>';
		}
		echo $data;
	}
	
	public function getStatusAlur()
	{
		$rows = DB::select("
			SELECT *
			FROM r_status_alur
			WHERE aktif='1'
			ORDER BY id
		");
		
		$data='<option value="" style="display:none;">Pilih Status Alur</option>';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['id'].'">'.$row['nm_status'].'</option>';
		}
		echo $data;
	}
	
	public function getStatusPeraturan()
	{
		$rows = DB::select("
			SELECT *
			FROM r_status_peraturan
			WHERE aktif='1' AND id <> 1
			ORDER BY id
		");
		
		$data='<option value="" style="display:none;">Pilih Status</option>';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['id'].'">'.$row['status'].'</option>';
		}
		echo $data;
	}
	
	public function getTahun()
	{
		$rows = DB::select("
			SELECT *
			FROM r_tahun
			WHERE aktif='1'
			ORDER BY tahun DESC
		");
		
		$data='
			<option value="" style="display:none;">Tahun</option>
			<option value="" style="font-weight:bold;">Semua</option>
		';
		foreach($rows as $row){
			$row=(array)$row;
			$data.='<option value="'.$row['TAHUN'].'">'.$row['TAHUN'].'</option>';
		}
		echo $data;
	}

}
