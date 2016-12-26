<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_organisasi extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_organisasi_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_jabatan($this->router->fetch_class());
        redirect(site_url('owner/data_organisasi/update/1'));

        $data_organisasi = $this->data_organisasi_model->get_all();
        
        //DATA
        $data['data_organisasi_data']         = $data_organisasi;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'data organisasi List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>data organisasi</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."data_organisasi_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->data_organisasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_perusahaan' => $row->id_perusahaan,
		'nama_perusahaan' => $row->nama_perusahaan,
		'motto' => $row->motto,
		'alamat' => $row->alamat,
		'phone' => $row->phone,
		'fax' => $row->fax,
		'email' => $row->email,
		'logo' => $row->logo,
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'data_organisasi';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>data_organisasi</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."data_organisasi_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/data_organisasi'));
        }
    }
    
    public function create() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/data_organisasi/create_action'),
	    'id_perusahaan' => set_value('id_perusahaan'),
	    'nama_perusahaan' => set_value('nama_perusahaan'),
	    'motto' => set_value('motto'),
	    'alamat' => set_value('alamat'),
	    'phone' => set_value('phone'),
	    'fax' => set_value('fax'),
	    'email' => set_value('email'),
	    'logo' => set_value('logo'),
	);
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'data_organisasi Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>data_organisasi</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."data_organisasi_form";
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
		'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
		'motto' => $this->input->post('motto',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'fax' => $this->input->post('fax',TRUE),
		'email' => $this->input->post('email',TRUE),
		'logo' => $this->input->post('logo',TRUE),
	    );

            $this->data_organisasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/data_organisasi'));
        }
    }
    
    public function update($id) 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        $row = $this->data_organisasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/data_organisasi/update_action'),
		'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
		'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
		'motto' => set_value('motto', $row->motto),
        'home_text' => set_value('home_text', $row->home_text),
        'home_text_en' => set_value('home_text_en', $row->home_text_en),
		'alamat' => set_value('alamat', $row->alamat),
        'alamat2' => set_value('alamat2', $row->alamat2),
        'alamat3' => set_value('alamat3', $row->alamat3),
        'koordinat' => set_value('koordinat', $row->koordinat),
		'phone' => set_value('phone', $row->phone),
		'fax' => set_value('fax', $row->fax),
		'email' => set_value('email', $row->email),
		'logo' => set_value('logo', $row->logo),
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'data organisasi';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>data organisasi</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."data_organisasi_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/data_organisasi'));
        }
    }
    
    public function update_action() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_perusahaan', TRUE));
        } else {

            $data = array(
                'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
                'motto' => $this->input->post('motto',TRUE),
                'home_text' => $this->input->post('home_text',TRUE),
                'home_text_en' => $this->input->post('home_text_en',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'alamat2' => $this->input->post('alamat2',TRUE),
                'alamat3' => $this->input->post('alamat3',TRUE),
                'koordinat' => $this->input->post('koordinat',TRUE),
                'phone' => $this->input->post('phone',TRUE),
                'fax' => $this->input->post('fax',TRUE),
                'email' => $this->input->post('email',TRUE),
                );

            // if($_FILES["logo"]["error"] != 0)
            // {   //Foto Bermasalah
            //     $this->session->set_flashdata('message', 'Update Record Success');
            // }
            // else
            // {   //Validasi File
            //     $config['upload_path'] = './images/';
            //     $config['allowed_types'] = 'gif|jpg|png';
            //     $config['max_size'] = '1000';
            //     $config['max_width']  = '1024';
            //     $config['max_height']  = '768';
            //     $config['encrypt_name'] = TRUE;

            //     //load upload class library
            //     $this->load->library('upload', $config);

            //     if (!$this->upload->do_upload('logo'))
            //     {   // case - failure
            //         $this->session->set_flashdata('message', 'Update Record Success');
            //     }
            //     else
            //     {   // case - success
            //         $foto_lama = $this->data_organisasi_model->get_by_id($this->input->post('id_perusahaan', TRUE))->logo;
            //         if(!empty($foto_lama))
            //         {   //echo $foto_lama;
            //             $this->_cek_old_file($foto_lama);                    
            //         }
            //         $upload_data = $this->upload->data();
            //         $nama_file = $upload_data['file_name'];
            //         $data ['logo'] = $nama_file;
            //         $this->session->set_flashdata('message', 'Update Record Success');
            //     }
            // }

            $this->session->set_flashdata('message', 'Data Berhasil di Ubah');
            $this->data_organisasi_model->update($this->input->post('id_perusahaan', TRUE), $data);
            redirect(site_url('owner/data_organisasi/update/1'));
        }
    }
    
    public function delete($id) 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        
        $row = $this->data_organisasi_model->get_by_id($id);

        if ($row) {
            $this->data_organisasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/data_organisasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/data_organisasi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_perusahaan', ' ', 'trim|required');
	// $this->form_validation->set_rules('motto', ' ', 'trim|required');
 //    $this->form_validation->set_rules('home_text', ' ', 'trim|required');
 //    $this->form_validation->set_rules('home_text_en', ' ', 'trim|required');
	$this->form_validation->set_rules('alamat', ' ', 'trim|required');
	$this->form_validation->set_rules('phone', ' ', 'trim|required');
	$this->form_validation->set_rules('fax', ' ', 'trim|required');
	$this->form_validation->set_rules('email', ' ', 'trim|required');
	//$this->form_validation->set_rules('logo', ' ', 'trim|required');

	$this->form_validation->set_rules('id_perusahaan', 'id_perusahaan', 'trim');
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

/* End of file data_organisasi.php */
/* Location: ./application/controllers/data_organisasi.php */