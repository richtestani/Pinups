<?php

class Groups extends Pinups_Controller {

	public function __construct() {
	
		parent::__construct();
		$this->load->library('navigation');
		$this->load->model('settings_model', 'settings', true);
		$this->navigation->methods_to_navigation(__CLASS__, array('save', 'do_upload'));
		$this->data['subnav'] = $this->navigation->get_subnav();
	
	}
	
	public function index() {
	
	}
	
	public function add() {
	
	}
	
	public function edit() {
	
	}
	
	public function save($id = '') {
	
	}

}