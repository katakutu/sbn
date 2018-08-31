<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pemesanan_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insert_order($data=array(), $uid)
    {
        try
        {
			$KodePemesanan = $this->db->escape($data['KodePemesanan']);
			$Seri = $this->db->escape($data['Seri']);
			$TingkatKupon = $this->db->escape($data['TingkatKupon']);
			$TglBayarKupon = $this->db->escape($data['TglBayarKupon']);
			$TglSetelmen = $this->db->escape($data['TglSetelmen']);
			$TglSetelmen = str_replace('T', ' ', $TglSetelmen);
			$TglSetelmen = str_replace('Z', '', $TglSetelmen);
			$TglJatuhTempo = $this->db->escape($data['TglJatuhTempo']);
			$TglJatuhTempo = str_replace('T', ' ', $TglJatuhTempo);
			$TglJatuhTempo = str_replace('Z', '', $TglJatuhTempo);
			$Sid = $this->db->escape($data['Sid']);
			$KodeBilling = $this->db->escape($data['KodeBilling']);
			$IdRekDana = $this->db->escape($data['IdRekDana']);
			$IdRekSb = $this->db->escape($data['IdRekSb']);
			$Nominal = $this->db->escape($data['Nominal']);
			$NominalKuponPertama = $this->db->escape($data['NominalKuponPertama']);
			$NominalKupon = $this->db->escape($data['NominalKupon']);
			$BatasWaktuBayar = $this->db->escape($data['BatasWaktuBayar']);
			$BatasWaktuBayar = str_replace('T', ' ', $BatasWaktuBayar);
			$BatasWaktuBayar = str_replace('Z', '', $BatasWaktuBayar);
			$Status = $this->db->escape($data['Status']);
			$NTPN = $this->db->escape($data['NTPN']);
			//$NTB = '';
			$CreatedAt = $this->db->escape($data['TglPemesanan']);
			$CreatedAt = str_replace('T', ' ', $CreatedAt);
			$CreatedAt = str_replace('Z', '', $CreatedAt);
			$CreatedBy = $this->db->escape($data['CreatedBy']);
			$IdSeri = $this->db->escape($data['IdSeri']);
			$IdStatus = $this->db->escape($data['IdStatus']);
			
			$qstr = "INSERT INTO orders VALUES ($KodePemesanan, $Seri, $TingkatKupon, $TglBayarKupon, $TglSetelmen, $TglJatuhTempo, $Sid, $KodeBilling, $IdRekDana, $IdRekSb, $Nominal, $NominalKuponPertama, $NominalKupon, $BatasWaktuBayar, $Status, $NTPN, NULL, $CreatedAt, $CreatedBy, $IdSeri, $IdStatus, $uid, NULL, NULL, NULL, NULL, NULL)";	
			$this->db->trans_start();
			$query = $this->db->query($qstr);
       		$this->db->trans_complete();

            if(!$query)
            {       
            	return false;
            }
        	return true;
        }
        catch(Exception $e)
        {
			return false;
        }
    }

    function edit_investor($data=array(), $data1=array())
    {
        try
        {
			$JenisKelamin = $this->db->escape($data['JenisKelamin']);
			$Pekerjaan = $this->db->escape($data['Pekerjaan']);
			$Kota = $this->db->escape($data['Kota']);
			$Provinsi = $this->db->escape($data['Provinsi']);
			$Sid = $this->db->escape($data['Sid']);
			$Nama = $this->db->escape($data['Nama']);
			$NoIdentitas = $this->db->escape($data['NoIdentitas']);
			$TempatLahir = $this->db->escape($data['TempatLahir']);
			$TglLahir = $this->db->escape($data['TglLahir']);
			$TglLahir = str_replace('T', ' ', $TglLahir);
			$TglLahir = str_replace('Z', '', $TglLahir);
			$KdJenisKelamin = $this->db->escape($data['KdJenisKelamin']);
			$KdPekerjaan = $this->db->escape($data['KdPekerjaan']);
			$KdKota = $this->db->escape($data['KdKota']);
			$Alamat = $this->db->escape($data['Alamat']);
			$NoTelp = $this->db->escape($data['NoTelp']);
			$NoHp = $this->db->escape($data['NoHp']);
			$Email = $this->db->escape($data['Email']);
			$Status = $this->db->escape($data['Status']);
			$CreatedAt = $this->db->escape($data['CreatedAt']);
			$CreatedAt = str_replace('T', ' ', $CreatedAt);
			$CreatedAt = str_replace('Z', '', $CreatedAt);
			$CreatedBy = $this->db->escape($data['CreatedBy']);
			$ModifiedAt = $this->db->escape($data['ModifiedAt']);
			$ModifiedAt = str_replace('T', ' ', $ModifiedAt);
			$ModifiedAt = str_replace('Z', '', $ModifiedAt);
			$ModifiedBy = $this->db->escape($data['ModifiedBy']);
			$KdProvinsi = $this->db->escape($data1['province']);
			$uid = $this->db->escape($data1['uid']);
			
			$qstr = "UPDATE investor SET 
						fullname = $Nama, idcard_no = $NoIdentitas, gender = $JenisKelamin, gender_code = $KdJenisKelamin, 
						placeofbirth = $TempatLahir, dateofbirth = $TglLahir, typeofwork_name = $Pekerjaan, typeofwork_code = $KdPekerjaan,
						address = $Alamat, province = $Provinsi, province_code = $KdProvinsi, city = $Kota, city_code = $KdKota, 
						mobilephone_no = $NoHp, phone_no = $NoTelp, email = $Email, modification_date = $ModifiedAt, modified_by = $ModifiedBy
						where sid = $Sid";
			//echo $qstr; die;
            $query = $this->db->query($qstr);
            if(!$query)
            {       
            	return false;
            }
        	return true;
        }
        catch(Exception $e)
        {
			return false;
        }
    }

    function get_datatable_order($Uid){
       	$this->db->select('*');
		$this->db->where('uid', $Uid);
		$upload = $this->db->get('orders');
		return $upload->result();
    }

	function get_filter_order_report($idseri,$idstatus,$orderdate,$nohal,$halaman)
	{
		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/seri/'.$idseri.'?search&TglPemesanan='.$orderdate.'&IdStatus='.$idstatus.'&PageNumber='.$nohal.'&PageSize='.$halaman.'&Sort';
	
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
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		$var = json_decode($result);
		echo json_encode($var->Records);

		// $this->datatables->select("userid,fullname,status")
		// ->from("investor")
		// ->where("userid",$userid);	
	}

	function get_filter_order_report_red($idseri,$orderdate,$nohal,$halaman)
	{
		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/redemption/seri/'.$idseri.'?search&TglRedeem='.$orderdate.'&PageNumber='.$nohal.'&PageSize='.$halaman.'&Sort';
	
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
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		$var = json_decode($result);
		echo json_encode($var->Records);

		// $this->datatables->select("userid,fullname,status")
		// ->from("investor")
		// ->where("userid",$userid);	
	}

	function get_filter_all_range($idstatus,$orderdate2,$orderdate3,$nohal,$halaman)
	{
		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/seri/all/range?Search&TglPemesananAwal='.$orderdate2.'&TglPemesananAkhir='.$orderdate3.'&IdStatus='.$idstatus.'&PageNumber='.$nohal.'&PageSize='.$halaman.'&Sort';
	
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
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		$var = json_decode($result);
		//echo json_encode($var->Records);
		print_r($AuthString);
		// $this->datatables->select("userid,fullname,status")
		// ->from("investor")
		// ->where("userid",$userid);	
	}

	function get_filter_sid_range($idseri,$idstatus,$orderdate2,$orderdate3,$nohal,$halaman)
	{
		$APIId = 'c895ac1b90af4cf3b28778a225f09053';
		$APIKey = 'N64R9dKdD1jePimpgXOUXrJBaMUUIH4frYbGzNcvIL4=';
		$url = $this->parameter_helper->ip_intranet_sbn.'/v1/pemesanan/seri/'.$idseri.'/range?Search&TglPemesananAwal='.$orderdate2.'&TglPemesananAkhir='.$orderdate3.'&IdStatus='.$idstatus.'&PageNumber='.$nohal.'&PageSize='.$halaman.'&Sort';
		
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
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$result = curl_exec($ch);
		curl_close($ch);
		$var = json_decode($result);
		echo json_encode($var->Records);

		// $this->datatables->select("userid,fullname,status")
		// ->from("investor")
		// ->where("userid",$userid);	
	}

	function get_total_order($idseri, $uid)
	{
		$query = $this->db->query("SELECT SUM(amount) AS amount from orders where id_seri = '" . $idseri ."' and uid = '" . $uid . "' and (id_status = '4' or id_status = '3' and creation_date >= NOW() - INTERVAL 1 DAY);");

		return $query->row()->amount;
	}

	function get_fund_account($userid)
	{
		$this->db->select('*');
		$this->db->where('uid',$userid);
		$this->db->where('is_deleted', 'N');
		$sqlquery = $this->db->get('fund_account');

		return $sqlquery;
	}

	function insert_token($token, $uid)
	{
		$data['TOKEN'] = $token;
		$data['USERID'] = $uid;
		$data['CREATEDDATE'] = date("Y-m-d H:i:s");
		$data['ISUSED'] = '0';

		$this->db->insert('token',$data);
		if($this->db->affected_rows() > 0)
		{
		    return true;
		}

		return false;
	}

	function check_token($token, $uid)
	{
		$this->db->set('ISUSED', '1', FALSE);
		$this->db->where('TOKEN', $token);
		$this->db->where('USERID', $uid);
		$this->db->where('ISUSED', '0');

		$this->db->update('token');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}

		return false;
	}

	
}
