<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module_member extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('module_member_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $module_member = $this->module_member_model->get_all();
        
        //DATA
        $data['module_member_data']         = $module_member;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Module member List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Module member</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."module_member_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->module_member_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_main' => $row->id_main,
		'nama_menu' => $row->nama_menu,
		'link' => $row->link,
		'jabatan' => $row->jabatan,
		'parrent' => $row->parrent,
		'urutan' => $row->urutan,
		'icon' => $row->icon,
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Module member';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Module member</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."module_member_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/module_member'));
        }
    }
    
    public function create() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/module_member/create_action'),
	    'id_main' => set_value('id_main'),
	    'nama_menu' => set_value('nama_menu'),
	    'link' => set_value('link'),
	    'jabatan' => set_value('jabatan'),
	    'parrent' => set_value('parrent'),
	    'urutan' => set_value('urutan'),
	    'icon' => set_value('icon'),
	);
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Module member Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Module member</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."module_member_form";
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
            $data = array(
		'nama_menu' => $this->input->post('nama_menu',TRUE),
		'link' => $this->input->post('link',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'parrent' => $this->input->post('parrent',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'icon' => $this->input->post('icon',TRUE),
	    );

            $this->module_member_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/module_member'));
        }
    }
    
    public function update($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->module_member_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/module_member/update_action'),
		'id_main' => set_value('id_main', $row->id_main),
		'nama_menu' => set_value('nama_menu', $row->nama_menu),
		'link' => set_value('link', $row->link),
		'jabatan' => set_value('jabatan', $row->jabatan),
		'parrent' => set_value('parrent', $row->parrent),
		'urutan' => set_value('urutan', $row->urutan),
		'icon' => set_value('icon', $row->icon),
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Module member Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Module member</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."module_member_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/module_member'));
        }
    }
    
    public function update_action() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_main', TRUE));
        } else {
            $data = array(
		'nama_menu' => $this->input->post('nama_menu',TRUE),
		'link' => $this->input->post('link',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'parrent' => $this->input->post('parrent',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'icon' => $this->input->post('icon',TRUE),
	    );

            $this->module_member_model->update($this->input->post('id_main', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('owner/module_member'));
        }
    }
    
    public function delete($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->module_member_model->get_by_id($id);

        if ($row) {
            $this->module_member_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/module_member'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/module_member'));
        }
    }

    public function _rules() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        
	$this->form_validation->set_rules('nama_menu', ' ', 'trim|required');
	$this->form_validation->set_rules('link', ' ', 'trim|required');
	$this->form_validation->set_rules('jabatan', ' ', 'trim|required');
	$this->form_validation->set_rules('parrent', ' ', 'trim|required');
	$this->form_validation->set_rules('urutan', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('icon', ' ', 'trim|required');

	$this->form_validation->set_rules('id_main', 'id_main', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Module_member.php */
/* Location: ./application/controllers/Module_member.php */