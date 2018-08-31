<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusbayar extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Api'));
	}

	function index()
	{
		echo "Restrict Area";
	}

	function info()
	{
		phpinfo();
	}

	function StatusPembayaran()
	{
		//$data_post = $this->input->post('data');

		// if(!function_exists('apache_request_headers()'))
		// {
		// 	$headerValue = $this->apache_request_headers();
		// }
		// else
		// {
		// 	$headerValue = apache_request_headers();
		// }

		$headerValue = apache_request_headers();

		$headerIp = $headerValue["Host"];
		// print_r($headerValue); die();

		$json = file_get_contents('php://input');
		$json = urldecode($json);
		$data_post = $json;

		// print_r($data_post); die();
		
		//print_r($headerValue["Authorization"]); die();
		$Authorization = str_replace("amx ","",$headerValue["Authorization"]);

		$Authorization_dec = base64_decode($Authorization);
		$Authorization_split = explode(":", $Authorization_dec);

		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		$url = 'https://'.$headerIp.'/Api.jsp/StatusPembayaran';

		$data_string2 = str_replace(' ', '',$data_post);
		$data_string2 = str_replace("\r", '', $data_string2);
		$data_string2 = str_replace("\n", '', $data_string2);
		$data_string2 = str_replace("\t", '', $data_string2);
		$RequestUrl = urlencode($url);
		$RequestUrl = strtolower($RequestUrl);
		$requestHttpMethod = 'post';
		$requestHttpMethod = strtoupper($requestHttpMethod);
		$RequestBodyBase64 = base64_encode(md5($data_string2,true));
		$RequestTimeStamp =  $Authorization_split[3];
		$Nonce = $Authorization_split[2];
		$SignatureRawData = $APIId.''.$requestHttpMethod.''.$RequestUrl.''.$RequestTimeStamp.''.$Nonce.''.$RequestBodyBase64;
		$SignatureBase64 = base64_encode(hash_hmac('sha256', $SignatureRawData, $APIKey, 'true'));		
		$dataSignature = $APIId.':'.$SignatureBase64.':'.$Nonce.':'.$RequestTimeStamp;
		$AuthString = base64_encode($dataSignature);

		// print_r("<br/>");
		// print_r($RequestTimeStamp);
		// print_r("<br/>");
		// print_r($Nonce);
		// print_r("<br/>");
		// print_r($SignatureBase64);
		// print_r("<br/>");
		// print_r($RequestBodyBase64);
		// 		print_r("<br/>");
		// print_r($SignatureRawData);

		// print_r("<br/>");
		// print_r("<br/>");
		// print_r(base64_decode($AuthString));
		// print_r("<br/>");
		// print_r(base64_decode($Authorization)); 
		// die();

		if ($AuthString == $Authorization)
		{
			$countupdate = 0;
			$dataarray = []; 
			$recordgagal = [];

			$decode_post = json_decode($data_post);
			for($i = 0; $i < count($decode_post); $i++)
			{
				$data['KodePemesanan'] = $decode_post[$i]->KodePemesanan;
				$data['KodeBilling'] = $decode_post[$i]->KodeBilling;
				$data['NTPN'] = $decode_post[$i]->NTPN;
				$data['NTB'] = $decode_post[$i]->NTB;
				$data['TglJamPembayaran'] = $decode_post[$i]->TglJamPembayaran;
				$data['BankPersepsi'] = $decode_post[$i]->BankPersepsi;
				$data['ChannelPembayaran'] = $decode_post[$i]->ChannelPembayaran;
				$data['ModifiedAt'] = date("Y-m-d\TH:i:s\Z");
				$data['ModifiedBy'] = "KEMENKEU";

				$update_data = $this->Api->update_bayar($data);
				if($update_data)
				{
					$countupdate++;
					array_push($dataarray, $data);
				}
				else
				{
					$response_err['Message'] = "ERROR - Gagal Update Status Pembayaran Kode Pemesanan: " . $decode_post[$i]->KodePemesanan;
					$this->writeLog("","400 : ".$response_err['Message'],"Web Service","Update Status Bayar", "KEMENKEU",$data_post);
					array_push($recordgagal, $decode_post[$i]->KodePemesanan);
				}
			}

			if($countupdate == count($decode_post))
			{
				$Message = "Transaction successful";
				$response_success = array(
					'Code' => 1,
					'TotalRecord' => count($decode_post),
					'Success' => $countupdate,
					'Failed' => 0
					 );
				$dataresult = json_encode($response_success); 
				$this->writeLog("","201 : ".$Message,"Web Service","Update Status Bayar", "KEMENKEU",$data_post);
				header('Content-Type: application/json;charset=utf-8');
				echo $dataresult;
			}
			else
			{
				$jumlahgagal = count($decode_post) - $countupdate;
				$response['Message'] = "ERROR - Gagal Update Status Pembayaran ".  $jumlahgagal . " transaksi.";
				$response_failed = array(
					'Code' => 2,
					'TotalRecord' => count($decode_post),
					'Success' => $countupdate,
					'Failed' => $jumlahgagal,
					'FailedRecord' => $recordgagal,
					 );
				$dataresult = json_encode($response_failed);
				$this->writeLog("","400 : ".$response['Message'],"Web Service","Update Status Bayar", "KEMENKEU",$data_post);
				header('Content-Type: application/json;charset=utf-8');
				echo $dataresult;
			}
		}
		else
		{
			$response['Message'] = "ERROR - AMX Header tidak valid";
			$dataresult = json_encode($response);
			$this->writeLog("","401 : ".$response['Message'],"Web Service","Update Status Bayar", "KEMENKEU",$data_post);
			header('Content-Type: application/json;charset=utf-8');
			echo $dataresult;
		}
	}

	function TesKirim()
	{
		$arrayData = '[{"KodePemesanan":"10100310300002","KodeBilling":"920180416000618","NTPN":"F130A0LA25NDDL09","NTB":"000000154870","TglJamPembayaran":"2018-04-16T10:29:35Z","BankPersepsi":"520009000990","ChannelPembayaran":"7012"},{"KodePemesanan":"10100310300003","KodeBilling":"920180416000619","NTPN":"CB7F22G8A25TU002","NTB":"180416594019","TglJamPembayaran":"2018-04-16T10:35:18Z","BankPersepsi":"520002000990","ChannelPembayaran":"7014"},{"KodePemesanan":"10100310300004","KodeBilling":"920180416000622","NTPN":"BF0022G9EEAQQL02","NTB":"180416594286","TglJamPembayaran":"2018-04-16T10:36:13Z","BankPersepsi":"520002000990","ChannelPembayaran":"7014"},{"KodePemesanan":"10100310300001","KodeBilling":"920180416000617","NTPN":"7E99C0L8MGNTUF09","NTB":"000000145548","TglJamPembayaran":"2018-04-16T10:29:41Z","BankPersepsi":"520009000990","ChannelPembayaran":"7012"},{"KodePemesanan":"10100310300009","KodeBilling":"920180416000630","NTPN":"BA13F0M5QN0A9Q09","NTB":"000000347872","TglJamPembayaran":"2018-04-16T10:42:52Z","BankPersepsi":"520009000990","ChannelPembayaran":"7012"},{"KodePemesanan":"10100310300005","KodeBilling":"920180416000623","NTPN":"BA13F0M5QN0A9Q09","NTB":"000000347872","TglJamPembayaran":"2018-04-16T10:42:52Z","BankPersepsi":"520009000990","ChannelPembayaran":"7012"},{"KodePemesanan":"10100310300007","KodeBilling":"920180416000625","NTPN":"BCDBE4FJH1KDFPU8","NTB":"180416000209","TglJamPembayaran":"2018-04-16T10:44:14Z","BankPersepsi":"523016000990","ChannelPembayaran":"7012"},{"KodePemesanan":"10100310300008","KodeBilling":"920180416000626","NTPN":"BCDBE4FJH1KDFPU8","NTB":"180416000209","TglJamPembayaran":"2018-04-16T10:44:14Z","BankPersepsi":"523016000990","ChannelPembayaran":"7012"}]';
 
		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		$url = 'https://172.18.104.99/Api.jsp/StatusPembayaran';
		//$proxy = '172.18.104.20:1707';
		//$data_string = json_encode($arrayData);
		$data_string2 = str_replace(' ', '',$arrayData);
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
		echo $AuthString;die;	
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization: amx '.$AuthString)
		);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		
		var_dump($result);
	}

	function writeLog($RowIDTrx, $Message, $AppType, $LogType, $User, $Data)
	{
		$log = array(
			//'ROWID_TRX'	=> $RowIDTrx,
			'TRXLOG'	=> date("Y-m-d H:i:s"),
			'MESSAGE'	=> $Message,
			'USER'		=> $User,
			'APPTYPE'	=> $AppType,
			'LOGTYPE'	=> $LogType,
			'DATA'		=> $Data
		);
		$this->Api->SaveLog($log);
	}

	function apache_request_headers() { 
        $return = array();
        foreach($_SERVER as $key=>$value) { 
            if (substr($key,0,5)=="HTTP_") { 
                $key=str_replace(" ","-",ucwords(strtolower(str_replace("_"," ",substr($key,5))))); 
                $return[$key]=$value; 
            }else{
                $return[$key]=$value; 
            }
        } 
        return $return; 
    } 

    function getallheaders() 
    { 
       $headers = []; 
       foreach ($_SERVER as $name => $value) 
       { 
           if (substr($name, 0, 5) == 'HTTP_') 
           { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
       return $headers; 
    }

	
}
?>