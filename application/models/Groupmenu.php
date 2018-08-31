<?php
class Groupmenu extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function identify_menuheader($id)
	{
		$this->db->where_in('IDFUNCTION', $id);
		$this->db->group_by("IDMENUHEADER");
		$query = $this->db->get('groupmenu');
		return $query;
	}
	
	function list_function($id)
	{
		$this->db->where("IDMENUHEADER", $id); 
		$this->db->order_by('URUTAN', 'asc');
		$query = $this->db->get('groupmenu');
		return $query;
	}

	function getListMenu($usertype)
	{
		$query = "SELECT group_concat(id separator '|') AS IDMENU  FROM function WHERE PARENT = 0 AND TYPE IN (0, $usertype) AND STATUS = 1";
		$result = $this->db->query($query);

		return $result->row();
	}
}