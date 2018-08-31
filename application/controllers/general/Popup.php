<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup extends CI_Controller {
	var $sess;
	var $sessLang;
	
	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
	}

	
	function bank_name()
	{
		$this->load->view('popup_pages/list_bank_name');
	}
	
	function bank_code()
	{
		$this->load->view('popup_pages/list_bank_code');
	}

	function show_bank_name()
	{
		$this->Bank->get_bank_name();
		echo $this->datatables->generate();
	}
	
	function show_bank_code()
	{
		$this->Bank->get_bank_code();
		echo $this->datatables->generate();
	}

	/* Show KdJenisPekerjaan */
	function KdJenisPekerjaan()
	{		
		$this->load->view('popup_pages/list_kode_pekerjaan');
	}

	function show_kode_pekerjaan()
	{
		/* Data API */
    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pekerjaan';
		/* End */
    	echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url); 
	}

	
	function KdJenisPekerjaanDb()
	{
		$this->load->view('popup_pages/list_kode_pekerjaan_db');
	}

	function show_kode_pekerjaan_db()
	{
		$this->Investor_model->get_jenis_pekerjaan();
		echo $this->datatables->generate();
	}

	/* Show Provinsi */
	function Provinsi()
	{		
	$this->load->view('popup_pages/list_kode_provinsi');
	}

	function show_kode_provinsi()
	{
		/* Data API */
    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/provinsi';
		/* End */
    	echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url); 
	}

	/* Show Provinsi */
	function ProvinsiDb()
	{		
	$this->load->view('popup_pages/list_kode_provinsi_db');
	}

	function show_kode_provinsi_db()
	{
		$this->Investor_model->get_provinsi();
		echo $this->datatables->generate();
	}

	/* Show Kota */
	function Kota()
	{		
		$this->load->view('popup_pages/list_kode_kota');
	}

	function show_kode_kota()
	{
		$province_code = $this->input->post('province_code');
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/provinsi/'.$province_code;
		echo $this->sbn_kemenkeuapi->get_data_kota($url);
	}

	function KotaDb()
	{
		$this->load->view('popup_pages/list_kode_kota_db');
	}

	function KotaDb2()
	{
		$this->load->view('popup_pages/list_kode_kota_db2');
	}

	function show_kode_kota_db()
	{
		if($this->input->post('province_code') == NULL)
		{
			$this->Investor_model->get_kota_all();
		} else {
			$provinsi_code = $this->input->post('province_code');
			$this->Investor_model->get_kota($provinsi_code);
		}

		echo $this->datatables->generate();
	}

	function show_kode_kota_db2()
	{
		if($this->input->post('province_code') == NULL)
		{
			$this->Investor_model->get_kota_all();
		} else {
			$provinsi_code = $this->input->post('province_code');
			$this->Investor_model->get_kota($provinsi_code);
		}

		echo $this->datatables->generate();
	}

	function KewarganegaraanDb()
	{
		$this->load->view('popup_pages/list_kewarganegaraan_db');
	}

	function show_kode_kewarganegaraan_db()
	{
		$this->Investor_model->get_kewarganegaraan();
		echo $this->datatables->generate();
	}

	/* Show Filter Investor */
	function Filter()
	{		
		$userid = $this->sess['userid'];

		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor';
		$this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
		
		echo $this->datatables->generate();
		$this->load->view('popup_pages/list_filter_investor');
	}

	function Filter_secaccount()
	{		
		$userid = $this->sess['userid'];
		$this->Bank->get_filter_secaccount_sid($userid);
		echo $this->datatables->generate();
		$this->load->view('popup_pages/list_filter_secaccount');
	}

	function Filter_fundaccount()
	{		
		$userid = $this->sess['userid'];
		$this->Bank->get_filter_fundaccount_sid($userid);
		echo $this->datatables->generate();
		$this->load->view('popup_pages/list_filter_fundaccount');
	}

	function show_investor()
	{
		/* Data API */
    	$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor';
		/* End */
    	echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url); 
	}

	function show_investor_by_sid()
	{
		$nama = rawurlencode($this->input->post('fullname'));
		$ktp = $this->input->post('idcardno');
		$tgllahir = $this->input->post('dateofbirth'); 
		$userid = $this->input->post('sid');
		if(isset($nama) && isset($ktp) && isset($tgllahir)){
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor?Nama='.$nama.'&NoIdentitas='.$ktp.'&TglLahir='.$tgllahir;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url); 
			//echo $this->Bank->get_filter($nama,$ktp,$tgllahir);
			//echo json_encode($data, TRUE);
		}else{
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/'.$userid;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
			//echo $this->Bank->get_filter_by_sid($userid);
			//echo json_encode($data, TRUE);
		}
	}

	function show_secaccount_filter()
	{
		$idreksb = $this->input->post('id_reksb'); 
		$sid = $this->input->post('sid');
		if(isset($sid)){
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningsb?Sid='.$sid;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
			//echo $this->Bank->get_filter_reksb_sid($sid);
			//echo json_encode($data, TRUE);
		}else{
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningsb/'.$idreksb;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo_tag($url);	
			//echo $this->Bank->get_filter_reksb_idreksb($idreksb);
			//echo json_encode($data, TRUE);
		}
	}

	function show_fundaccount_filter()
	{
		$idrek = $this->input->post('id_rek'); 
		$sid = $this->input->post('sid');
		if(isset($sid)){
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningdana?Sid='.$sid;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
			//echo $this->Bank->get_filter_rekdana_sid($sid);
		}else{
			$url = $this->parameter_helper->ip_intranet_sbn.'/v1/rekeningdana/'.$idrek;
			echo $this->sbn_kemenkeuapi->get_data_api_direct_echo_tag($url);
			//echo $this->Bank->get_filter_rekdana_idrek($idrek);
		}
	}

	/* Show KdBank */
	function KdBank()
	{		
		$this->load->view('popup_pages/list_kode_bank');
	}

	function show_kode_bank()
	{
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/Bank';
		echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
		//echo $this->Bank->get_kd_bank();
	}

	/* Show KdSugreg */
	function KdSubreg()
	{		
		$this->load->view('popup_pages/list_kode_subreg');
	}

	function show_kode_subreg()
	{
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/SubRegistry';
		echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
		//echo $this->Bank->get_kd_subreg();
	}

	function StatusName()
	{		
		$this->load->view('popup_pages/list_status');
	}

	function SeriName()
	{		
		$this->load->view('popup_pages/list_seri_name');
	}

	function show_all_seri()
	{
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri';
		echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
		//echo $this->Bank->get_seri_all();
	}

	/* Show SeriOffer */
	function SeriOffer()
	{		
		$this->load->view('popup_pages/list_seri_offer');
	}

	function show_seri_offer()
	{
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/offer';
		echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
		//echo $this->Bank->get_seri_offer();
	}

	function show_status()
	{
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/statustransaksi';
		echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
		//echo $this->Bank->get_status();
	}

	/* Show FundAccount */
	function FundAccount()
	{		
		$this->load->view('popup_pages/list_fund_account');
	}

	function show_fund_account()
	{
		$_POST = $this->secure_array($_POST);
		$userid = $this->sess['iduser'];
		$this->Bank->get_fund_account($userid);
		echo $this->datatables->generate();
	}

	/* Show SecAccount */
	function SecAccount()
	{		
		$this->load->view('popup_pages/list_sec_account');
	}

	function show_sec_account()
	{
		$userid = $this->sess['iduser'];
		$this->Bank->get_sec_account($userid);
		echo $this->datatables->generate();
	}

	/* Show Orders */
	function OrderRedemption()
	{		
		$this->load->view('popup_pages/list_order_redemption');
	}

	function show_order_redemption()
	{
		$sid = $this->sess['sid'];
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/redeemable/'.$sid;
		echo $this->sbn_kemenkeuapi->get_data_api_direct_echo($url);
	}

	function secure_array($array0 = array())
	{
	 // this function secures the content of an array against SQL injection and HTML code injection attacks
	 // it works for arrays of any number of dimensions, recursively for each dimension
		// print_r($array0);die();
		$result = array();
	 
		if (count($array0)>0)
		{
		     foreach ($array0 as $key0 => $value0)
		     {
		        if (is_array($value0)) // if element is array, then go to next dimension
		        {
		           	// $this->secure_array($array[$key]);
		        	foreach ($value0 as $key1 => $value1) {
		        		if (is_array($value1)) {
		        			foreach ($value1 as $key2 => $value2) {
		        				if (is_array($value2)) {
				        			foreach ($value2 as $key3 => $value3) {
				        				$val = $this->db->escape($value3);
		        						$result[$key0][$key1][$key2][$key3] = $val;
				        			}
				        		} else {
				        			$val = $this->db->escape($value2);
		        					$result[$key0][$key1][$key2] = $val;
				        		}
		        			}
		        		} else {
		        			$val = $this->db->escape($value1);
		        			$result[$key0][$key1] = $val;
		        		}
		        		
		        	}

		        }
		        else // if element is a normal variable, clean it up
		        {
		           //$array[$key] = $mysqli -> real_escape_string($array[$key]); // replace this with mysql / PDO real escape string function depending on which database connector you are using
		           // $array[$key] = $this->db->escape($array[$key]);
		           // $array[$key] = strip_tags($array[$key]);
		        	$val = $this->db->escape($value0);
		        	$result[$key0] = $val;
		        }
		    }
		}

		return $result;
	}
}