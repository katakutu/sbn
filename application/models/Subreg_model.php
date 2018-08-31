<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subreg_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insert_subreg($data=array())
    {
        try
        {
			$kodebank = $this->db->escape($data['id_name']);
			$sid = $this->db->escape($data['sid']);
			$nama = $this->db->escape($data['nama']);
			$ktp = $this->db->escape($data['ktp']);
			$kota = $this->db->escape($data['kota']);
			$idsubreg = $this->db->escape($data['id_subreg']);
			$createddate = $this->db->escape($data['createddate']);
			
			$qstr = "INSERT INTO subregbri VALUES ($sid, $kodebank, $idsubreg, null, $nama, $ktp, null, null, null, null, null, null, $kota, $createddate)";
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

    function data_subreg($userid)
    {
    	$this->datatables->select('sid,nama,id_subreg')
    	->from('subregbri')
    	->where('userid',$userid)
    	->where('userid !=','null')
    	->add_column('', '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\''.rtrim(base64_encode($userid), "=").'\', \'$1\');">Detail</a>', 'id_subreg');
    }

	function get_subreg_detail($array)
	{
		$this->db->select('*');
		$this->db->where($array);
		$sqlquery = $this->db->get('subregbri');
		return $sqlquery;
	}	
}
