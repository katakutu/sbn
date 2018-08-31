<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
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
    		$data_subacc = $this->Investor_model->get_secaccount_data($Uid);

       		if($data_sid <> NULL && $data_subacc <> NULL)
       		{
       			$rekdana = $this->Pemesanan_model->get_fund_account($Uid);
       			if ($rekdana->num_rows() == 1)
				{
					$data['fundaccountno'] = $rekdana->row()->account_no;
					$data['fundaccountid'] = $rekdana->row()->id_rek;
					$data['fundaccountname'] = $rekdana->row()->account_name;
				}

				//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/offer';
				//$serioffer = $this->sbn_kemenkeuapi->get_data_api_return($url); 
				
				//$arr_serioffer = json_decode($serioffer);

				//if(count($arr_serioffer) == 1)
				//{
				//	$data['seriname'] = $arr_serioffer[0]->Seri;
				//	$data['seriid'] = $arr_serioffer[0]->Id;
				//}
			
       			$data['sid'] = $data_sid[0]['SID'];
       			$data['secaccountid'] = $data_subacc[0]['id_reksb'];
       			$data['secaccountno'] = $data_subacc[0]['sec_account_no'];
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

				$this->load->view('transaction/pemesanan/add', $data_add);
       		}
       		else
       		{
       			flash_err($this->lang->line("msg_failed_unreg_subaccount")); 
    			$this->load->view('investor/message');
       		}
		}
	    else
	    {
	    	flash_err($this->lang->line("msg_failed_unreg_investor_order")); 
    		$this->load->view('investor/message');
    	}
	}

	function add_confirm()
	{
		/* DEFINE POST DATA */
		$uid = $this->sess['iduser'];
		$data['sid'] = $this->input->post('sid');
		$data['seriid'] = $this->input->post('seriid');
		$data['seriname'] = $this->input->post('seriname');
		$data['amount'] = str_replace(",", "", $this->input->post('amount'));
		$data['fundaccountid'] = $this->input->post('fundaccountid');
		$data['fundaccountno'] = $this->input->post('fundaccountno');
		$data['secaccountid'] = $this->input->post('secaccountid');
		$data['secaccountno'] = $this->input->post('secaccountno');
		$data['val_min'] = $this->input->post('val_min');
		$data['val_max'] = $this->input->post('val_max');
		$data['multorder'] = str_replace(",", "", $this->input->post('multorder'));
		$data['totorder'] = $this->input->post('totorder');
		$data['quotorder'] = str_replace(",", "", $this->input->post('quotorder'));
		$data['quotordernat'] = str_replace(",", "", $this->input->post('quotordernat'));
		/* eof DEFINE POST DATA */

		$config_validation = array(
		    array( 'field'=>'sid','label'=>'sid','rules'=> 'trim|required'),
		    array( 'field'=>'seriid','label'=>'seri name','rules'=> 'trim|required'),
		    array( 'field'=>'fundaccountid','label'=>'fund account no','rules'=> 'trim|required'),
			array( 'field'=>'secaccountid','label'=>'sec account no','rules'=> 'trim|required'),
			array( 'field'=>'amount','label'=>'amount','rules'=> 'required'),
			);

		$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run() == TRUE)
		{
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/Kuota/'.$data['seriid'].'/'.$data['sid'];
			$kuotaseribysiddata = $this->sbn_kemenkeuapi->get_data_api($url);

			if ($kuotaseribysiddata[0] == 200)
			{
				$result = json_decode($kuotaseribysiddata[1]);
				$kuotainvestor = $result->KuotaInvestor;
				$kuotaseri = $result->KuotaSeri;

				if((double)$data['amount'] <= (double)$kuotaseri)
				{
					if((double)$data['amount'] <= (double)$kuotainvestor)
					{
						if((double)$data['amount'] >= (double)$data['val_min'])
						{
							if((double)$data['amount'] <= (double)$data['val_max'])
							{
								if(fmod((double)$data['amount'], (double)$data['multorder']) == 0)
								//if((double)$data['amount'] % (double)$data['multorder'] == 0)
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
											$this->load->view('transaction/pemesanan/add_confirm', $data);	
										}
										else
										{
											flash_err("Error generate token");
											$this->add('', '', $data);
										}
									}
									else
									{
										flash_err("Error generate token");
										$this->add('', '', $data);
									}
								}
								else
								{
									$multiple_valid = false;
									flash_err($this->lang->line("error_multiple"));
									$this->add('', '', $data);
								}
							}
							else
							{
								$limit_valid = false;
								flash_err($this->lang->line("error_max_amount"));
								$this->add('', '', $data);
							}
						}
						else
						{
							$limit_valid = false;
							flash_err($this->lang->line("error_min_amount"));
							$this->add('', '', $data);
						}
					}
					else
					{
						$kuota_valid = false;
						flash_err($this->lang->line("error_kuota_investor"));
						$this->add('', '', $data);
					}

				}
				else
				{
					$kuota_valid = false;
					flash_err($this->lang->line("error_kuota_seri"));
					$this->add('', '', $data);
				}
			}
			else
			{
				$objerr = json_decode($kuotaseribysiddata[1]);
				flash_err($objerr->{'Message'});
				$this->add('', '', $data);
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
			'IdSeri' => $this->input->post('seriid'),
			'Nominal' => $this->input->post('amount'),                        
			'IdRekDana' => $this->input->post('fundaccountid'),
			'IdRekSb' => $this->input->post('secaccountid'),
		);

		$uid = $this->sess['iduser'];

		$token = $this->input->post('token');
		$cek_token = $this->Pemesanan_model->check_token($token, $uid);
		
		if($cek_token)
		{
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan';
	        $data_string = json_encode($dataArray);
			$data_string_clean = str_replace(' ', '',$data_string);

			$resultdata = $this->sbn_kemenkeuapi->post_data_api($url, $data_string, $data_string_clean);
			//$resultdata = $this->AddOrder($dataArray);

			$resultbody = json_decode($resultdata[1], true);

	       	if ($resultdata[0] == 201)
	       	{
	            if($this->Pemesanan_model->insert_order($resultbody, $uid))
	            {
	            	$BatasWaktuBayar = str_replace('T', ' ', $resultbody["BatasWaktuBayar"]);
					$BatasWaktuBayar = str_replace('Z', '', $BatasWaktuBayar);
					
					$criteria['id'] = $this->sess['iduser'];
					$sql_query = $this->Investor_model->get_user_email($criteria);
					if ($sql_query->result())
					{
						foreach ($sql_query->result() as $row)
						{
							$email = $row->email;
						}

						$this->Email->insert_email_order($email, $resultbody["KodeBilling"], $BatasWaktuBayar, $resultbody["KodePemesanan"], $resultbody["Nominal"], $uid);
					}			

					flash_succ($this->lang->line("msg_success_add_order") ."<br>". $this->lang->line("orderno")." : ".$resultbody["KodePemesanan"]."<br>".$this->lang->line("billcode")." : ".$resultbody["KodeBilling"]. "<br>".$this->lang->line("amount")." : ".number_format($resultbody["Nominal"])." IDR <br>".$this->lang->line("payout")." : ".$BatasWaktuBayar."<br>".$this->lang->line("payment_info"));
					$this->load->view('transaction/pemesanan/guide');
	            }
	            else
	            {
					flash_err($this->lang->line("msg_failed_add_order"));
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
			$this->load->view('transaction/pemesanan/filter', $data);
		}
		else
	    {
	    	flash_err($this->lang->line("msg_failed_unreg_investor")); 
    		$this->load->view('investor/message');
    	}
	}

	function mpn_view($message = '', $addition = '')
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
		$this->load->view('transaction/pemesanan/payment_mpn', $data);
	}

	function query_filter()
    {
    	$Uid = $this->sess['sid'];

    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/seri/all/'.$Uid;
    	$order = $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);

  		echo $order;
    }

    function show_order_filter()
	{
		$sid = $this->input->post('sid');
		$sid2 = $this->input->post('sid2');
		$idseri = $this->input->post('seriid');
		$order_code = $this->input->post('ordercode'); 
		$bill_code = $this->input->post('billcode');
		
		if(isset($sid)){
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/seri/all/'.$Uid;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
		} elseif(isset($sid2) && isset($idseri)) {
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/seri/'.$idseri.'/'.$sid2;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
			//echo json_encode($data, TRUE);
		}elseif(isset($order_code)) {
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/'.$order_code;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo_tag($url);
		} else {
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/billing/'.$bill_code;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo_tag($url);
		}			
	}

	function order_detail()
	{
		$orderno = $this->input->post('identifier');
		$sid = $this->input->post('sid');
		$idseri = $this->input->post('idseri');

		$investor_valid = $this->Investor_model->check_order_investor($orderno, $this->sess['iduser']);
		if ($investor_valid->num_rows() > 0)
		{
			$url1 = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/'.$orderno;
			$url2 = $this->parameter_helper->ip_intranet_sbn.'/v1/Kuota/'.$idseri.'/'.$sid;
			
			$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url1); 
			$data['kuota'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url2); 

			$this->load->view('popup_pages/list_filter_orders', $data);
		}
		else
		{
			flash_err($this->lang->line("unauthorized investor")); 
    		$this->load->view('investor/message');
		}	
	}

	function query_detail()
	{
		$validator = base64_decode($this->input->post('user_validator'));
		$id = $this->input->post('identifier');	
		//$data = $this->limit();			
		
		if ($validator == $this->sess['iduser'])
		{
			$criteria['order_id'] = $id;
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/'.$id;
			$sql_query = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url); 
			//$this->Pemesanan_model->get_query_detail($criteria);			
			if ($sql_query->result())
			{
				foreach ($sql_query ->result() as $row)
				{
					$data['Seri'] = $row->seri_name;
					$data['KodePemesanan'] = $row->order_id;
					$data['TingkatKupon'] = $row->coupon_rate;
					$data['KodeBilling'] = $row->billing_code;
					$data['NominalKupon'] = $row->coupon_amount;
					$data['Status'] = $row->status;
					$data['Sid'] = $row->sid;
					$data['IdSeri'] = $row->id_seri;
					$data['Nominal'] = $row->amount;
					$data['IdRekDana'] = $row->id_rek;
					$data['IdRekSb'] = $row->id_reksb;
					$data['BatasWaktuBerbayar'] = $row->payment_limit;
				}
				$this->load->view('popup_pages/list_filter_order_detail', $data);
			}
			else
			{
				echo '<script type="text/javascript">parent.content.location = "'.base_url().'default"</script>';
			}
		}
	}

	function count_total()
    {
    	$Uid = $this->sess['iduser'];
    	$idseri = $this->input->post('idseri');

    	$criteria['id_seri'] = $idseri;
    	$criteria['uid'] = $Uid;
    	$idstatus = array('3', '4');
    	//$criteria['id_status'] = '4';

    	$totorder = $this->Pemesanan_model->get_total_order($idseri, $Uid);

    	if($totorder > 0)
    	{
			echo $totorder;		
    	}
    	else
    	{
    		echo "0";
    	}
    }

    function get_kuota_seri()
    {
		$sid = $this->sess['sid'];	
		$idseri = $this->input->post('idseri');
		$response['KuotaInvestor'] = "0";
		$response['KuotaNasional'] = "0";	

		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/Kuota/'.$idseri.'/'.$sid;
		$sql_query = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url);		
		
//		$sql_query = $this->Pemesanan_model->get_kuota_seri_by_sid($idseri, $sid);		
		if(empty($sql_query)){
			echo json_encode($response);
		} else {
			$response['KuotaInvestor'] = $sql_query['KuotaInvestor'];
			$response['KuotaNasional'] = $sql_query['KuotaSeri'];
			echo json_encode($response);
		}	
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