<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
		// $this->load->view('manajemen/user/reactivation', $data);
        var_dump($data['data']);
        exit;
	}

    function unlock()
    {
        $data['data'] = $this->managementuser_model->get_unlock();
        $this->load->view('manajemen/user/unlock', $data);
    }
}

?>