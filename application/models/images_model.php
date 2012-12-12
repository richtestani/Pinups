<?php

class Images_Model extends Pinups_Model {

	protected $pinups_table;
	protected $groups_table;

	public function __construct() {
		parent::__construct();
		
		$this->pinups_table = 'pinups as p';
		$this->groups_table = 'pinups_groups as g';
		
		$this->fieldset = array(
							
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
											),
							
							'pinups_categories' => array(
														
											'id'				=> 'c.id as category_id',
											'name'				=> 'c.name as category',
											'slug'				=> 'c.slug as category_slug',
											'parent'			=> 'c.parent as category_parent',
											'created_on'		=> 'c.created_on as category_creation',
											'modified_on'		=> 'c.modified_on as category_modified'
										
													),
							'pinups_link'		=> array(
											'id'				=> 'l.id as link_id',
											'itemid'			=> 'l.itemid',
											'pinupid'			=> 'l.pinupid as link_pinup_id',
											'created_on'		=> 'l.created_on as link_creation',
											'modified_on'		=> 'l.modified_on as link_modified',
											'item'				=> 'l.item as link_item'
												
												),
							'pinups_tags' => array(
											'id'				=> 't.id as tag_id',
											'tag'				=> 't.tag',
											'created_on'		=> 't.created_on as tag_creation',
											'modified_on'		=> 't.modified_on as tag_modified'
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
	
		$result = $this->all( $data );
	
	}
	
	public function all( $data ) {
	
		if( is_array( $data ) AND !empty( $data ) ) {
		
			extract( $data );
			
		}
		
		if( isset( $fields ) ) {
		
			$this->set_fields( $fields );
			
		} else {
		
			$this->db->select( implode( ", ", $this->fieldset['pinups'] ) );
			$this->db->select( implode( ", ", $this->fieldset['pinups_groups'] ) );
			
		}
		
		if( isset( $from ) ) {
		
			if( is_array( $var ) ) {
				
				$tables = implode( ", ", $from );
				
			} else {
				
				$tables = $from;
			
			}
			
			$this->db->from($tables);
		
		} else {
		
			$this->db->from('pinups as p');
		
		}
		
		if( isset( $where ) ) {
			
			$this->filter( $where );
			
		}
		
		if( isset( $join ) ) {
		
			$this->set_join( $join );
		
		} else {
		
			$this->set_join( array() );
		
		}
		
		if( isset( $like ) ) {
		
			$this->like_match( $like );
		
		}
	
		/*
			Set the limits
		*/
		
		$limit_num	= ( isset( $limit ) AND @array_key_exists( 'limit', $limit ) )	? $limit['limit']	: 48;
		$offset 	= ( isset( $limit ) AND @array_key_exists( 'offset', $limit ) )	? $limit['offset']	: 0;

		$this->db->limit( $limit_num, $offset );
		
		
		$order_field = ( isset( $order_by ) AND array_key_exists( 'fields', $order_by ) ) ? $order_by['fields'] : $this->order_by['fields'];
		$order_dir = ( isset( $order_by ) AND array_key_exists( 'direction', $order_by ) ) ? $order_by['direction'] : $this->order_by['direction'];
		
		$this->db->order_by($order_field, $order_dir);
		
		return $this;
				
	}
	
	/*
		Build select fields
	*/
	private function set_fields($fields) {
	
		$fieldsets = array_keys($this->fieldsets);
		
		if( is_array( $fields ) ) {
		
			foreach ( $fields as $value ) {
			
				if( in_array( $value, $fieldsets ) ) {
				
					$this->db->select( implode(", ", $this->fieldset[$value]) );
					
				} else {
				
					$this->db->select($value);
					
				}
			}
		
		} else {
		
			$this->db->select( implode(", ", $fields) );
		
		}
		
	}
	
	private function like_match( $like ) {
	
	
	}
	
	private function set_join( $join ) {
	
		if( !array( $join ) ) {
		
			echo '$join should be an array';
			return false;
		
		}
		
		if( empty( $join ) ) {
		
			$this->db->join('pinups_groups as g', 'p.group_id = g.id', 'left');
		
		}
		
		foreach ( $join as $key => $value ) {
			
			$table	= isset( $value['table'] ) 			? $value['table'] 		: 'pinups_groups as g';
			$on		= isset( $value['on'] ) 			? $value['on'] 			: 'p.group_id = g.id';
			$join_type = isset( $value['join_type'] ) 	? $value['join_type'] 	: 'left';
			
			$this->db->join($table, $on, $join_type);
			
		}
	
	}
	
	
	
	private function filter( $where ) {
	
		$field = 'p.id';
		$backticks = false;
		$operation = '';
		$values = 1;
		$method = 'where';
		
		if( !is_array( $where ) ) {
		
			echo '$where should be an array';
			return false;
		
		} else {
		
			foreach ($where as $key => $val) {
				
				if( is_array( $val ) ) {
					
					$method 	= isset( $val['where'] ) 		? $val['where'] 			: 'where';
					$field		= isset( $val['field'] ) 		? $val['field'] 			: '*';
					$values		= isset( $val['values'] ) 	? $val['values'] 			: 1;
					$operation 	= isset( $val['operation'] ) 	? $val['operation'] 	: '';
					$backticks 	= isset( $val['backticks'] ) 	? $val['backticks'] 		: true;
					
					$this->db->$method($field.' '.trim($operation), $values, $backticks);
					
				
				} else {
		
					$$key = $val;
					
				}
				
			}
			
			$this->db->$method($field.' '.trim($operation), $values, $backticks);
		
		}
		
	}
	
	public function result() {
		
		$q = $this->db->get();
		$result = $q->result_array();
		
		echo $this->db->last_query();
		return $result;
		
	}
	
	public function collection($q) {
		return $q;
	}

}