<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seri extends CI_Controller {
	var $sess;
	var $sessLang;
	var $CI;
	var $functionid = 310;

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
		$this->query_account();
	}

	function filter_view($message = '', $addition = '')
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
		// $this->load->view('reporting/seri/query', $data);
		$this->load->view('reporting/seri/query', $data);
	}

    function query_filter()
    {
    	$userid = $this->sess['iduser'];
		$this->Bank->get_datatable_order_report($userid);
  		echo $this->datatables->generate();
    }

    function seri_detail()
	{
		$id = $this->input->post('identifier');
		$data['resultdata'] = $this->Pemesanan_model->get_seri_id_detail($id);

		// print_r($data); die();

		$this->load->view('popup_pages/list_filter_seri', $data);
	}

	function show_seri_id()
	{
		// $seriid = $this->input->post('idseri');
		$seri = $this->Pemesanan_model->get_filter_seri_id();
		echo $seri;
	}

	function show_seri_order()
	{
		// $seriid = $this->input->post('idseri');
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/offer';
		$seri = $this->sbn_kemenkeuapi->get_data_api_return($url);
		echo $seri;
	}

	function show_seri_redem()
	{
		// $seriid = $this->input->post('idseri');
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/redeem';
		$seri = $this->sbn_kemenkeuapi->get_data_api_return($url);
		echo $seri;
	}
	
	function query_detail()
	{
		$id = $this->input->post('identifier');
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/'.$id;
		$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url);			

		$this->load->view('popup_pages/filter_order_detail_seri', $data);
	}

	function query_detail_redem()
	{
		$id = $this->input->post('identifier');
		
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/redeem/'.$id;
		$data['resultdata'] = $this->sbn_kemenkeuapi->get_data_api_return_json_decode($url);

		$this->load->view('popup_pages/filter_redem_detail_seri', $data);
	}
}

?>