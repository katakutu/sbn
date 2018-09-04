<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
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
	}

	function index()
	{
		$this->load->view('contactus/faq', $data);
	}
}

?>