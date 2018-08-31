<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ibank_api {
	var $CI;
	
	function __construct() {
		$this->CI =& get_instance();
	}
	
	/*
	* method untuk melakukan koneksi ke web service security
	* Service 	: 'LOGIN' 	OpenSession (membuka session)
	* 			: 'LOGOUT' 	CloseSession (menutup session)
	*/
	function opencon()
	{
		$this->CI->load->library('Nusoap_lib');
		$ws_url = $this->CI->parameter_helper->ibank_mdw;
		$client = new nusoap_client($ws_url, 'wsdl', '', '', '', '', '', 50);
		return $client;
	}
	
	/*
	* @method untuk validasi API
	* 
	*/
	public function validate($id, $code)
	{
		$client = $this->opencon();
		$body['ActionCode'] = 'VALIDATE';
		$body['Id'] = $id;
		$body['Ref_Id'] = $code;
		error_reporting(E_ALL^ E_WARNING);
		$result = $client->call('api', array('request' => $body));
		$errmsg = $client->getError();
		if ($errmsg)
		{
			$response['statuscode'] = '000';
			$response['description'] = 'ERROR';
			$response['message'] = 'IBNK00QC';
			$this->CI->log_website->write('', 'VALIDATE API', $errmsg, implode(" ## ", $body), date("Y-m-d H:i:s"));
		}
		else
		{
			$response['statuscode'] = $result['apiResult']['StatusCode'];
			$response['description'] = $result['apiResult']['Description'];
			$response['message'] = $result['apiResult']['Result'];
		}
		
		return $response;
	}
}

?>