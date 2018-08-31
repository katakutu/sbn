<?php
class Functions extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_function($id)
	{
		$this->db->where('ID', $id);
		$query = $this->db->get('function');
		return $query;
	}
	
	function get_child($id, $usertype)
	{
		$this->db->where('PARENT', $id);
		$this->db->where_in('TYPE', array(0, $usertype));
		$query = $this->db->get('function');
		return $query;
	}

	function get_by_type($id, $clienttype)
	{
		$this->db->where('PARENT', $id);
		$this->db->where('TYPE',$clienttype);
		$query = $this->db->get('function');
		return $query;
	}
}
?>	