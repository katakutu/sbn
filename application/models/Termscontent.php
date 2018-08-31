<?php
class Termscontent extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_termscontent($title)
	{
		$this->db->where('TITLE', $title);
		$this->db->where('PUBLISH', '1');
		$query = $this->db->get('termscontent');
		return $query;
	}
}
?>	