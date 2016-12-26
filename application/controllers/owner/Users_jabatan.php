<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class users_jabatan extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('users_jabatan_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $users_jabatan = $this->users_jabatan_model->get_all();
        
        //DATA
        $data['users_jabatan_data']         = $users_jabatan;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Jabatan List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Jabatan</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."users_jabatan_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->users_jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		    'id_jabatan' => $row->id_jabatan,
		    'nama_jabatan' => $row->nama_jabatan,
		    'list_modul' => $row->list_modul,
		    'ke' => $row->ke,
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Jabatan';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Jabatan</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."users_jabatan_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/users_jabatan'));
        }
    }
    
    public function create() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/users_jabatan/create_action'),
    	    'id_jabatan' => set_value('id_jabatan'),
    	    'nama_jabatan' => set_value('nama_jabatan'),
    	    'list_modul' => set_value('list_modul'),
    	    'ke' => set_value('ke'),
    	);
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Jabatan Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Jabatan</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."users_jabatan_form";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }
    
    public function create_action() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

         if (!empty($this->input->post('list_modul',TRUE))){
            $list_modul_input = $this->input->post('list_modul',TRUE);
            $list_modul=implode('|',$list_modul_input);
          }

        if (!empty($this->input->post('modul_android',TRUE))){
            $modul_android_input = $this->input->post('modul_android',TRUE);
            $modul_android=implode('|',$modul_android_input);
        }
          
            $data = array(
    		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
    		'list_modul' => $list_modul,
    		'ke' => $this->input->post('ke',TRUE),
            'modul_android' => $modul_android,
    	    );

            $this->users_jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/users_jabatan'));
        }
    }
    
    public function update($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->users_jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/users_jabatan/update_action'),
		'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
		'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
		'list_modul' => set_value('list_modul', $row->list_modul),
		'ke' => set_value('ke', $row->ke),

	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Jabatan Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Jabatan</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."users_jabatan_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/users_jabatan'));
        }
    }
    
    public function update_action() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jabatan', TRUE));
        } else {

        if (!empty($this->input->post('list_modul',TRUE))){
            $list_modul_input = $this->input->post('list_modul',TRUE);
            $list_modul=implode('|',$list_modul_input);
          }

        if($this->input->post('id_jabatan', TRUE) == 1)
        {
            $list_modul = "|all|";
        }

            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
		'list_modul' => $list_modul,
		'ke' => $this->input->post('ke',TRUE),
	    );

            $this->users_jabatan_model->update($this->input->post('id_jabatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('owner/users_jabatan'));
        }
    }
    
    public function delete($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->users_jabatan_model->get_by_id($id);

        if ($row) {
            $this->users_jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/users_jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/users_jabatan'));
        }
    }

    public function _rules() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        
	$this->form_validation->set_rules('nama_jabatan', ' ', 'trim|required');
	//$this->form_validation->set_rules('list_modul', ' ', 'trim|required');
	//$this->form_validation->set_rules('ke', ' ', 'trim|required');

	$this->form_validation->set_rules('id_jabatan', 'id_jabatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file users_jabatan.php */
/* Location: ./application/controllers/users_jabatan.php */