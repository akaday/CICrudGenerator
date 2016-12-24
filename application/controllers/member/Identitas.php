<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Identitas extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('identitas_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_admin();
        redirect(site_url('owner/identitas/update/1'));

        $identitas = $this->identitas_model->get_all();
        
        //DATA
        $data['identitas_data']         = $identitas;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Identitas List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Identitas</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."identitas_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {
        $row = $this->identitas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_identitas' => $row->id_identitas,
		'nama_website' => $row->nama_website,
		'meta_deskripsi' => $row->meta_deskripsi,
		'meta_keyword' => $row->meta_keyword,
		'favicon' => $row->favicon,
		'email' => $row->email,
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Identitas';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Identitas</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."identitas_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/identitas'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/identitas/create_action'),
	    'id_identitas' => set_value('id_identitas'),
	    'nama_website' => set_value('nama_website'),
	    'meta_deskripsi' => set_value('meta_deskripsi'),
	    'meta_keyword' => set_value('meta_keyword'),
	    'favicon' => set_value('favicon'),
	    'email' => set_value('email'),
	);
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Identitas Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Identitas</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."identitas_form";
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
		'nama_website' => $this->input->post('nama_website',TRUE),
		'meta_deskripsi' => $this->input->post('meta_deskripsi',TRUE),
		'meta_keyword' => $this->input->post('meta_keyword',TRUE),
		'favicon' => $this->input->post('favicon',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->identitas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/identitas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->identitas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/identitas/update_action'),
		'id_identitas' => set_value('id_identitas', $row->id_identitas),
		'nama_website' => set_value('nama_website', $row->nama_website),
		'meta_deskripsi' => set_value('meta_deskripsi', $row->meta_deskripsi),
		'meta_keyword' => set_value('meta_keyword', $row->meta_keyword),
		'favicon' => set_value('favicon', $row->favicon),
		'email' => set_value('email', $row->email),
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Identitas Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Identitas</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."identitas_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/identitas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_identitas', TRUE));
        } else 
        {
            $data = array(
                    'nama_website' => $this->input->post('nama_website',TRUE),
                    'meta_deskripsi' => $this->input->post('meta_deskripsi',TRUE),
                    'meta_keyword' => $this->input->post('meta_keyword',TRUE),
                    'email' => $this->input->post('email',TRUE),
                );

            if($_FILES["favicon"]["error"] != 0)
            {   //Foto Bermasalah
                $this->session->set_flashdata('message', 'Update Record Success');
            }
            else
            {   //Validasi File
                $config['upload_path'] = './images/';
                //$config['allowed_types'] = 'gif|jpg|png|ico';
                $config['allowed_types'] = '*';
                $config['max_size'] = '1000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
               // $config['encrypt_name'] = TRUE;

                //load upload class library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('favicon'))
                {   // case - failure
                    $this->session->set_flashdata('message', 'Update Record Success, But photo error to upload');
                }
                else
                {   // case - success
                    $foto_lama = $this->identitas_model->get_by_id($this->input->post('id_identitas', TRUE))->favicon;
                    if(!empty($foto_lama))
                    {   //echo $foto_lama;
                        $this->_cek_old_file($foto_lama);                    
                    }
                    $upload_data = $this->upload->data();
                    $nama_file = $upload_data['file_name'];
                    $data ['favicon'] = $nama_file;
                    $this->session->set_flashdata('message', 'Update Record Success');
                }
            }

            $this->identitas_model->update($this->input->post('id_identitas', TRUE), $data);
            redirect(site_url('owner/identitas/update/1'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->identitas_model->get_by_id($id);

        if ($row) {
            $this->identitas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/identitas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/identitas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_website', ' ', 'trim|required');
	$this->form_validation->set_rules('meta_deskripsi', ' ', 'trim|required');
	$this->form_validation->set_rules('meta_keyword', ' ', 'trim|required');
	//$this->form_validation->set_rules('favicon', ' ', 'trim|required');
	$this->form_validation->set_rules('email', ' ', 'trim|required');

	$this->form_validation->set_rules('id_identitas', 'id_identitas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

     function _cek_old_file($foto_lama)
    {   
        $DelFilePath = './images/'.$foto_lama;
            
        if (file_exists($DelFilePath)) 
        {   
            unlink ($DelFilePath);
        }

    }

};

/* End of file Identitas.php */
/* Location: ./application/controllers/Identitas.php */