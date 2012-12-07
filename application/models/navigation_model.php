<?php

class Navigation_Model extends Pinups_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_pages($parent) {
	
		$this->db->select('*');
		$this->db->from('pinups_navigation');
		$this->db->where('parent >=', $parent);
		$this->db->order_by('parent');
		
		$q = $this->db->get();
		$result = $q->result_array();
		
		return $result;
	
	}
	
	public function add() {
	}
	
	public function save() {}

}