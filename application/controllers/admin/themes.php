<?php

class Themes extends Pinups_Controller {

	public function __construct() {
		parent::__construct();
		$this->navigation->methods_to_navigation(__CLASS__, array());
		$this->data['subnav'] = $this->navigation->get_subnav();
	}
	
	public function index() {
		$this->data['styles'] = $this->assets->css('admin_styles');
		$this->data['grid'] = $this->assets->css('grid');
		$this->data['lobster'] = $this->assets->css('lobster');
		$this->data['logo'] = $this->assets->img('logo');
		$this->data['page_title'] = 'Choose a Theme';
		$this->data['doc_title'] = 'Choose a Theme';
		$this->data['theme_data'] = $this->themes_lib->get_theme_data();
		$this->data['current_theme'] = $this->themes_lib->current_theme();
		$this->data['theme_location'] = $this->themes_lib->theme_location();
		$this->data['theme_preview'] = $this->themes_lib->preview_name();
		$this->data['themes'] = $this->themes_lib->get_themes();
		$this->data['content'] = $this->load->view('admin/themes/show', $this->data, true);
		$this->load->view('admin/template', $this->data);
		
	}
	
	public function options() {
	
		
	
	}

}