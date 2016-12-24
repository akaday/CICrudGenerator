<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module extends CI_Controller
{   
    public $admin_folder;
    function __construct()
    {
        parent::__construct();
        $this->load->model('module_model');
        $this->load->library('form_validation');
        $this->admin_folder = $this->config->item('admin_folder');
    }

    public function index()
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        if($this->input->post('filter',TRUE) == "" OR $this->input->post('filter',TRUE) == "menu_utama")
        {
            $data['filter'] = "menu_utama";
            $sistem_module = $this->db->query("SELECT * FROM module WHERE parrent = '0' ORDER by urutan ASC")->result();
        }
        else{
            $data['filter'] = "menu_sub";
            $sistem_module = $this->db->query("SELECT * FROM module WHERE parrent != '0' ORDER by urutan ASC")->result();
//            $sistem_module = $this->module_model->get_all();
        }
        
        //DATA
        $data['sistem_module_data']         = $sistem_module;
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Sistem Module List';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Sistem Module</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."module_list";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }

    public function read($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->module_model->get_by_id($id);
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
            $data['content_header']          = 'Sistem Module';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Sistem Module</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."Module_read";
            //View
            template_lib($element, $data, '', $this->admin_folder);

        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('owner/module'));
        }
    }
    
    public function create() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $data = array(
            'button' => 'Create',
            'action' => site_url('owner/module/create_action'),
	    'id_main' => set_value('id_main'),
	    'nama_menu' => set_value('nama_menu'),
	    'link' => set_value('link'),
	    'jabatan' => set_value('jabatan'),
	    //'parrent' => set_value('parrent'),
	    'urutan' => set_value('urutan'),
	    'icon' => set_value('icon'),
	);
        $query_menu  = $this->module_model->get_parrent();
        $num_rows_menu = $this->module_model->total_get_parrent_rows();

        if ($num_rows_menu > 0)
        {   
            //$data['options_menu'][$this->input->post('id_menu')] = $this->menu_model->get_by_id($this->input->post('id_menu'))->nama;
            $data['parrent'][0] = "Menu Induk";
            foreach($query_menu as $row_menu)
            {   
                if($this->input->post('parrent',TRUE) == $row_menu->id_main)
                {   
                    $data['default']['parrent'] = $this->input->post('parrent',TRUE);
                    $data['parrent'][$row_menu->id_main] = $row_menu->nama_menu;
                }
                else{
                    $data['parrent'][$row_menu->id_main] = $row_menu->nama_menu;
                }           
            }
        }
        else
        {
          $data['parrent'][''] = 'Input Modul Terlebih Dahulu';
        }
        //DATA
        $data['folder_admin']            = $this->admin_folder;
        $data['content_header']          = 'Sistem Module Create';
        $data['content_header_small']    = '';
        $data['breadcrumb_active']       = '<li class=active>Sistem Module</li>';
        $data['show_username']           = $this->session->userdata('namauser');
        

        $element = $this->admin_folder."module_form";
        //View
        template_lib($element, $data, '', $this->admin_folder);
    }
    
    public function create_action() 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $this->_rules();
        //$this->form_validation->set_rules('link', ' ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
        if($this->input->post('link',TRUE) == "")
        {
            $link = 0;
        }
        else{
            $link = $this->input->post('link');
        }
            $data = array(
		'nama_menu' => $this->input->post('nama_menu',TRUE),
		'link' => $link,
		//'jabatan' => $this->input->post('jabatan',TRUE),
		'parrent' => $this->input->post('parrent',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'icon' => $this->input->post('icon',TRUE),
	    );

            $this->module_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('owner/module'));
        }
    }
    
    public function update($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->module_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('owner/module/update_action'),
		'id_main' => set_value('id_main', $row->id_main),
		'nama_menu' => set_value('nama_menu', $row->nama_menu),
		'link' => set_value('link', $row->link),
		'jabatan' => set_value('jabatan', $row->jabatan),
		//'parrent' => set_value('parrent', $row->parrent),
		'urutan' => set_value('urutan', $row->urutan),
		'icon' => set_value('icon', $row->icon),
	    );

            $query_menu  = $this->module_model->get_parrent();
            $num_rows_menu = $this->module_model->total_get_parrent_rows();

            if(!empty($this->module_model->get_by_id($row->id_main)->nama_menu))
            {
                $data['parrent'][$row->parrent] = $this->module_model->get_by_id($row->parrent)->nama_menu;
            }

            if ($num_rows_menu > 0)
            {   
                foreach($query_menu as $row_menu)
                {   
                    if($this->input->post('parrent',TRUE) == $row_menu->id_main)
                    {   
                        $data['default']['parrent'] = $this->input->post('parrent',TRUE);
                        $data['parrent'][$row_menu->id_main] = $row_menu->nama_menu;
                    }
                    else{
                        $data['parrent'][$row_menu->id_main] = $row_menu->nama_menu;
                    }
                }
                $data['parrent'][0] = "Menu Induk";
            }
            else
            {
              $data['parrent'][''] = 'Input 1 menu Terlebih Dahulu';
            }
            //DATA
            $data['folder_admin']            = $this->admin_folder;
            $data['content_header']          = 'Sistem Module Update';
            $data['content_header_small']    = '';
            $data['breadcrumb_active']       = '<li class=active>Sistem Module</li>';
            $data['show_username']           = $this->session->userdata('namauser');
            

            $element = $this->admin_folder."module_form";
            //View
            template_lib($element, $data, '', $this->admin_folder);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/module'));
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
		//'jabatan' => $this->input->post('jabatan',TRUE),
		'parrent' => $this->input->post('parrent',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'icon' => $this->input->post('icon',TRUE),
	    );

            $this->module_model->update($this->input->post('id_main', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('owner/module'));
        }
    }
    
    public function delete($id) 
    {   
        $this->auth->is_jabatan($this->router->fetch_class());

        $row = $this->module_model->get_by_id($id);

        if ($row) {
            $this->module_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('owner/module'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('owner/module'));
        }
    }

    public function _rules() 
    {
        $this->auth->is_jabatan($this->router->fetch_class());
        
	$this->form_validation->set_rules('nama_menu', ' ', 'trim|required');
	//$this->form_validation->set_rules('jabatan', ' ', 'trim|required');
	//$this->form_validation->set_rules('parrent', ' ', 'trim');
	//$this->form_validation->set_rules('urutan', ' ', 'trim|required');
	$this->form_validation->set_rules('icon', ' ', 'trim');

	$this->form_validation->set_rules('id_main', 'id_main', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Sistem_module.php */
/* Location: ./application/controllers/Sistem_module.php */