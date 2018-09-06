<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ReportingTransaction_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_daily($tgl){
        $this->db->select('b.NAME,a.creation_date,a.order_id,a.status');
        $this->db->from('orders a');
        $this->db->join('user b', 'b.ID=a.uid', 'left');
        $this->db->like('a.creation_date', '"'.$tgl.'%"');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_final_transaction_all($tgl){
        $this->db->select('a.order_id,a.billing_code,a.ntpn,a.ntb,a.status,a.seri_name,a.created_by,a.sid,b.NAME,a.amount,c.NOMOR_REKENING,c.NOMOR_KTP,c.TEMPAT_LAHIR,c.TANGGAL_LAHIR,c.GENDER,c.PEKERJAAN,c.ALAMAT,c.KODE_KOTA,c.KODE_PROVINSI,c.NOMOR_TELEPON,c.NOMOR_HANDPHONE,c.EMAIL,a.creation_date,d.sec_account_no,c.KODE_BANK,d.subreg_name');
        $this->db->from('orders a');
        $this->db->join('user b', 'b.ID=a.uid', 'left');
        $this->db->join('sid c', 'c.USERID=b.ID', 'left');
        $this->db->join('sec_account d', 'd.id_reksb=a.id_reksb', 'left');
        $this->db->like('a.creation_date', '"'.$tgl.'%"');
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
?>