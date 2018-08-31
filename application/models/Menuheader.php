<?php
class Menuheader extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_menuheader($id)
	{
		$this->db->where('ID', $id);
		$query = $this->db->get('menuheader');
		return $query;
	}	
}
?>