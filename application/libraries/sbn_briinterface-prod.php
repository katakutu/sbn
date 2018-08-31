<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sbn_briinterface {
	var $CI;
	
	function __construct() {
		$this->CI =& get_instance();
	}
	
	/*
	* method untuk melakukan koneksi ke BRIInterface
	*/
	function opencon()
	{
		$this->CI->load->library('Nusoap_lib');
		$ws_url = $this->CI->parameter_helper->brifast_mdw;
		$client = new nusoap_client($ws_url, 'wsdl', '', '', '', '', '', 50);
		return $client;
	}
	
	/*
	* method untuk melakukan inquiry account dengan cek kewenangan rekening
	*/
	public function inquiry_account($accountno)
	{
		$client = $this->opencon();

		$body['acctno'] = $accountno;
		
		error_reporting(E_ALL^ E_WARNING);
		
		$result = $client->call('doInquiryAccount', $body);
		$errmsg = $client->getError();
		
		if ($errmsg)
		{
			$response['statuscode'] = '0000';
			$response['statusdesc'] = 'ERROR';
		}
		else
		{
			$response['accountname'] = $result['doInquiryAccountResult']['accountname'];
			$response['accountstatus'] = $result['doInquiryAccountResult']['accountstatus'];
			$response['accountstatusdesc'] = $result['doInquiryAccountResult']['accountstatusdesc'];
			$response['statuscode'] = $result['doInquiryAccountResult']['statuscode'];
			$response['statusdesc'] = $result['doInquiryAccountResult']['statusdesc'];
		}

		return $response;
	}
}
