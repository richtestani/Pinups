<?php

class Image_Manager {
	
	protected $image;
	
	public function __construct() {
		$this->CI = get_instance();
		require_once(APPPATH.'libraries/image.php');
	}
	
	public function build_image($data) {
		
		if(count($data) == 1) {
			$image = new Image($data[0]);
		} else {
			$image = new Image($data);
		}
		
		
		return $image->get_image();
	
	}
}

?>