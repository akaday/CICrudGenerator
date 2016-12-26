<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_jabatan($this->router->fetch_class());
        //redirect(site_url('owner/users/update/'.$this->session->userdata('namauser')));

        $users = $this->users_model->get_all();
        
        //DATA
        $data['users_data']         = $users;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'List Member';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>List Member</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."users_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        $row = $this->users_model->get_by_id($id);
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
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'List Member';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>List Member</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."users_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/users'));
        }
    }
    
    public function create() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/users/create_action'),
        'userdata' => set_value('userdata'),
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
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'List Member Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>List Member</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."users_form";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }
    
    public function create_action() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());

        $this->form_validation->set_rules('userdata', ' ', 'trim|required|callback_username_check');
        $this->form_validation->set_rules('password', ' ', 'trim|required');
        $this->_rules_normal();

        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'username' => $this->input->post('userdata',TRUE),
                'password' => md5($this->input->post('password',TRUE)),
                'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                'email' => $this->input->post('email',TRUE),
                'no_telp' => $this->input->post('no_telp',TRUE),
                'level' => $this->input->post('level',TRUE),
                'blokir' => $this->input->post('blokir',TRUE),
                //'id_session' => $this->input->post('id_session',TRUE),
            );

            $this->users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/users'));
        }
    }
    
    public function update($id) 
    {
        if($this->session->userdata('namauser') == '' 
            AND $this->session->userdata('passuser') == '' )
        {
            redirect('');
        }
        $row = $this->users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/users/update_action'),
        'username' => set_value('username', $row->username),
        'password' => "",
        'password_baru' => "",
        'ulangi_password' => "",
        'id_session' => set_value('id_session', $row->id_session),
        );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = '';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Users</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."users_form_password";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/users'));
        }
    }
    
    public function update_action() 
    {   
        if($this->session->userdata('namauser') == '' 
            AND $this->session->userdata('passuser') == '' )
        {
            redirect('');
        }
        $this->_rules_();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('username', TRUE));
        } else {
            $data = array(
              'password' => md5($this->input->post('password_baru',TRUE)),
            );

            $this->users_model->update($this->input->post('username', TRUE), $data);
            $this->session->set_flashdata('message', 'Password Berhasil diubah');
            redirect(site_url('owner/users/update/'.$this->input->post('username', TRUE)));
        }
    }

    public function update_normal($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());
        $row = $this->users_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('owner/users/update_action_normal'),
            'userdata' => set_value('userdata', $row->username),
            'username' => set_value('username', $row->username),
            'password' => "",
            'password_baru' => "",
            'ulangi_password' => "",
            'password' => md5(set_value('password', $row->password)),
            'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
            'email' => set_value('email', $row->email),
            'no_telp' => set_value('no_telp', $row->no_telp),
            'level' => set_value('level', $row->level),
            'blokir' => set_value('blokir', $row->blokir),
            'id_session' => set_value('id_session', $row->id_session),
            'kcfinder' => set_value('kcfinder', $row->kcfinder),
            // 'list_modul' => set_value('list_modul', $row->list_modul),
        );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Users Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Users</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."users_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/users'));
        }
    }
    
    public function update_action_normal() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());
        $this->_rules_normal();

        if ($this->input->post('password',TRUE) != "") {
            $this->form_validation->set_rules('password', ' ', 'trim|required|callback_oldpassword_check');
            $this->form_validation->set_rules('password_baru', ' ', 'trim|required|matches[ulangi_password]');
            $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'trim|required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->update_normal($this->input->post('username', TRUE));
        } else {
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                'email' => $this->input->post('email',TRUE),
                'no_telp' => $this->input->post('no_telp',TRUE),
                'level' => $this->input->post('level',TRUE),
                'blokir' => $this->input->post('blokir',TRUE),
            );
            
            if ($this->input->post('password',TRUE) != "") {
                $data['password'] = md5($this->input->post('password_baru',TRUE));
            }

            $this->users_model->update($this->input->post('username', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('owner/users'));
        }
    }
    
    public function delete($id) 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        $row = $this->users_model->get_by_id($id);

        if ($row) {
            $this->users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/users'));
        }
    }

    public function _rules_() 
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

    public function _rules_normal() 
    {   
        $this->form_validation->set_rules('nama_lengkap', ' ', 'trim|required');
        $this->form_validation->set_rules('email', ' ', 'trim|required');
        $this->form_validation->set_rules('no_telp', ' ', 'trim|required');
        $this->form_validation->set_rules('level', ' ', 'trim|required');
    //    $this->form_validation->set_rules('blokir', ' ', 'trim|required');
    //    $this->form_validation->set_rules('id_session', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function oldpassword_check($old_password){
       $old_password_hash = md5($old_password);
       $old_password_db_hash = $this->users_model->get_by_id($this->session->userdata('namauser'))->password;

       if($old_password_hash != $old_password_db_hash)
       {
          $this->form_validation->set_message('oldpassword_check', 'Password Lama Tidak Sama');
          return FALSE;
       } 
       return TRUE;
    }

    public function username_check($username)
    {   
        $row = $this->users_model->get_by_id($username);

        if($row)
        {   
            $this->form_validation->set_message('username_check', 'Username sudah digunakan');
            return FALSE;
        }

        return TRUE;
    }

};

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */