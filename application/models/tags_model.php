<?php


class Tags_Model extends Pinups_Model {

	protected $tags;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function find($tag) {
		
		$this->db->select('*');
		$this->db->from('pinups_tags');
		if(is_array($tag)) {
			$this->db->where_in('tag', $tag);
		} else {
			$this->db->where('tag', $tag);
		}
		
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
		
		if( !$this->find($data['tag']) && !empty($data['tag']) ) {
			
			$this->db->insert('pinups_tags', $data);
			$this->insert_id = $this->db->insert_id();
			
		} 
		
	}
	

}