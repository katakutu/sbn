<?php
class Bank extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_bank_name()
	{
		$this->datatables->select("nama, bankcode")
		->from("bank")
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'nama, bankcode');
	}

	function get_bank_code()
	{
		$this->datatables->select("nama, code")
		->from("bank")
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'nama, code');
	}

	function get_fund_account($userid)
	{
		$this->datatables->select("id_rek, account_no, account_name")
		->from("fund_account")
		->where('uid',$userid)
		->where('is_deleted', 'N')
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'id_rek, account_no');
	}

	function get_sec_account($userid)
	{
		$this->datatables->select("id_reksb, sec_account_no, sec_account_name")
		->from("sec_account")
		->where('uid',$userid)
		->where('is_deleted', 'N')
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\');">></a>', 'id_reksb, sec_account_no');
	}

	function get_order_redemption($userid)
	{
		$this->datatables->select("order_id, seri_name, amount, status, id_seri")
		->from("orders")
		->where('uid',$userid)
		->where('id_status', '4')
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getValue(\'$1\', \'$2\', \'$3\');">></a>', 'order_id, id_seri, amount');
	}

	function get_datatable_order_report($userid)
	{
		$this->datatables->select('order_id,seri_name,sid,billing_code,amount,status,DATE_FORMAT(creation_date,"%Y-%m-%d"),id_seri')
    	->from('orders')
    	->where('uid',$userid)
    	->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getDetail(\''.rtrim(base64_encode($userid), "=").'\', \'$1\');">Detail</a>', 'order_id');
	}

	function get_datatable_investor($userid)
	{
		$this->datatables->select('sid,fullname,status')
    	->from('investor')
    	->where('uid',$userid)
    	->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\'$1\');">Detail</a>', 'sid');
	}

	function get_filter_secaccount_sid($userid)
	{
		$this->datatables->select("*")
		->from("sec_account")
		->where("sec_account_name",$userid);	
	}

	function get_filter_fundaccount_sid($userid)
	{
		$this->datatables->select("*")
		->from("fund_account")
		->where("account_name",$userid);	
	}

	function get_datatable_secaccount($userid)
	{
		$this->datatables->select('id_reksb,sec_account_name,sec_account_no, DATE_FORMAT(created_date, "%d/%m%/%Y %H:%m:%s") as created_date')
    	->from('sec_account')
    	->where('uid',$userid)
    	->where('is_deleted','N')
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\'$1\');">Delete</a>', 'id_reksb');
	}

	function get_datatable_fundaccount($userid)
	{
		$this->datatables->select('id_rek, uid, account_name,account_no, DATE_FORMAT(created_date, "%d/%m%/%Y %H:%m:%s") as created_date')
    	->from('fund_account')
    	->where('uid',$userid)
    	->where('is_deleted','N')
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\'$1\', \'$2\');">Delete</a>', 'id_rek, uid');
	}

	function get_secaccount_by_id($userid)
	{
		$this->datatables->select('id_reksb,sec_account_no,sec_account_name')
    	->from('sec_account')
    	->where('id_reksb',$userid);
	}

	function update_profile($data=array())
	{
		try
        {
			$Nama = $this->db->escape($data['username']);
			$TglLahir = $this->db->escape($data['userbirthdate']);
			$NoIdentitas = $this->db->escape($data['useridcard']);
			$TglExpktp = $this->db->escape($data['useridcardexpired']);
			$Alamat = $this->db->escape($data['useraddress']);
			$NoTelp = $this->db->escape($data['usertelephone']);
			$NoHp = $this->db->escape($data['userhandphone']);
			$Email = $this->db->escape($data['useremail']);
			$Sid = $this->db->escape($data['usersid']);
			
			$qstr = "UPDATE user SET 
						NAME = $Nama, BIRTHDATE = $TglLahir, IDNUMBER = $NoIdentitas, IDEXPIRED = $TglExpktp, 
						ADDRESS = $Alamat, PHONE = $NoTelp, HANDPHONE = $NoHp, EMAIL = $Email
						where ID = $Sid";
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

	function update_password($data=array())
	{
		$handle = $this->db->escape($data['userid']);
		$oldpass = $this->db->escape($data['oldpassword']);
		$newpass = $this->db->escape($data['newpassword']);
		$exppass = $this->db->escape($data['expiredpass']);
		
		$qstr = "UPDATE user SET PASSWORD = $newpass, PREVPASSWORD = $oldpass, EXPPASSWORD = $exppass where HANDLE = $handle";
		//echo $qstr; die;
        $query = $this->db->query($qstr);
        if(!$query)
        {       
        	return false;
        }
    	return true;
	}

	function get_bank_identifier($bankcode)
	{
		$this->db->select("code");
        $this->db->from('bank');
        $this->db->where('bankcode', $bankcode);
        $query = $this->db->get();
        return $query->result();
	}
	
}
?>
