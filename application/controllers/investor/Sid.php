<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sid extends CI_Controller {
	var $sess;
	var $sessLang;
	var $functionid = 50;

	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
	}

	function index()
	{
		$this->add_sid();
	}

	function add_sid($message = 0, $addition = '', $data_post = null)
	{
		$Uid = $this->sess['iduser'];
		$siduser = $this->sess['sid'];
		$result = $this->Investor_model->get_sid($Uid);

		if(!$result == null)
		{
			flash_err($this->lang->line("msg_failed_registered_sid")); 
    		$this->load->view('investor/message');
		}
		else
		{
			$data['fid'] = $this->functionid;
			$data['message'] = $message;
			$data['addition'] = $addition;
			if ($message == 'msg_success'){
				$data['msg_type'] = 'success';
				$data['msg_icon'] = 'ok-sign';
			} else{
				$data['msg_type'] = 'danger';
				$data['msg_icon'] = 'remove-sign';
			}
			if($data_post != null) { $data['post'] = $data_post; }
			
			$criteria['handle'] = $this->sess['userid'];
			$sql_query = $this->User->get_detail($criteria);

			if ($sql_query)
			{
				foreach ($sql_query ->result() as $row)
				{
					$data['id'] = $row->ID;
					$data['siduser'] = $this->sess['sid'];
					$data['username'] = $row->NAME;
					$data['npwp'] = $row->SALT;

					$u_type = $row->IDTYPE;
					$data['usertypeid'] = $u_type;
					if ($u_type == 1)
						$data['_usertypeid_'] = $this->lang->line('id card ktp');
					else
						$data['_usertypeid_'] = $this->lang->line('id card passport');
					$data['useridcard'] = $row->IDNUMBER;

					$userbirthdate = new DateTime($row->BIRTHDATE);
					$data['userbirthdate'] = $userbirthdate->format('d-m-Y');
					$data['gender'] = $row->GENDER;
					$data['useraddress'] = $row->ADDRESS;
					$data['usertelephone'] = $row->PHONE;
					$data['userhandphone'] = $row->HANDPHONE;
					$data['useremail'] = $row->EMAIL;
					$data['usertitle'] = $row->TITLE;
				}

				$this->load->view('investor/add_sid', $data);
			}
		}
	}

	function insert_sid()
	{
		/* Define post data */
		$data['KODE_BANK']				= "BRI01";
		$data['NOMOR_REKENING']			= $this->input->post('USER_ACC');
		$data['NAMA']					= $this->input->post('USER_NAME');
		$data['NOMOR_KTP']				= $this->input->post('USER_ID_CARD');
		$data['NOMOR_NPWP']				= $this->input->post('USER_NPWP');
		$data['TEMPAT_LAHIR']			= $this->input->post('USER_BIRTHPLACE');
		$data['TANGGAL_LAHIR']			= date("Y-m-d H:i:s", strtotime($this->input->post('USER_BIRTHDATE')));
		$data['KEWARGANEGARAAN']		= "ID";
		$data['TIPE_INVESTOR']			= "ID";
		$data['GENDER']					= $this->input->post('USER_INVESTOR_GENDER');
		$data['KODE_JENIS_PEKERJAAN']	= $this->input->post('typeofwork_code');
		$data['PEKERJAAN']				= $this->input->post('typeofwork_name');
		$data['KODE_NEGARA']			= "ID";
		$data['NEGARA']					= "INDONESIA";
		$data['KODE_PROVINSI']			= $this->input->post('province_code');
		$data['PROVINSI']				= $this->input->post('province');	
		$data['KODE_KOTA']				= $this->input->post('city_code');
		$data['KOTA']					= $this->input->post('city');
		$data['ALAMAT']					= $this->input->post('USER_ADDRESS');
		$data['NOMOR_TELEPON']			= $this->input->post('USER_TELEPHONE');
		$data['NOMOR_HANDPHONE']		= $this->input->post('USER_HANDPHONE');
		$data['EMAIL']					= $this->input->post('USER_EMAIL');
		$date 							= new Datetime('NOW');
		$data['CREATEDDATE']			= $date->format('Y-m-d H:i:s');
		$data['USERID']					= $this->sess['iduser'];
		$data['STATUS']					= "1";

		$config_validation = array(
			array( 'field'=>'USER_ACC','label'=>$this->lang->line('account_no'),'rules'=> 'trim|required|regex_match[/^[0-9,\/\-+]+$/]'),
			array( 'field'=>'USER_NAME','label'=>$this->lang->line('full name'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9. ]+$/]'),
			array( 'field'=>'USER_ID_CARD','label'=>$this->lang->line('id card number'),'rules'=> 'trim|required|min_length[15]|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'USER_NPWP','label'=>$this->lang->line('npwp number'),'rules'=> 'trim|required|min_length[15]|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'USER_BIRTHPLACE','label'=>$this->lang->line('place of birth'),'rules'=> 'trim|required|regex_match[/^[a-zA-Z0-9.,\/\-+ ]+$/]'),
			array( 'field'=>'USER_BIRTHDATE','label'=>$this->lang->line('tgl lahir'),'rules'=> 'trim|required|regex_match[/^[0-9,\/\-+]+$/]'),
			array( 'field'=>'USER_ADDRESS','label'=>$this->lang->line('address'),'rules'=> 'trim|required|max_length[100]|regex_match[/^[a-zA-Z0-9.,\/\-+ ]+$/]'),
			array( 'field'=>'USER_TELEPHONE','label'=>$this->lang->line('phone number'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'USER_HANDPHONE','label'=>$this->lang->line('mobile phone number'),'rules'=> 'trim|required|regex_match[/^[0-9]+$/]'),
			array( 'field'=>'USER_EMAIL','label'=>$this->lang->line('email'),'rules'=> 'trim|required|valid_email'),
		);

		$this->form_validation->set_rules($config_validation);

		if($this->form_validation->run() == TRUE)
		{	
			$query_insert = $this->Investor_model->insert_sid($data);
			if($query_insert)
			{
				flash_succ($this->lang->line("msg_succ_register_sid")); 
				$this->load->view('investor/message');
			}
			else
			{
				flash_err($this->lang->line('msg_failed'));
				$this->add_sid();
			}	
		} 
		else
		{

			$data['JENIS_PEKERJAAN']		= $this->input->post('typeofwork_name');
			$data['PROVINSI']				= $this->input->post('province');
			$data['KOTA']					= $this->input->post('city');
			$this->add_sid('', '', $data);
		}
	}

	function filter_view_sid($message = '', $addition = '')
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
		$this->load->view('investor/filter_sid', $data);
	}

	function query_filter()
    {
    	$userid = $this->sess['iduser'];
		$this->Investor_model->data_sid($userid);
  		echo $this->datatables->generate();
    }

    function sid_detail()
	{
		$criteria = $this->sess['iduser'];
		$sql_query = $this->Investor_model->get_sid_detail($criteria);			
		if ($sql_query->result())
		{
			foreach ($sql_query ->result() as $row)
			{
				$data['sid'] = $row->SID;
				$data['kode_bank'] = $row->KODE_BANK;
				$data['nomor_rekening'] = $row->NOMOR_REKENING;
				$data['name'] = $row->NAMA;
				$data['nomor_ktp'] = $row->NOMOR_KTP;
				$data['nomor_npwp'] = $row->NOMOR_NPWP;
				$data['tempat_lahir'] = $row->TEMPAT_LAHIR;
				$data['tanggallahir'] = $row->TANGGAL_LAHIR;
				$data['tanggal_lahir'] = date("d-m-Y", strtotime($data['tanggallahir']));
				$data['kewarganegaraan'] = $row->KEWARGANEGARAAN;
				$data['tipe_investor'] = $row->TIPE_INVESTOR;
				$data['gender'] = $row->GENDER;
				$data['pekerjaan'] = $row->PEKERJAAN;
				$data['negara'] = ucfirst(strtolower($row->NEGARA));
				$data['provinsi'] = $row->PROVINSI;
				$data['kota'] = $row->KOTA;
				$data['alamat']	= $row->ALAMAT;
				$data['nomor_telepon'] = $row->NOMOR_TELEPON;
				$data['nomor_handphone'] = $row->NOMOR_HANDPHONE;
				$data['email'] = $row->EMAIL;

			}
			$this->load->view('investor/sid_detail', $data);
		}
		else
		{
			echo '<script type="text/javascript">parent.content.location = "'.base_url().'default"</script>';
		}
	}

}

?>