<?php

class Settings extends Pinups_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function initialize() {
	
		$this->db->select('*');
		$this->db->from('pinups_settings');
		$q = $this->db->get();
		$result = $q->result_array();
		
		return $result;
	
	}
	
	public function get_setting($name) {
		
	}
	
	public function set_setting($name, $value) {
		
		$this->db->where($name, $value);
		$this->db->table('settings');
		
	}

}

?>