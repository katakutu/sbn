<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ReportingTransaction_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_daily(){
        $this->db->select('b.NAME,a.creation_date,a.order_id,a.status');
        $this->db->from('orders a');
        $this->db->join('user b', 'b.ID=a.uid', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all(){
    }
    
}
?>