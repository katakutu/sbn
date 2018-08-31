<?php 
class Front_popup extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function KewarganegaraanDb()
	{
		$this->load->view('front/front_popup/list_kewarganegaraan_front');
	}

	function show_kode_kewarganegaraan_db()
	{
		$this->Investor_model->get_kewarganegaraan();
		echo $this->datatables->generate();
	}

	function KdJenisPekerjaanDb()
	{
		$this->load->view('front/front_popup/list_kode_pekerjaan_front');
	}

	function show_kode_pekerjaan_db()
	{
		$_POST = $this->secure_array($_POST);
		$this->Investor_model->get_jenis_pekerjaan();
		echo $this->datatables->generate();
	}

	/* Show Provinsi */
	function ProvinsiDb()
	{		
	$this->load->view('front/front_popup/list_kode_provinsi_db');
	}

	function show_kode_provinsi_db()
	{
		$_POST = $this->secure_array($_POST);
		// print_r($_POST); die();
		//$_POST = $this->db->escape($_POST);

		// $result = $this->Investor_model->get_provinsi_2();
		// echo json_encode($result);

		$this->Investor_model->get_provinsi();
		echo $this->datatables->generate();
	}

	function KotaDb($province_code)
	{
		$data['province_code'] = $province_code;		
		$this->load->view('front/front_popup/list_kode_kota_db', $data);
	}

	function show_kode_kota_db()
	{
		$_POST = $this->secure_array($_POST);
		if($this->input->post('province_code') == NULL)
		{
			$this->Investor_model->get_kota_all();
		} else {
			$provinsi_code = $this->input->post('province_code');
			$this->Investor_model->get_kota($provinsi_code);
		}

		echo $this->datatables->generate();
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
?>