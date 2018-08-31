<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Regis extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/*
	* lock status.
	*/
	function check_user_registered($email)
	{
		$status_registered = array('3');

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('handle', $email);
		$this->db->where_in('status_register', $status_registered);
		$sqlquery = $this->db->get();
		
		return $sqlquery;
	}

	function check_user_process_register($email)
	{
		$status_registered = array('1','2','3');

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('handle', $email);
		$this->db->where_in('status_register', $status_registered);
		$sqlquery = $this->db->get();
		
		return $sqlquery;
	}


	function insert_user($data)
	{
		$insert_id = "";
		$this->db->insert('user',$data);
		if($this->db->affected_rows() > 0)
		{
		    $insert_id = $this->db->insert_id();
		}

		return $insert_id;
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

	function insert_subreg($data)
	{
		$this->db->insert('subregbri', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}

		return false;
	}

	function insert_api($data)
	{
		$query = $this->db->insert('api_reference', $data);

		if($this->db->affected_rows() > 0)
		{
		    return true;
		}

		return false;
	}

	function delete_user($handle)
	{
		$this->db->where('HANDLE', $handle);
		$this->db->delete('user');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;	
	}

	function delete_sid($uid)
	{
		$this->db->where('USERID', $uid);
		$this->db->delete('sid');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;
	}

	function delete_subreg($uid)
	{
		$this->db->where('USERID', $uid);
		$this->db->delete('subregbri');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;
	}

	function get_api($id, $code)
	{
		$this->db->where('REF_ID', $code . $id);
		//$this->db->where('STATUS', "1");
		$query = $this->db->get('api_reference');

		return $query;
	}

	function update_aktivasi($handle, $ref_id)
	{
		$data = array(
           	'STATUS' => "1",
			'DESCRIPTION' => "ACTIVE"
            );

		$this->db->where('HANDLE', $handle);
		$this->db->update('user', $data);

		$data2 = array(
			'STATUS' => "2",
			'DESCRIPTION' => "INACTIVE"
		);

		$this->db->where('REF_ID', $ref_id);
		$this->db->update('api_reference', $data2);
	}

}
?>