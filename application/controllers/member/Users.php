<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{   
    public $member_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->library('form_validation');
        $this->member_folder = $this->config->item('member_folder');
    }

    public function index()
    {   
        $this->auth->is_member();
        redirect(site_url('member/users/update/'.$this->session->userdata('namauser')));

        $users = $this->member_model->get_all();
        
        //DATA
        $data['users_data']         = $users;
        $data['folder_member']            = $this->member_folder;
        $data['content_header']          = 'Users List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Users</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->member_folder."users_list";
        //View
        template_lib($element, $data, '', $this->member_folder);
    }

    public function read($id) 
    {   
        $this->auth->is_member();
        $row = $this->member_model->get_by_username($id);
        if ($row) {
            $data = array(
		'username' => $row->username,
		'password' => $row->password,
		'nama_lengkap' => $row->nama_lengkap,
		'email' => $row->email,
		'no_telp' => $row->no_telp,
		'level' => $row->level,
		'blokir' => $row->blokir,
		'id_session' => $row->id_session,
	    );
            //DATA
            $data['folder_member']            = $this->member_folder;
            $data['content_header']          = 'Users';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Users</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->member_folder."users_read";
            //View
            template_lib($element, $data, '', $this->member_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('member/users'));
        }
    }
    
    public function create() 
    {   
        $this->auth->is_member();
        $data = array(
            'button' => 'Create',
            'action' => site_url('member/users/create_action'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'nama_lengkap' => set_value('nama_lengkap'),
	    'email' => set_value('email'),
	    'no_telp' => set_value('no_telp'),
	    'level' => set_value('level'),
	    'blokir' => set_value('blokir'),
	    'id_session' => set_value('id_session'),
	);
        //DATA
        $data['folder_member']            = $this->member_folder;
        $data['content_header']          = 'Users Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Users</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->member_folder."users_form";
        //View
        template_lib($element, $data, '', $this->member_folder);
    }
    
    public function create_action() 
    {
        $this->auth->is_member();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'password' => $this->input->post('password',TRUE),
		);

            $this->member_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('member/users'));
        }
    }
    
    public function update($id) 
    {
        $this->auth->is_member();
        $row = $this->member_model->get_by_username($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('member/users/update_action'),
		'username' => set_value('username', $row->username),
		// 'password' => set_value('password', $row->password),
		// 'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
		// 'email' => set_value('email', $row->email),
		// 'no_telp' => set_value('no_telp', $row->no_telp),
		// 'level' => set_value('level', $row->level),
		// 'blokir' => set_value('blokir', $row->blokir),
        'password' => "",
        'password_baru' => "",
        'ulangi_password' => "",
		// 'id_session' => set_value('id_session', $row->id_session),
	    );
            //DATA
            $data['folder_member']            = $this->member_folder;
            $data['content_header']          = 'member';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Users</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->member_folder."users_form";
            //View
            template_lib($element, $data, '', $this->member_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('member/users'));
        }
    }
    
    public function update_action() 
    {
        $this->auth->is_member();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('username', TRUE));
        } else {
            $data = array(
		      'password' => md5($this->input->post('password_baru',TRUE)),
	        );

            $this->member_model->update($this->session->userdata('namauser'), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('member/users/update/'.$this->session->userdata('namauser')));

        }
    }
    
    public function delete($id) 
    {
        $this->auth->is_member();
        $row = $this->member_model->get_by_username($id);

        if ($row) {
            $this->member_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('member/users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('member/users'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('password', ' ', 'trim|required|callback_oldpassword_check');
    $this->form_validation->set_rules('password_baru', ' ', 'trim|required|matches[ulangi_password]');
    $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'trim|required');
	//$this->form_validation->set_rules('nama_lengkap', ' ', 'trim|required');
	// $this->form_validation->set_rules('email', ' ', 'trim|required');
	// $this->form_validation->set_rules('no_telp', ' ', 'trim|required');
	// $this->form_validation->set_rules('level', ' ', 'trim|required');
	// $this->form_validation->set_rules('blokir', ' ', 'trim|required');
	// $this->form_validation->set_rules('id_session', ' ', 'trim|required');

	$this->form_validation->set_rules('username', 'username', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function oldpassword_check($old_password){
   $old_password_hash = md5($old_password);
   $old_password_db_hash = $this->member_model->get_by_username($this->session->userdata('namauser'))->password;

   if($old_password_hash != $old_password_db_hash)
   {
      $this->form_validation->set_message('oldpassword_check', 'Password Lama Tidak Sama');
      return FALSE;
   } 
   return TRUE;
}

};

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */