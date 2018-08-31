<?php
class Auditsite extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function audit_insert($data)
	{
		$query = $this->db->insert('auditsite', $data);

		return $query;
	}
}
?>