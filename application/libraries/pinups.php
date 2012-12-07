<?php

class Pinups {

	protected $pinups;
	protected $CI;

	public function __construct() {
	
		$this->CI = get_instance();
		$this->CI->load->model('images_model', 'imgs', true);
		$this->CI->load->library('image_manager');
		$this->CI->load->library('image_transform');
		$this->CI->load->library('output');
		$this->sizes = $this->CI->config->item('sizes');
		
	
	}
	
	public function find($by, $data) {

		if(!method_exists($this->CI->imgs, $by)) {
			echo 'not right';
			return false;
		}

		$this->CI->imgs->{$by}($data);
		$result = $this->CI->imgs->result();
		
		if( count($result) == 1 ) {
			$this->pinups = $this->CI->image_manager->build_image($result);
		} else {
			foreach ($result as $key => $value) {
				$this->pinups[] = $this->CI->image_manager->build_image($value);
			}
		}
		
	}
	
	public function get_pinups($by = '', $data = array() ) {
		
		if(empty($data) || is_array($by)) {
			$this->find('all', $data);
			return $this->pinups;
		} else {
			$this->find($by, $data);
			return $this->pinups;
		}
		
	}
	
	public function image($image) {
		
		$config = $this->CI->config->item('upload');
	
	}
	
	public function image_exists($path_to_image) {
	
		if(!file_exists($path_to_image)) {
			return false;
		}
	
	}

	
	public function transform($action, $image, $data = array()) {
		
		if(method_exists('image_transform', $action)) {
			
			$this->CI->image_transform->$action($image, $data);
			
		}
		
	}
	
	public function get($by, $data) {
		return $this->get_pinups($by, $data);
	}
	
	public function __call($name, $args) {
		echo $name;
	}

}