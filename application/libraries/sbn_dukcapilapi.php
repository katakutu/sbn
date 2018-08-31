<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sbn_dukcapilapi {
	var $CI;
	
	function __construct() {
		$this->CI =& get_instance();
	}

	function validate_ktp($noktp, $tgllahir)
	{
		$url = 'http://172.18.44.62:8080/WsEktp/reqEktp.do?funcid=inquiryByNik&useridbrinets=9999901&nik=' .$noktp;
		$date = new Datetime('NOW');
		$tgllahir_formatted= date("d/m/Y", strtotime($tgllahir));

		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);

		$data_ktp = json_decode($data, true);
		$responseCode = $data_ktp['responseCode'];
		$tanggalLahir = $data_ktp['tanggalLahir'];

		if($responseCode == '00' && $tanggalLahir == $tgllahir_formatted){
			return true;
		} else {
			return false;
		}
	}
}