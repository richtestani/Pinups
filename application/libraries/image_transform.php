<?php


class Image_Transform {

	protected $CI;
	protected $image_config;

 public function __construct() {
 
 	$this->CI = get_instance();
 	$this->CI->load->library('image_lib');
 
 }
 
 public function set_image_data($data) {
 
 	$this->image_config = $data;
 	
 }
 
 public function resize( $file, $data ) {
 
 	$overwrite = false;
 	$crop = false;
 	$maintain_ratio = false;
	
 	if( is_array( $data ) ) {
 	
 		if( !array_key_exists( 'width', $data ) ) {
 		
 			return 'requires a width parameter';
 			
 		} else {
 		
 			$width = $data['width'];
 			
 		}
 	}
 	
 	$file_size 		= getimagesize( $file );
 	$orig_width		= $file_size[0];
 	$orig_height	= $file_size[1];
 	extract($data);
 	
 	$ratio 			= $orig_width / $orig_height;
 	
 	/*
 	
 		If the original width is larger than the original width,
 		we are working with landscape orientation
 	*/
 	
 	if( $orig_width > $orig_height ) {
 		
 		$new_height = $width / $ratio;
 	
 	} else {
 	
 		$ratio 			= $orig_height / $orig_width;
 		$new_height 	= $width * $ratio;
 	
 	}
 	 	
 	if( array_key_exists( 'height', $data ) ) {
 	
 		$new_height = $data['height'];
 	
 	}
 	
 	if( $data['size'] == 'custom' ) {
 	
 		$data['path'] = $data['path'].$width;
 		
 	}
 	print_r($data);
 	$dest 						= $data['path'];
 	
 	$config['maintain_ratio'] 	= $maintain_ratio;
 	
 	$config['source_image'] 	= $file;
 	$config['new_image'] 		= $dest;
 	$config['width'] 			= $width;
 	$config['height'] 			= $new_height;
	 
 	
 	if(!file_exists( $dest )) {
 	
 		mkdir($dest, 0777, true);
 		
 	}
 	
 	if( $crop ) {

 		
 		
 		$this->CI->image_lib->initialize( $config );
 		
 		if( !$this->CI->image_lib->crop() ) {
 			
 			echo $this->CI->image_lib->display_errors();
 			
 		}
 	
 	
 	} else {
 		
 		$this->CI->image_lib->initialize( $config );
 		
 		if( !$this->CI->image_lib->resize() ) {
 		
 			echo $this->CI->image_lib->display_errors();
 			
 		}
 	
 	}
 	
 	
 	
 	$this->CI->image_lib->clear();
 }
 
 private function set_image_position( $data ) {
 
 	if( !array_key_exists( 'width', $data ) AND
 		!array_key_exists( 'height', $data ) AND
 		!array_key_exists( 'x_axis', $data ) AND
 		!array_key_exists( 'y_axis', $data ) AND 
 		!array_key_exists( 'position', $data ) ) {
 			return false;
 		}
 
 	extract($data);
 	
 	switch( $position ) {
 	
 		case 'center':
 		$midw = $width / 2;
 		$midh = $height / 2;
 	
 	}
 	
 
 }

}