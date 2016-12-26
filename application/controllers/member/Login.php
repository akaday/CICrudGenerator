<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public $member_folder;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->member_folder = $this->config->item('member_folder');
	}

	public function index()
	{	

		$url = $_SERVER['HTTP_HOST'];
		if (strpos($url, 'www') !== false) {
		    redirect('member/login');
		}
		//authentication
		$this->auth->member_login();

		$data['form_action'] = "login/login_action.html";
		$element = $this->member_folder."login";

		//View
		template_lib($element, $data, $element, $this->member_folder);
		
	}

	public function login_action()
	{	
		$this->auth->member_login();

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
      	$this->form_validation->set_rules('password', 'Password', 'trim|required');

      	if ($this->form_validation->run() == FALSE)
	      	{	
	      		$data['form_action'] = "login_action";
	      		$element = $this->member_folder."login";
	        	
	        	template_lib($element, $data, $element, $this->member_folder);
	      	}
	      	else
	      	{
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				//Cek Ada User atau Tidak, 
				//sesuaikan dengan database user anda
				$this->db->from('member');
				$this->db->where('username', $username);
				$this->db->where('password', md5($password));
		        $this->db->where('status !=','blokir');

				$result = $this->db->get();
				if($result->num_rows() == 0) 
				{
					$data['form_action'] = "login_action.html";
					$data['login_info']  = "Username atau Password Salah";
		      		$element = $this->member_folder."login";
		        	
		        	template_lib($element, $data, $element, $this->member_folder);
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
					  // $_SESSION['KCFINDER']=array();
					  // $_SESSION['KCFINDER']['disabled'] = false;
					  // $_SESSION['KCFINDER']['uploadURL'] = "http://labdajaya.com/tinymcpuk/gambar";
					  // $_SESSION['KCFINDER']['uploadDir'] = "";
					// buat session
					$this->session->set_userdata($session_data);

					// echo $_SESSION['KCFINDER']['disabled']."<br>";
					// echo $_SESSION['KCFINDER']['uploadURL']."<br>";
					// echo $_SESSION['KCFINDER']['uploadDir']."<br>";
					
                    //print_r($_SESSION[KCFINDER]);
					session_regenerate_id();

					$sid_baru = session_id();
                    $data = array(
				      'id_session' => $sid_baru,
				     // 'kcfinder'	=> "false",
			        );

		            $this->member_model->update($userdata->username, $data);



					redirect($this->member_folder.'users');
				}

			}

	}

	public function do_logout()
	{
		$this->auth->hapus_session();

      //   $data = array(
	     // // 'kcfinder'	=> "true",
      //   );

       // $this->member_model->update($this->session->userdata('namauser'), $data);

		redirect('');
	}


}
