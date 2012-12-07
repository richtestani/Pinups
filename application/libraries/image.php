<?php

class Image {

	protected $name;
	protected $id;
	protected $file_size;
	protected $filename;
	protected $thumbnail;
	
	public function __construct($data = '') {
		
		if(!empty($data)) {
			$this->set_image($data);
		}
	} 
	
	public function set_image($data) {
		
		foreach ($data as $key => $value) {
			
			$this->{$key} = $value;
		}
	
	}
	
	public function get_image() {
		return $this;
	}
	
	public function __get($prop) {
		return $this->$prop;
	}

}