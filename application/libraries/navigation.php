<?php

class Navigation {

	private $ci;
	private $nav;
	private $subnav = array();

	public function __construct() {
	
		$this->ci = get_instance();
		$this->ci->load->helper('inflector');
		$this->ci->load->model('navigation_model', 'nav', true);
		
		$this->current = $this->ci->uri->segment(1);
	}
	
	public function initialize($uri) {
		$this->current = $uri;
	}
	

		if(file_exists($path)) {
		
			$count = 0;
			
			foreach (glob($path.'/*php') as $key => $value) {
			
				$section_segment = basename($value, '.php');
				$this->nav[$count]['original'] = $value;
				$this->nav[$count]['basename'] = $section_segment;
				$this->nav[$count]['label'] = $this->transform('humanize', $section_segment);
				$this->nav[$count]['href'] = '.'.DIRECTORY_SEPARATOR.$section_segment;
				
				$count++;
			}
			
		} else {
		
			echo 'path does not exist';
			
		}
		
		
	}
	
	public function methods_to_navigation($classname, $filter = array()) {
	
		$methods = get_class_methods($classname);
		$count = 0;
		
		foreach ($methods as $key => $value) {
			if( ( $value != '__construct' ) && ( $value != 'get_instance' ) && !in_array($value, $filter) ) {
				$this->subnav[$count]['basename'] = $value;
				$this->subnav[$count]['label'] = ($value == 'index') ? 'Main' : $this->transform('humanize', $value);
				$this->subnav[$count]['href'] = strtolower($classname).'/'.$value;
			}
			
			$count++;
		}
		
		$this->subnav = array_merge(array(), $this->subnav);
		
	
	}
	
	public function filter($filter = array()) {
		
		$count = 0;
		
		foreach ($this->subnav as $key => $value) {
			if(in_array($value['basename'], $filter)) {
				unset($this->subnav[$count]);
			}
			
			$count++;
			
		}
		
		$count = 0;
		
		foreach ($this->nav as $key => $value) {
			if(in_array($value['basename'], $filter)) {
				unset($this->nav[$count]);
			}
			
			$count++;
			
		}
		
		
		$this->nav = array_merge(array(), $this->nav);
		$this->subnav = array_merge(array(), $this->subnav);
	
	}
	
	public function transform($transform, $string = '') {
		
		if(empty($string)) {
			return $string;
		}
		
		switch ($transform) {
			
			case 'underscore':
			return underscore($string);
			break;
			
			case 'humanize':
			return humanize($string);
		}
		
	}
	
	public function set_menu_item($item) {
		//build menu item, then save it to db
	}
	
	public function build_navigation($parent = 0) {
		
		$nav = $this->ci->nav->get_pages($parent);
		$list = array();
		foreach ($nav as $key => $value) {
			
			if(!empty($value['route'])) {
				$href = $value['route'];
			} else {
				$href = $value['slug'];
			}
			
			$list[] = '<li><a href="/'.$href.'">'.$value['name'].'</a></li>';
		}
		
		return '<ul id="nav">'.implode("", $list).'</ul>';
		
	}
	
	public function get_nav() {
		return $this->nav;
	}
	
	public function get_subnav() {
		return $this->subnav;
	}

}