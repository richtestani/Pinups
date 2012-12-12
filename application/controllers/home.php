<?php

class Home extends Pinups_Controller {

	public function __construct() {
		parent::__construct();
		$this->theme = $this->themes_lib->get_theme_data();
		$this->load->library('pagination');
		$this->assets->set_asset_path($this->themes_lib->theme_location().'/'.$this->theme['theme_name'].'/assets/');
		
		$this->data['nav'] = $this->navigation->build_navigation();
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
	
	public function index($page = 1) {
		
		$pages = $this->config->item('pages');
		$offset = 0;
		if($page > 1) {
			$offset = $pages['per_page'] * $page;
		}
		
		$this->pagination->initialize($pages); 
		$path = $this->themes_lib->theme_location().'/'.$this->theme['theme_name'];
		
		/*
			Get your pinups object
		*/
		$this->data['pinups'] = $this->pinups->get_pinups('all', 
															array(
																'limit'=>array(
																			'limit'=>$pages['per_page'],
																			'offset'=>$offset
																				)
																	)
															);
		
		$this->data['page_title'] = 'Home Page';
		$this->data['styles'] = $this->assets->css('styles');
		$this->data['ostrich'] = $this->assets->css('ostrich');
		$this->data['logo'] = $this->assets->img('mp_logo');
		$this->data['page_links'] = $this->pagination->create_links();
		$this->data['header'] = $this->load->view($path.'/header', $this->data, true);
		$this->data['footer'] = $this->load->view($path.'/footer', $this->data, true);
		$this->data['content'] = $this->load->view($path.'/home', $this->data, true);
		$this->load->view($path.'/listing.php', $this->data);

	}
	
	
	public function categories($category, $page = 1) {
		
		if(empty($category)) {
			echo 'a category was not supplied';
			return false;
		}
		
		$pages = $this->config->item('pages');
		$offset = 0;
		if($page > 1) {
			$offset = $pages['per_page'] * $page;
		}
		
		$this->pagination->initialize($pages); 
		$path = $this->themes_lib->theme_location().'/'.$this->theme['theme_name'];
		
		/*
			Get your pinups object
		*/
		$this->data['pinups'] = $this->pinups->get_pinups('all', 
															array(
																'limit'=>array(
																			'limit'=>$pages['per_page'],
																			'offset'=>$offset
																				)
																	),
																'where' => array(
																				'where'=>'where',
																				'field' => 'category',
																				'values' => $category
																			),
																			
																'join' => array(
																			array(
																				'table' => 'pinups_categories as c'
															);
		
		$this->data['page_title'] = 'Home Page';
		$this->data['styles'] = $this->assets->css('styles');
		$this->data['ostrich'] = $this->assets->css('ostrich');
		$this->data['logo'] = $this->assets->img('mp_logo');
		$this->data['page_links'] = $this->pagination->create_links();
		$this->data['header'] = $this->load->view($path.'/header', $this->data, true);
		$this->data['footer'] = $this->load->view($path.'/footer', $this->data, true);
		$this->data['content'] = $this->load->view($path.'/home', $this->data, true);
		$this->load->view($path.'/listing.php', $this->data);	
	
	}
	
	public function tags($tags, $page = 1) {
		
		if(empty($tags)) {
			echo 'a category was not supplied';
			return false;
		}
		
		$pages = $this->config->item('pages');
		$offset = 0;
		if($page > 1) {
			$offset = $pages['per_page'] * $page;
		}
		
		$this->pagination->initialize($pages); 
		$path = $this->themes_lib->theme_location().'/'.$this->theme['theme_name'];
		
		/*
			Get your pinups object
		*/
		$this->data['pinups'] = $this->pinups->get_pinups('all', 
															array(
																'limit'=>array(
																			'limit'=>$pages['per_page'],
																			'offset'=>$offset
																				)
																	),
																'where' => array(
																				'where'=>'where',
																				'field' => 'category',
																				'values' => $category
																			),
																			
																'join' => array(
																			array(
																				'table' => 'pinups_categories as c'
															);
		
		$this->data['page_title'] = 'Home Page';
		$this->data['styles'] = $this->assets->css('styles');
		$this->data['ostrich'] = $this->assets->css('ostrich');
		$this->data['logo'] = $this->assets->img('mp_logo');
		$this->data['page_links'] = $this->pagination->create_links();
		$this->data['header'] = $this->load->view($path.'/header', $this->data, true);
		$this->data['footer'] = $this->load->view($path.'/footer', $this->data, true);
		$this->data['content'] = $this->load->view($path.'/home', $this->data, true);
		$this->load->view($path.'/listing.php', $this->data);	
	
	}
	

}