<?php
class User extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function set_lock_user($userid, $status, $loginretry)
	{
		$data = array(
           	'LOGIN' => $status,
			'WRGPASSWORD' => $loginretry
            );
		$this->db->where('id', $userid);
		$query = $this->db->update('user', $data);

		return $query;
	}

	function get_username($userid)
	{
		$this->db->where('handle', $userid);
		$this->db->where('status_register', '3');
		$query = $this->db->get('user');

		return $query;
	}

	function get_user_list($corpid, $userid)
	{
		$this->datatables->select('ID, HANDLE, NAME, DATE_FORMAT(EXPPASSWORD,"%d %b %Y") AS EXPIREDDATE, STATUS')
		->from('user')
		->where('`id` IN (SELECT `userentity` from `usermap` where `cliententity` = '.$corpid.')')
		->where('`usrtype` IN (1,2)')
		->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:void(0);" onClick="javascript:getUser(\''.rtrim(base64_encode($userid), "=").'\', \'$1\');">></a>', 'ID');
	}

	function get_checker_list($corpid)
	{
		$this->datatables->select('HANDLE, NAME')
		->from('user')
		->where('`id` IN (SELECT `userentity` from `usermap` where `cliententity` = '.$corpid.' and `usrtype` = 2 and `status` = 1)');
	}	

	function get_detail($array)
	{
		$this->db->select('*');
		$this->db->where($array);
		$sqlquery = $this->db->get('user');

		return $sqlquery;
	}

	function get_detail_sid($array)
	{
		$this->db->select('*');
		$this->db->where($array);
		$sqlquery = $this->db->get('sid');

		return $sqlquery;
	}
	
	function get_detail_user($array)
	{
		$this->db->select('a.*');
		$this->db->from('user a');
		$this->db->join('usermap b', 'a.id = b.userentity', 'left');
		$this->db->where($array);
		$sqlquery = $this->db->get();

		return $sqlquery;
	}

	public function do_login($userid, $password, $passcode)
	{
		$cln_userid = $this->db->escape($userid);
        $encrypt_pass = md5($password);
        $key = md5($encrypt_pass . $passcode);
        //print_r($key); die;
        $cln_password = $this->db->escape($key);
        $currdate = $this->db->escape(date('Y-m-d H:i:s'));
        $is_logged_query = "SELECT * FROM user WHERE LOGIN = 1 and TIMESTAMPDIFF(MINUTE, lastlogin,  now()) < 15 and HANDLE = $cln_userid";
        $is_logged = $this->db->query($is_logged_query);
        
        if($is_logged->num_rows() < 1)
        {
	        $qstr = "SELECT *, "
	                . "IF(password = $cln_password, 'Y', 'N') as correct_pass, "
	                . "IF(EXPPASSWORD >= $currdate, 'N', 'Y') as is_expired "
	                . "FROM user "
	                . "WHERE handle=$cln_userid ";
	        $query = $this->db->query($qstr);
	        if($query->num_rows() > 0)
	        {
	            $row = $query->row();
	            if($row->correct_pass == 'Y')
	            {
	                $qstr = "UPDATE user SET WRGPASSWORD = 0, LOGIN =1, lastlogin = now() WHERE handle=$cln_userid";
	                $this->db->query($qstr);
	                return 'success';
	            }
	            else
	            {
	                $qstr = "UPDATE user SET WRGPASSWORD = (WRGPASSWORD + 1) WHERE handle=$cln_userid";
	                $this->db->query($qstr);
	                return 'wrong_pass';
	            }
	        }
	        else
	        {
	            return 'user_not_found';
	        }
        }
        else 
        {
            return 'already_login';
        }
    }

 	public function do_logout($userid)
    {
        try
        {
            $qstr = "UPDATE user
                     SET login=0, LastLogout=Now()
                     WHERE handle='$userid'";
            $query = $this->db->query($qstr);
            if(!$query)
            {
                throw new Exception();
            }
           	return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }

    public function update_profile($data=array())
	{
		 try
        {
			$TglExpktp = $this->db->escape($data['useridcardexpired']);
			$LastUpdate = $this->db->escape($data['userlastupdate']);
			$Id = $this->db->escape($data['userid']);
			$Typeofwork = $this->db->escape($data['usertypeofwork2']);
			$Address = $this->db->escape($data['useraddress2']);
			// $Province = $this->db->escape($data['userprovince2']);
			// $City = $this->db->escape($data['usercity2']);
			$Telephone = $this->db->escape($data['usertelephone2']);
			$Handphone = $this->db->escape($data['userhandphone2']);
			$Email = $this->db->escape($data['useremail2']);
			
			$qstr = "UPDATE user SET 
						IDEXPIRED = $TglExpktp, LASTUPDATE = $LastUpdate, POSITION = $Typeofwork, ADDRESS = $Address, PHONE = $Telephone, HANDPHONE = $Handphone, EMAIL = $Email
						where ID = $Id";
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
}
?>