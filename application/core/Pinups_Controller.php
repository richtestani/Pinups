<?php

class Pinups_Controller extends CI_Controller {

	protected $is_admin = false;
	protected $pinups_config;
	protected $theme;
	protected $upload_path;
	protected $asset_path;
	protected $current_uri;
	protected $curl_support = false;
	protected $curl;
	protected $data;

	public function __construct() {
		if( in_array('curl', get_loaded_extensions()) ) {
			$this->curl_support = true;
		}
		parent::__construct();
		$this->load->helper(array(
								'form', 
								'file', 
								'path', 
								'inflector', 
								'array', 
								'cookie', 
								'date',
								'number',
								'url',
								'string',
								'text'));
								
		$this->data['size'] = 'xlarge';
				
		$this->setup();
		$this->upload_config = $this->config->item('upload');
		$this->assets->set_asset_path('/assets');
		$config = $this->config->item('setup');
		$this->assets->set_asset('grid', 'css');
		$this->assets->set_asset('logo.png', 'img');
		 
		/*
			Pinups
		*/
		$this->pinups_config = $config['pinups'];
		$this->load->library('themes_lib', $this->pinups_config['themes']);

		if( $this->is_admin ) {
			
			$storage = $this->config->item('storage');
			$driver = $storage['driver'];
			
			$this->assets->set_asset('admin_styles', 'css');
			$this->assets->set_asset('admin_js', 'js');
			$this->assets->set_asset(array(
										'name' => 'lobster',
										'href' => 'http://fonts.googleapis.com/css?family=Lobster+Two:400,700italic,400italic,700',
										'type' => 'css',
										'absolute' => true
									));
									
			$this->assets->set_asset(array(
										'name' => 'jquery',
										'href' => '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js',
										'type' => 'js',
										'absolute' => true
										));
										
			$this->assets->set_asset(array(
										'name' => 'jqueryui',
										'href' => '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js',
										'type' => 'js',
										'absolute' => true
										));

		} else {
		
			$this->theme = $this->themes_lib->load_theme();
		
		}

	}
	
	protected function is_admin() {
	
		$uri = $this->uri->segment(1);
		
		if( $uri == 'admin' ) {
		
			$this->is_admin = true;
			$this->navigation->path_to_navigation(realpath(realpath(APPPATH).'/controllers/admin'));
			$this->navigation->filter(array('ajax'));
			$this->data['nav'] = $this->navigation->get_nav();
			$this->data['curl_support'] = $this->curl_support;
		}
		
	}
	
	private function setup() {
		
		$this->is_admin();
		
		$settings = $this->settings->initialize();
		
		$group_name = '';

		$upload_config = $this->config->item('upload');
		
		$this->data['upload_path'] = $upload_config['upload_path'];
		
		foreach ($settings as $key => $value) {
			
			if($group_name != $value['group_name']) {
				
				$this->setup_array['pinups'][$value['group_name']][] = $value;
				
			} else {
				
				$this->setup_array['pinups'][$value['group_name']][] = $value;
				
			}
			
			$group_name = $value['group_name'];
		}
		
		$this->config->set_item('setup', $this->setup_array);
		$this->current_uri = $this->uri->uri_to_assoc(1);
		
	}

	

}