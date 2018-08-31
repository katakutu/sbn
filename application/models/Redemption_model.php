<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Redemption_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
    }

    function insert_redemption($data=array())
    {
        $this->db->insert('redemption',$data);
		if($this->db->affected_rows() > 0)
		{
		    return true;
		}

		return false;
    }

    function check_user_redemption($uid, $redeem_code)
    {
        $this->db->select('*');
        $this->db->from('redemption');
        $this->db->where('kode_redeem', $redeem_code);
        $this->db->where('uid', $uid);
        $sqlquery = $this->db->get();
        
        return $sqlquery;
    }
}
