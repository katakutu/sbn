<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audit_website {
	var $CI;
	
	function __construct() {
		$this->CI =& get_instance();
	}

	/*
	* method untuk menulis audittrail website
	*/
	function write($userid, $transactionid, $description, $data, $time){
		$data = array(
			'user' 	=> $userid,
			'transactionid'		=> $transactionid,
			'description'	=> $description,
			'data'	=> $data,
			'time'		=> $time,
			'ipinfo'		=> $this->CI->ibank_session->checking_ip()
			);
		$this->CI->Auditsite->audit_insert($data);
	}
}