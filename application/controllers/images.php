<?php

class Images extends Pinups_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->theme = $this->themes_lib->get_theme_data();
		$this->assets->set_asset_path($this->themes_lib->theme_location().'/'.$this->theme['theme_name'].'/assets/');
		$this->data['nav'] = $this->navigation->build_navigation();
		$this->data['sizes'] = $this->config->item('size');
		$this->data['thumb'] = $this->config->item('thumb');
		$this->assets->set_asset('mp_logo.png', 'img');
		$this->assets->set_asset(array(
									'name'=>'styles',
									'type'=>'css',
									'href'=>'styles.css'
									));
									
		$this->assets->set_asset(array(
									'name'=>'ostrich',
									'type'=>'css',
									'href'=>'fonts/ostrich-sans-fontfacekit/stylesheet.css'
								));
	}

	public function index($id, $return = false) {
	
		$id = (int) $id;
		
		if($id == 0) {
			echo 'not a number';
			return false;
		}
		
		$this->data['pinups'] = $this->pinups->get('id', array(
													'where'=> array(
																array(
																	'where' => 'where',
																	'field'=>'p.id',
																	'values' => $id,
																)
															),
													'limit' => array('limit' => 1)
														)
													);
					
		$path = $this->themes_lib->theme_location().'/'.$this->theme['theme_name'];
		$this->data['page_title'] = 'Home Page';
		$this->data['styles'] = $this->assets->css('styles');
		$this->data['ostrich'] = $this->assets->css('ostrich');
		$this->data['logo'] = $this->assets->img('mp_logo');
		$this->data['theme_path'] = $path;
		$this->data['header'] = $this->load->view($path.'/header', $this->data, true);
		$this->data['footer'] = $this->load->view($path.'/footer', $this->data, true);
		$current_image = ROOT.$this->data['upload_path']
							.$this->data['pinups']->path_to_file
							.$this->data['size']
							.'/'
							.$this->data['pinups']->filename;
		$upload_path = ROOT.$this->upload_config['upload_path'];
		$width = $this->data['sizes'][$this->data['size']];
		$size = $this->data['size'];
		
		if(!$this->pinups->image_exists($current_image)) {
			
			$original = ROOT.$this->data['upload_path']
								.$this->data['pinups']->path_to_file.'original/'.$this->data['pinups']->filename;
			$new_path = $upload_path.$this->data['pinups']->path_to_file.$size.'/';
			$data['size'] = $size;
			$data['path'] = $new_path;
			$data['width'] = $width;
			$data['filename'] = $this->data['pinups']->filename;
			
			$this->pinups->transform('resize', $original, $data);
		}
		if(!$return) {
			$this->data['image_path'] = $this->data['upload_path']
										.$this->data['pinups']->path_to_file
										.$size
										.DIRECTORY_SEPARATOR;
			$this->data['content'] = $this->load->view($path.'/image', $this->data, true);
			$this->load->view($path.'/single', $this->data);
		}
		
	}
	
	public function id($id) {
		$this->index($id);
	}
	
	public function size( $size, $id = 0, $overwrite = false ) {

		$id = (int) $id;
		
		if( $id == 0 ) {
			echo 'not an image';
			return false;
		}
		
		/*
			Set data for view
		*/
		$this->index($id, true);
		
		/*
			Build file on the fly
			If size is a number,
			generate image to that width
		*/
		if( is_numeric($size) ) {
		
			$data['width'] 		= (int) $size;
			$data['size'] 		= 'custom';
			$size 				= 'custom';
			$data['overwrite'] 	= $overwrite;
			
			$this->data['image_path'] = $this->data['upload_path']
										.$this->data['pinups']->path_to_file
										.$size
										.DIRECTORY_SEPARATOR
										.$data['width']
										.DIRECTORY_SEPARATOR;
			
		} else {
			
			if( $size == 'thumbnail' || $size == 'thumb' ) {
			
				$data['size'] = $size;
				$data['overwrite'] = true;
			
			} else {
			
				$data['size'] 		= $size;
				$data['overwrite'] 	= $overwrite;
				
				$this->data['image_path'] = $this->data['upload_path']
											.$this->data['pinups']->path_to_file
											.DIRECTORY_SEPARATOR
											.$size
											.DIRECTORY_SEPARATOR;
			
			}
			
			
		}
	
		$this->data['size'] 	= $size;
	
		$current_image 			= ROOT
									.$this->data['upload_path']
									.$this->data['pinups']->path_to_file
									.$size
									.DIRECTORY_SEPARATOR
									.$this->data['pinups']->filename;
		
									
		if( $data['overwrite'] ) {
			
			
			$this->pinups->transform( 'resize', $original, $data );
			
		
		} elseif( !$this->pinups->image_exists( $current_image ) ) {
			
			
			$original 			= ROOT
									.$this->data['upload_path']
									.$this->data['pinups']->path_to_file
									.'original'
									.DIRECTORY_SEPARATOR
									.$this->data['pinups']->filename;
									
			$data['path'] = ROOT
										.$this->data['upload_path']
										.$this->data['pinups']->path_to_file
										.$size
										.DIRECTORY_SEPARATOR;
									
			$this->pinups->transform( 'resize', $original, $data );
			
			
			
		}
				
		$this->data['content'] = $this->load->view( $this->data['theme_path'].'/image', $this->data, TRUE );
		$this->load->view( $this->data['theme_path'].'/single', $this->data );
		
	}
	
	public function tags($data) {
		$data = array('remake', 'disney', 'nicole kidman');
		$this->pinups->find('tags', $data);
		$this->data['pinups'] = $this->pinups->get_pinups();
		$this->load->view('admin/dashboard', $this->data);
		
	}
	
	public function added() {}
	
	public function __call($name, $args) {
		echo $name;
	}

}