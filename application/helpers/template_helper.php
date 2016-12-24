<?php

//TEMPALTE HELPER

if ( ! function_exists('element')) {
    
	//$element			= "master/list_member/list_member";

    function template_lib($view, $data = array(), $template = '', $folder = "") {
    	if($template == "")
    	{
    		$template = $folder."template";
    	}

        $ci = &get_instance();
        $data['view'] = $view;
        $ci->load->view($template, $data);
    }

    /*
		Keterangan :
		$view  		= halaman yang selalu berganti saat di load
		$data 		= berupa data-data, seperti tittle, content header, dll
		$template 	= halaman main template
		$folder 	= berupa folder admin maupun folder member atau folder pengunjung normal 	 

    */
}
 
/* End of file page_template_helper.php */
/* Location: ./system/helpers/page_template_helper.php */ 