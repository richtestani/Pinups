<?php

class Images_Model extends Pinups_Model {

	protected $pinups_table;
	protected $groups_table;

	public function __construct() {
		parent::__construct();
		
		$this->pinups_table = 'pinups as p';
		$this->groups_table = 'pinups_groups as g';
		
		$this->fields = array(
							
							'pinups' => array(
											
											'id' 				=> 'p.id as pinup_id',
											'title' 			=> 'p.title',
											'filename' 			=> 'p.filename',
											'size'				=> 'p.size',
											'created_on'		=> 'p.created_on as pinup_creation',
											'modified_on'		=> 'p.modified_on as pinup_modified',
											'storage_type'		=> 'p.storage_type',
											'path_to_file'		=> 'p.path_to_file',
											'original_name'		=> 'p.original_name',
											'mime_type'			=> 'p.mime_type',
											'ext'				=> 'p.ext as file_ext',
											'file_size'			=> 'p.file_size',
											'original_width'	=> 'p.original_width',
											'original_height'	=> 'p.original_height',
											'image_type'		=> 'p.image_type',
											'group_id'			=> 'p.group_id pinup_group_id',
											'thumbnail'			=> 'p.thumbnail'
											
											),
											
							'pinups_groups' => array(
							
											'id' 				=> 'g.id as group_id',
											'group'				=> 'g.group',
											'parent'			=> 'g.parent as group_parent',
											'stub'				=> 'g.stub as group_stub',
											'created_on'		=> 'g.created_on as group_creation',
											'modified_on'		=> 'g.modified_on as group_modified'
											)
		
							);
			$this->order_by = array('fields' => 'p.created_on', 'direction'=>'desc');
							
		
	}
	
	public function find($data) {
	
	}
	
	public function delete($id) {
	
	}
	
	public function create($data) {
		
		$data['modified_on'] = $this->modified_on;
		$this->db->insert('pinups', $data);
		
	}
	
	public function update($data, $id = 0) {
		
		$data['modified_on'] = $this->modified_on;
		
		if($id) {
			$this->db->where('id', $id);
		}
		$this->db->update('pinups', $data);
	
	}
	
	public function tags($data) {

	}
	
	public function category($data) {
	
	}
	
	public function id($data) {
	
		$result = $this->all($data);
	
	}
	
	public function all($data) {
	
		if( !empty($data) && is_array($data) ) {
			extract($data);
		}
		
		$this->db->select(implode(", ", $this->fields['pinups']));
		$this->db->select(implode(", ", $this->fields['pinups_groups']));
		$this->db->from($this->pinups_table);
		
		if(isset($order_by)) {
			$this->db->order_by(implode(", ", $order_by), 'asc');
		} else {
			extract($this->order_by);
			$this->db->order_by($fields, $direction);
		}
		
		if(isset($limit)) {
			$this->db->limit($limit, $offset);
		}
		
		$this->db->join($this->groups_table, 'p.group_id=g.id', 'left');
		
		if(isset($where)) {
			$this->filter($where);
		}
		
		return $this;
				
	}
	
	public function filter($where) {
		
		if(isset($where)) {
			
			switch($where['where']) {
			
				case 'where':
				
				$this->db->where('p.'.$where['field'], $where['value']);
				break;
				
				case 'like':
				break;
			
			}
			
		}
	
	}
	
	public function result() {
		
		$q = $this->db->get();
		$result = $q->result_array();

		//echo $this->db->last_query();
		return $result;
		
	}
	
	public function collection($q) {
		return $q;
	}

}