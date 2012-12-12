<?php


class Views_Model extends Pinups_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function create($data) {
		
		$this->db->insert('pinups_views', $data);
		
	}

}