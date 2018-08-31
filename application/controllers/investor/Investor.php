<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investor extends CI_Controller {
	var $sess;
	var $sessLang;
	var $functionid = 100;
	var $fid_investor = 100;
	var $fid_fund_account = 110;
	var $fid_sec_account = 120;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
		$this->load->model(array('Investor_model'));
		$this->CI =& get_instance();
	}

	function index()
	{
		$this->add_investor();
	}


	/* ===== Function INVESTOR ===== */

	function add_investor()
    {
    	$Uid = $this->sess['iduser'];
    	$Sid = $this->sess['sid'];
    	$result = $this->Investor_model->get_investor_detail($Uid);
    	if ($result == NULL)
    	{
    		/* Check investor registered in API */
    		$url2 = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/'.$Sid;
	    	$resultdata_investor = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url2);

	    	if(array_key_exists("JenisKelamin", $resultdata_investor))
	    	{
	    		$resultdata_investor['uid'] = $Uid;

				if($this->Investor_model->insert_investor_exist($resultdata_investor))
	            {
					flash_err($this->lang->line("msg_failed_add_investor_registered")); 
	    			$this->load->view('investor/message');
	            }
	            else
	            {
					flash_err($this->lang->line("msg_failed_add_investor_missing"));
	            }
	    	}
	    	else
	    	{
	    		if($this->input->post('submit'))
			    {
			    	$config_validation = array(
						array( 'field'=>'sid','label'=>$this->lang->line('sid'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
						array( 'field'=>'fullname','label'=>$this->lang->line('full name'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
						array( 'field'=>'idcardno','label'=>$this->lang->line('id card no'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
						array( 'field'=>'placeofbirth','label'=>$this->lang->line('place of birth'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
						array( 'field'=>'dateofbirth','label'=>$this->lang->line('date of birth'),'rules'=> 'trim|required|max_length[10]|regex_match[/^[0-9,\/\-+]+$/]'),
						//array( 'field'=>'gender','label'=>$this->lang->line('gender'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
						array( 'field'=>'typeofwork_code','label'=>$this->lang->line('typeofwork_name'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
						array( 'field'=>'address','label'=>$this->lang->line('address'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9.,\/\-+ ]+$/]'),
						array( 'field'=>'province_code','label'=>$this->lang->line('province'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
						array( 'field'=>'city_code','label'=>$this->lang->line('city'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
						array( 'field'=>'mobilephone','label'=>$this->lang->line('mobile phone number'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
						array( 'field'=>'telp','label'=>$this->lang->line('phone number'),'rules'=> 'trim|regex_match[/^[0-9]+$/]'),
						array( 'field'=>'email','label'=>$this->lang->line('email'),'rules'=> 'trim|required|valid_email'),
					);

			    	$data['uid'] = $this->sess['iduser'];
			        $data['Sid'] = $this->input->post('sid');
			        $data['Nama'] = $this->input->post('fullname');
			        $data['NoIdentitas'] = $this->input->post('idcardno');                        
			        $data['TempatLahir'] = $this->input->post('placeofbirth');
			        $data['TglLahir'] = $this->input->post('dateofbirth');
			        $data['KdJenisKelamin'] = $this->input->post('HID_gender');
			        $data['KdPekerjaan'] = $this->input->post('typeofwork_code');
			        $data['Alamat'] = $this->input->post('address');
			        $data['KdKota'] = $this->input->post('city_code');
			        $data['province'] = $this->input->post('province_code');
			        $data['NoHp'] = $this->input->post('mobilephone');
			        $data['NoTelp'] = $this->input->post('telp');
			        $data['Email'] = $this->input->post('email');
			        $data['Title'] = $this->input->post('HID_TYPE_USER_TITLE');
		            if($data['Title'] == 'MR') { $data['KdJenisKelamin'] = "1"; } else { $data['KdJenisKelamin'] = "2"; }	

		            $tgllahir_formatted = date("Y-m-d\TH:i:s\Z", strtotime($this->input->post('dateofbirth')));

			        $dataArray = array(
						'Sid' => $this->input->post('sid'),
						'Nama' => $this->input->post('fullname'),
						'NoIdentitas' => $this->input->post('idcardno'),                        
						'TempatLahir' => $this->input->post('placeofbirth'),
						'TglLahir' => $tgllahir_formatted,
						'KdJenisKelamin' => $data['KdJenisKelamin'],
						'KdPekerjaan' => $this->input->post('typeofwork_code'),
						'Alamat' => $this->input->post('address'),
						'KdKota' => $this->input->post('city_code'),
						'NoHp' => $this->input->post('mobilephone'),
						'NoTelp' => $this->input->post('telp'),
						'Email' => $this->input->post('email')
					);

		            $this->form_validation->set_rules($config_validation);
			        if($this->form_validation->run() == TRUE)
			        {
			        	/* Data API */
			        	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor';
			        	$data_string = json_encode($dataArray);
						$data_string_clean = str_replace(' ', '',$data_string);
						$data_string_clean = str_replace('\r', '',$data_string_clean);
						$data_string_clean = str_replace('\n', '',$data_string_clean);
						$data_string_clean = str_replace('\t', '',$data_string_clean);
						$data_string_clean = str_replace('\\', '',$data_string_clean);
						/* End */

						$resultdata = $this->sbn_kemenkeuapi->post_data_api($url, $data_string ,$data_string_clean);

						$this->audit_website->write($this->sess['iduser'], $this->fid_investor, 'ADD INVESTOR', implode(" ## ", $resultdata), date("Y-m-d H:i:s"));

			        	if ($resultdata[0] == 409)
				        {
							flash_err($this->lang->line("msg_failed_add_investor_409"));
				        }
				        else if ($resultdata[0] == 400)
				       	{
				       		flash_err($this->lang->line("msg_failed_add_investor_400"));
				       	}
				       	else if ($resultdata[0] == 201)
				       	{
				       		$resultbody = json_decode($resultdata[1], true);
				            if($this->Investor_model->insert_investor($resultbody, $data))
				            {
								flash_succ($this->lang->line("msg_success_add_investor_201"));
				            }
				            else
				            {
								flash_err($this->lang->line("msg_failed_add_investor_missing"));
				            }
				        }
				        else
				        {
							flash_err($this->lang->line("msg_failed_400"));
				        }
				    }
				    else
			        {
						flash_err($this->lang->line("msg_failed_add_investor_400"));
			        }

			         $this->load->view('investor/add_investor', $data);

		       	}
		       	else
		       	{
		       		$data_sid = $this->Investor_model->get_user_sid($Uid);
		       		if($data_sid <> NULL)
		       		{
		       			$data['Sid'] = $data_sid[0]['SID'];
		       		}
		       		else
		       		{
		       			$data['Sid'] = '';
		       		}
	    			 
		       		$criteria['handle'] = $this->sess['userid'];
					$sql_query = $this->User->get_detail($criteria);

					if ($sql_query)
					{
						foreach ($sql_query->result() as $row)
						{
							$data['KdJenisKelamin'] = $row->GENDER;
							$data['Nama'] = $row->NAME;
							$data['NoIdentitas'] = $row->IDNUMBER;      				
							$userbirthdate = new DateTime($row->BIRTHDATE);
							$data['TglLahir'] = $userbirthdate->format('Y-m-d');
							$data['TempatLahir'] = $row->BIRTHPLACE;
							$data['Alamat'] = $row->ADDRESS;
							$data['NoTelp'] = $row->PHONE;
							$data['NoHp'] = $row->HANDPHONE;
							$data['Email'] = $row->EMAIL;
							$data['Title'] = $row->TITLE;
						}
					}

		       		$this->load->view('investor/add_investor', $data);
		       	}
	    	}  	   
		}
		else
		{
	    	flash_err($this->lang->line("msg_failed_add_investor_registered")); 
	    	$this->load->view('investor/message');
		}
    }
   
    function edit_investor()
    {
    	$Uid = $this->sess['iduser'];
    	$result = $this->Investor_model->get_investor_detail($Uid);

    	if ($result != NULL)
    	{
	    	$data = array();
	        if($this->input->post('submit'))
	        {

	        	$config_validation = array(
					array( 'field'=>'sid','label'=>$this->lang->line('sid'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
					array( 'field'=>'fullname','label'=>$this->lang->line('full name'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
					array( 'field'=>'idcardno','label'=>$this->lang->line('id card no'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
					array( 'field'=>'placeofbirth','label'=>$this->lang->line('place of birth'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
					array( 'field'=>'dateofbirth','label'=>$this->lang->line('date of birth'),'rules'=> 'trim|required|max_length[10]|regex_match[/^[0-9,\/\-+]+$/]'),
					//array( 'field'=>'gender','label'=>$this->lang->line('gender'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
					array( 'field'=>'typeofwork_code','label'=>$this->lang->line('typeofwork_name'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
					array( 'field'=>'address','label'=>$this->lang->line('address'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9.,\/\-+ ]+$/]'),
					array( 'field'=>'province_code','label'=>$this->lang->line('province_name'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
					array( 'field'=>'city_code','label'=>$this->lang->line('city_name'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
					array( 'field'=>'mobilephone','label'=>$this->lang->line('mobile phone number'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
					array( 'field'=>'telp','label'=>$this->lang->line('phone number'),'rules'=> 'trim|regex_match[/^[0-9]+$/]'),
					array( 'field'=>'email','label'=>$this->lang->line('email'),'rules'=> 'trim|required|valid_email'),
				);

	        	$data['uid'] = $this->sess['iduser'];
	            $data['Sid'] = $this->input->post('sid');
	            $data['Nama'] = $this->input->post('fullname');
	            $data['NoIdentitas'] = $this->input->post('idcardno');                        
	            $data['TempatLahir'] = $this->input->post('placeofbirth');
	            $data['TglLahir'] = $this->input->post('dateofbirth');
	            $data['KdJenisKelamin'] = $this->input->post('HID_gender');
	            $data['KdPekerjaan'] = $this->input->post('typeofwork_code');
	            $data['Alamat'] = $this->input->post('address');
	            $data['KdKota'] = $this->input->post('city_code');
	            $data['province'] = $this->input->post('province_code');
	            $data['NoHp'] = $this->input->post('mobilephone');
	            $data['NoTelp'] = $this->input->post('telp');
	            $data['Email'] = $this->input->post('email');

	            $dataArray = array(
					'Sid' => $this->input->post('sid'),
					'Nama' => $this->input->post('fullname'),
					'NoIdentitas' => $this->input->post('idcardno'),                        
					'TempatLahir' => $this->input->post('placeofbirth'),
					'TglLahir' => $this->input->post('dateofbirth'),
					'KdJenisKelamin' => $this->input->post('HID_gender'),
					'KdPekerjaan' => $this->input->post('typeofwork_code'),
					'Alamat' => $this->input->post('address'),
					'KdKota' => $this->input->post('city_code'),
					'NoHp' => $this->input->post('mobilephone'),
					'NoTelp' => $this->input->post('telp'),
					'Email' => $this->input->post('email')
				);

			    $this->form_validation->set_rules($config_validation);
		        if($this->form_validation->run() == TRUE)
		        {
		        	$investor_valid = $this->Investor_model->check_user_investor($this->sess['iduser'], $data['Sid']);
					if ($investor_valid->num_rows() > 0)
					{
						/* Data API */
			        	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/'.$dataArray['Sid'];
			        	$data_string = json_encode($dataArray);
						$data_string_clean = str_replace(' ', '',$data_string);
						$data_string_clean = str_replace('\r', '',$data_string_clean);
						$data_string_clean = str_replace('\n', '',$data_string_clean);
						$data_string_clean = str_replace('\t', '',$data_string_clean);
						$data_string_clean = str_replace('\\', '',$data_string_clean);
						/* End */

			        	$resultdata = $this->sbn_kemenkeuapi->put_data_api($url, $data_string, $data_string_clean);

			        	$this->audit_website->write($this->sess['iduser'], $this->fid_investor, 'EDIT INVESTOR', implode(" ## ", $resultdata), date("Y-m-d H:i:s")); 

			        	if ($resultdata[0] == 404)
				        {
							flash_err($this->lang->line("msg_failed_edit_investor_404"));
				        }
				        else if ($resultdata[0] == 400)
				       	{
				       		flash_err($this->lang->line("msg_failed_edit_investor_400"));
				       	}
				       	else if ($resultdata[0] == 200)
				       	{
				       		$resultbody = json_decode($resultdata[1], true);
				            if($this->Investor_model->edit_investor($resultbody, $data))
				            {
								flash_succ($this->lang->line("msg_success_edit_investor_200"));
				            }
				            else
				            {
								flash_err($this->lang->line("msg_failed_edit_investor_missing"));
				            }
				        }
				        else
				        {
							flash_err($this->lang->line("msg_failed_400"));
				        }
					}
					else
					{
						flash_err($this->lang->line("unauthorized investor"));
					}   	
			    }
			    else
		        {
					flash_err($this->lang->line("msg_failed_edit_investor_400"));
		        }
	        }
	        else if($this->input->post('inactive'))
	        {
	        	$Sid = $this->input->post('sid');

	        	$config_validation = array(	
	        			array( 'field'=>'sid','label'=>$this->lang->line('sid'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),			
				);

	            $this->form_validation->set_rules($config_validation);
	            if($this->form_validation->run() == TRUE)
	            {
	            	$investor_valid = $this->Investor_model->check_user_investor($this->sess['iduser'], $Sid);
					if ($investor_valid->num_rows() > 0)
					{
						$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/'.$Sid.'/deactivate';

		            	$resultdata = $this->sbn_kemenkeuapi->put_data_api($url, $Sid, '""');

		            	$this->audit_website->write($this->sess['iduser'], $this->fid_investor, 'DEACTIVATE INVESTOR', implode(" ## ", $resultdata), date("Y-m-d H:i:s"));

		            	if ($resultdata[0] == 404)
				        {
							flash_err($this->lang->line("msg_failed_edit_investor_404"));
				        }
				       	else if ($resultdata[0] == 200)
				       	{
				       		$resultbody = json_decode($resultdata[1], true);
			                if($this->Investor_model->deactivate_investor($resultbody))
			                {
								flash_succ($this->lang->line("msg_success_inactive_investor"));
			                }
			                else
			                {
			                	flash_err($this->lang->line("msg_failed_inactive_investor"));
			                }
			            }
				        else
				        {
							flash_err($this->lang->line("msg_failed_400"));
				        }
					}
					else
					{
						flash_err($this->lang->line("unauthorized investor"));
					}
	            }
			    else
		        {
					flash_err($this->lang->line("msg_failed_400"));
		        }
	        }
	        else if($this->input->post('active'))
	        {
	        	$Sid = $this->input->post('sid');

	        	$config_validation = array(	
	        			array( 'field'=>'sid','label'=>$this->lang->line('sid'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),			
				);

	            $this->form_validation->set_rules($config_validation);
	            if($this->form_validation->run() == TRUE)
	            {
	            	$investor_valid = $this->Investor_model->check_user_investor($this->sess['iduser'], $Sid);
					if ($investor_valid->num_rows() > 0)
					{
						$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/'.$Sid.'/activate';
						$resultdata = $this->sbn_kemenkeuapi->put_data_api($url, $Sid, '""');

						$this->audit_website->write($this->sess['iduser'], $this->fid_investor, 'ACTIVATE INVESTOR', implode(" ## ", $resultdata), date("Y-m-d H:i:s"));

		            	if ($resultdata[0] == 404)
				        {
							flash_err($this->lang->line("msg_failed_edit_investor_404"));
				        }
				       	else if ($resultdata[0] == 200)
				       	{
				       		$resultbody = json_decode($resultdata[1], true);
			                if($this->Investor_model->activate_investor($resultbody))
			                {
								flash_succ($this->lang->line("msg_success_active_investor"));
			                }
			                else
			                {
			                	flash_err($this->lang->line("msg_failed_active_investor"));
			                }
			            }
				        else
				        {
							flash_err($this->lang->line("msg_failed_400"));
				        }
					}
					else
					{
						flash_err($this->lang->line("unauthorized investor"));
					}
	            	
	            }
			    else
		        {
					flash_err($this->lang->line("msg_failed_400"));
		        }
	        }
        
	        $uid = $this->sess['iduser'];
	        $sql_query = $this->Investor_model->get_investor_detail($uid);
			foreach ($sql_query as $row)
			{
				$data['sid'] = $row->sid;
				$data['gender'] = $row->gender;  
				$data['gender_code'] = $row->gender_code;  
	            $data['fullname'] = $row->fullname;  
	            $data['idcard_no'] = $row->idcard_no;                        
	            $data['placeofbirth'] = $row->placeofbirth;    
	            $data['dateofbirth'] = date('Y-m-d', strtotime($row->dateofbirth));
	            $data['typeofwork_code'] = $row->typeofwork_code; 
	            $data['typeofwork_name'] = $row->typeofwork_name; 
	            $data['address'] = $row->address; 
	            $data['province_code'] = $row->province_code; 
	            $data['province'] = $row->province; 
	            $data['city'] = $row->city; 
	            $data['city_code'] = $row->city_code; 
	            $data['mobilephone_no'] =  $row->mobilephone_no; 
	            $data['phone_no'] =  $row->phone_no; 
	            $data['email'] =  $row->email; 
	            $data['status'] =  $row->status; 

			}

			$this->load->view('investor/edit_investor', $data); 
		} 
		else
	    {
	    	flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	} 
    }

     function filter_view($message = '', $addition = '')
	{
		$uid = $this->sess['iduser'];
		$result_investor = $this->Investor_model->get_investor_detail($uid);
		if ($result_investor <> NULL)
    	{
    		foreach ($result_investor as $row) 
    		{
    			$sid = $row->sid;
    		}

	    	/* Data API */
	    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/'.$sid;
			/* End */
	    	$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url);

	    	
	    	$data_audit = json_encode($data);
	    	$this->audit_website->write($this->sess['iduser'], $this->fid_investor, 'DETAIL INVESTOR', $data_audit, date("Y-m-d H:i:s")); 

			$this->load->view('investor/filter_investor', $data);
    	}
    	else
    	{
    		flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	}	
	}

    function filter_view_old($message = '', $addition = '')
	{
		$Uid = $this->sess['iduser'];
    	$result = $this->Investor_model->get_investor_detail($Uid);
    	if ($result <> NULL)
    	{
    		$data['fid'] = $this->functionid;
			$data['message'] = $message;
			$data['addition'] = strtolower($addition);
			if ($message == 'msg_success'){
				$data['msg_type'] = 'success';
				$data['msg_icon'] = 'ok-sign';
			} else{
				$data['msg_type'] = 'danger';
				$data['msg_icon'] = 'remove-sign';
			}
			$this->load->view('investor/filter', $data);
    	}
    	else
    	{
    		flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	}	
	}

    function query_filter()
    {
    	$userid = $this->sess['iduser'];
		$this->Bank->get_datatable_investor($userid);
  		echo $this->datatables->generate();
    }

    function investor_detail()
	{
		$id = $this->input->post('identifier');

    	/* Data API */
    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/'.$id;
		/* End */
    	$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url);

    	
    	$data_audit = json_encode($data);
    	$this->audit_website->write($this->sess['iduser'], $this->fid_investor, 'DETAIL INVESTOR', $data_audit, date("Y-m-d H:i:s")); 

		$this->load->view('popup_pages/list_filter_investor', $data);
	}

	/* ===== End Function INVESTOR ===== */

	/* ===== Function FUND ACCOUNT ===== */

	function add_fundaccount()
    {

    	$Uid = $this->sess['iduser'];
    	$result = $this->Investor_model->get_investor_detail($Uid);
    	if ($result <> NULL)
    	{
    		$data_sid = $this->Investor_model->get_user_sid_data($Uid);
       		if($data_sid <> NULL)
       		{
   				$Sid = $data_sid[0]['SID'];
   				$NoRek = $data_sid[0]['NOMOR_REKENING'];
   				$Nama = $data_sid[0]['NAMA'];
   				$data = array();

		        if($this->input->post('submit'))
		        {
		           	$config_validation = array(
						array( 'field'=>'sid','label'=>$this->lang->line('sid'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
						array( 'field'=>'accountname','label'=>$this->lang->line('accountname'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
						array( 'field'=>'accountno','label'=>$this->lang->line('accountno'),'rules'=> 'trim|max_length[15]|regex_match[/^[0-9]+$/]'),

					);

		        	$uid = $this->sess['iduser'];

		            $dataArray = array(
		            	'IdBank' => $this->CI->parameter_helper->kodefundaccountbri,
						'Sid' => $this->input->post('sid'),
						'NoRek' => $this->input->post('accountno'),
						'Nama' => $this->input->post('accountname')
					);
		            
		            $url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningdana';
		            $data_string = json_encode($dataArray);
					$data_string_clean = str_replace(' ', '',$data_string);
					
		            $this->form_validation->set_rules($config_validation);
		            if($this->form_validation->run() == TRUE)
		            {
		            	$resultdata = $this->sbn_kemenkeuapi->post_data_api($url, $data_string, $data_string_clean);

		            	$data_audit = json_encode($resultdata);
    					$this->audit_website->write($this->sess['iduser'], $this->fid_fund_account, 'ADD FUND ACC', $data_audit, date("Y-m-d H:i:s")); 

				       	if ($resultdata[0] == 201)
				       	{
				       		$resultbody = json_decode($resultdata[1], true);
		                	if($this->Investor_model->insert_fundaccount($resultbody, $uid))
				            {
								flash_succ($this->lang->line("msg_success_add_fa"));
				            }
				            else
				            {
								flash_err($this->lang->line("msg_failed_add_fa_missing"));
				            }
				        }
				        else
				        {
				        	$resulterror = json_decode($resultdata[1], true);
							flash_err($resulterror['Message']);
				        }
		            }
		            else
		            {

		                flash_err($this->lang->line("msg_failed_add_fa_400"));
		            }
	        	}

		        $data['sid'] = $Sid;
		        $data['NoRek'] = $NoRek;
		        $data['Nama'] = $Nama;
		        $this->load->view('investor/add_fundaccount', $data);
       		}
       		else
       		{
       			flash_err($this->lang->line("msg_failed_unreg_investor")); 
    			$this->load->view('investor/message');
       		}
	    }
	    else
	    {
	    	flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	}
    }

    function filter_view_fundaccount($message = '', $addition = '')
	{
		$Uid = $this->sess['iduser'];
    	$result = $this->Investor_model->get_investor_detail($Uid);
    	if ($result <> NULL)
    	{
    		if ($message == 'msg_success'){
				flash_succ($this->lang->line('msg_success'));
			} else if($message == 'msg_failed') {
				flash_err($this->lang->line('msg_failed_error'));
			}
			$this->load->view('investor/filter_fundaccount');
    	}
    	else
	    {
	    	flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	}
		
	}

    function query_filter_fundaccount()
    {
    	$_POST = $this->secure_array($_POST);
    	$userid = $this->sess['iduser'];
		$this->Bank->get_datatable_fundaccount($userid);
  		echo $this->datatables->generate();
    }

	function fundaccount_delete()
	{
		$uid = $this->input->post('user_validator');
		$id_rek = $this->input->post('identifier');

		$investor_valid = $this->Investor_model->check_fundacc_investor($this->sess['iduser'], $id_rek);
		if ($investor_valid->num_rows() > 0)
		{
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningdana/'.$id_rek;
			$resultdata = $this->sbn_kemenkeuapi->delete_data_api($url, $id_rek, $id_rek);

			if ($resultdata[0] == 200)
	        {
	        	$criteria['id_rek'] = $id_rek;
				$sql_query = $this->Investor_model->delete_fundaccount($criteria, $id_rek);

				$this->audit_website->write($this->sess['iduser'], $this->fid_fund_account, 'DELETE FUND ACC', 'ID Rek :'. $id_rek , date("Y-m-d H:i:s")); 

				if ($sql_query)
				{
					$this->filter_view_fundaccount('msg_success');
				}
				else
				{
					$this->filter_view_fundaccount('msg_failed');
				}
	        }
	        else
	        {
	        	$this->filter_view_fundaccount('msg_failed');
	        }			
		}
		else
		{
			$this->filter_view_fundaccount('msg_failed');
		}
		
	}	

	/* Gak dipake lg */

	function edit_fundaccount($message = '', $addition = '')
	{
		$data['fid'] = $this->functionid;
		$data['message'] = $message;
		$data['addition'] = strtolower($addition);
		if ($message == 'msg_success'){
			$data['msg_type'] = 'success';
			$data['msg_icon'] = 'ok-sign';
		} else{
			$data['msg_type'] = 'danger';
			$data['msg_icon'] = 'remove-sign';
		}
		$this->load->view('investor/edit_fundaccount', $data);
	}

	function list_edit_fundaccount()
	{
		$this->Investor_model->get_fundaccount($this->sess['userid'], $this->sess['iduser']);
		echo $this->datatables->generate();
	}

	function edit_fundaccount_detail()
	{
		$validator = base64_decode($this->input->post('user_validator'));
		$id = $this->input->post('identifier');	
		//$data = $this->limit();			
		
		if ($validator == $this->sess['userid'])
		{
			$criteria['id_rek'] = $id;
			$sql_query = $this->Investor_model->get_fundaccount_detail($criteria);			
			if ($sql_query->result())
			{
				foreach ($sql_query ->result() as $row)
				{
					$data['id_rek'] = $row->id_rek;
					$data['bank_name'] = $row->bank_name;
					$data['bank_id'] = $row->bank_id;
					$data['account_no'] = $row->account_no;
					$data['account_name'] = $row->account_name;
					$data['sid'] = $row->sid;
				}
				$this->load->view('investor/edit_fundaccount2', $data);
			}
			else
			{
				echo '<script type="text/javascript">parent.content.location = "'.base_url().'default"</script>';
			}
		}
	}

	function edit_fundaccount2()
    {
    	$data = array();
        if($this->input->post('submit'))
        {
        	$config_validation = array(
				array( 'field'=>'sid','label'=>$this->lang->line('sid'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
				//array( 'field'=>'bankname','label'=>$this->lang->line('bankname'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
				array( 'field'=>'accountno','label'=>$this->lang->line('accountno'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
				array( 'field'=>'accountname','label'=>$this->lang->line('accountname'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]')
			);

        	$id_rek = $this->input->post('id_rek');
            $data['Sid'] = $this->input->post('sid');
            $data['IdBank'] = $this->input->post('bankid');
            $data['NoRek'] = $this->input->post('accountno');
            $data['Nama'] = $this->input->post('accountname');

            $dataArray = array(
				'Sid' => $this->input->post('sid'),
				'IdBank' => $this->input->post('bankid'),
				'NoRek' => $this->input->post('accountno'),
				'Nama' => $this->input->post('accountname')
			);

			/* Data API */
        	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningdana/'.$id_rek;
        	$data_string = json_encode($dataArray);
			$data_string_clean = str_replace(' ', '',$data_string);
			/* End */

			$resultdata = $this->sbn_kemenkeuapi->put_data_api($url, $data_string, $data_string_clean); 
            //$resultdata = $this->editRekeningDana($dataArray, $id_rek);

           	$resultbody = json_decode($resultdata[1], true);
            $this->form_validation->set_rules($config_validation);
            if($this->form_validation->run() == TRUE)
            {
            	if ($resultdata[0] == 404)
		        {
					flash_err($this->lang->line("msg_failed_edit_fa_404"));
		        }
		       	else if ($resultdata[0] == 400)
		       	{
		       		flash_err($this->lang->line("msg_failed_edit_fa_400"));
		       	}
		       	else if ($resultdata[0] == 200)
		       	{

                	if($this->Investor_model->edit_fundaccount($resultbody))
		            {
						flash_succ($this->lang->line("msg_success_edit_fa"));
		            }
		            else
		            {
						flash_err($this->lang->line("msg_failed_edit_fa_missing"));
		            }
		        }
		        else
		        {
					flash_err($resultbody['Message']);
		        }
            }
            else
            {
                flash_err($resultbody['Message']);
            }
        }
        else if($this->input->post('delete'))
        {
        	$id_rek = $this->input->post('id_rek');

        	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningdana/'.$id_rek;
        	$resultdata = $this->sbn_kemenkeuapi->delete_data_api($url, $id_rek, $id_rek);
        	//$resultdata = $this->deleteRekeningDana($id_rek);
        	
        	if ($resultdata[0] == 404)
	        {
				flash_err($this->lang->line("msg_failed_edit_fa_404"));
	        }
	        else if ($resultdata[0] == 200)
		    {
		    	$resultbody = json_decode($resultdata[1], true);
        		if($this->Investor_model->delete_fundaccount($resultbody, $id_rek))
                {
					flash_succ($this->lang->line("msg_success_delete_fa"));
                }
                else
                {
                	flash_err($this->lang->line("msg_failed_delete_fa"));
				}
			}
	        else
	        {
				flash_err($this->lang->line("msg_failed_401"));
	        }
        }

        $this->load->view('investor/edit_fundaccount', $data);
    }

	/* ===== End Function FUND ACCOUNT ===== */


	/* ===== Function SEC ACCOUNT ===== */
	function add_secaccount()
    {
    	$Uid = $this->sess['iduser'];
    	$result_investor = $this->Investor_model->get_investor_detail($Uid);
    	if ($result_investor <> NULL)
    	{
    		$result = $this->Investor_model->get_user_sid_data($Uid);
			$rsult = $this->Investor_model->get_secaccount_exist($Uid);
			$result_subreg = $this->Investor_model->get_subreg($Uid);

			if ($rsult == NULL)
			{
		    	if ($result <> NULL)
		    	{
		    		$Sid = $result[0]['SID'];
		    		$Nama = $result[0]['NAMA'];
		    		$Sec_acc = $result_subreg[0]['ID_SUBREG']; 
			    	$data = array();

			        if($this->input->post('submit'))
			        {
			        	$config_validation = array(
							array( 'field'=>'sid','label'=>$this->lang->line('sid'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
							array( 'field'=>'secaccountno','label'=>$this->lang->line('secaccountno'),'rules'=> 'trim|regex_match[/^[A-Za-z0-9- .,]*$/]'),
						);

			        	$uid = $this->sess['iduser'];

			            $dataArray = array(
			            	'IdSubregistry' => $this->CI->parameter_helper->kodesecaccountbri,
							'Sid' => $this->input->post('sid'),
							'NoRek' => $this->input->post('secaccountno'),
							'Nama' => $this->input->post('secaccountname')
						);

						$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningsb';
						$data_string = json_encode($dataArray);
						$data_string_clean = str_replace(' ', '',$data_string);

						//$resultdata = $this->sbn_kemenkeuapi->post_data_api($url, $data_string, $data_string_clean);
			            //$resultdata = $this->addRekeningSb($dataArray);

			            $this->form_validation->set_rules($config_validation);
			            if($this->form_validation->run() == TRUE)
			            {
			            	$resultdata = $this->sbn_kemenkeuapi->post_data_api($url, $data_string, $data_string_clean);

		            		$data_audit = json_encode($resultdata);
	    					$this->audit_website->write($this->sess['iduser'], $this->fid_sec_account, 'ADD SEC ACC', $data_audit, date("Y-m-d H:i:s")); 

			            	if ($resultdata[0] == 201)
					       	{
					       		$resultbody = json_decode($resultdata[1], true);
			                	if($this->Investor_model->insert_secaccount($resultbody, $uid))
					            {
									flash_succ($this->lang->line("msg_success_add_sec"));
					            }
					            else
					            {
									flash_err($this->lang->line("msg_failed_add_sec_missing"));
					            }
					        }
					        else
					        {
								$resulterror = json_decode($resultdata[1], true);
								flash_err($resulterror['Message']);
					        }
			            }
			            else
			            {
			                flash_err($this->lang->line("msg_failed_add_sec_400"));
			            }
			        }

			        $data['sid'] = $Sid;
			        $data['secaccountname'] = $Nama; 
			        $data['secaccountno'] = $Sec_acc;

			        $this->load->view('investor/add_secaccount', $data);
			    }
			    else
			    {
			    	flash_err($this->lang->line("msg_failed_unreg_investor")); 
		    		$this->load->view('investor/message');
			    }
			}
			else
			{
				flash_err($this->lang->line("msg_failed_add_sec_registered")); 
		    	$this->load->view('investor/message');
			}
    	}
    	else
    	{
    		flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	}    	
    }

	function filter_view_secaccount()
	{
		$uid = $this->sess['iduser'];
		$result_investor = $this->Investor_model->get_investor_detail($uid);
		if ($result_investor <> NULL)
    	{
    		$rsult = $this->Investor_model->get_secaccount_exist($uid);

    		if($rsult <> NULL)
    		{
    			foreach ($rsult as $row) {
					$id_reksb = $row->id_reksb;
				}

				/* Data API */
		    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningsb/'.$id_reksb;;
				/* End */
		    	$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url);

		    	$data_audit = json_encode($data);
		    	$this->audit_website->write($this->sess['iduser'], $this->fid_sec_account, 'DETAIL SECACCOUNT', $data_audit, date("Y-m-d H:i:s"));  

				$this->load->view('investor/filter_secaccount', $data);
    		}
    		else
    		{
    			flash_err($this->lang->line("msg_failed_edit_sec_404")); 
    			$this->load->view('investor/message');
    		}
    	}
    	else
    	{
    		flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	} 
	}

	/* Gak dipake lg */

    function filter_view_secaccount_old($message = '', $addition = '')
	{
		$data['fid'] = $this->functionid;
		$data['message'] = $message;
		$data['addition'] = strtolower($addition);
		if ($message == 'msg_success'){
			flash_succ($this->lang->line('msg_success'));
		} else if ($message == 'msg_failed'){
			flash_err($this->lang->line('msg_failed_error'));
		}
		$this->load->view('investor/filter_secaccount', $data);
	}

    function query_filter_secaccount()
    {
    	$userid = $this->sess['iduser'];
		$this->Bank->get_datatable_secaccount($userid);
  		echo $this->datatables->generate();
    }

    function secaccount_detail()
	{
		$id_reksb = $this->input->post('identifier');

		/* Data API */
    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningsb/'.$id_reksb;
		/* End */
    	$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url); 

		$this->load->view('popup_pages/list_filter_secaccount', $data);
	}

    function secaccount_delete()
	{
		$id_rek = $this->input->post('identifier');
		$criteria['id_reksb'] = $id_rek;
		$sql_query = $this->Investor_model->delete_secaccount($criteria, $id_rek);
		if ($sql_query)
		{
			$this->filter_view_secaccount('msg_success');
		}
		else
		{
			$this->filter_view_secaccount('msg_failed');
		}
	}

	function edit_secaccount($message = '', $addition = '')
	{
		$data['fid'] = $this->functionid;
		$data['message'] = $message;
		$data['addition'] = strtolower($addition);
		if ($message == 'msg_success'){
			$data['msg_type'] = 'success';
			$data['msg_icon'] = 'ok-sign';
		} else{
			$data['msg_type'] = 'danger';
			$data['msg_icon'] = 'remove-sign';
		}
		$this->load->view('investor/edit_secaccount', $data);
	}

	function list_edit_secaccount()
	{
		$this->Investor_model->get_secaccount($this->sess['userid'], $this->sess['iduser']);
		echo $this->datatables->generate();
	}

	function edit_secaccount_detail()
	{
		$validator = base64_decode($this->input->post('user_validator'));
		$id = $this->input->post('identifier');	
		//$data = $this->limit();			
		
		if ($validator == $this->sess['userid'])
		{
			$criteria['id_reksb'] = $id;
			//$criteria['clientid'] = $this->sess['clientid'];
			//$criteria['status'] = 1;
			$sql_query = $this->Investor_model->get_secaccount_detail($criteria);
			if ($sql_query->result())
			{
				foreach ($sql_query ->result() as $row)
				{
					$data['id_reksb'] = $row->id_reksb;
					$data['subreg_name'] = $row->subreg_name;
					$data['subreg_id'] = $row->subreg_id;
					$data['sec_account_no'] = $row->sec_account_no;
					$data['sec_account_name'] = $row->sec_account_name;
					$data['sid'] = $row->sid;
				}
				$this->load->view('investor/edit_secaccount2', $data);
			}
			else
			{
				echo '<script type="text/javascript">parent.content.location = "'.base_url().'default"</script>';
			}
		}
	}

	function edit_secaccount2()
    {
    	$data = array();
        if($this->input->post('submit'))
        {

        	$config_validation = array(
				//array( 'field'=>'subregid','label'=>$this->lang->line('subregid'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
				array( 'field'=>'sid','label'=>$this->lang->line('sid'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
				array( 'field'=>'secaccountno','label'=>$this->lang->line('secaccountno'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
				array( 'field'=>'secaccountname','label'=>$this->lang->line('secaccountname'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]')
			);

        	$id_reksb = $this->input->post('id_reksb');
            $data['IdSubregistry'] = $this->input->post('subregid');
            $data['Sid'] = $this->input->post('sid');
            $data['NoRek'] = $this->input->post('secaccountno');
            $data['Nama'] = $this->input->post('secaccountname');

            $dataArray = array(
				'IdSubregistry' => $this->input->post('subregid'),
				'Sid' => $this->input->post('sid'),
				'NoRek' => $this->input->post('secaccountno'),
				'Nama' => $this->input->post('secaccountname')
			);

            /* Data API */
        	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningsb/'.$id_reksb;
        	$data_string = json_encode($dataArray);
			$data_string_clean = str_replace(' ', '',$data_string);
			/* End */

			$resultdata = $this->sbn_kemenkeuapi->put_data_api($url, $data_string, $data_string_clean); 
			//$resultdata = $this->editRekeningSb($dataArray, $id_reksb);
            
            $this->form_validation->set_rules($config_validation);
            if($this->form_validation->run() == TRUE)
            {
            	if ($resultdata[0] == 404)
		        {
					flash_err($this->lang->line("msg_failed_edit_sec_404"));
		        }
		       	else if ($resultdata[0] == 400)
		       	{
		       		flash_err($this->lang->line("msg_failed_edit_sec_400"));
		       	}
		       	else if ($resultdata[0] == 200)
		       	{
		       		$resultbody = json_decode($resultdata[1], true);
                	if($this->Investor_model->edit_secaccount($resultbody))
		            {
						flash_succ($this->lang->line("msg_success_edit_sec"));
		            }
		            else
		            {
						flash_err($this->lang->line("msg_failed_edit_sec_missing"));
		            }
		        }
		        else
	        {
					flash_err($this->lang->line("msg_failed_401"));
		        }
            }
            else
            {
                flash_err($this->lang->line("msg_failed_edit_sec_400"));
            }
        }
        else if($this->input->post('delete'))
        {
        	$id_reksb = $this->input->post('id_reksb');
        	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningSb/'.$id_reksb;
        	$resultdata = $this->sbn_kemenkeuapi->delete_data_api($url, $id_reksb, $id_reksb);
        	//$resultdata = $this->deleteRekeningSb($id_reksb);
        	
        	if ($resultdata[0] == 404)
	        {
				flash_err($this->lang->line("msg_failed_edit_sec_404"));
	        }
	        else if ($resultdata[0] == 200)
		    {
		    	$resultbody = json_decode($resultdata[1], true);
        		if($this->Investor_model->delete_secaccount($resultbody, $id_reksb))
                {
					flash_succ($this->lang->line("msg_success_delete_sec"));
                }
                else
                {
                	flash_err($this->lang->line("msg_failed_delete_sec"));
				}
			}
	        else
	        {
				flash_err($this->lang->line("msg_failed_401"));
	        }
        }
        $this->load->view('investor/edit_secaccount', $data);
    }

    /* ===== Function SEC ACCOUNT ===== */

	function doInquiryAccount()
	{		
		$accountno = $this->input->post('accountno');

		$account_detail = $this->sbn_briinterface->inquiry_account($accountno);

		echo json_encode($account_detail);
	}

	function onlyNumber()
	{
		$this->load->view('testing');
	}

	function secure_array($array0 = array())
	{
	 // this function secures the content of an array against SQL injection and HTML code injection attacks
	 // it works for arrays of any number of dimensions, recursively for each dimension
		// print_r($array0);die();
		$result = array();
	 
		if (count($array0)>0)
		{
		     foreach ($array0 as $key0 => $value0)
		     {
		        if (is_array($value0)) // if element is array, then go to next dimension
		        {
		           	// $this->secure_array($array[$key]);
		        	foreach ($value0 as $key1 => $value1) {
		        		if (is_array($value1)) {
		        			foreach ($value1 as $key2 => $value2) {
		        				if (is_array($value2)) {
				        			foreach ($value2 as $key3 => $value3) {
				        				$val = $this->db->escape($value3);
		        						$result[$key0][$key1][$key2][$key3] = $val;
				        			}
				        		} else {
				        			$val = $this->db->escape($value2);
		        					$result[$key0][$key1][$key2] = $val;
				        		}
		        			}
		        		} else {
		        			$val = $this->db->escape($value1);
		        			$result[$key0][$key1] = $val;
		        		}
		        		
		        	}

		        }
		        else // if element is a normal variable, clean it up
		        {
		           //$array[$key] = $mysqli -> real_escape_string($array[$key]); // replace this with mysql / PDO real escape string function depending on which database connector you are using
		           // $array[$key] = $this->db->escape($array[$key]);
		           // $array[$key] = strip_tags($array[$key]);
		        	$val = $this->db->escape($value0);
		        	$result[$key0] = $val;
		        }
		    }
		}

		return $result;
	}
}
?>