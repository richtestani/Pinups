<?php


class Image_Transform {

	protected $CI;
	protected $image_config;

 public function __construct() {
 
 	$this->CI = get_instance();
 	$this->CI->load->library('image_lib');
 	$this->sizes = $this->CI->config->item('size');
 
 }
 
 public function set_image_data($data) {
 	$this->image_config = $data;
 }
 
 public function resize($file, $data) {
	 	
 	if(is_array($data)) {
 		if(!array_key_exists('width', $data)) {
 			return 'requires a width parameter';
 		} else {
 			$width = $data['width'];
 		}
 	}
 	

 	$file_size = getimagesize($file);
 	
 	$ratio = $file_size[1] / $file_size[0];
 	$new_height = $file_size[1] / $ratio;
 	
 	$new_name = $width.'_'.$data['filename'];
 	$dest = $data['path'];
 	$config['width'] = $width;
 	$config['height'] = $new_height;
 	$config['maintain_ratio'] = false;
 	$config['source_image'] = $file;
 	$config['new_image'] = $dest;

 	$this->CI->image_lib->initialize($config); 
 	if(!file_exists($dest)) {
 		mkdir($dest, 0777, true);
 	}
 	if( !$this->CI->image_lib->resize() ) {
 		echo $this->CI->image_lib->display_errors();
 	}
 }

}