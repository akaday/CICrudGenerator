<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Core extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('core_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $tgl_mulai      = ($this->input->post('tgl_mulai') == "" ? DATE("Y-m-1") : $this->input->post('tgl_mulai') );
        $tgl_selesai    = ($this->input->post('tgl_selesai') == "" ? date("Y-m-t") : $this->input->post('tgl_selesai') );


        // $core = $this->core_model->get_all();
        $core = $this->core_model->filter_tgl($tgl_mulai, $tgl_selesai);
        
        //DATA
        $data['core_data']         = $core;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Core List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Core</li>';
        $data['show_username']           = $this->session->userdata('namauser');

        $data['tgl_mulai']      = $tgl_mulai;
        $data['tgl_selesai']    = $tgl_selesai;
        

        $element = $this->admin_folder."core_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->core_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_db' => $row->id_db,
		'nama' => $row->nama,
		'tgl_mulai' => $row->tgl_mulai,
		'tgl_selesai' => $row->tgl_selesai,
		'kelamin' => $row->kelamin,
		'pass' => $row->pass,
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Core';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Core</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."core_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/core'));
        }
    }
    
    public function create() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/core/create_action'),
	    'id_db' => set_value('id_db'),
	    'nama' => set_value('nama'),
	    'tgl_mulai' => set_value('tgl_mulai'),
	    'tgl_selesai' => set_value('tgl_selesai'),
	    'kelamin' => set_value('kelamin'),
	    'pass' => set_value('pass'),
	);
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Core Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Core</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."core_form";
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
		'nama' => $this->input->post('nama',TRUE),
		'tgl_mulai' => $this->input->post('tgl_mulai',TRUE),
		'tgl_selesai' => $this->input->post('tgl_selesai',TRUE),
		'kelamin' => $this->input->post('kelamin',TRUE),
		'pass' => $this->input->post('pass',TRUE),
	    );

            $this->core_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/core'));
        }
    }
    
    public function update($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->core_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/core/update_action'),
		'id_db' => set_value('id_db', $row->id_db),
		'nama' => set_value('nama', $row->nama),
		'tgl_mulai' => set_value('tgl_mulai', $row->tgl_mulai),
		'tgl_selesai' => set_value('tgl_selesai', $row->tgl_selesai),
		'kelamin' => set_value('kelamin', $row->kelamin),
		'pass' => set_value('pass', $row->pass),
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Core Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Core</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."core_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/core'));
        }
    }
    
    public function update_action() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_db', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'tgl_mulai' => $this->input->post('tgl_mulai',TRUE),
		'tgl_selesai' => $this->input->post('tgl_selesai',TRUE),
		'kelamin' => $this->input->post('kelamin',TRUE),
		'pass' => $this->input->post('pass',TRUE),
	    );

            $this->core_model->update($this->input->post('id_db', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('owner/core'));
        }
    }
    
    public function delete($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->core_model->get_by_id($id);

        if ($row) {
            $this->core_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/core'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/core'));
        }
    }

    public function _rules() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        
	$this->form_validation->set_rules('nama', ' ', 'trim|required');
	$this->form_validation->set_rules('tgl_mulai', ' ', 'trim|required');
	$this->form_validation->set_rules('tgl_selesai', ' ', 'trim|required');
	$this->form_validation->set_rules('kelamin', ' ', 'trim|required');
	$this->form_validation->set_rules('pass', ' ', 'trim|required');

	$this->form_validation->set_rules('id_db', 'id_db', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Core.php */
/* Location: ./application/controllers/Core.php */