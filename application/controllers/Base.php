<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
	var $sess;
	var $sessLang;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		if(is_direct())
		{
			//redirect(base_url());
		}
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
		$this->load->model('managementcontent_model');
	}

	function index()
	{
		$user = $this->User->get_username($this->sess['userid']);
		foreach ($user ->result() as $row) {
			$data['name'] = ucwords(strtolower($row->NAME));
			$data['name_detail'] = '<strong>Email 		:</strong> xxx'.substr($row->EMAIL, strlen($row->EMAIL) - 15, strlen($row->EMAIL)).'<br />';
			$data['name_detail'] .= '<strong>SID Investor :</strong> '.$row->SID.'<br />';
			$data['name_detail'] .= '<strong>Sub Registri  :</strong> '.$row->SUBREG.'<br />';
			$data['name_detail'] .= '<strong>Last login :</strong> <br />'.date('d M Y H:i:s', strtotime($row->LASTLOGIN)).'<br />';
			$data['name_detail'] .= '<strong>Last logout :</strong> <br />'.date('d M Y H:i:s', strtotime($row->LASTLOGOUT)).'<br />';
			
			$prev_password = $row->PREVPASSWORD;
		}
			$data['header'] = $this->menuheader($this->sess['userid']);
			$this->load->view('main/base', $data);
	}

	function menuheader($userid)
	{
		$i = $this->sess['menuheader'];
		$header = '';

		foreach ($i as $idm) {
			$menu = $this->Menuheader->get_menuheader($idm);
			foreach ($menu ->result() as $row) {
				if ($row->ID == 0)
				{
					$header .=  '<li id="0" class="nav-child active">';
				}
				else
				{
					$header .= '<li class="nav-child" id="'.$row->ID.'">';
				}

				if ($row->ID == 0) {
					$header .= '<a href="Home.jsp" title="'.$this->lang->line(strtolower($row->NAMEHEADER)).'" target="">';
				}
				else {
					$header .= '<a href="javascript:void(0);" onclick="clickedHeaderMenu(\'default\', \'Home.jsp/origin/'.$row->ID.'\', '.$row->ID.')" title="'.$this->lang->line(strtolower($row->NAMEHEADER)).'" target="">';
				}
				$header .= '<i class="'.$row->LOGO.'"></i>';
				$header .= '&nbsp;'.$this->lang->line(strtolower($row->NAMEHEADER));
				$header .= '</a>';
				$header .= '</li>';
			}
		}
		
		return $header;
	}

	function content()
	{
		$data['termscontent'] = '';
		$data['transfer'] = '';
		$data['payment'] = '';
		$data['notification'] = '';

		/* Level */
		$usertype = $this->sess['usertype'];
		$level = 'add';
		$status = 0;
		if ($usertype == 2) { $level = 'verify'; $status = 1; }
		else if ($usertype == 3) { $level = 'approve'; $status = 2; }
		/* ==== */

		$user = $this->User->get_username($this->sess['userid']);
		foreach ($user ->result() as $row) {
			$data['name']		 = ucwords(strtolower(explode(" ", $row->NAME)[0]));
			$data['full_name'] 	= ucwords(strtolower($row->NAME));
			$data['title'] 		= $this->lang->line(strtolower($row->TITLE));
			$data['sid'] 		= $row->SID;
			$data['subreg']		= $row->SUBREG;
			if ($row->GENDER == 1){
				$data['img'] = "man";
			} else {
				$data['img'] = "woman";
			}
			$data['image_content'] = $this->managementcontent_model->get_front();
			$data['handphone'] = 'xxxxxxxx'.substr($row->HANDPHONE, strlen($row->HANDPHONE) - 4, strlen($row->HANDPHONE));
			$data['email'] = 'xxx'.substr($row->EMAIL, strlen($row->EMAIL) - 15, strlen($row->EMAIL));
		}

		$this->load->view('main/content', $data);
	}

	function keya(){
		// Create a cURL handle
$ch = curl_init('http://apisbn.kemenkeu.go.id/v1/seri/offer');

// Execute
curl_exec($ch);

// Check if any error occurred
if (!curl_errno($ch)) {
  $info = curl_getinfo($ch);
  print_r($info);
}

// Close handle
curl_close($ch);
	}

	function key()
	{
		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/redemption/seri/2/IDD9869DUMMY';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/10100310300025';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/IDD9869DUMMY';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/offer'; -- IDD98765DUMMY;
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/provinsi';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/redeemable/IDD9869DUMMY';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/redeemable/IDD9868DUMMY';
		//$url =$this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/seri/all/IDD9868DUMMY';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/offer';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/investor/IDD1234511DUMMY';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/Kuota/2/IDD1234511DUMMY';
		//$url = $this->parameter_helper->ip_intranet_sbn.'/v1/seri/redeem/2' ;


	
		$RequestUrl = urlencode($url);
		$RequestUrl = strtolower($RequestUrl);
		$requestHttpMethod = 'get';
		$requestHttpMethod = strtoupper($requestHttpMethod);
		$RequestBodyBase64 = base64_encode(md5('""',true));
		$RequestTimeStamp = time();
		$Nonce = bin2hex(openssl_random_pseudo_bytes(10));
		$SignatureRawData = $APIId.''.$requestHttpMethod.''.$RequestUrl.''.$RequestTimeStamp.''.$Nonce.''.$RequestBodyBase64;
		$SignatureBase64 = base64_encode(hash_hmac('sha256', $SignatureRawData, $APIKey, 'true'));		
		$dataSignature = $APIId.':'.$SignatureBase64.':'.$Nonce.':'.$RequestTimeStamp;
		$AuthString = base64_encode($dataSignature);	

		$data = new stdClass;   
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization : amx '.$AuthString)
		);

		//print_r($AuthString);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);

 if ($result === false) $result = curl_error($ch);
  echo stripslashes($response);

		curl_close($ch);
		var_dump($result);
	}

	function sidemenu($headerid = 0)
	{
		$data['output'] = "";

		$function = [];
		
		$groupmenu = $this->Groupmenu->list_function($headerid);
		//var_dump($checkerclient);exit();
		foreach ($groupmenu ->result() as $index => $row)
		{
			$function[$index] = $row->IDFUNCTION;
			
			if (in_array($function[$index], $this->sess['menu']))
			{
				$get_function = $this->Functions->get_function($function[$index]);
				foreach ($get_function ->result() as $row)
				{
					$name_function = $row->NAME;
					$type_function = $row->TYPE;
					$link_function = $row->LINK;
					$new_name_function = str_ireplace("cms", "CMS", str_ireplace("bpjs", "BPJS", str_ireplace("skbdn", "SKBDN", str_ireplace(" lc", " LC", str_ireplace("swift", "SWIFT", str_ireplace("rtgs", "RTGS", str_ireplace("llg", "LLG", str_ireplace("ft", "FT", ucwords(strtolower($name_function))))))))));
				}
				
				$data['output'] .= '<div class="panel-default">';
				$data['output'] .= '<div class="panel-heading" role="tab" id="'.preg_replace("/[^[:alnum:]]/u", '', strtolower($name_function)).'">';
				$data['output'] .= '<h4 class="panel-title">';
				$data['output'] .= '<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.preg_replace("/[^[:alnum:]]/u", '', strtolower($name_function)).'-group" aria-expanded="false" aria-controls="'.preg_replace("/[^[:alnum:]]/u", '', strtolower($name_function)).'-group" onclick="toggle_caret(\''.preg_replace("/[^[:alnum:]]/u", '', strtolower($name_function)).'-caret\');" >';
				$data['output'] .= '<i id="'.preg_replace("/[^[:alnum:]]/u", '', strtolower($name_function)).'-caret" class="glyphicon glyphicon-chevron-right"></i>&nbsp;'.$this->lang->line(strtolower($new_name_function)).'';
				$data['output'] .= '</a>';
				$data['output'] .= '</h4>';
				$data['output'] .= '</div>';
				$data['output'] .= '<div id="'.preg_replace("/[^[:alnum:]]/u", '', strtolower($name_function)).'-group" class="panel-collapse collapse" role="tabpanel" aria-labelledby="'.preg_replace("/[^[:alnum:]]/u", '', strtolower($name_function)).'">';
				$data['output'] .= '<ul class="list-group">';

				$get_child = $this->Functions->get_child($function[$index], $this->sess['usertype']);
				foreach ($get_child ->result() as $row)
				{					
					$id_child = $row->ID;
					$name_child = $row->NAME;
					//if($client->CHECKERTOTAL == 0 && $client->SIGNERTOTAL == 0 && $name_child == "EDIT")
					//{
						
					//}
					//else
					//{
						$data['output'] .= '<li class="list-group-item"><a href="javascript:void(0);" id="sidemenu" onClick="parent.goto(\''.base_url().'Redirect.jsp/'.rtrim(base64_encode($this->sess['userid']), "=").'/'.$id_child.'\')">'.$this->lang->line(strtolower($name_child)).'</a></li>';
					//}
				}
				
				$data['output'] .= '</ul>';
				$data['output'] .= '</div>';
				$data['output'] .= '</div>';
			}
		}

		$this->load->view('main/side', $data);
	}
	
	function default_pg()
	{
		$this->load->view('main/default');
	}

	function getlang(){
		$lang = trim($this->sessLang);
		print $lang;
	}
}