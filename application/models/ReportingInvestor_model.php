<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ReportingInvestor_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_statistic_all(){
        $this->db->select('b.NAME,a.gender,a.email,a.idcard_no,b.NPWP,b.SID,b.SUBREG,a.address,a.phone_no,a.mobilephone_no,c.NOMOR_REKENING,a.creation_date');
        $this->db->from('investor a');
        $this->db->join('user b', 'b.ID=a.uid', 'left');
        $this->db->join('sid c', 'c.USERID=b.ID', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_portofolio_all(){
        $this->db->select('a.fullname,a.gender,a.email,a.idcard_no,b.NPWP,b.SID,b.SUBREG,a.address,a.phone_no,a.mobilephone_no,c.NOMOR_REKENING,a.creation_date');
        $this->db->from('investor a');
        $this->db->join('user b', 'b.ID=a.uid', 'left');
        $this->db->join('sid c', 'c.USERID=b.ID', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
?>