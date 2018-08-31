<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personalize extends CI_Controller {
	var $sess;
	var $sessLang;
	var $functionid = 10;

	/*
	* method constructor untuk class login.
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
		$this->profile_mgt();
	}

	function profile_mgt($message = '', $additional = '')
	{
		$user['fid'] = $this->functionid;
		$user['additional'] = $additional;
		$user['message'] = $message;
		if ($message == 'msg_success'){
			$user['msg_type'] = 'success';
			$user['msg_icon'] = 'ok-sign';
		} else{
			$user['msg_type'] = 'danger';
			$user['msg_icon'] = 'remove-sign';
		}

		$criteria['id'] = $this->sess['iduser'];
		$criteria_sid['USERID'] = $this->sess['iduser'];

		$sql_query = $this->User->get_detail($criteria);
		$sql_query_sid = $this->User->get_detail_sid($criteria_sid);

		if($sql_query)
		{
			foreach ($sql_query ->result() as $row)
			{
				$user['id'] 					= $row->ID;
				$user['usertitle'] 				= $row->TITLE;
				$user['username'] 				= $row->NAME;
				$user['useridcard'] 			= $row->IDNUMBER;
				if($row->IDEXPIRED == 'Seumur Hidup')
				{
					$user['useridcardexpired'] 		= 'Seumur Hidup';
				}
				else
				{
					$useridcardexpired 				= new DateTime($row->IDEXPIRED);
					$user['useridcardexpired'] 		= $useridcardexpired->format('Y-m-d');
				}
				
				$user['useraddress'] 			= $row->ADDRESS;
				$user['userposition'] 			= $row->POSITION;
				$user['usertelephone'] 			= $row->PHONE;
				$user['userhandphone'] 			= $row->HANDPHONE;
				$user['useremail'] 				= $row->EMAIL;
				$userbirthdate 					= new DateTime($row->BIRTHDATE);
				$user['userbirthdate'] 			= $userbirthdate->format('Y-m-d');
				$user['userbirthplace']			= $row->BIRTHPLACE; 
			}
		}

		if($sql_query_sid)
		{
			foreach ($sql_query_sid -> result() as $row_sid) 
			{
				$user['useracc'] 				= $row_sid->NOMOR_REKENING;
				$user['usernationality']		= "Indonesia";
				$user['usernpwp']				= $row_sid->NOMOR_NPWP;
				$user['usertypeofwork']			= $row_sid->PEKERJAAN;
				$user['useraddress2']			= $row_sid->ALAMAT;
				$user['userprovince']			= $row_sid->PROVINSI;
				$user['usercity']				= $row_sid->KOTA;
			}
		}

		$this->load->view('personalize/profile_mgt', $user);
	}

	function confirm_profile()
	{
		$date = new Datetime('NOW');
		$data['userid'] = $this->sess['iduser'];
		$data['useridcardexpired'] = $this->input->post('USER_ID_CARD_EXPIRED');
		$data['userlastupdate'] = $date->format('Y-m-d H:i:s');
		$data['usertypeofwork2'] = $this->input->post('typeofwork_name');
		$data['useraddress2'] = $this->input->post('USER_ADDRESS');
		$data['usertelephone2'] = $this->input->post('USER_TELEPHONE');
		$data['userhandphone2'] = $this->input->post('USER_HANDPHONE');
		$data['useremail2'] = $this->input->post('USER_EMAIL');

		$config_validation = array(
			array( 'field'=>'USER_ID_CARD_EXPIRED','label'=>$this->lang->line('id card expiry date'),'rules'=> 'trim|required'),
			array( 'field'=>'USER_ADDRESS','label'=>$this->lang->line('address'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9.,\/\-+ ]+$/]'),
			array( 'field'=>'USER_HANDPHONE','label'=>$this->lang->line('mobile phone number'),'rules'=> 'trim|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'USER_TELEPHONE','label'=>$this->lang->line('phone number'),'rules'=> 'trim|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'USER_EMAIL','label'=>$this->lang->line('email'),'rules'=> 'trim|required|valid_email'),
		);

		$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run() == TRUE)
		{
			$updateprofile = $this->User->update_profile($data);

			$data_audit = json_encode($data);
			$this->audit_website->write($this->sess['iduser'], $this->functionid, 'CHANGE PASSWORD', $data_audit, date("Y-m-d H:i:s"));

			if($updateprofile)
			{
				flash_succ($this->lang->line("msg_success_edit_fa_200"));
			}
			else
			{
				flash_err($this->lang->line("msg_failed_401"));
			}

			$this->profile_mgt();
		}
		else
		{
			$this->profile_mgt();
		}
	}

	function password_mgt($message = '', $addition = '')
	{
		$data['fid'] = $this->functionid;

		$data['message'] = $message;
		$data['addition'] = $addition;
		if ($message == 'msg_success'){
			$data['msg_type'] = 'success';
			$data['msg_icon'] = 'ok-sign';
		} else{
			$data['msg_type'] = 'danger';
			$data['msg_icon'] = 'remove-sign';
		}

		$id = $this->sess['iduser'];
		$criteria['id'] = $id;
		$sql_query = $this->User->get_detail($criteria);
		if ($sql_query)
		{
			foreach ($sql_query ->result() as $row)
			{
				$data['passwordexpired'] = $row->EXPPASSWORD;
			}	
		}
		$dateexpiry = date('Y-m-d', strtotime($data['passwordexpired']));
		$datenow = date('Y-m-d');
		if ($datenow > $dateexpiry)
		{
			$alert = $this->lang->line('alert password');
			$data['alert_type'] = 'danger';
			$data['alert_icon'] = 'warning';
			$data['alert'] = $alert;
		}  
		else
		{
			$data['alert_type'] = '';
			$data['alert_icon'] = '';
			$alert = '';
			$data['alert'] = '';
		}
		$this->load->view('personalize/password_mgt', $data);
	}

	function first_login($message = '')
	{
		$data['message'] = $message;
		if ($message == 'msg_success'){
			$data['msg_type'] = 'success';
			$data['msg_icon'] = 'ok-sign';
		} else{
			$data['msg_type'] = 'danger';
			$data['msg_icon'] = 'remove-sign';
		}

		$this->load->view('front/registration/first_login', $data);
	}

	function change_password()
	{
		$data = array();
		$activity = $this->input->post('ACTIVITY_ID');
		$userid = $this->sess['userid'];
		$oldpassword = $this->input->post('OLD_PASSWORD');
		$newpassword = $this->input->post('NEW_PASSWORD');		
		$exppassword = $this->input->post('exppass');

		$query_user = $this->Regis->check_user_registered($userid);
		if ($query_user->num_rows() > 0)
		{
			foreach ($query_user->result() as $row)
			{
				$salt = $row->SALT;
				$password_now = $row->PASSWORD;
			}

			$passdata = $oldpassword;
			$password = md5($passdata);
			$password_check = md5($password . $salt);

			if($password_check == $password_now)
			{
				$passdata = $newpassword;
				$password = md5($passdata);
				$password_new = md5($password . $salt);

				$data['userid'] = $userid;
				$data['oldpassword'] = $password_now;
				$data['newpassword'] = $password_new;		
				$data['expiredpass'] = date('Y-m-d H:i:s', strtotime('+1 years'));	

				$updatePass = $this->Bank->update_password($data);

    			$this->audit_website->write($this->sess['iduser'], $this->functionid, 'CHANGE PASSWORD', '', date("Y-m-d H:i:s"));  
				
				if ($updatePass[0] == 400)
		       	{
		       		flash_err($this->lang->line("msg_failed_edit_investor_400"));
		       	}
		        else
		        {
					flash_succ($this->lang->line("msg_success_edit_pass_200"));
		        }
		        $this->password_mgt();
			}
			else
			{
				flash_err($this->lang->line("msg_fail_change_password_old_password"));
				$this->password_mgt();
			}
		}
		else
		{
			flash_err($this->lang->line("msg_failed_edit_investor_404"));
			$this->password_mgt();
		}
	}
}

?>