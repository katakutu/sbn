<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Investor_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insert_investor($data=array(), $data1=array())
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
			
			$qstr = "INSERT INTO investor(sid, fullname, idcard_no, gender, gender_code, placeofbirth, dateofbirth, typeofwork_name, typeofwork_code, address, province, province_code, city, city_code, mobilephone_no, phone_no, email, status, creation_date, created_by, modification_date, modified_by, uid) VALUES ($Sid, $Nama, $NoIdentitas, $JenisKelamin, $KdJenisKelamin, $TempatLahir, $TglLahir, $Pekerjaan, $KdPekerjaan, $Alamat, $Provinsi, $KdProvinsi, $Kota, $KdKota, $NoHp, $NoTelp, $Email, $Status, $CreatedAt, $CreatedBy, $ModifiedAt, $ModifiedBy, $uid)";
			$qstr2 = "UPDATE user SET Sid=$Sid WHERE id=$uid";
			
			$this->db->trans_start();
			$query = $this->db->query($qstr);
            $query2 = $this->db->query($qstr2);
       		$this->db->trans_complete();

            if(!$query)
            {       
            	return false;
            }
            if(!$query2)
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

    function insert_investor_exist($data=array())
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
			$KdProvinsi = substr($data['KdKota'], 0, 2) . "00";
			$uid = $this->db->escape($data['uid']);
			
			$qstr = "INSERT INTO investor(sid, fullname, idcard_no, gender, gender_code, placeofbirth, dateofbirth, typeofwork_name, typeofwork_code, address, province, province_code, city, city_code, mobilephone_no, phone_no, email, status, creation_date, created_by, modification_date, modified_by, uid) VALUES ($Sid, $Nama, $NoIdentitas, $JenisKelamin, $KdJenisKelamin, $TempatLahir, $TglLahir, $Pekerjaan, $KdPekerjaan, $Alamat, $Provinsi, $KdProvinsi, $Kota, $KdKota, $NoHp, $NoTelp, $Email, $Status, $CreatedAt, $CreatedBy, $ModifiedAt, $ModifiedBy, $uid)";
			$qstr2 = "UPDATE user SET Sid=$Sid WHERE id=$uid";
			
			$this->db->trans_start();
			$query = $this->db->query($qstr);
            $query2 = $this->db->query($qstr2);
       		$this->db->trans_complete();

            if(!$query)
            {       
            	return false;
            }
            if(!$query2)
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

    function deactivate_investor($data=array())
    {
        try
        {
			$Sid = $this->db->escape($data['Sid']);
			$Status = $this->db->escape($data['Status']);
			$ModifiedAt = $this->db->escape($data['ModifiedAt']);
			$ModifiedAt = str_replace('T', ' ', $ModifiedAt);
			$ModifiedAt = str_replace('Z', '', $ModifiedAt);
			$ModifiedBy = $this->db->escape($data['ModifiedBy']);
			
			$qstr = "UPDATE investor SET 
						status = $Status, modification_date = $ModifiedAt, modified_by = $ModifiedBy
						where sid = $Sid";

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

    function activate_investor($data=array())
    {
        try
        {
			$Sid = $this->db->escape($data['Sid']);
			$Status = $this->db->escape($data['Status']);
			$ModifiedAt = $this->db->escape($data['ModifiedAt']);
			$ModifiedAt = str_replace('T', ' ', $ModifiedAt);
			$ModifiedAt = str_replace('Z', '', $ModifiedAt);
			$ModifiedBy = $this->db->escape($data['ModifiedBy']);
			
			$qstr = "UPDATE investor SET 
						status = $Status, modification_date = $ModifiedAt, modified_by = $ModifiedBy
						where sid = $Sid";

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

    function get_investor_detail($uid)
	{
		$qstr = "SELECT * FROM investor WHERE uid=$uid";
        $query = $this->db->query($qstr);
        return $query->result();
	}
	
    function insert_fundaccount($data=array(), $uid)
    {
        try
        {
			$IdRek = $this->db->escape($data['Id']);
			$NamaBank = $this->db->escape($data['NamaBank']);
			$IdBank = $this->db->escape($data['IdBank']);
			$NoRek = $this->db->escape($data['NoRek']);
			$Nama = $this->db->escape($data['Nama']);
			$CreatedAt = $this->db->escape($data['CreatedAt']);
			$CreatedAt = str_replace('T', ' ', $CreatedAt);
			$CreatedAt = str_replace('Z', '', $CreatedAt);
			$CreatedBy = $this->db->escape($data['CreatedBy']);
			$ModifiedAt = $this->db->escape($data['ModifiedAt']);
			$ModifiedAt = str_replace('T', ' ', $ModifiedAt);
			$ModifiedAt = str_replace('Z', '', $ModifiedAt);
			$ModifiedBy = $this->db->escape($data['ModifiedBy']);
			$Sid = $this->db->escape($data['Sid']);
			
			$qstr = "INSERT INTO fund_account VALUES ($IdRek, $NamaBank, $IdBank, $NoRek, $Nama, $CreatedAt, $CreatedBy, $ModifiedAt, $ModifiedBy, $Sid, $uid, 'N')";
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

    function insert_secaccount($data=array(), $uid)
    {
        try
        {
			$IdRekSb = $this->db->escape($data['Id']);
			$NamaSubregistry = $this->db->escape($data['NamaSubregistry']);
			$IdSubregistry = $this->db->escape($data['IdSubregistry']);
			$NoRek = $this->db->escape($data['NoRek']);
			$Nama = $this->db->escape($data['Nama']);
			$CreatedAt = $this->db->escape($data['CreatedAt']);
			$CreatedAt = str_replace('T', ' ', $CreatedAt);
			$CreatedAt = str_replace('Z', '', $CreatedAt);
			$CreatedBy = $this->db->escape($data['CreatedBy']);
			$ModifiedAt = $this->db->escape($data['ModifiedAt']);
			$ModifiedAt = str_replace('T', ' ', $ModifiedAt);
			$ModifiedAt = str_replace('Z', '', $ModifiedAt);
			$ModifiedBy = $this->db->escape($data['ModifiedBy']);
			$Sid = $this->db->escape($data['Sid']);
			
			$qstr = "INSERT INTO sec_account VALUES ($IdRekSb, $NamaSubregistry, $IdSubregistry, $NoRek, $Nama, $CreatedAt, $CreatedBy, $ModifiedAt, $ModifiedBy, $Sid, $uid, 'N')";

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

    function get_investor_detail_sid($criteria)
	{
		$this->db->select('*');
		$this->db->where('fullname', $criteria);
		$sqlquery = $this->db->get('investor');
		return $sqlquery;
	}

    function get_fundaccount($userid, $iduser)
	{
		$this->datatables->select("id_rek, account_name, account_no")
		 ->from("fund_account")
		 ->where('uid ='.$iduser)
		 ->where('is_deleted = "N"')
		 ->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\''.rtrim(base64_encode($userid), "=").'\', \'$1\');">></a>', 'id_rek');
	}

	function get_fundaccount_detail($array)
	{
		$this->db->select('*');
		$this->db->where($array);
		$sqlquery = $this->db->get('fund_account');
		return $sqlquery;
	}

	function edit_fundaccount($data=array())
    {
        try
        {
			$IdRek = $this->db->escape($data['Id']);
			$NamaBank = $this->db->escape($data['NamaBank']);
			$IdBank = $this->db->escape($data['IdBank']);
			$NoRek = $this->db->escape($data['NoRek']);
			$Nama = $this->db->escape($data['Nama']);
			$CreatedAt = $this->db->escape($data['CreatedAt']);
			$CreatedBy = $this->db->escape($data['CreatedBy']);
			$ModifiedAt = $this->db->escape($data['ModifiedAt']);
			$ModifiedAt = str_replace('T', ' ', $ModifiedAt);
			$ModifiedAt = str_replace('Z', '', $ModifiedAt);
			$ModifiedBy = $this->db->escape($data['ModifiedBy']);

			$Sid = $this->db->escape($data['Sid']);
			
			$qstr = "UPDATE fund_account SET bank_name = $NamaBank, bank_id = $IdBank, account_no = $NoRek, account_name = $Nama, modified_date = $ModifiedAt, modified_by = $ModifiedBy where id_rek = $IdRek";
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

    function delete_fundaccount($data=array(), $id_rek)
    {
        try
        {
			$qstr = "UPDATE fund_account SET is_deleted = 'Y' where id_rek = $id_rek";
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

    function get_secaccount($userid, $iduser)
	{
		$this->datatables->select("id_reksb, subreg_name, sec_account_no")
		 ->from("sec_account")
		 ->where('uid ='.$iduser)
		 ->where('is_deleted = "N"')
		 ->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\''.rtrim(base64_encode($userid), "=").'\', \'$1\');">></a>', 'id_reksb');
	}

	function get_secaccountname($Uid){
       	$qstr	= "SELECT fullname FROM investor WHERE uid = '$Uid'";
        $query 	= $this->db->query($qstr);
        return $query->result_array();
    }

    function get_secaccount_exist($Uid){
       	$qstr	= "SELECT * FROM sec_account WHERE uid = '$Uid' and is_deleted='N'";
        $query 	= $this->db->query($qstr);
        return $query->result();
    }

    function get_user_sid($Uid){
       	$qstr	= "SELECT SID FROM sid WHERE USERID = '$Uid'";
        $query 	= $this->db->query($qstr);
        return $query->result_array();
    }

    function get_secaccount_data($Uid){
       	$qstr	= "SELECT * FROM sec_account WHERE uid = '$Uid' and is_deleted='N'";
        $query 	= $this->db->query($qstr);
        return $query->result_array();
    }
    
    function get_user_sid_data($Uid){
       	$qstr	= "SELECT * FROM sid WHERE USERID = '$Uid'";
        $query 	= $this->db->query($qstr);
        return $query->result_array();
    }

    function get_subreg($uid)
    {
    	$qstr	= "SELECT * FROM subregbri WHERE USERID = '$uid' and STATUS_PROCESS='3'";
        $query 	= $this->db->query($qstr);
        return $query->result_array();
    }

	function get_secaccount_detail($array)
	{
		$this->db->select('*');
		$this->db->where($array);
		$sqlquery = $this->db->get('sec_account');
		return $sqlquery;
	}

	function edit_secaccount($data=array())
    {
        try
        {
        	$IdRekSb = $this->db->escape($data['Id']);
			$NamaSubregistry = $this->db->escape($data['NamaSubregistry']);
			$IdSubregistry = $this->db->escape($data['IdSubregistry']);
			$NoRek = $this->db->escape($data['NoRek']);
			$Nama = $this->db->escape($data['Nama']);
			$CreatedAt = $this->db->escape($data['CreatedAt']);
			$CreatedBy = $this->db->escape($data['CreatedBy']);
			$ModifiedAt = $this->db->escape($data['ModifiedAt']);
			$ModifiedAt = str_replace('T', ' ', $ModifiedAt);
			$ModifiedAt = str_replace('Z', '', $ModifiedAt);
			$ModifiedBy = $this->db->escape($data['ModifiedBy']);
			$Sid = $this->db->escape($data['Sid']);

			$qstr = "UPDATE sec_account SET subreg_name = $NamaSubregistry, subreg_id = $IdSubregistry, sec_account_no = $NoRek, sec_account_name = $Nama, modified_date = $ModifiedAt, modified_by = $ModifiedBy where id_reksb = $IdRekSb";
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

    function delete_secaccount($data=array(), $id_reksb)
    {
        try
        {
			$qstr = "UPDATE sec_account SET is_deleted = 'Y' where id_reksb = $id_reksb";
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

    function get_jenis_pekerjaan()
	{
		$this->datatables->select("code, description")
		->from("pekerjaan")
		->add_column('action', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'code, description');
	}

	function get_kota($kode_prov)
	{
		$this->datatables->select("code, description")
		->from("kota")
		->where('provinsi_code ='.$kode_prov)
		->add_column('action', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'code, description');
	}

	function get_kota_all()
	{
		$this->datatables->select("code, description")
		->from("kota")
		->add_column('action', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'code, description');
	}

	function get_provinsi()
	{
		$this->datatables->select("code, description")
		->from("provinsi")
		->add_column('action', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'code, description');
	}

	function get_kewarganegaraan()
	{
		$this->datatables->select("code, description")
		->from("nationality")
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'code, description');
	}

	function insert_sid($data)
	{
		$this->db->insert('sid',$data);
		if($this->db->affected_rows() > 0)
		{
		    return true;
		}

		return false;
	}

	function get_sid($Uid)
	{
		$qstr	= "SELECT Sid FROM sid WHERE userid = '$Uid'";
        $query 	= $this->db->query($qstr);
        return $query->result_array();
	}

	function count_today_sid()
	{
		$qstr	= "SELECT COUNT(*) FROM sid WHERE date(createddate) = CURDATE()";
        $query 	= $this->db->query($qstr);
        return $query->row_array();
	}

	function data_sid($userid)
    {
    	$this->datatables->select('sid,nama')
    	->from('sid')
    	->where('userid',$userid)
    	->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\''.rtrim(base64_encode($userid), "=").'\', \'$1\');">Detail</a>', 'sid');
    }

    function get_sid_detail($criteria)
	{
		$this->db->select('*');
		$this->db->where('USERID',$criteria);
		$sqlquery = $this->db->get('sid');
		return $sqlquery;
	}

	function get_user_email($array)
	{
		$this->db->select('email');
		$this->db->where($array);
		$sqlquery = $this->db->get('user');
		return $sqlquery;
	}

	function check_user_investor($uid, $sid)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id', $uid);
		$this->db->where('sid', $sid);
		$sqlquery = $this->db->get();
		
		return $sqlquery;
	}

	function check_fundacc_investor($uid, $id_rek)
	{
		$this->db->select('*');
		$this->db->from('fund_account');
		$this->db->where('id_rek', $id_rek);
		$this->db->where('uid', $uid);
		$sqlquery = $this->db->get();
		
		return $sqlquery;
	}

	function check_order_investor($orderid, $uid)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('order_id', $orderid);
		$this->db->where('uid', $uid);
		$sqlquery = $this->db->get();
		
		return $sqlquery;
	}

	function get_provinsi_2()
	{
		$this->db->select('*');
		$this->db->from('provinsi');

		$sqlquery = $this->db->get();
		
		return $sqlquery->result();
	}
}
