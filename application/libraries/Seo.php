<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
  	Seo library
**/
class Seo{
	var $CI = NULL;
	function __construct()
	{
		// get CI's object
		$this->CI =& get_instance();

	}

	function perusahaan(){
		$row = $this->CI->perusahaan_model->get_by_id(1);
        if ($row) {
            $perusahaan = array(
			'id_perusahaan' => $row->id_perusahaan,
			'nama_perusahaan' => $row->nama_perusahaan,
			'motto' => $row->motto,
			'home_text' => $row->home_text,
			'home_text_en' => $row->home_text_en,
			'alamat' => $row->alamat,
			'alamat2' => $row->alamat2,
			'alamat3' => $row->alamat3,
			'koordinat' => $row->koordinat,
			'telp' => $row->telp,
			'phone' => $row->phone,
			'fax' => $row->fax,
			'email' => $row->email,
			'logo' => $row->logo,
		    );
		    return $perusahaan;
		}
		else{
			return NULL;
		}
	}
	function identitas(){
		$row = $this->CI->identitas_model->get_by_id(1);
        if ($row) {
        	$identitas = array(
			'id_identitas' => $row->id_identitas,
			'nama_website' => $row->nama_website,
			'meta_deskripsi' => $row->meta_deskripsi,
			'meta_keyword' => $row->meta_keyword,
			'favicon' => $row->favicon,
			'email' => $row->email,
	    	);
	    	return $identitas;
		}
		else{
			return NULL;
		}
	}

}
