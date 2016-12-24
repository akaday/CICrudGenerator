<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
  	Auth library
**/
class Auth{
	var $CI = NULL;
	function __construct()
	{
		// get CI's object
		$this->CI =& get_instance();
	}
	function cek_session_login()
	{
		if($this->CI->session->userdata('namauser') == '' AND $this->CI->session->userdata('passuser') == '' AND $this->CI->session->userdata('leveluser') == '')
		{
			return false;
		}
		return true;
	}
	function cek_login()
	{
		if($this->cek_session_login() == false)
		{
            redirect('');
		}
	}
	function cek_session_admin()
	{
		//Sesuikan dengan database anda
		if($this->CI->session->userdata('namauser') != ''
			AND $this->CI->session->userdata('passuser') != ''
			AND $this->CI->session->userdata('leveluser') == '1' )
		{
			return true;
		}
		return false;
	}
	function is_admin()
	{
		//echo $this->cek_session_admin().",".$this->CI->session->userdata('level').",".$this->CI->session->userdata('password');
		if($this->cek_session_admin() == false)
		{
            redirect('');
		}
	}
	function is_member($module = 0, $hal_event = 0)
	{
			$id_jabatan = $this->CI->session->userdata('leveluser');
			$id_eo 			= $this->CI->session->userdata('id_event_eo');

			if($module == 'point_withdraw' OR $module == 'point_deposit' OR $module == 'point_statement')
			{
				$module = 'finance';
			}
			// echo "$module <br />";
			if($module == 'Event_acara_showtime' OR $module == 'Event_acara_tiket')
			{
				$module = 'event_acara';
			}
			// echo "$module <br />";

			$this->CI->db->from('event_staff_eo');
			$this->CI->db->where('id_eo', $id_eo);
			$this->CI->db->where("list_module_eo like '%|$module|%'");
			$result = $this->CI->db->get();
			//  echo $this->CI->db->last_query();
			$this->CI->db->from('event_eo');
			$this->CI->db->where('id_db', $this->CI->session->userdata('id_event_eo'));
			$result1 = $this->CI->db->get();
			//echo $this->CI->db->last_query();
			if($id_jabatan != "111")	//Member Utama
			{
				if($this->CI->session->userdata('namauser') == ''
				AND $this->CI->session->userdata('passuser') == ''
				AND $this->CI->session->userdata('leveluser') == '')
				{
		            redirect('');
				}
				elseif($result->num_rows() == 0)
				{
					 redirect('');
				}
				elseif ($result1->row()->level == "regis" AND $hal_event == 0)
				{
					$this->CI->session->set_flashdata('message', 'Mohon Lengkapi Profil Anda');
					redirect('member/event_eo/update/'.$this->session->userdata('id_event_eo'));
				}
			}
			elseif ($result1->row()->level == "regis" AND $hal_event == 0)
			{
				$this->CI->session->set_flashdata('message', 'Mohon Lengkapi Profil Anda');
				redirect('member/event_eo/update/'.$this->CI->session->userdata('id_event_eo'));
			}
			// elseif($id_jabatan != "112")	//Member / Staff Buatan
			// {
			// 		$this->CI->db->from('event_staff_eo');
			// 		$this->CI->db->where('id_db', $id_eo);
			// 		$this->CI->db->where("list_module_eo like '%|$module|%'");
			// 		$result2 = $this->CI->db->get();
			//
			// 		if($this->CI->session->userdata('namauser') 	== ''
			// 		AND $this->CI->session->userdata('passuser') 	== ''
			// 		AND $this->CI->session->userdata('leveluser') == '')
			// 		{
			//       	redirect('');
			// 		}
			// 		elseif($result2->num_rows() == 0)
			// 		{
			// 				redirect('');
			// 		}
			// }
	}
	function is_jabatan($module = 0)
	{
		$id_jabatan = $this->CI->session->userdata('leveluser');
		$this->CI->db->from('users_jabatan');
		$this->CI->db->where('id_jabatan', $id_jabatan);
		$this->CI->db->where("list_modul like '%$module%'");
		$result = $this->CI->db->get();
		// echo $this->CI->db->last_query();
		if($id_jabatan != "1")
		{
			if($this->CI->session->userdata('namauser') == ''
			AND $this->CI->session->userdata('passuser') == ''
			AND $this->CI->session->userdata('leveluser') == '')
			{
	            redirect('');
			}
			elseif($result->num_rows() == 0)
			{
				redirect('');
			}
		}
	}
	function admin_login()
	{
		if($this->cek_session_admin() == true)
		{
            //redirect($this->CI->config->item('admin_folder').'artikel');
            //redirect('member/event_eo/update/'.$this->session->userdata('id_event_eo'));
		}
	}
	function cek_session_member()
	{
		//Sesuikan dengan database anda
		if($this->CI->session->userdata('namauser') != ''
			AND $this->CI->session->userdata('passuser') != ''
			AND $this->CI->session->userdata('leveluser') == '3' )
		{
			return true;
		}
		return false;
	}
	function is_member_lama()
	{
		//echo $this->cek_session_member().",".$this->CI->session->userdata('level').",".$this->CI->session->userdata('password');
		if($this->cek_session_member() == false)
		{
            redirect('');
		}
	}
	function member_login()
	{
		if($this->cek_session_member() == true)
		{
            redirect($this->CI->config->item('member_folder').'users');
		}
	}
	function hapus_session()
	{
		$this->CI->session->sess_destroy();
	}
}
