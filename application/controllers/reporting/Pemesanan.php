<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
	var $sess;
	var $sessLang;
	var $CI;
	var $functionid = 300;

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
		$this->CI =& get_instance();
	}

	function index()
	{
		$this->monitoring();
	}
	
	function monitoring($message = '', $addition = '')
	{
		$data['fid'] = $this->functionid;
		$data['message'] = $message;
		$data['addition'] = strtolower($addition);
		$data['status'] = $this->input->post('status');
		if ($message == 'msg_success'){
			$data['msg_type'] = 'success';
			$data['msg_icon'] = 'ok-sign';
		} else{
			$data['msg_type'] = 'danger';
			$data['msg_icon'] = 'remove-sign';
		}

		$this->load->view('reporting/pemesanan/monitoring', $data);
	}
	
	function monitoring_red($message = '', $addition = '')
	{
		$data['fid'] = $this->functionid;
		$data['message'] = $message;
		$data['addition'] = strtolower($addition);
		$data['status'] = $this->input->post('status');
		if ($message == 'msg_success'){
			$data['msg_type'] = 'success';
			$data['msg_icon'] = 'ok-sign';
		} else{
			$data['msg_type'] = 'danger';
			$data['msg_icon'] = 'remove-sign';
		}
		$this->load->view('reporting/pemesanan/monitoring_red', $data);
	}

    function query_filter()
    {
    	$userid = $this->sess['iduser'];
		$this->Bank->get_datatable_order_report($userid);
  		echo $this->datatables->generate();
    }

    function order_detail()
	{
		$orderno = $this->input->post('identifier');
		$sid = $this->input->post('sid');
		$idseri = $this->input->post('idseri');

		$data['seriname'] = $this->input->post('seriname');
		$data['seriid'] = $this->input->post('idseri');
		$data['stats'] = $this->input->post('stats');
		$data['idstatus'] = $this->input->post('idstatus');
		$data['orderdateone'] = $this->input->post('orderdate2');
		$data['orderdatetwo'] = $this->input->post('orderdate3');

		$url1 = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/'.$orderno;
		$url2 = $this->parameter_helper->ip_intranet_sbn.'/v1/Kuota/'.$idseri.'/'.$sid;

		$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url1); 
		$data['kuota'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url2); 

		$this->load->view('popup_pages/list_filter_detail_api', $data);
	}

	function redem_detail()
	{
		$id = $this->input->post('identifier');
		$link = $this->parameter_helper->ip_intranet_sbn.'/v1/redemption/'.$id;
		$data['seriname'] = $this->input->post('seriname');
		$data['seriid'] = $this->input->post('seriid');
		$data['orderdate'] = $this->input->post('orderdate');
		$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($link);

		$this->load->view('popup_pages/list_detail_redem_report', $data);
	}

	function show_order_report()
	{
		if($_POST){
			$halaman = 1000;
			$nohal = 1;
			$idseri = $this->input->post('seriid');
			$idstatus = $this->input->post('statid');
			//$orderdate = $this->input->post('orderdate');
			$orderdate2 = $this->input->post('orderdate2');
			$orderdate3 = $this->input->post('orderdate3');
			// if(isset($idseri) && isset($idstatus) && isset($orderdate)){
		 //    	echo  $this->Pemesanan_model->get_filter_order_report($idseri,$idstatus,$orderdate,$nohal,$halaman);
			// }else 
			if(empty($idseri) && !empty($idstatus) && !empty($orderdate2) && !empty($orderdate3)){
				$noidseri = $this->Pemesanan_model->get_filter_all_range($idstatus,$orderdate2,$orderdate3,$nohal,$halaman);
			}else if(!empty($idseri) && !empty($idstatus) && !empty($orderdate2) && !empty($orderdate3)){
				$filterall = $this->Pemesanan_model->get_filter_sid_range($idseri,$idstatus,$orderdate2,$orderdate3,$nohal,$halaman);
			}else{
				 echo "Filter tidak lengkap!";
			}
		}else{
			echo '<script type="text/javascript">parent.content.location = "'.base_url().'default"</script>';
		}
	}

	function session_filter()
	{
		$data = array('seriid'=>$this->input->get('seriid'),
					'seriname'=>$this->input->get('seriname'),
					'stats'=>$this->input->get('stats'),
					'statid'=>$this->input->get('idstatus'),
					'orderdate2'=>$this->input->get('orderdateone'),
					'orderdate3'=>$this->input->get('orderdatetwo'),
					);
		$this->load->view('reporting/pemesanan/monitoring',$data);
	}

	function session_filter_redem()
	{
		$data = array('seriid'=>$this->input->get('seriid'),
					'seriname'=>$this->input->get('seriname'),
					'orderdate'=>$this->input->get('orderdate'),
					);
		$this->load->view('reporting/pemesanan/monitoring_red',$data);
	}

	function show_order_report_red()
	{
		if($_POST){
			$arr = array('IdSeri' => $this->input->post('seriid'),
						 'TglRedeem' => $this->input->post('orderdate')
						);
			$halaman = 1000;
			$nohal = 1;
			$idseri = $arr['IdSeri'];
			$orderdate = $arr['TglRedeem'];

			if(!empty($idseri) && !empty($orderdate))
			{
				$apiData = $this->Pemesanan_model->get_filter_order_report_red($idseri,$orderdate,$nohal,$halaman);
				echo $apiData;
			}
			else {
				 echo "Filter tidak lengkap!";
			}
		}else{
			echo '<script type="text/javascript">parent.content.location = "'.base_url().'default"</script>';
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
			$sql_query = $this->Pemesanan_model->get_query_detail($criteria);			
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
				$this->load->view('popup_pages/filter_order_detail', $data);
			}
			else
			{
				echo '<script type="text/javascript">parent.content.location = "'.base_url().'default"</script>';
			}
		}
	}


	function test()
	{
		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		$url = 'https://10.242.19.160/v1/pemesanan/seri/all/range?Search&TglPemesananAwal=2018-05-01&TglPemesananAkhir=2018-05-30&IdStatus=4&PageNumber=1&PageSize=1000&Sort';
	
		$RequestUrl = urlencode($url);
		$RequestUrl = strtolower($RequestUrl);
		$requestHttpMethod = 'get';
		$requestHttpMethod = strtoupper($requestHttpMethod);
		$RequestBodyBase64 = base64_encode(md5('""',true));
		$RequestTimeStamp = time();
		$Nonce = bin2hex(openssl_random_pseudo_bytes(10));
		$SignatureRawData = $APIId.''.$requestHttpMethod.''.$RequestUrl.''.$RequestTimeStamp.''.$Nonce.''.$RequestBodyBase64;
		$SignatureBase64 = base64_encode(hash_hmac('sha256', $SignatureRawData, $APIKey, 'true'));		
		$dataSignature = $APIId.':'.$SignatureBase64.':'.$Nonce.':'.$RequestTimeStamp;
		$AuthString = base64_encode($dataSignature);	

		$data = new stdClass;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization : amx '.$AuthString)
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		$var = json_decode($result);
		//echo json_encode($var->Records);
		
		var_dump($result);
	}
}

?>