<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**

  	Bahasa library

**/

class Bahasa{

	var $CI = NULL;

	function __construct()

	{

		// get CI's object

		$this->CI =& get_instance();

		$this->CI->load->database();

		

	}



	function cek_bahasa()

	{

		$bahasa = $this->CI->session->userdata('bahasa');



		if($bahasa == "" OR $bahasa == "English")

		{	

			$session_data = array('bahasa'    => 'English');

			$this->CI->session->set_userdata($session_data);

			$bahasa = $this->CI->session->userdata('bahasa');

		}

		elseif($bahasa == "Indonesia")

		{

			$session_data = array('bahasa'    => 'Indonesia');

			$this->CI->session->set_userdata($session_data);

			$bahasa = $this->CI->session->userdata('bahasa');

		}



		return $bahasa;

	}



	function cek_kategori($data, $url, $method)

	{	

		if($data == "" OR $data == "English")

		{	

			$url_sekarang = $this->CI->db->query("SELECT * FROM kategori WHERE class like '$url' ")->row_array();

            $link['id'] = $url_sekarang['link'];

            $link['en'] = $url_sekarang['link_en'];

		}

		elseif($data == "Indonesia")

		{

			$url_sekarang = $this->CI->db->query("SELECT * FROM kategori WHERE class like '$url' ")->row_array();

            $link['id'] = $url_sekarang['link'];

            $link['en'] = $url_sekarang['link_en'];

		}



		return $link;

		

	}

	

}