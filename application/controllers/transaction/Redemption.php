<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redemption extends CI_Controller {
	var $sess;
	var $sessLang;
	var $functionid = 210;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
		$this->load->model(array('Pemesanan_model','Investor_model'));
	}

	function index()
	{
		$this->add();
	}

	function add($message = '', $addition = '', $data_confirm = array())
	{
		$Uid = $this->sess['iduser'];
    	$result = $this->Investor_model->get_investor_detail($Uid);
    	if ($result <> NULL)
    	{
    		$data_sid = $this->Investor_model->get_user_sid($Uid);
       		if($data_sid <> NULL)
       		{
		    	$data['sid'] = $data_sid[0]['SID'];
		 		// $data['sid'] = $Sid;
				$data['message'] = $message;
				$data['addition'] = strtolower($addition);
				if ($message == 'msg_success'){
					$data['msg_type'] = 'success';
					$data['msg_icon'] = 'ok-sign';
				} else{
					$data['msg_type'] = 'danger';
					$data['msg_icon'] = 'remove-sign';
				}
				if(!empty($data_confirm)) $data_add = array_merge($data, $data_confirm);
				else $data_add = $data;

				$this->load->view('transaction/redemption/add', $data_add);
			}
		}
		else
	    {
	    	flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	}
	}

	function add_confirm()
	{
		/* DEFINE POST DATA */
		$uid = $this->sess['iduser'];
		$data['sid'] = $this->input->post('sid');
		$data['seriid'] = $this->input->post('seriid');
		$data['orderno'] = $this->input->post('orderno');
		$data['amount'] = str_replace(",", "", $this->input->post('amount'));
		$data['maxred'] = str_replace(",", "", $this->input->post('maxred'));
		$data['multredem'] = str_replace(",", "", $this->input->post('multredem'));
		$data['sisakepemilikan'] = str_replace(",", "", $this->input->post('sisakepemilikan'));
		/* eof DEFINE POST DATA */

		$config_validation = array(
		    array( 'field'=>'sid','label'=>'sid','rules'=> 'trim|required'),
		    array( 'field'=>'orderno','label'=>'order no','rules'=> 'trim|required'),
			array( 'field'=>'amount','label'=>'amount','rules'=> 'required'),
		);

		$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run() == TRUE)
		{
			if((double)$data['amount'] <= (double)$data['maxred'])
			{
				if(fmod((double)$data['amount'], (double)$data['multredem']) == 0)
				{
					$uid = $this->sess['iduser'];

					$token = $this->randomString('6');
					$insert_token = $this->Pemesanan_model->insert_token($token, $uid);
					if($insert_token)
					{
						$criteria['id'] = $uid;
						$sql_query = $this->Investor_model->get_user_email($criteria);

						if ($sql_query->result())
						{
							foreach ($sql_query->result() as $row)
							{
								$email = $row->email;
							}
						}

						$send_token = $this->Email->insert_email_token($email, $token, $uid);

						if($send_token)
						{
							$this->load->view('transaction/redemption/add_confirm', $data);
						}
						else
						{
							flash_err("Error generate token");
							$this->add();
						}
					}
					else
					{
						flash_err("Error generate token");
						$this->add();
					}
				}
				else
				{
					flash_err($this->lang->line("error_multiple_redeem"));
					$this->add();
				}
			} 
			else
			{
				flash_err($this->lang->line("error_max_amount"));
				$this->add();
			}      		
		}
		else
		{
			$this->add('', '', $data);
		}
	}

	function confirm()
	{
		$dataArray = array(
			'Sid' => $this->input->post('sid'),
			'KodePemesanan' => $this->input->post('orderno'),
			'Nominal' => $this->input->post('amount'),                        
		);

		$uid = $this->sess['iduser'];
		$token = $this->input->post('token');
		$cek_token = $this->Pemesanan_model->check_token($token, $uid);

		if($cek_token)
		{
			$resultdata = $this->AddRedemption($dataArray);
			$resultbody = json_decode($resultdata[1], true);
			
			if ($resultdata[0] == 201)
	       	{
	       		$data['nama_investor'] = $resultbody['NamaInvestor'];
	       		$data['kode_redeem'] = $resultbody['KodeRedeem'];
	       		$data['seri'] = $resultbody['Seri'];
	       		$tglsettlement = strtotime($resultbody['TglSetelmen']);
	       		$data['settlement_date'] = date('Y-m-d H:i:s', $tglsettlement);
	       		$data['sisa_kepemilikan'] = $resultbody['SisaKepemilikan'];
	       		$data['status'] = $resultbody['Status'];
	       		$data['created_by'] = $resultbody['CreatedBy'];
	       		$tglredeem = strtotime($resultbody['TglRedeem']);
	       		$data['redeem_date'] = date('Y-m-d H:i:s', $tglredeem);
	       		$data['order_id'] = $resultbody['KodePemesanan'];
	       		$data['sid'] = $resultbody['Sid'];
	       		$data['amount'] = $resultbody['Nominal'];
	       		$data['uid'] = $this->sess['iduser'];

	       		$query_insert = $this->Redemption_model->insert_redemption($data);
	       		if($query_insert)
	       		{
	       			$criteria['id'] = $this->sess['iduser'];
					$sql_query = $this->Investor_model->get_user_email($criteria);
					if ($sql_query->result())
					{
						foreach ($sql_query->result() as $row)
						{
							$email = $row->email;
						}

						$this->Email->insert_email_redeem($email, $resultbody["KodeRedeem"], $resultbody["KodePemesanan"], $resultbody["Nominal"], date('Y-m-d h:i:s', strtotime($resultbody["TglRedeem"] )), $uid);
					}

	       			flash_succ($this->lang->line("msg_success_add_redemption"));
					$this->add();
	       		}
	       		else
	       		{
	       			flash_err($this->lang->line("msg_failed_add_redemption"));
					$this->add();
	       		}
	        }
	        else
	       	{
	       		flash_err($resultbody["Message"]);
	       		$this->add();
	       	}
		}
		else
		{
			flash_err($this->lang->line('wrong_token'));
			$this->add();
		}	
	}

	function query_view($message = '', $addition = '')
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
			$this->load->view('transaction/redemption/filter', $data);
		}
		else
	    {
	    	flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	}
	}

	function query_filter()
    {
    	$Uid = $this->sess['sid'];
    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/redemption/seri/all/'.$Uid;
    	$redem = $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
  		echo $redem;
    }

    function show_redem_filter()
	{
		$sid = $this->input->post('sid2');
		$idseri = $this->input->post('seriid'); 
		$redemcode = $this->input->post('redemcode');
		if(isset($sid) && isset($idseri)){
			$link = $this->parameter_helper->ip_intranet_sbn.'/v1/redemption/seri/'.$idseri.'/'.$sid;
			echo  $this->sbn_kemenkeuapi->get_data_api_direct_echo($link);
		} else {
			$link = $this->parameter_helper->ip_intranet_sbn.'/v1/redemption/'.$redemcode;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($link);
		}
		
	}

	function count_max_redeem()
	{
		$sid = $this->sess['sid'];
		$idseri = $this->input->post('seriid');
		$amount = $this->input->post('amount');

		$response['MaxRedeem'] = "0";
		$response['MultipleRedeem'] = "0";	

		$link = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/redeem/'. $idseri ;
		$result =  $this->sbn_kemenkeuapi->get_data_api_return_json_decode($link);
		if(empty($result)){
			echo json_encode($response);
		} else {
			$maxredeem = $result['MaxPcent'] / 100 * $amount;
			$response['MaxRedeem'] = $maxredeem;
			$response['MultipleRedeem'] = $result['KelipatanRedeem'];
			echo json_encode($response);
		}
		
	}

	function sisa_kepemilikan()
	{
		$sid = $this->sess['sid'];
		$idseri = $this->input->post('seriid');
		$amount = $this->input->post('amount');
		$kodepemesanan = $this->input->post('kodepemesanan');
		$link = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/'.$kodepemesanan;
		$result = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($link);

		$sisa = $result['SisaKepemilikan'];
		echo $sisa;
	}

	function redemption_detail()
	{
		$redemcode = $this->input->post('identifier');
		$investor_valid = $this->Redemption_model->check_user_redemption($this->sess['iduser'], $redemcode);
		if ($investor_valid->num_rows() > 0)
		{
			$link = $this->parameter_helper->ip_intranet_sbn.'/v1/redemption/'.$redemcode;
			$data['resultdata'] =$this->sbn_kemenkeuapi->get_data_api_return_json_decode($link);
			$this->load->view('popup_pages/list_filter_redemption', $data);
		}
		else
		{
			flash_err($this->lang->line("unauthorized investor")); 
    		$this->load->view('investor/message');
		}
	}

	function AddRedemption($arrayData)
	{
		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/redemption';
		$data_string = json_encode($arrayData);
		$data_string2 = str_replace(' ', '',$data_string);
		$RequestUrl = urlencode($url);
		$RequestUrl = strtolower($RequestUrl);
		$requestHttpMethod = 'post';
		$requestHttpMethod = strtoupper($requestHttpMethod);
		$RequestBodyBase64 = base64_encode(md5($data_string2,true));
		$RequestTimeStamp = time();
		$Nonce = bin2hex(openssl_random_pseudo_bytes(10));
		$SignatureRawData = $APIId.''.$requestHttpMethod.''.$RequestUrl.''.$RequestTimeStamp.''.$Nonce.''.$RequestBodyBase64;
		$SignatureBase64 = base64_encode(hash_hmac('sha256', $SignatureRawData, $APIKey, 'true'));		
		$dataSignature = $APIId.':'.$SignatureBase64.':'.$Nonce.':'.$RequestTimeStamp;
		$AuthString = base64_encode($dataSignature);	
 		// echo $AuthString; die;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization : amx '.$AuthString)
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$responsebody = curl_exec($ch);
		$responsecode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$result[0] = $responsecode;
		$result[1] = $responsebody;
		
		return $result;
	}

	function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
	
}
?>