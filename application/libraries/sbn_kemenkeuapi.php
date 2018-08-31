<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sbn_kemenkeuapi {
	var $CI;
	
	function __construct() {
		$this->CI =& get_instance();
	}

	function get_data_api($link)
    {
        $APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
        $APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
        $url = $link;
    
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
        $proxy = '172.18.104.20:1707';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization : amx '.$AuthString)
        );
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

    function get_data_api_return($link)
	{
		$APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
		$APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
		$url = $link;
	
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
		$proxy = '172.18.104.20:1707';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization : amx '.$AuthString)
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}

    function get_data_api_return_json_decode($link)
    {
    	$APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
        $APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
        $url = $link;

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
		$proxy = '172.18.104.20:1707';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization : amx '.$AuthString)
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);

		return json_decode($result, true);
    }

    function get_data_api_direct_echo($link)
    {
    	$APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
		$APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
		$url = $link;
	
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
		$proxy = '172.18.104.20:1707';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization : amx '.$AuthString )
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		
		echo $result;
    }

    function get_data_kota($link)
    {
    	$APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
		$APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
		$url = $link;
	
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
		$proxy = '172.18.104.20:1707';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization : amx '.$AuthString )
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result);
		
		echo json_encode($result->Kota);
    }

    function get_data_api_direct_echo_tag($link)
    {
    	$APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
		$APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
		$url = $link;
	
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
		$proxy = '172.18.104.20:1707';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization : amx '.$AuthString )
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		echo "[". $result ."]";
    }

    function post_data_api($link, $data_string, $data_string_clean)
    {
    	$APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
		$APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
		$url = $link;
		$proxy = '172.18.104.20:1707';

		$RequestUrl = urlencode($url);
		$RequestUrl = strtolower($RequestUrl);
		$requestHttpMethod = 'post';
		$requestHttpMethod = strtoupper($requestHttpMethod);
		$RequestBodyBase64 = base64_encode(md5($data_string_clean,true));
		$RequestTimeStamp = time();
		$Nonce = bin2hex(openssl_random_pseudo_bytes(10));
		$SignatureRawData = $APIId.''.$requestHttpMethod.''.$RequestUrl.''.$RequestTimeStamp.''.$Nonce.''.$RequestBodyBase64;
		$SignatureBase64 = base64_encode(hash_hmac('sha256', $SignatureRawData, $APIKey, 'true'));		
		$dataSignature = $APIId.':'.$SignatureBase64.':'.$Nonce.':'.$RequestTimeStamp;
		$AuthString = base64_encode($dataSignature);	

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
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

    function put_data_api($link, $data_string, $data_string_clean)
    {
		$APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
		$APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
		$url = $link;  
		$proxy = '172.18.104.20:1707';

		$RequestUrl = urlencode($url);
		$RequestUrl = strtolower($RequestUrl);
		$requestHttpMethod = 'put';
		$requestHttpMethod = strtoupper($requestHttpMethod);
		$RequestBodyBase64 = base64_encode(md5($data_string_clean,true));
		$RequestTimeStamp = time();
		$Nonce = bin2hex(openssl_random_pseudo_bytes(10));
		$SignatureRawData = $APIId.''.$requestHttpMethod.''.$RequestUrl.''.$RequestTimeStamp.''.$Nonce.''.$RequestBodyBase64;
		$SignatureBase64 = base64_encode(hash_hmac('sha256', $SignatureRawData, $APIKey, 'true'));		
		$dataSignature = $APIId.':'.$SignatureBase64.':'.$Nonce.':'.$RequestTimeStamp;
		$AuthString = base64_encode($dataSignature);	
 
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization : amx '.$AuthString)
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
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

    function delete_data_api($link, $data_string, $data_string_clean)
    {
    	$APIId = '8d7d71ff7cf7433fb3427a65dcb8f1cf';
		$APIKey = 'pR4Dt7JpUsjV0Ch2A+bbrGCOhNsD0ShQNMF1LyhPjWo=';
		$url = $link;
		$data = new stdClass;  
		$proxy = '172.18.104.20:1707';

		$RequestUrl = urlencode($url);
		$RequestUrl = strtolower($RequestUrl);
		$requestHttpMethod = 'delete';
		$requestHttpMethod = strtoupper($requestHttpMethod);
		$RequestBodyBase64 = base64_encode(md5('""',true));
		$RequestTimeStamp = time();
		$Nonce = bin2hex(openssl_random_pseudo_bytes(10));
		$SignatureRawData = $APIId.''.$requestHttpMethod.''.$RequestUrl.''.$RequestTimeStamp.''.$Nonce.''.$RequestBodyBase64;
		$SignatureBase64 = base64_encode(hash_hmac('sha256', $SignatureRawData, $APIKey, 'true'));		
		$dataSignature = $APIId.':'.$SignatureBase64.':'.$Nonce.':'.$RequestTimeStamp;
		$AuthString = base64_encode($dataSignature);	
 
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization : amx '.$AuthString)
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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
}