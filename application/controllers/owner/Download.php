<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Download extends CI_Controller
{   
    public $member_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('download_model');
        $this->load->model('download_kategori_model');
        $this->load->library('form_validation');
        $this->member_folder = $this->config->item('member_folder');
    }

    public function index($id_kategori = 0)
    {   
        $this->auth->is_member();
        
        if($id_kategori == 0)
        redirect(site_url('member/users'));
        
        $download = $this->download_model->get_by_id_kategori($id_kategori);

        //DATA
        $data['download_data']           = $download;
        $data['id_kategori']            = $id_kategori;
        $data['folder_member']            = $this->member_folder;
        $data['content_header']          = 'Download List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Download</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->member_folder."download_list";
        //View
        template_lib($element, $data, '', $this->member_folder);
    }

    public function do_download($id = 0)
    {   
        $this->auth->is_member();
        
        if($id == 0)
        redirect(site_url('member/users'));

        $row = $this->download_model->get_by_id($id);
        if ($row) {
            $jlh_downloads = $row->jlh_download + 0.5;
            echo $jlh_downloads;
            $data = array(
                'jlh_download' => $jlh_downloads,
            );
            $this->download_model->update($id, $data);

            $this->load->helper('download');

            $data = file_get_contents("./files/".$row->file); // Read the file's contents
            $name = $row->file;

            $this->do_force_download($name, $data);
            //redirect(site_url('member/download'));

        } else {
            $this->session->set_flashdata('message', 'File Tidak Ditemukan');
            redirect(site_url('member/users'));
        }

    }

    public function do_force_download($name, $data)
    {
        force_download($name, $data);
    }

    public function read($id) 
    {   
        $this->auth->is_member();
        $row = $this->download_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_db' => $row->id_db,
		'id_kategori' => $row->id_kategori,
		'nama_file' => $row->nama_file,
		'file' => $row->file,
		'file_size' => $row->file_size,
		'tanggal' => $row->tanggal,
		'jlh_download' => $row->jlh_download,
	    );
            //DATA
            $data['folder_member']            = $this->member_folder;
            $data['content_header']          = 'Download';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Download</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->member_folder."download_read";
            //View
            template_lib($element, $data, '', $this->member_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('member/download'));
        }
    }
    
    public function create() 
    {   
        $this->auth->is_member();
        $data = array(
            'button' => 'Create',
            'action' => site_url('member/download/create_action'),
	    'id_db' => set_value('id_db'),
	    'id_kategori' => set_value('id_kategori'),
	    'nama_file' => set_value('nama_file'),
	    'file' => set_value('file'),
	    'file_size' => set_value('file_size'),
	    'tanggal' => set_value('tanggal'),
	    'jlh_download' => set_value('jlh_download'),
	); 
        // ambil data download_kategori dari tabel
        $query_download_kategori  = $this->download_kategori_model->get_all();
        $num_rows_download_kategori = $this->download_kategori_model->total_rows();

        if ($num_rows_download_kategori > 0)
        {   
            //$data['options_download_kategori'][$this->input->post('id_download_kategori')] = $this->download_kategori_model->get_by_id($this->input->post('id_download_kategori'))->nama;
            foreach($query_download_kategori as $row_download_kategori)
            {   
                if($this->input->post('id_kategori',TRUE) == $row_download_kategori->id_db)
                {   
                    $data['default']['id_kategori'] = $this->input->post('id_kategori',TRUE);
                    $data['options_download_kategori'][$row_download_kategori->id_db] = $row_download_kategori->nama_kategori;
                }
                else{
                    $data['options_download_kategori'][$row_download_kategori->id_db] = $row_download_kategori->nama_kategori;
                }           
            }
        }
        else
        {
          $data['options_download_kategori'][''] = 'Input download_kategori Terlebih Dahulu';
        }

        //DATA
        $data['folder_member']            = $this->member_folder;
        $data['content_header']          = 'Download Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Download</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->member_folder."download_form";
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
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'nama_file' => $this->input->post('nama_file',TRUE),
		//'file' => $this->input->post('file',TRUE),
		//'file_size' => $this->input->post('file_size',TRUE),
		'tanggal' => date("Y-m-d"),
		'jlh_download' => 1,
	    ); 
            if($_FILES["file"]["error"] != 0)
            {   //Foto Bermasalah
                $this->session->set_flashdata('message', 'Update Record Success');
            }
            else
            {   //Validasi File
                $config['upload_path'] = './files/';
                $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf';
                $config['max_size'] = '2000';
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';
                //$config['encrypt_name'] = TRUE;

                //load upload class library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file'))
                {   // case - failure
                    $this->session->set_flashdata('message', 'Update Record Success, But File error to upload');
                }
                else
                {   // case - success
                    // $foto_lama = $this->album_model->get_by_id($this->input->post('id_db', TRUE))->foto;
                    // if(!empty($foto_lama))
                    // {   //echo $foto_lama;
                    //     $this->_cek_old_file($foto_lama);                    
                    // }
                    $upload_data = $this->upload->data();
                    $nama_file = $upload_data['file_name'];
                    $data['file'] = $nama_file;
                    $data['file_size'] = $upload_data['file_size'];
                    $this->session->set_flashdata('message', 'Update Record Success');
                }
            }

            $this->download_model->insert($data);
            //$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('member/download'));
        }
    }
    
    public function update($id) 
    {   
        $this->auth->is_member();
        $row = $this->download_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('member/download/update_action'),
		'id_db' => set_value('id_db', $row->id_db),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'nama_file' => set_value('nama_file', $row->nama_file),
		'file' => set_value('file', $row->file),
		'file_size' => set_value('file_size', $row->file_size),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'jlh_download' => set_value('jlh_download', $row->jlh_download),
	    );
            // ambil data download_kategori dari tabel
            $query_download_kategori  = $this->download_kategori_model->get_all();
            $num_rows_download_kategori = $this->download_kategori_model->total_rows();
            
            if(!empty($this->download_kategori_model->get_by_id($row->id_kategori)->nama_kategori))
            {
                $data['options_download_kategori'][$row->id_kategori] = $this->download_kategori_model->get_by_id($row->id_kategori)->nama_kategori;
            }

            if ($num_rows_download_kategori > 0)
            {   
                foreach($query_download_kategori as $row_download_kategori)
                {   
                    if($this->input->post('id_kategori',TRUE) == $row_download_kategori->id_db)
                    {   
                        $data['default']['id_kategori'] = $this->input->post('id_kategori',TRUE);
                        $data['options_download_kategori'][$row_download_kategori->id_db] = $row_download_kategori->nama_kategori;
                    }
                    else{
                        $data['options_download_kategori'][$row_download_kategori->id_db] = $row_download_kategori->nama_kategori;
                    }
                }
            }
            else
            {
              $data['options_download_kategori'][''] = 'Input download kategori Terlebih Dahulu';
            }

            //DATA
            $data['folder_member']            = $this->member_folder;
            $data['content_header']          = 'Download Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Download</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->member_folder."download_form";
            //View
            template_lib($element, $data, '', $this->member_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('member/download'));
        }
    }
    
    public function update_action() 
    {   
        $this->auth->is_member();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_db', TRUE));
        } else {
            $data = array(
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'nama_file' => $this->input->post('nama_file',TRUE),
		//'file' => $this->input->post('file',TRUE),
		//'file_size' => $this->input->post('file_size',TRUE),
		//'tanggal' => $this->input->post('tanggal',TRUE),
		//'jlh_download' => $this->input->post('jlh_download',TRUE),
	    );
            if($_FILES["file"]["error"] != 0)
            {   //Foto Bermasalah
                $this->session->set_flashdata('message', 'Update Record Success');
            }
            else
            {   //Validasi File
                $config['upload_path'] = './files/';
                $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf';
                $config['max_size'] = '2000';
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';
                //$config['encrypt_name'] = TRUE;

                //load upload class library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file'))
                {   // case - failure
                    $this->session->set_flashdata('message', 'Update Record Success, But File error to upload');
                }
                else
                {   // case - success
                    $foto_lama = $this->download_model->get_by_id($this->input->post('id_db', TRUE))->file;
                    if(!empty($foto_lama))
                    {   //echo $foto_lama;
                        $this->_cek_old_file($foto_lama);                    
                    }
                    $upload_data = $this->upload->data();
                    $nama_file = $upload_data['file_name'];
                    $data['file'] = $nama_file;
                    $data['file_size'] = $upload_data['file_size'];
                    $this->session->set_flashdata('message', 'Update Record Success');
                }
            }

            $this->download_model->update($this->input->post('id_db', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('member/download'));
        }
    }
    
    // public function delete($id) 
    // {   
    //     $this->auth->is_member();
    //     $row = $this->download_model->get_by_id($id);

    //     if ($row) {
    //         $this->download_model->delete($id);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //         redirect(site_url('member/download'));
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('member/download'));
    //     }
    // }

    public function delete($id) 
    {   
        $this->auth->is_member();
        $row = $this->download_model->get_by_id($id);

        if ($row) {
            $this->download_model->delete($id);
            $foto_lama = $row->file;
            //echo $foto_lama."<br>";
            if(!empty($foto_lama))
            {   $this->_cek_old_file($foto_lama);   }
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('member/download'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('member/download'));
        }
    }

    function _cek_old_file($foto_lama)
    {   
        $DelFilePath = './files/'.$foto_lama;
        //echo $DelFilePath."<br>";
       // delete_files($DelFilePath);
        if (file_exists($DelFilePath)) 
        {   
            unlink ($DelFilePath);
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_kategori', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('nama_file', ' ', 'trim|required');
	//$this->form_validation->set_rules('file', ' ', 'trim|required');
	//$this->form_validation->set_rules('file_size', ' ', 'trim|required');
	//$this->form_validation->set_rules('tanggal', ' ', 'trim|required');
	//$this->form_validation->set_rules('jlh_download', ' ', 'trim|required|numeric');

	$this->form_validation->set_rules('id_db', 'id_db', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Download.php */
/* Location: ./application/controllers/Download.php */