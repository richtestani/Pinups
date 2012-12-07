<?php


class Links_Model extends Pinups_Model {

	protected $tags;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function find($link) {
		
		$this->db->select('*');
		$this->db->from('pinups_links');
		$this->db->where('pinupid', $link);
		$q = $this->db->get();
		
		if( $q->num_rows() == 1 ) {
			return $q->row_array();
		} else {
			return false;
		}
		
	}
	
	public function create($data) {
	
		
	
		$data['created_on'] = $this->created_on;
		$data['modified_on'] = $this->modified_on;
		
		if( !$this->find($data['pinupid']) && !empty($data['pinupid']) ) {
			
			$this->db->insert('pinups_links', $data);
			$this->insert_id = $this->db->insert_id();
			
		} 
		
	}
	

}