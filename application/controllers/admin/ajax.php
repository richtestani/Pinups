<?php

class Ajax extends Pinups_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->model('categories_model', 'categories', true);
		$this->load->model('groups_model', 'groups', true);
		$this->load->model('themes_model', 'themes', true);
	}
	
	public function index() {
	echo 'hi';
	}
	
	public function action($action, $model, $format = 'json') {

		$data['where_type'] = $this->input->post('where_type');
		$data['value'] = $this->input->post('value');
		$data['field'] = $this->input->post('where_field');
		
		$result = $this->$model->$action($data);
		
		switch ($format) {
			
			case 'json':
				$json = json_encode($result);
				echo $json;
			break;
			
		}
		
	}

}