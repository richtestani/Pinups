<?php

class Preferences extends Pinups_Controller {

	public function __construct() {
		parent::__construct();
		$this->navigation->path_to_navigation(realpath(realpath(APPPATH).'/controllers/admin'));
		$this->navigation->methods_to_navigation(__CLASS__, array());
		$this->navigation->filter(array('index'));
		$this->data['subnav'] = $this->navigation->get_subnav();
		$this->data['styles'] = $this->assets->css('admin_styles');
		$this->data['grid'] = $this->assets->css('grid');
		$this->data['lobster'] = $this->assets->css('lobster');
		$this->data['logo'] = $this->assets->img('logo');
		
	}
	
	public function index() {
		
		$this->data['content'] = 'index';
		$this->load->view('admin/template', $this->data);
		
	}
	
	public function generate_thumbnails($start = false) {
	public function plugin() {
		echo 'plugins';
	}
	
	public function update_data() {
		$this->load->model('tags_model', 'tags', true);
		$this->load->model('links_model', 'links', true);
		$this->load->model('images_model', 'images', true);
		$this->load->helper('date');
		$config = $this->config->item('upload');
		$file = file('/srv/www/themoviepostersite.com/posters.csv');
		$data = '';
		$views = array();
		foreach ($file as $key => $value) {
			$csv = str_getcsv($value);
			
			$data['id'] 		= $csv[0];
			$data['title'] 		= $csv[1];
			$data['filename'] 	= $csv[2];
			$num_views 			= $csv[3];
			$data['created_on'] = mysql_to_unix($csv[4]);
			$views['created_on']= $csv[5];
			$data['group_id']	= $csv[6];
			$data['thumbnail']	= $csv[7];
			$data['path_to_file'] = $config['upload_path'].$data['id']; //legacy path
			$tags = explode(", ", $csv[9]);
			
			$this->images->create($data);
			
			foreach ($tags as $k => $v) {
				$tag['tag'] = $v;
				$this->tags->create($tag);
				$id = $this->tags->get_insert_id();
				
				$tag_link['itemid'] = $id;
				$tag_link['item'] = 'tag';
				$tag_link['pinupid'] = $data['id'];
				$this->links->create($tag_link);
				
			}
		}
		
	
	}
	
	/*
	
		Build structure with array
		
		/{theme_path}/
			{group}/
				{orginal}/{filename}
				{small}/{filename}
				{medium}/{filename}
				{large}/{filename}
				{xlarge}/{filename}
		
		#default structure
		$structure = array(
						
						$theme_path => 'theme_path',
						'group' => array('directory' => array(
														'original' => array( 'directory => array('file' => $filename) ),
														'small' => array( 'directory => array('file' => $filename) ),
														'medium' => array( 'directory => array('file' => $filename) ),
														'large' => array( 'directory => array('file' => $filename) ),
														'xlarge' => array( 'directory => array('file' => $filename) )
														)
						
						
						);
	
	*/
	public function update_image_files($structure = '') {
		
		$this->load->model('images_model', 'images', true);
		$config = $this->config->item('upload');
		$setup = $this->config->item('setup');
		$this->load->helper('file');
		
		$data = array('limit' => 10000);
		$upload_path = ROOT.$config['upload_path'];
		$list = $this->imgs->all($data)->result();
		$template_syntax = array('{', '}');
		$structure = array(
						
						'{group_stub}' => array('directory' => 
											array(
												'original' => array( 'directory' => array('file' => '{filename}') ),
												'small' => array( 'directory' => array('file' => '{filename}') ),
												'medium' => array( 'directory' => array('file' => '{filename}') ),
												'large' => array( 'directory' => array('file' => '{filename}') ),
												'xlarge' => array( 'directory' => array('file' => '{filename}') )
												)
									)
						
						);
		
		foreach ($list as $key => $value) {
			$path = $upload_path;
			$count = 0;
			
			foreach ($structure as $k => $v) {
				$dir = str_replace($template_syntax, '', $k);
				$base = $path;
				$path .= $value[$dir].'/original';
				
				echo $path.'<br>';
				
				//test if directory is already there
				if(!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				
				
				$orig_path =  $upload_path.$value['pinup_id'].'/';
				$original = $orig_path.$value['filename'];
				$thumb = $orig_path.$value['thumbnail'];
				
				if(file_exists($orig_path)) {
					if(file_exists($original)) {
						copy($original, $path.'/'.$value['filename']);
						//update date
						
						
						
					}
					if(file_exists($thumb)) {
						copy($thumb, $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$value[$dir].'/'.$value['thumbnail']);
					}
					$mime = get_mime_by_extension($value['filename']);
					$value['mime_type'] = $mime;
					$value['path_to_file'] = $value[$dir].'/';
					$value['storage_type'] = 'local';
					$id = $value['pinup_id'];
					unset($value['pinup_id']);
					unset($value['pinup_creation']);
					unset($value['pinup_modified']);
					unset($value['file_ext']);
					$value['group_id'] = $value['pinup_group_id'];
					unset($value['pinup_group_id']);
					unset($value['group']);
					unset($value['group_parent']);
					unset($value['group_stub']);
					unset($value['group_creation']);
					unset($value['group_modified']);
					$this->images->update($value, $id);
					//remove original file
					unlink($orig_path);
					
				}
				
			}
			
			
			
		}
	
	}
	
}

?>