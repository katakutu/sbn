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
		if(isset($_POST['cari'])){
		  if(isset($_POST['tgl']) && $_POST['tgl']!=''){
		    $data['data'] = $this->reportingtransaction_model->get_daily($_POST['tgl']);	
		  } else {
		    $data['data'] = array();	
		  }
		  	
		} else {
		  $data['data'] = array();
		}
		
		$this->load->view('transaction/reporting/daily', $data);
	}

	function final_transaction()
	{
		if(isset($_POST['cari'])){
		  if(isset($_POST['tgl']) && $_POST['tgl']!=''){
			$data['data'] = $this->reportingtransaction_model->get_final_transaction_all($_POST['tgl']);
		  } else {
		  	$data['data'] = array();
		  }
		} else {
			$data['data'] = array();
		}
		$this->load->view('transaction/reporting/final', $data);
		// var_dump($data['data']);
		// exit();
	}
}

?>