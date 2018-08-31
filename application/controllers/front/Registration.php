<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
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
	
	function index()
	{
		$session = $this->session->userdata('session');

		if (!empty($session)) {
			redirect('Login.jsp');
		}
		$termcond = $this->Termscontent->get_termscontent('termcond');
		$i=0;
		foreach ($termcond ->result() as $row) {
			$data['announcement_tab'][$i] = str_replace(",", "", $row->TAB);
			$data['announcement_title'][$i] = $this->lang->line($row->TITLE);
			$subtitle = str_replace("_", " ", $row->TAB);
			$data['announcement_icon'][$i] = '<i class="'.$row->ICON.'"></i>';
			$data['announcement_subtitle'][$i] = '<b>'.ucfirst($subtitle).'</b>';
			$data['announcement_content'][$i] = $row->CONTENT_ID;
			$i++;
		}
		$data['total_ann'] = $i;
		$this->load->view('front/registration/term_registration', $data);
	}

	function view($error = 0, $refnum = '', $data_post = null) // telah membaca persyaratan
	{
		if(!is_direct())
		{
			$session = $this->session->userdata('session');

			if (!empty($session)) {
				redirect('Login.jsp');
			}
			
			if(!empty($data_post)) {
				$data['post'] = $data_post;
			}

			$data['error'] = $error;
			$data['refnum'] = $refnum;
			$this->load->view('front/registration/registration', $data);
		} 
		else 
		{
			redirect(base_url().'Form.jsp/index');
		}
	}

	/*
	* method untuk memasukkan data registrasi
	*/
	function open()
	{

		// echo $this->input->post('statusktp'); die;
		$session = $this->session->userdata('session');

		if (!empty($session)) {
			redirect('Login.jsp');
		}

		$admin_name = preg_replace("/[^ \w]+/", "", $this->input->post('ADMIN_NAME'));

		$config_validation = array(
			array( 'field'=>'ADMIN_ACC','label'=>$this->lang->line('account_no'),'rules'=> 'trim|required|regex_match[/^[0-9,\/\-+]+$/]'),
			array( 'field'=>'ADMIN_NAME','label'=>$this->lang->line('full name'),'rules'=> 'trim|required'),
			array( 'field'=>'ADMIN_TEMPATLAHIR','label'=>$this->lang->line('place of birth'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9.,\/\-+ ]+$/]'),
			array( 'field'=>'ADMIN_TGLLHR','label'=>$this->lang->line('tgl lahir'),'rules'=> 'trim|required|regex_match[/^[0-9,\/\-+]+$/]'),
			array( 'field'=>'ADMIN_ID_CARD','label'=>$this->lang->line('id card number'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
			// array( 'field'=>'statusktp','label'=>$this->lang->line('id card expiry date'),'rules'=> 'trim|required|callback_select_validate'),
			array( 'field'=>'ADMIN_NPWP','label'=>$this->lang->line('npwp number'),'rules'=> 'trim|required|min_length[15]|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'typeofwork_name','label'=>$this->lang->line('typeofwork_name'),'rules'=> 'trim|required'),
			array( 'field'=>'ADMIN_ADDRESS','label'=>$this->lang->line('address'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9.,\/\-+ ]+$/]'),
			array( 'field'=>'province_name','label'=>$this->lang->line('province'),'rules'=> 'trim|required'),
			array( 'field'=>'city','label'=>$this->lang->line('city'),'rules'=> 'trim|required'),
			array( 'field'=>'ADMIN_TELEPHONE','label'=>$this->lang->line('phone number'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'ADMIN_HANDPHONE','label'=>$this->lang->line('mobile phone number'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'ADMIN_EMAIL','label'=>$this->lang->line('email'),'rules'=> 'trim|required|valid_email'),
			array( 'field'=>'ADMIN_PASSWORD','label'=>$this->lang->line('password'),'rules'=> 'trim|required'),
		);
		
		$this->form_validation->set_rules($config_validation);

		if($this->form_validation->run() == TRUE)
		{
			$date = new Datetime('NOW');

			/* Data User */
			$data['TITLE']						= $this->input->post('HID_TYPE_ADMIN_TITLE');
			$data['HANDLE']						= $this->input->post('ADMIN_EMAIL'); 
			$data['NAME']						= $admin_name;
			$data['CREATEDDATE']				= $date->format('Y-m-d H:i:s');
			$data['LASTUPDATE']					= $date->format('Y-m-d H:i:s');
			$data['BIRTHDATE']					= date("Y-m-d", strtotime($this->input->post('ADMIN_TGLLHR')));
			$data['BIRTHPLACE']					= $this->input->post('ADMIN_TEMPATLAHIR');
			
			if($data['TITLE'] == 'MR') { $data['GENDER'] = "1"; } else { $data['GENDER'] = "2"; }	
			
			$data['IDNUMBER'] 					= $this->input->post('ADMIN_ID_CARD');
			$data['IDTYPE']						= "1";
			// $data['IDEXPIRED']					= $this->input->post('statusktp');
			$testing = $this->input->post('statusktp');
			if($testing == '1')
			{
				$data['IDEXPIRED'] = $this->lang->line('lifetime');
			}else{
				$data['IDEXPIRED'] = date("Y-m-d h:i:s", strtotime($this->input->post('ADMIN_ID_CARD_EXPIRED')));
			}

			$data['NPWP']						= $this->input->post('ADMIN_NPWP');
			$data['ADDRESS']					= $this->input->post('ADMIN_ADDRESS');
			$data['PHONE']						= $this->input->post('ADMIN_TELEPHONE');
			$data['HANDPHONE']					= $this->input->post('ADMIN_HANDPHONE');
			$data['EMAIL']						= $this->input->post('ADMIN_EMAIL');
			$data['STATUS']						= "0";
			$data['DESCRIPTION']				= "INACTIVE";
			$data['USRTYPE']					= "1";
			$data['SALT']						= $this->input->post('ADMIN_NPWP');
			$passdata							= $this->input->post('ADMIN_PASSWORD');
			$password 							= md5($passdata);
			$data['PASSWORD'] 					= md5($password . $data['SALT']);
			$data['EXPPASSWORD'] 				= date('Y-m-d H:i:s', strtotime('+1 years'));
			$data['STATUS_REGISTER']			= "1";
			/* End of Data User */

			/* Data SID */
			$data_sid['KODE_BANK']				= "BRI01";
			$data_sid['NOMOR_REKENING']			= $this->input->post('ADMIN_ACC');
			$data_sid['NAMA']					= $admin_name;
			$data_sid['NOMOR_KTP']				= $this->input->post('ADMIN_ID_CARD');
			$data_sid['NOMOR_NPWP']				= $this->input->post('ADMIN_NPWP');
			$data_sid['TEMPAT_LAHIR']			= $this->input->post('ADMIN_TEMPATLAHIR');
			$data_sid['TANGGAL_LAHIR']			= date("Y-m-d H:i:s", strtotime($this->input->post('ADMIN_TGLLHR')));
			$data_sid['KEWARGANEGARAAN']		= "ID";
			$data_sid['TIPE_INVESTOR']			= "ID";

			if($data['TITLE'] == 'MR') { $data_sid['GENDER'] = "1"; } else { $data_sid['GENDER'] = "2"; }
			
			$data_sid['KODE_JENIS_PEKERJAAN']	= $this->input->post('typeofwork_code');
			$data_sid['PEKERJAAN']				= $this->input->post('typeofwork_name');
			$data_sid['KODE_NEGARA']			= "ID";
			$data_sid['NEGARA']					= "INDONESIA";
			$data_sid['KODE_PROVINSI']			= $this->input->post('province_code');
			$data_sid['PROVINSI']				= $this->input->post('province_name');	
			$data_sid['KODE_KOTA']				= $this->input->post('city_code');
			$data_sid['KOTA']					= $this->input->post('city');
			$data_sid['ALAMAT']					= $this->input->post('ADMIN_ADDRESS');
			$data_sid['NOMOR_TELEPON']			= $this->input->post('ADMIN_TELEPHONE');
			$data_sid['NOMOR_HANDPHONE']		= $this->input->post('ADMIN_HANDPHONE');
			$data_sid['EMAIL']					= $this->input->post('ADMIN_EMAIL');
			$data_sid['CREATEDDATE']			= $date->format('Y-m-d H:i:s');
			$data_sid['USERID']					= "";
			$data_sid['STATUS']					= "1";
			/* End of Data SID */

			/* Data Subreg */
			$data_sub['ID_NAME']				= "SRBRINIDJA";
			$data_sub['SID']					= "";
			$data_sub['NAMA']					= $admin_name;
			$data_sub['KTP']					= $this->input->post('ADMIN_ID_CARD');
			$data_sub['NPWP']					= $this->input->post('ADMIN_NPWP');
			$data_sub['KOTA_NAMA']				= $this->input->post('city');
			$data_sub['KOTA_KODE']				= $this->input->post('city_code');
			$data_sub['CREATEDDATE']			= $date->format('Y-m-d H:i:s');
			$data_sub['STATUS_PROCESS']			= "1";
			$data_sub['NOREK_REGISTER']			= $this->input->post('ADMIN_ACC');
			/* End of Data Subreg */

			// $dukcapil = $this->sbn_dukcapilapi->validate_ktp($this->input->post('ADMIN_ID_CARD'), $this->input->post('ADMIN_TGLLHR'));
			// //  print_r($dukcapil);
			// // die;
			// if($dukcapil)
			// {
				$query_user = $this->Regis->check_user_process_register($data['EMAIL']);
				if ($query_user->num_rows() > 0)
				{
					$data['error'] = 1;
					$data['refnum'] = 'email_registered';
					$this->load->view('popup_pages/front/registration_response', $data);
				}
				else
				{
					$dukcapil = $this->sbn_dukcapilapi->validate_ktp($this->input->post('ADMIN_ID_CARD'), $this->input->post('ADMIN_TGLLHR'));

					if(true)//if($dukcapil)
					{
						$user_id = $this->Regis->insert_user($data);
						if(trim($user_id)!=='')
						{
							$data_sid['USERID'] = $user_id;
							$data_sub['USERID'] = $user_id;

							$query_insert_sid		= $this->Regis->insert_sid($data_sid);
							$query_insert_subreg	= $this->Regis->insert_subreg($data_sub); 

							/* This for generate url activation
							$api_ref = $this->generate_link($data['EMAIL']);
							$api_url = base_url(). "display.return/api/" . substr($api_ref, 20, strlen($api_ref) - 20) . "/redirect/" . substr($api_ref, 0, 20) . ".java";
							*/

							$email_refnum = $this->sbn_email->email_register($data['EMAIL'], $data['NAME']);

							if($email_refnum)
							{
								$this->audit_website->write(0, 900002, 'REGISTRATION', $data['HANDLE'], date("Y-m-d H:i:s"));
								$data['error'] = 0;
								$data['refnum'] = 'register_success';
								$this->load->view('popup_pages/front/registration_response', $data);
							}
							else
							{
								$delete_user 		= $this->Regis->delete_user($data['HANDLE']);
								$delete_sid			= $this->Regis->delete_sid($data_sid['USERID']);
								$delete_subreg		= $this->Regis->delete_subreg($data_sid['USERID']);	

								if($delete_user)
								{
									$data['error'] = 1;
									$data['refnum'] = 'register_failed';
									$this->load->view('popup_pages/front/registration_response', $data);
								}
								else
								{
									$data['error'] = 1;
									$data['refnum'] = 'register_email_failed';
									$this->load->view('popup_pages/front/registration_response', $data);
								}
							}
						}
						else
						{
							$data['error'] = 1;
							$data['refnum'] = 'register_failed';
							$this->load->view('popup_pages/front/registration_response', $data);
						}
					}
					else
					{
						//$this->sbn_email->email_register_fail_dukcapil($data['EMAIL'], $data['NAME']);

						$data['error'] = 1;
						$data['refnum'] = 'register_failed_ktp';
						$this->load->view('popup_pages/front/registration_response', $data);
					}				
				}
			// } 
			// else
			// {
				
			// }
		}
		else
		{
			/* ADMIN PROFILE */
			$data['adminacc'] 				= $this->input->post('ADMIN_ACC');
			$data['admintitle'] 			= $this->input->post('HID_TYPE_ADMIN_TITLE');
			$data['adminname'] 				= $admin_name;
			$data['admintempatlahir']		= $this->input->post('ADMIN_TEMPATLAHIR');
			$data['admintgllhr'] 			= $this->input->post('ADMIN_TGLLHR');
			$data['admintypeid'] 			= $this->input->post('HID_TYPE_ADMIN_ID');
			$data['adminidcard'] 			= $this->input->post('ADMIN_ID_CARD');	
			$data['adminidcardexpired'] 	= $this->input->post('ADMIN_ID_CARD_EXPIRED');
			$data['adminnationality'] 		= $this->input->post('nationality_name');
			$data['adminnationalitycode'] 	= $this->input->post('nationality_code');
			$data['adminnpwp'] 				= $this->input->post('ADMIN_NPWP');
			$data['admintypeofworkname'] 	= $this->input->post('typeofwork_name');
			$data['admintypeofworkcode'] 	= $this->input->post('typeofwork_code');
			$data['adminaddress'] 			= $this->input->post('ADMIN_ADDRESS');
			$data['adminprovincename'] 		= $this->input->post('province_name');
			$data['adminprovincecode'] 		= $this->input->post('province_code');
			$data['admincityname'] 			= $this->input->post('city');
			$data['admincitycode'] 			= $this->input->post('city_code');
			$data['admintelephone'] 		= $this->input->post('ADMIN_TELEPHONE');
			$data['adminhandphone'] 		= $this->input->post('ADMIN_HANDPHONE');
			$data['adminemail'] 			= $this->input->post('ADMIN_EMAIL');
				
			$this->view(0, '', $data);
		}
	}

	function generate_link($email)
	{
		$now = new Datetime ('NOW');
		$date = $now->format('HisdmY');

		$code = $email . $date;
		$code_encrypt = substr(hash('sha256', $code), 0, 45);

		$data['REF_ID'] = $code_encrypt;
		$data['REFDATE'] = $now->format('Y-m-d H:i:s');
		$data['LASTUPDATE'] = $now->format('Y-m-d H:i:s');;
		$data['ACTIVITY'] = 'REGISTER';
		$data['DATA'] = 'REGISTER|' . $email;
		$data['STATUS'] = '1';
		$data['DESCRIPTION'] = 'ACTIVE';

		$query_insert = $this->Regis->insert_api($data);
		if($query_insert)
		{
			return $code_encrypt;
		}
	}

	function doInquiryAccount()
	{		
		$accountno = $this->input->post('accountno');
		$typeacc = substr($accountno, 12, 2);
		$typecurracc = substr($accountno, 4, 2);
		$acclength = strlen($accountno);

		$response['accountname'] = "";
		$response['accountstatus'] = "";
		$response['accountstatusdesc'] = "";
		$response['statuscode'] = "0002";
		$response['statusdesc'] = "";

		if($acclength !== 15)
		{
			$response['statusdesc'] = "Invalid Account Format.";
			echo json_encode($response); 
		}	
		else if($typeacc !== '50' && $typeacc !== '30' && $typeacc !== '56' && $typeacc !== '53')
		{
			$response['statusdesc'] = "Invalid Account Type. Only Saving Account or Current Account allowed.";
			echo json_encode($response); 
		}
		// else if ($typeacc !== '30')
		// {
		// 	$response['statusdesc'] = "Invalid Account Type. Only Saving Account or Current Account allowed." . $typeacc;
		// 	echo json_encode($response); 
		// }
		else if ($typecurracc !== '01')
		{
			$response['statusdesc'] = "Invalid Account Currency. Only Saving IDR Account allowed. " . $typeacc;
			echo json_encode($response);
		} 
		else
		{
			$account_detail = $this->sbn_briinterface->inquiry_account($accountno);
			echo json_encode($account_detail);
		}
	}
}
?>