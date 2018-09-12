<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ManagementUser_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all_activation(){
        $this->db->select('ID,SID,TITLE,NAME,EMAIL,STATUS');
        $this->db->from('user');
        $this->db->where('STATUS', '0');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_unlock(){
        $mlr = $this->db->select('DATA')->where('ID', 'LOGIN_MAX_RETRY')->get('param')->row();
        $max_login_retry = $mlr->DATA;

        $this->db->select('ID,SID,TITLE,NAME,EMAIL,WRGPASSWORD');
        $this->db->from('user');
        $this->db->where('WRGPASSWORD > ', $max_login_retry);
        $query = $this->db->get();
        return $query->result_array();
    }

    function unlock($id){
        $this->db->set('WRGPASSWORD', '0');
        $this->db->where('ID', $id);
        $this->db->update('user');
    }

    function send_activation($id){
        $this->db->set('STATUS', '0');
        $this->db->where('TRXID', $id);
        $this->db->where('TIPE', '2');
        $this->db->update('email');
        if($this->db->affected_rows() > 0){
          return TRUE;
        } else {
          return FALSE;
        }
    }
}