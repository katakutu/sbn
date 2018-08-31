<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Director extends CI_Controller {
	var $sess;
	var $sessLang;

	/*
	* method constructor untuk class director.
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
		
	}
	
	function route($user_validator,$id)
	{
		$validator = base64_decode($user_validator);
		
		if ($validator == $this->sess['userid'])
		{
			$function = $this->Functions->get_function($id);
			foreach($function ->result() as $row)
			{
				$page = $row->LINK;
				$parent = $row->PARENT;
				$type_authority = $row->TYPE;
			}

			if ($type_authority == $this->sess['usertype'] || $type_authority == 0)
			{
				$validation = $this->Functions->get_function($parent);
				foreach($validation ->result() as $row)
				{
					$valid_auth = $row->TYPE;
				}

				if ($this->sess['userhandle'] == "ADMIN") $valid_auth = 1;

				//if ($valid_auth == $this->sess['clienttype'] || $valid_auth == 0) {
					redirect($page);
				//} else
					//$this->load->view('main/default');
			}
			else
				$this->load->view('main/default');
		}
		else
		{
			$this->load->view('main/default');
		}
	}
}