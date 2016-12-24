<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

	public $admin_folder;
	public function __construct()
	{
		parent::__construct();
		$this->admin_folder = $this->config->item('admin_folder');
	}


	public function index()
	{	
		$this->auth->is_admin();

		//DATA
		$data['folder_admin'] 			= $this->admin_folder;
		$data['content_header'] 		= "Blank Page";
		$data['content_header_small'] 	= "Small Header";
		$data['breadcrumb_active'] 		= "<li class='active'>Blank Page</li>";
		$data['show_username'] 			= $this->session->userdata('namauser');
		
		$element = $this->admin_folder."blank";
		//View
		template_lib($element, $data, "", $this->admin_folder);
	}
}
