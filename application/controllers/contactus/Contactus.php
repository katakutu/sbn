<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {
	var $sess;
	var $sessLang;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
	}

	/*
	* method untuk menampilkan halaman HELP.
	*/
	function index()
	{
		$session = $this->session->userdata('session');

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

		$this->load->view('contactus/contactus', $data);
	}

	function sendmail()
	{
		// $this->load->library('email');
		$session = $this->session->userdata('session');

		if (!empty($session)) {
			redirect('Login.jsp');
		}
		// $uid = $this->sess['iduser'];
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$handphone = $this->input->post('handphone');
		$message = $this->input->post('message');

		if($_POST)
		{
			// $sendmail = $this->sbn_email->email_contact($email,$name,$handphone,$message);
			$sendmaildb = $this->Email->insert_email_contactus($email, $name,$handphone,$message);
			if($sendmaildb){
				echo "<script>alert('Email Terkirim');</script>";
				$this->load->view('contactus/contactus', $data);	
			}else{
				echo "<script>alert('Email Gagal Terkirim');</script>";
				$this->load->view('contactus/contactus', $data);
			}
		}else{
			$this->load->view('contactus/contactus', $data);
		}
	}
}