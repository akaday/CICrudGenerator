<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public $admin_folder;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->admin_folder = $this->config->item('admin_folder');
	}
	
	public function index()
	{	
		//authentication
		$this->auth->admin_login();

		$data['form_action'] = "login/login_action.html";
		$element = $this->admin_folder."login";

		//View
		template_lib($element, $data, $element, $this->admin_folder);
		
	}

	public function login_action()
	{	
		$this->auth->admin_login();

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
      	$this->form_validation->set_rules('password', 'Password', 'trim|required');

      	if ($this->form_validation->run() == FALSE)
	      	{	
	      		$data['form_action'] = "login_action";
	      		$element = $this->admin_folder."login";
	        	
	        	template_lib($element, $data, $element, $this->admin_folder);
	      	}
	      	else
	      	{
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				//Cek Ada User atau Tidak, 
				//sesuaikan dengan database user anda
				$this->db->from('users');
				$this->db->where('username', $username);
				$this->db->where('password', md5($password));
		        $this->db->where('blokir =','N');

				$result = $this->db->get();
				// echo $this->db->last_query();
				// echo $result->num_rows();
				if($result->num_rows() == 0) 
				{
					$data['form_action'] = "login_action.html";
					$data['login_info']  = "Username atau Password Salah";
		      		$element 			 = $this->admin_folder."login";
		        	
		        	template_lib($element, $data, $element, $this->admin_folder);
		        }
				else	
				{	
					// ada, maka ambil informasi dari database
					$userdata = $result->row();
					$session_data = array(
						'namauser'    => $userdata->username,
						'namalengkap' => $userdata->nama_lengkap,
						'passuser'    => $userdata->password,
						'leveluser'   => $userdata->level
					);
					// buat session
					$this->session->set_userdata($session_data);

					session_regenerate_id();

					$sid_baru = session_id();
                    $data = array(
				      'id_session' => $sid_baru,
				      'kcfinder'	=> "false",
			        );

		            $this->users_model->update($userdata->username, $data);

					// redirect($this->admin_folder.'dashboard1');
					$go_to = $this->db->query("SELECT * FROM users_jabatan WHERE id_jabatan = '$userdata->level' ")->row()->ke;
					
			        redirect($this->admin_folder."$go_to");
				}

			}

	}

	public function do_logout()
	{
		$this->auth->hapus_session();

        $data = array(
	      'kcfinder'	=> "true",
        );

        $this->users_model->update($this->session->userdata('namauser'), $data);

		redirect('');
	}


}