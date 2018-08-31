f<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {
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
	* method untuk menampilkan halaman lupa password.
	*/
	function index()
	{
		$session = $this->session->userdata('session');

		if (!empty($session)) {
			redirect('Login.jsp');
		}

		$this->load->view('front/forgot_password/forgot_password');	
	}

	/*
	* method untuk memasukkan data registrasi
	*/
	function open()
	{
		$session = $this->session->userdata('session');

		if (!empty($session)) {
			redirect('Login.jsp');
		}

		$config_validation = array(
		    array( 'field'=>'USERID','label'=>$this->lang->line('user id'),'rules'=> 'required'),
		);

		$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run() == TRUE)
		{
			try {
				$userhandle = strtolower($this->input->post('USERID'));

				$query_user = $this->Regis->check_user_registered($userhandle);
				if ($query_user->num_rows() > 0)
				{
					foreach ($query_user->result() as $row)
					{
						$salt = $row->SALT;
						$password_old = $row->PASSWORD;

						$email = $row->EMAIL;
						$name  = $row->NAME;
					}

					$passdata = $this->generateRandomString();
					$password = md5($passdata);
					$password_new = md5($password . $salt);

					$data['newpassword'] = $password_new;
					$data['userid'] 	 = $userhandle;
					$data['oldpassword'] = $password_old;	
					$data['expiredpass'] = date('Y-m-d H:i:s', strtotime('+1 years'));

					$updatePass = $this->Bank->update_password($data);

					if($updatePass)
					{
						$email_forget = $this->sbn_email->email_reset_password($email, $passdata, $name, $userhandle);
						if($email_forget)
						{
								$data['response'] = 'reset_password success';
				 				$this->load->view('popup_pages/front/forgot_password', $data);		
						}
					}
					else
					{
						$data['response'] = 'reset_password failed';
						$this->load->view('popup_pages/front/forgot_password', $data);
					}

				}
				else
				{
					$data['response'] = 'reset_password_file_not_found';
					$this->load->view('popup_pages/front/forgot_password', $data);
				}
			} catch (Exception $userhandle){
				// $this->Log_website->write('0', '0', 'FORGOT PASSWORD OPEN', $e->getMessage(), $userhandle."\r\n", date('Y-m-d H:i:s'));
				$this->index();
			}
		}
		else
		{
			$this->index();
		}
	}

	function generateRandomString($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
?>