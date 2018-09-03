<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {
	var $sess;
	var $sessLang;
	var $CI;
	var $functionid = 300;

	/*
	* method constructor untuk class content.
	*/
	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
		$this->load->model('managementcontent_model');
		$this->CI =& get_instance();
	}

	function index()
	{
		$data['data'] = $this->managementcontent_model->get_all();
		$this->load->view('manajemen/content/index', $data);
	}

	function add()
	{
		$upload_path = './content';  
        $upPath = $upload_path;
        if(!file_exists($upPath)) 
        {
            mkdir($upPath, 0777, true);
        }

        $config = array(
				        'upload_path' => $upPath,
				        'allowed_types' => "gif|jpg|png|jpeg",
				        'overwrite' => TRUE,
				        'max_size' => 2024, // (2 MB)
				        'file_name' => date('YmdHis')
        );

        $this->load->library('upload', $config);
        
        if(!$this->upload->do_upload('path_gambar'))
        { 
            $this->session->set_flashdata('error', $this->lang->line('message_image_content'));
            redirect('Content.jsp');
        }
        else
        {
            $imageDetailArray = $this->upload->data();
            $this->managementcontent_model->add($imageDetailArray);
            $this->session->set_flashdata('message', $this->lang->line('success_add_content'));
            redirect('Content.jsp');
        }

	}
	
}

?>