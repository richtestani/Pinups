<?php

class Dashboard extends Pinups_Controller {

	public function __construct() {
		
		parent::__construct();
		
		
	}
	
	public function index() {
		
		$this->data['styles'] = $this->assets->css('admin_styles');
		$this->data['grid'] = $this->assets->css('grid');
		$this->data['lobster'] = $this->assets->css('lobster', true);
		$this->data['logo'] = $this->assets->img('logo');
		$this->data['page_title'] = 'Dashboard';
		$this->data['doc_title'] = 'Dashboard';
		
		$this->data['nav'] = $this->navigation->get_nav();
		$this->data['content'] = $this->load->view('admin/dashboard', $this->data, true);
		$this->load->view('admin/template', $this->data);
		
	}
	
	

}