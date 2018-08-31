
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');	
	}

	/*
	* method untuk menampilkan halaman login.
	*/
	function index($lang='id', $message = '')
	{
		$session = $this->session->userdata('session');
		
		if (!empty($session)) {
			$this->logout();
		}

		$this->session->set_userdata('session_lang', $lang);
		$this->lang->load('message', $lang);
		$latestinfo = $this->Termscontent->get_termscontent('latestinfo');
		$data['latestinfo'] = $latestinfo->result()[0]->CONTENT_ID;
		$data['message'] = $message;

		$this->load->view('login', $data);
	}

	/*
	* method untuk membuat captcha.
	*/
	function captcha()
	{
		ob_clean();
		// $img = imagecreatefrompng(base_url().'/images/bg_captcha.png');
		$img = imagecreatefrompng(FCPATH.'/images/bg_captcha.png');
		$randomnum = substr(str_shuffle('0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'), 0, 6);
		$this->session->set_userdata('captcha', $randomnum);
		$white = imagecolorallocate($img, 0, 0, 0);
		
		for ($i=0;$i<6;$i++)
		{
			if ($i == substr(str_shuffle('0123'), 0, 1))
				$size[$i] = 18;
			else if ($i == substr(str_shuffle('0123'), 0, 1))
				$size[$i] = 18;
			else
				$size[$i] = 21;
		}
		
		imagettftext($img, $size[0], 0, 5, 25, $white, dirname(__FILE__) . '/../../system/fonts/texb.ttf', $randomnum[0]);
		imagettftext($img, $size[1], 0, 25, 25, $white, dirname(__FILE__) . '/../../system/fonts/texb.ttf', $randomnum[1]);
		imagettftext($img, $size[2], 0, 45, 25, $white, dirname(__FILE__) . '/../../system/fonts/texb.ttf', $randomnum[2]);
		imagettftext($img, $size[3], 0, 65, 25, $white, dirname(__FILE__) . '/../../system/fonts/texb.ttf', $randomnum[3]);
		imagettftext($img, $size[4], 0, 85, 25, $white, dirname(__FILE__) . '/../../system/fonts/texb.ttf', $randomnum[4]);
		imagettftext($img, $size[5], 0, 100, 25, $white, dirname(__FILE__) . '/../../system/fonts/texb.ttf', $randomnum[5]);
		
		header("Content-type: image/png");
		imagepng($img);
		imagedestroy($img);
	}

	/*
	* method untuk login.
	*/
	function login()
	{
		$clienthandle = $this->input->post('corpid');
		$userid = $this->input->post('userid');
		$password = $this->input->post('password');
		$passcode = $this->input->post('passcode');

		try
		{
			if ($passcode == $this->session->userdata('captcha'))
			{
				$user = $this->User->get_username($userid);
				//print_r($user->result());die();
				foreach ($user->result() as $row)
				{
					$loginretry = $row->WRGPASSWORD;
					$islogin = $row->LOGIN;
					$usertype = $row->USRTYPE;
					$userstatus = $row->STATUS;
					$uid = $row->ID;
					$sid = $row->SID;
					/* For Checking First Login */
					$prev_password = $row->PREVPASSWORD;
					$passcode = $row->SALT;
				}

				if($userstatus==1) 
				{
					$ip = $this->ibank_session->checking_ip();
					$max_login_retry = $this->Param->get_parameter("LOGIN_MAX_RETRY");
					foreach ($max_login_retry->result() as $row)
					{
						$login_max = $row->DATA;
					}

					//if ($loginretry > intval($login_max))
					if(false)	
					{			
						redirect ('lang_'.$this->session->userdata('session_lang').'.jsp/error_login_lock');
					}
					else
					{
						$loginresult = $this->User->do_login($userid, $password, $passcode);

						if($loginresult == 'success')
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
								'clienthandle' => $clienthandle,
								'sid' => $sid, 
								'userid' => $userid,
								'iduser' => $uid,
								'userhandle' => $userid,
								'usertype' => $usertype,
								'menuheader' => $menuheader,
								'menu'	=> $menu,
								'token' => ''
								);

							$this->session->set_userdata('session', $session);
							$this->audit_website->write($session['iduser'], 0, 'LOGIN', implode(" ## ", $session), date("Y-m-d H:i:s"));
							
							redirect('Home.jsp');

						}
						elseif($loginresult == 'already_login')
						{
								
							redirect ('lang_'.$this->session->userdata('session_lang').'.jsp/error_login_used');
						}

						elseif($loginresult == 'wrong_pass')
						{
							redirect('lang_'.$this->session->userdata('session_lang').'.jsp/error_login');
						}
						else
						{
							redirect('lang_'.$this->session->userdata('session_lang').'.jsp/error_login_authority');
						}
					}
				}
				else
				{
					redirect ('lang_'.$this->session->userdata('session_lang').'.jsp/error_login');
				}
			}
			else
			{
				redirect('lang_'.$this->session->userdata('session_lang').'.jsp/error_login');
			}
		}
		catch (Exception $ex)
		{
			// $this->log_website->write($clienthandle.'/'.$userhandle, 'LOGIN', $ex->getMessage().' ::: '.$ex->getCode(), 'CLIENT => '.$clienthandle.' :: USER => '.$userhandle, date("Y-m-d H:i:s"));
			redirect('lang_'.$this->session->userdata('session_lang').'.jsp/error_login');
		}
	}

	/*
	* method untuk logout.
	*/
	function logout()
	{
		$sess = $this->session->userdata('session');
		$userid = $sess['userid'];

		//$this->audit_website->write($sess['userid'], 0, 'LOGOUT', implode(" ## ", $sess), date("Y-m-d H:i:s"));
		// $this->audit_website->write($sess['userid'], 0, 'LOGOUT', '', date("Y-m-d H:i:s"));
		
		if (!empty($sess)) {
			$this->User->do_logout($userid);
		}
		
		$this->session->sess_destroy();
		redirect('Login.jsp');
	}
}
