<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sbn_tambahan {
	var $CI;

	function __construct() {
		$this->CI =& get_instance();
	}

	public function get_portofolio_detail($uid){
		$this->CI->db->select('order_id,seri_name,creation_date,amount,status');
		$this->CI->db->from('orders');
		$this->CI->db->where('uid', $uid);
		$query = $this->CI->db->get('');
		return $query->result_array();
	}
}