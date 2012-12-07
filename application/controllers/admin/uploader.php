<?php


class Uploader extends Pinups_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library('navigation');
		$this->load->model('settings_model', 'settings', true);
		$this->load->model('categories_model', 'categories', true);
		$this->load->model('groups_model', 'groups', true);
		$this->navigation->methods_to_navigation(__CLASS__, array('save', 'do_upload'));
		$this->data['subnav'] = $this->navigation->get_subnav();
		$this->assets->set_asset('scripts', 'js');
		
	}
	
	public function index() {
		
		$config = $this->config->item('upload');
		$this->data['message']['success'] = '';
		$this->data['message']['warning'] = '';
		$this->data['message']['error'] = '';
		$this->data['styles'] = $this->assets->css('admin_styles');
		$this->data['jquery'] = $this->assets->js('jquery');
		$this->data['jqueryui'] = $this->assets->js('jqueryui');
		$this->data['scripts'] = $this->assets->js('scripts');
		$this->data['grid'] = $this->assets->css('grid');
		$this->data['lobster'] = $this->assets->css('lobster');
		$this->data['logo'] = $this->assets->img('logo');
		$this->data['page_title'] = 'Uploader';
		$this->data['doc_title'] = 'Uploader';
		
		if( !is_really_writable(ROOT.$config['upload_path']) ) {
			$this->data['message']['warning'] = '<span class="warning">Ths path: '.$config['upload_path'].' is not writable</span>';
		}
		
		if( !file_exists(ROOT.$config['upload_path']) ) {
				$this->data['message']['error'] = '<span class="error">Ths path: '.$config['upload_path'].' does not exist</span>';
		
			}
			
		
		$this->data['categories'] = $this->categories->find();
		$this->data['content'] = $this->load->view('admin/pinups/upload', $this->data, true);
		
		$upload_data = $this->session->userdata('upload_data');

		if(!empty($upload_data)) {
			$this->data['upload_data'] = $upload_data;
			$this->session->unset_userdata('upload_data');
			$this->data['img_tag'] = '<img src="'.$upload_data['public_uri'].$upload_data['file_name'].'" />';
		} else {
			$error = $this->session->userdata('upload_error');
			$this->data['error'] = $error;
		}
		
		$this->load->view('admin/template', $this->data);		
	}
	
	
	public function do_upload() {
		
		$config = $this->config->item('upload');
		
		$categories = $this->input->post('categories');
		$tags = $this->input->post('tags');
		
		/*
		
		
		$this->pinups_storage->write($config);
		$data = $this->pinups_storage->get_uploaded();
		
		if(!empty($data)) {
			$this->session->set_userdata('upload_data', $data);
		} else {
			$this->session->set_userdata('upload_error', $this->pinups_storage->get_error());
		}
		redirect('/admin/uploader');
		
		*/
		
	}
	
	public function edit($id = '') {
	
	}
	
	public function save($data) {
	
	}
	
	
	
	

}