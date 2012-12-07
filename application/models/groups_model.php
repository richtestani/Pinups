<?php

class Groups_Model extends Pinups_Model {

	

	public function __construct() {
		parent::__construct();
	}
	
	public function find($data) {
		
		extract($data);
		
		if(isset($limit)) {
			$this->limit = $limit;
		}
		
		$this->db->select('*');
		$this->db->from('pinups_groups');
		
		if(isset($where_type)) {
			switch($where_type) {
				
				case 'in':
				$this->db->where_in($field, $value);
				break;
				
				case 'or':
				$this->db->or_where($field, $value);
				break;
				
				case 'like':
				$this->db->like($field, $value);
				break;
				
				default:
				$this->db->where($field, $value);
				
			}
			
		}
		
		$q = $this->db->get();
		$result = $q->result_array();
		
		return $result;
	}

}