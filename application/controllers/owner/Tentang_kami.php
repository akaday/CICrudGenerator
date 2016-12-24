<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tentang_kami extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('tentang_kami_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   redirect(site_url('owner/tentang_kami/update/1'));
        $this->auth->is_admin();

        $tentang_kami = $this->tentang_kami_model->get_all();
        
        //DATA
        $data['tentang_kami_data']       = $tentang_kami;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Tentang_kami List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Tentang_kami</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."tentang_kami_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {   
        $row = $this->tentang_kami_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_db' => $row->id_db,
		'isi' => $row->isi,
		'isi_en' => $row->isi_en,
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Tentang_kami';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Tentang_kami</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."tentang_kami_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/tentang_kami'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/tentang_kami/create_action'),
	    'id_db' => set_value('id_db'),
	    'isi' => set_value('isi'),
	    'isi_en' => set_value('isi_en'),
	);
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Tentang_kami Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Tentang_kami</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."tentang_kami_form";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'isi' => $this->input->post('isi',TRUE),
		'isi_en' => $this->input->post('isi_en',TRUE),
	    );

            $this->tentang_kami_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/tentang_kami'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->tentang_kami_model->get_by_id($id);
        //echo $id;
        if ($row) {
            $data = array(
                'button' => 'Update',
                    'action' => site_url('owner/tentang_kami/update_action'),
                    //'action' => "/owner/tentang_kami/update_action/",
        	'id_db' => set_value('id_db', $row->id_db),
        	'isi' => set_value('isi', $row->isi),
        	'isi_en' => set_value('isi_en', $row->isi_en),
            );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Tentang kami';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Tentang_kami</li>';
            $data['show_username']           = $this->session->userdata('namauser');

            $element = $this->admin_folder."tentang_kami_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found'.$id);
            redirect(site_url('owner/tentang_kami/update/1'));
        }
    }
    
    public function update_action() 
    {   

        $this->_rules();

        //echo $this->form_validation->run();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_db', TRUE));
        } else {
            //echo "bisa".$this->input->post('id_db')."<br>";
            $data = array(
    		'isi' => $this->input->post('isi'),
    		'isi_en' => $this->input->post('isi_en'),
    	    );

           $this->tentang_kami_model->update($this->input->post('id_db', TRUE), $data);
           $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('owner/tentang_kami'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->tentang_kami_model->get_by_id($id);

        if ($row) {
            $this->tentang_kami_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/tentang_kami'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/tentang_kami'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('isi', ' Isi', 'required');
	$this->form_validation->set_rules('isi_en', 'Isi En', 'required');

	$this->form_validation->set_rules('id_db', 'id_db', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Tentang_kami.php */
/* Location: ./application/controllers/Tentang_kami.php */