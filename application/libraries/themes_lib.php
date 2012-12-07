<?php

class Themes_Lib {

	protected $theme;
	protected $location;
	protected $CI;
	protected $theme_config;
	protected $installed_themes;
	protected $about_file = 'about.txt';
	protected $about_data;

	public function __construct($cf = '') {
		$this->CI = get_instance();
		$this->CI->load->model('themes_model', 'theme_model', true);
		$this->CI->load->helper('directory');	
		$config = $this->CI->config->item('themes');
		
		if(!empty($cf)) {
			$this->theme_config = $cf;
			foreach ($cf as $key => $value) {
				$this->{$value['name']} = $value['value'];
			}
		}
		
		foreach ($config as $key => $value) {
			$this->{$key} = $value;
		}
		
		$this->get_installed_themes();
		$this->load_about();
		
	}
	
	
	
	public function override_theme($theme) {
	
	}
	
	public function load_theme() {
		
	}
	
	public function current_theme() {
		return $this->theme_name;
	}
	
	public function theme_location() {
		return $this->theme_location;
	}
	
	public function preview_name() {
		return $this->theme_preview;
	}
	
	public function get_theme_data() {
		
		foreach ($this->installed_themes as $key => $value) {

			if( $value == $this->current_theme ) {
			
				return $this->about_data[$this->current_theme];
				
			}
		}
		
	}
	
	private function load_about() {
	
		foreach ($this->installed_themes as $key => $value) {
			
			$path = '.'.$this->theme_location.'/'.$value.'/'.$this->about_file;
			if( file_exists( $path ) ) {
			
				$about = file( $path );
				
				foreach ($about as $k => $v) {
					$part = explode(":", $v);
					$this->about_data[$value]['theme_name'] = $value;
					$this->about_data[$value][strtolower(url_title($part[0], '_'))] = ( !isset($part[1]) ) ? '' : trim($part[1]);
				}
			
			} else {
			
				$this->about_data[$value]['theme_name'] = $value;
			
			}
			
		}

	}
	
	public function get_themes() {
		
		if(empty($this->installed_themes)) {
			return array();
		} else {
			return $this->installed_themes;
		}
		
	}
	
	private function get_installed_themes() {
		$path = $this->theme_location();
		$listing = directory_map('.'.$path, 1);
		
		$this->installed_themes = $listing;
	}

}