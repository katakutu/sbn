<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investor extends CI_Controller {
	var $sess;
	var $sessLang;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
		$this->load->model(array('reportinginvestor_model'));
	}

	function statistic()
	{
		$data['data'] = $this->reportinginvestor_model->get_all();
		$this->load->view('reporting/investor/statistic', $data);
		// var_dump($data['data']);
		// exit;
	}

	function portofolio()
	{
		
	}
}

?>