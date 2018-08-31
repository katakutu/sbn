<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subreg extends CI_Controller {
	var $sess;
	var $sessLang;
	var $functionid = 10;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
		$this->load->model(array('Subreg_model'));
	}

	function index()
	{
		$this->add_subreg();
	}
	
    function add_subreg()
    {
    	$Uid = $this->sess['iduser'];
    	$result = $this->Investor_model->get_investor_detail($Uid);
    	$idbank = 'SRBRINIDJA';
    	$subregname = 'SUBREGBRI-'.mt_rand('100000','999999');
    	if ($result != NULL)
    	{
	    	$data = array();
	        if($this->input->post('submit'))
	        {	
	        	$config_validation = array(
					array( 'field'=>'sid_subreg','label'=>$this->lang->line('sid_subreg'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
					array( 'field'=>'fullname','label'=>$this->lang->line('name'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
					array( 'field'=>'idcardktp','label'=>$this->lang->line('id card ktp'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
					array( 'field'=>'city','label'=>$this->lang->line('city'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
				);

	            $date = new Datetime('NOW');

	            $dataArray = array(
	            	'id_name' => $this->input->post('kodebank'),
					'sid' => $this->input->post('sid_subreg'),
					'nama' => $this->input->post('fullname'),
					'ktp' => $this->input->post('idcardktp'),                        
					'kota' => $this->input->post('city_code'),
					'id_subreg' => $this->input->post('randsubreg'),
					'createddate' => $date->format('Y-m-d H:i:s'),
					'userid' => $this->sess['iduser'],
				);

				$resultdata = $this->Subreg_model->insert_subreg($dataArray);
			    $this->form_validation->set_rules($config_validation);
		        if($this->form_validation->run() == TRUE)
		        {
		        	flash_succ($this->lang->line("msg_success_add_subreg_200").$subregname);	
			    }
			    else
		        {
					if ($resultdata[0] == 404)
			        {
						flash_err($this->lang->line("msg_failed_edit_investor_404"));
			        }
			        else if ($resultdata[0] == 400)
			       	{
			       		flash_err($this->lang->line("msg_failed_edit_investor_400"));
			       	}
			        else
			        {
						flash_err($this->lang->line("msg_failed_400"));
			        }
		        }
	        }
	      	
	        $uid = $this->sess['iduser'];
	        $sql_query = $this->Investor_model->get_investor_detail($uid);
			foreach ($sql_query as $row)
			{
				$data['sid'] = $row->sid;
				$data['gender_code'] = $row->gender_code;  
	            $data['fullname'] = $row->fullname;  
	            $data['idcard_no'] = $row->idcard_no;    
	            $data['dateofbirth'] = date('Y-m-d', strtotime($row->dateofbirth)); 
	            $data['typeofwork_name'] = $row->typeofwork_name; 
	            $data['mobilephone_no'] =  $row->mobilephone_no; 
	            $data['phone_no'] =  $row->phone_no; 
	            $data['email'] =  $row->email; 
	            $data['status'] =  $row->status;
	            $data['subreg'] =  $subregname;
	            $data['bankkode'] =  $idbank; 
			}

			$this->load->view('investor/add_subreg', $data); 
		} 
		else
	    {
	    	$this->load->view('investor/add_subreg');
    	} 
    }

    function filter_subreg($message = '', $addition = '')
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
		$this->load->view('investor/filter_subreg', $data);
	}

    function query_filter()
    {
    	$userid = $this->sess['iduser'];
		$this->Subreg_model->data_subreg($userid);
  		echo $this->datatables->generate();
    }

    function subreg_detail()
    {
    	$validator = base64_decode($this->input->post('user_validator'));
    	$id = $this->input->post('identifier');
		$data['id'] = $id;

		if ($validator == $this->sess['iduser'])
		{
			$criteria['id_subreg'] = $id;
			$criteria['userid'] = $validator;

			$sql_query = $this->Subreg_model->get_subreg_detail($criteria);
			if ($sql_query->result())
			{
				foreach ($sql_query ->result() as $row)
				{
					$data['kodebank'] = $row->ID_NAME;
					$data['sid'] = $row->SID;
					$data['nama'] = $row->NAMA;
					$data['ktp'] = $row->KTP;
					$data['kotanama'] = $row->KOTA_NAMA;
					$data['id_subreg'] = $row->ID_SUBREG;
				}

				$this->load->view('investor/subreg_detail', $data);
			}
		}
    }

	function doInquiryAccount()
	{		
		$accountno = $this->input->post('accountno');

		$account_detail = $this->sbn_briinterface->inquiry_account($accountno);

		echo json_encode($account_detail);
	}
}
?>