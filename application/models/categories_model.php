<?php

class Categories_Model extends Pinups_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function find($data = '') {
		
		if(empty($data)) {
			$this->db->select('*');
			$this->db->from('pinups_categories');
		}
		
		$q = $this->db->get();
		$result = $q->result_array();
		
		return $result;
		
	}
	
	public function delete($id) {
	
	}
	
	public function create() {
		
	}
	
	public function edit($data) {
	}

}