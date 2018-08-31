<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ibank_session {
	var $CI;
	
	function __construct() {
		$this->CI =& get_instance();
	}
	
	/*
	* @method untuk mengecek session client
	* 
	*/
	public function checking_session()
	{
		$session 	= $this->CI->session->userdata('session');
		
		if (is_null($session)) {
			echo '<script type="text/javascript">window.parent.location = "'.base_url().'Login.jsp"</script>';
		}
	}

	/*
	* @method untuk mengambil IP Address Client, jika berada dibelakang reverse proxy
	* 
	*/
	public function checking_ip()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}

?>