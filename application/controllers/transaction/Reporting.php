<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting extends CI_Controller {
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
		$this->load->model(array('reportingtransaction_model'));
	}

	function daily()
	{
		$data['data'] = $this->reportingtransaction_model->get_daily();
		$this->load->view('transaction/reporting/daily', $data);
	}

	function final_transaction()
	{
		
	}
}

?>