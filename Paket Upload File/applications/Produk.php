<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_admin();

        $produk = $this->produk_model->get_all();
        
        //DATA
        $data['produk_data']             = $produk;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Produk List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Produk</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."produk_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {
        $row = $this->produk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_db' => $row->id_db,
		'nama' => $row->nama,
		'nama_en' => $row->nama_en,
		'deskripsi' => $row->deskripsi,
		'deskripsi_en' => $row->deskripsi_en,
        'urutan' => $row->urutan,
		'foto' => $row->foto,
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Produk';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Produk</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."produk_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/produk'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/produk/create_action'),
	    'id_db' => set_value('id_db'),
	    'nama' => set_value('nama'),
	    'nama_en' => set_value('nama_en'),
	    'deskripsi' => set_value('deskripsi'),
	    'deskripsi_en' => set_value('deskripsi_en'),
        'urutan' => set_value('urutan'),
	    'foto' => set_value('foto'),
	);
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Produk Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Produk</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."produk_form";
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
    		'nama' => $this->input->post('nama',TRUE),
            'seo' => $this->seo_title($this->input->post('nama',TRUE)),
            'nama_en' => $this->input->post('nama_en',TRUE),
            'seo_en' => $this->seo_title($this->input->post('nama_en',TRUE)),
            'deskripsi' => $this->input->post('deskripsi'),
            'deskripsi_en' => $this->input->post('deskripsi_en'),
            'urutan' => $this->input->post('urutan',TRUE),
    		//'foto' => $this->input->post('foto',TRUE),
    	    );

            if($_FILES["foto"]["error"] != 0)
            {   //Foto Bermasalah
                $this->session->set_flashdata('message', 'Update Record Success');
            }
            else
            {   //Validasi File
                $config['upload_path'] = './images/gallery/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['encrypt_name'] = TRUE;

                //load upload class library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto'))
                {   // case - failure
                    $this->session->set_flashdata('message', 'Update Record Success, But photo error to upload');
                }
                else
                {   // case - success
                    $foto_lama = $this->produk_model->get_by_id($this->input->post('id_db', TRUE))->foto;
                    if(!empty($foto_lama))
                    {   //echo $foto_lama;
                        $this->_cek_old_file($foto_lama);                    
                    }
                    $upload_data = $this->upload->data();
                    $nama_file = $upload_data['file_name'];
                    $data ['foto'] = $nama_file;
                    $this->session->set_flashdata('message', 'Update Record Success');
                }
            }

            $this->produk_model->insert($data);
            //$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/produk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/produk/update_action'),
		'id_db' => set_value('id_db', $row->id_db),
		'nama' => set_value('nama', $row->nama),
		'nama_en' => set_value('nama_en', $row->nama_en),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'deskripsi_en' => set_value('deskripsi_en', $row->deskripsi_en),
        'urutan' => set_value('urutan', $row->urutan),
		'foto' => set_value('foto', $row->foto),
	    );
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Produk Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Produk</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."produk_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/produk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_db', TRUE));
        } else {
            $data = array(
    		'nama' => $this->input->post('nama',TRUE),
    		'seo' => $this->seo_title($this->input->post('nama',TRUE)),
            'nama_en' => $this->input->post('nama_en',TRUE),
            'seo_en' => $this->seo_title($this->input->post('nama_en',TRUE)),
    		'deskripsi' => $this->input->post('deskripsi'),
    		'deskripsi_en' => $this->input->post('deskripsi_en'),
            'urutan' => $this->input->post('urutan',TRUE),
    		//'foto' => $this->input->post('foto',TRUE),
    	    );

            if($_FILES["foto"]["error"] != 0)
            {   //Foto Bermasalah
                $this->session->set_flashdata('message', 'Update Record Success');
            }
            else
            {   //Validasi File
                $config['upload_path'] = './images/gallery/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['encrypt_name'] = TRUE;

                //load upload class library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto'))
                {   // case - failure
                    $this->session->set_flashdata('message', 'Update Record Success, But photo error to upload');
                }
                else
                {   // case - success
                    $foto_lama = $this->produk_model->get_by_id($this->input->post('id_db', TRUE))->foto;
                    if(!empty($foto_lama))
                    {   //echo $foto_lama;
                        $this->_cek_old_file($foto_lama);                    
                    }
                    $upload_data = $this->upload->data();
                    $nama_file = $upload_data['file_name'];
                    $data ['foto'] = $nama_file;
                    $this->session->set_flashdata('message', 'Update Record Success');
                }
            }

            $this->produk_model->update($this->input->post('id_db', TRUE), $data);
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('owner/produk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->produk_model->get_by_id($id);

        if ($row) {
            $this->produk_model->delete($id);
            $foto_lama = $row->foto;
            if(!empty($foto_lama))
            {   $this->_cek_old_file($foto_lama);   }
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/produk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/produk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', ' ', 'trim|required');
	$this->form_validation->set_rules('nama_en', ' ', 'trim|required');
	$this->form_validation->set_rules('deskripsi', ' ', 'trim|required');
	$this->form_validation->set_rules('deskripsi_en', ' ', 'trim|required');
    $this->form_validation->set_rules('urutan', ' ', 'trim|required');
	//$this->form_validation->set_rules('foto', ' ', 'trim|required');

	$this->form_validation->set_rules('id_db', 'id_db', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function _cek_old_file($foto_lama)
    {   
        $DelFilePath = './images/gallery/'.$foto_lama;
            
        if (file_exists($DelFilePath)) 
        {   
            unlink ($DelFilePath);
        }
    }

    function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

};

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */