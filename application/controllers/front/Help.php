<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {
	var $sess;
	var $sessLang;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		$this->sessLang = $this->session->userdata('session_lang');
	}

	/*
	* method untuk menampilkan halaman HELP.
	*/
	function index()
	{
		$session = $this->session->userdata('session');

		if (!empty($session)) {
			redirect('Login.jsp');
		}

		$content = $this->Termscontent->get_termscontent('demotutorial');
		$i = 0;
		foreach ($content ->result() as $row) {
			$data['announcement_tab'][$i] = str_replace(",", "", $row->TAB);
			$data['announcement_title'][$i] = $this->lang->line($row->TITLE);
			$subtitle = str_replace("_", " ", $row->TAB);
			$data['announcement_icon'][$i] = '<i class="'.$row->ICON.'"></i>';
			$data['announcement_subtitle'][$i] = '<b>'.$subtitle.'</b>';
			$data['announcement_content'][$i] = $row->CONTENT_ID;
			$i++;
		}
		$data['total_ann'] = $i;

		$this->load->view('front/help/help', $data);
	}
}