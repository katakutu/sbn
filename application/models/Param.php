<?php
class Param extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_parameter($id)
	{
		$this->db->where('ID', $id);
		$query = $this->db->get('param');
		return $query;
	}
}
?>	