<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	var $sess;
	var $sessLang;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
	}

	/*
	* method untuk redirect Ref API yang tidak terdaftar
	*/
	function index()
	{

		redirect('Login.jsp');
	}

	/*
	* method untuk validasi Ref API
	*/
	function validate($id = '', $code = '')
	{
		$api = $this->Regis->get_api($id, $code);

		if(empty($api->result()))
		{
			$data['response'] = 'msg_failed';
			$this->load->view('popup_pages/front/api_response', $data);
		}
		else
		{
			$result = $api->result();

			if($result[0]->STATUS == '1')
			{
				foreach ($api->result() as $row) {
					$api_refid = $row->REF_ID;
					$api_data = explode("|", $row->DATA);
				}

				if(substr($api_refid, 20, strlen($api_refid) - 20) == $id)
				{ 
					$this->Regis->update_aktivasi($api_data[1], $api_refid);
					$this->login_bypass($api_data[1]);
				}
			}
			else
			{
				$data['response'] = 'account_activated';
				$this->load->view('popup_pages/front/api_response', $data);
			}
		}
	}

	function login_bypass($handle)
	{
		$user = $this->User->get_username($handle);
		foreach ($user->result() as $row) {
			$loginretry = $row->WRGPASSWORD;
			$islogin = $row->LOGIN;
			$usertype = $row->USRTYPE;
			$userstatus = $row->STATUS;
			$uid = $row->ID;
			$sid = $row->SID;
			/* For Checking First Login */
			$prev_password = $row->PREVPASSWORD;
		}

		if($userstatus==1) 
		{
			$ip = $this->ibank_session->checking_ip();
			$max_login_retry = $this->Param->get_parameter("LOGIN_MAX_RETRY");
			foreach ($max_login_retry->result() as $row)
			{
				$login_max = $row->DATA;
			}
			
			if ($loginretry > intval($login_max))
			{				
				redirect ('lang_'.$this->session->userdata('session_lang').'.jsp/error_login_lock');
			}
			else
			{
				$menuheader = [];

				$str_menu = $this->Groupmenu->getListmenu($usertype)->IDMENU;
				$menu = explode("|", $str_menu);


				$groupmenu = $this->Groupmenu->identify_menuheader($menu);
				foreach ($groupmenu->result() as $index => $row)
				{
					$menuheader[$index] = $row->IDMENUHEADER;
				}
				
				$session = array(
					//'clientid' => $clientid, 
					'clienthandle' => '',
					//'clientsigner' => $clientsigner,
					'sid' => $sid, 
					'userid' => $handle,
					'iduser' => $uid,
					'userhandle' => $handle,
					'usertype' => $usertype,
					//'clienttype' => $clienttype,
					'menuheader' => $menuheader,
					'menu'	=> $menu,
					'token' => ''
					);

					$this->session->set_userdata('session', $session);
					$this->audit_website->write($session['iduser'], 0, 'LOGIN', '', date("Y-m-d H:i:s"));

					redirect('Home.jsp');
			}
		}
		else
		{
			redirect ('lang_'.$this->session->userdata('session_lang').'.jsp/error_login_lock');
		}
	}


}