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
	
	public function image_categories($pinupid) {
	
		$this->db->select('*');
		
	
	}
	
	public function image_tags($fields) {
		/*
			SELECT * FROM pinups as p LEFT JOIN pinups_groups as g ON g.id = p.group_id
			LEFT JOIN pinups_links as l ON l.pinupid = p.id
			LEFT JOIN pinups_tags as t ON l.itemid = t.id
		*/

		
	}
	

}