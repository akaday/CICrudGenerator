<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hubungi_kami extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('hubungi_kami_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $hubungi_kami = $this->hubungi_kami_model->get_all();
        
        //DATA
        $data['hubungi_kami_data']         = $hubungi_kami;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Hubungi kami List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Hubungi kami</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."hubungi_kami_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->hubungi_kami_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_db' => $row->id_db,
		'nama' => $row->nama,
		'ponsel' => $row->ponsel,
		'deskripsi' => $row->deskripsi,
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Hubungi kami';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Hubungi kami</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."hubungi_kami_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/hubungi_kami'));
        }
    }
    
    public function create() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());

        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/hubungi_kami/create_action'),
	    'id_db' => set_value('id_db'),
	    'nama' => set_value('nama'),
	    'ponsel' => set_value('ponsel'),
	    'deskripsi' => set_value('deskripsi'),
	);
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Hubungi kami Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Hubungi kami</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."hubungi_kami_form";
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
		'ponsel' => $this->input->post('ponsel',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
	    );

            $this->hubungi_kami_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/hubungi_kami'));
        }
    }
    
    public function update($id) 
    {
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->hubungi_kami_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/hubungi_kami/update_action'),
		'id_db' => set_value('id_db', $row->id_db),
		'nama' => set_value('nama', $row->nama),
		'ponsel' => set_value('ponsel', $row->ponsel),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Hubungi kami Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Hubungi kami</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."hubungi_kami_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/hubungi_kami'));
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
		'ponsel' => $this->input->post('ponsel',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
	    );

            $this->hubungi_kami_model->update($this->input->post('id_db', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('owner/hubungi_kami'));
        }
    }
    
    public function delete($id) 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        
        $row = $this->hubungi_kami_model->get_by_id($id);

        if ($row) {
            $this->hubungi_kami_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/hubungi_kami'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/hubungi_kami'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', ' ', 'trim|required');
	$this->form_validation->set_rules('ponsel', ' ', 'trim|required');
	$this->form_validation->set_rules('deskripsi', ' ', 'trim|required');

	$this->form_validation->set_rules('id_db', 'id_db', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Hubungi_kami.php */
/* Location: ./application/controllers/Hubungi_kami.php */