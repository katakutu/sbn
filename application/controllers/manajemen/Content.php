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
		$to_month = date('m');
		$to_year = date('Y');
		$upload_path = './content';  
        $upPath = $upload_path;
        if(!file_exists($upPath)) 
        {
            mkdir($upPath, 0777, true);
        }

        if(!file_exists($upload_path.'/'.$to_year)) 
        {
            mkdir($upload_path.'/'.$to_year, 0777, true);
        }

        if(!file_exists($upload_path.'/'.$to_year.'/'.$to_month)) 
        {
            mkdir($upload_path.'/'.$to_year.'/'.$to_month, 0777, true);
        }

        $config = array(
				        'upload_path' => $upload_path.'/'.$to_year.'/'.$to_month,
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

	function change()
	{
		$id = $this->input->post('id');
		$to_month = date('m');
		$to_year = date('Y');
		$upload_path = './content';  
        $upPath = $upload_path;
        if(!file_exists($upPath)) 
        {
            mkdir($upPath, 0777, true);
        }

        if(!file_exists($upload_path.'/'.$to_year)) 
        {
            mkdir($upload_path.'/'.$to_year, 0777, true);
        }

        if(!file_exists($upload_path.'/'.$to_year.'/'.$to_month)) 
        {
            mkdir($upload_path.'/'.$to_year.'/'.$to_month, 0777, true);
        }

        $path_gambar_lama = $this->input->post('path_gambar_lama');
        if($path_gambar_lama != '' || $path_gambar_lama != NULL){
        	$pecah_gambar = explode('.', $path_gambar_lama);
        	$eliminasi = $pecah_gambar[0];
        	$u_tahun = substr($eliminasi,0,4);
        	$u_bulan = substr($eliminasi,5,2);
        	unlink($upPath.'/'.$u_tahun.'/'.$u_bulan.'/'.$path_gambar_lama);
        }

        $config = array(
				        'upload_path' => $upload_path.'/'.$to_year.'/'.$to_month,
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
            $this->managementcontent_model->change($id, $imageDetailArray);
            $this->session->set_flashdata('message', $this->lang->line('success_update_content'));
            redirect('Content.jsp');
        }

	}

	function update(){
		$id = $this->input->post('id');
		$this->managementcontent_model->update($id);
		$this->session->set_flashdata('message', $this->lang->line('success_update_content'));
            redirect('Content.jsp');
	}
	
	function delete(){
		$id = $this->input->post('id');
		$this->managementcontent_model->delete($id);
		$this->session->set_flashdata('message', $this->lang->line('success_delete_content'));
            redirect('Content.jsp');
	}
}

?>