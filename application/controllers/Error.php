<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	/*
	* method constructor untuk class error.
	*/
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		
	}
	
	function direction($parent = 'general', $page = 'IBNK404')
	{
		$this->load->view('errors/'.$parent.'/'.$page);
	}
}