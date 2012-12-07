<?php

class Pinups_Model extends CI_Model {

	protected $insert_id;
	protected $created_on;
	protected $modified_on;
	
	public function __construct() {
		parent::__construct();
		$this->created_on = strtotime('now');
		$this->modified_on = strtotime('now');
	}
	
	protected function save($table, $data, $where = '') {
		
		if(!empty($where)) {
			$this->db->where('id', $where);
		}
		
		$this->db->update($table, $data);
		
	}
	
	protected function create($table, $data) {
		$this->db->insert($table, $data);
	}
	
	public function get_insert_id() {
		return $this->insert_id;
	}
}

?>