<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	var $sess;
	var $sessLang;

	/*
	* method constructor untuk class content.
	*/
	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
        $this->load->model(array('managementuser_model'));
	}

	function send_activation(){
		$data['data'] = $this->managementuser_model->get_all_activation();
		$this->load->view('manajemen/users/activation', $data);
        // var_dump($data['data']);
        // exit;
	}

	function psend_activation($id){
		$email = $this->get_email_user($id);
		$name = $this->get_name_user($id);
		$this->sbn_email->email_send_activation($email, $name);
        $this->session->set_flashdata('message', $this->lang->line('success_send_link_activation'));
            redirect('SendActivation.jsp');
	}

    function unlock()
    {
        $data['data'] = $this->managementuser_model->get_all_unlock();
		$this->load->view('manajemen/users/unlock', $data);
		// var_dump($data['data']);
  //       exit;
    }

    function punlock($id)
    {
        $this->managementuser_model->unlock($id);
        $this->session->set_flashdata('message', $this->lang->line('success_unlock'));
            redirect('UnlockUser.jsp');
    }

    function get_email_user(){
    	$this->db->select('EMAIL');
    	$this->db->from('user');
    	$this->db->where('ID', $id);
    	$query = $this->db->get('')->row();
    	return $query->EMAIL;
    }

    function get_name_user(){
    	$this->db->select('NAME');
    	$this->db->from('user');
    	$this->db->where('ID', $id);
    	$query = $this->db->get('')->row();
    	return $query->NAME;
    }
}

?>