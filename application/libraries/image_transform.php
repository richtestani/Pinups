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
 	
 	/*
 	
 		If the new width is larger than the original width.
 		In this case we need to enlarge the height proportionately
 	
 	*/
 	if( $width > $orig_width ) {
 	if( $orig_width > $orig_height ) {
 		
 		$ratio 			= $orig_height / $orig_width;
 		$new_height 	= $width * $ratio;
 		
 	} else {
 		
 		$ratio 			= $orig_width / $orig_height;
 		
 		/*
 		
 			If the original width is less than the original height,
 			then we are dealing with a landscape oriented image
 		
 		*/
 		if( $orig_width > $orig_height ) {
 		
 			$new_height = $orig_width * $ratio;
 		
 		} else {
 			
 			$ratio 			= $orig_height / $orig_width;
 			$new_height 	= $width * $ratio;
 		
 		}
 	
 	}
 	
 	if( array_key_exists( 'height', $data ) ) {
 	
 		$new_height = $data['height'];
 	
 	}
 	print_r($data);
 	if( $data['size'] == 'custom' ) {
 	
 		$data['path'] = $data['path'].$width;
 		
 	}
 
 	$dest 						= $data['path'];
 	
 	$config['width'] 			= $width;
 	$config['height'] 			= $new_height;
 	$config['maintain_ratio'] 	= $maintain_ratio;
 	$config['crop']				= $crop;
 	$config['source_image'] 	= $file;
 	$config['new_image'] 		= $dest;
	
 	$this->CI->image_lib->initialize( $config ); 
 	
 	if(!file_exists( $dest )) {
 	
 		mkdir($dest, 0777, true);
 		
 	}
 	
 	if( !$this->CI->image_lib->resize() ) {
 	
 		echo $this->CI->image_lib->display_errors();
 		
 	}
 	
 	$this->CI->image_lib->clear();
 }

}