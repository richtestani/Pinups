<?php

class Preferences extends Pinups_Controller {

	public function __construct() {
		parent::__construct();
		$this->navigation->files_to_navigation(realpath(realpath(APPPATH).'/controllers/admin'));
		$this->navigation->methods_to_navigation(__CLASS__, array());
		$this->navigation->filter(array('index'));
		$this->data['subnav'] = $this->navigation->get_subnav();
		$this->data['styles'] = $this->assets->css('admin_styles');
		$this->data['grid'] = $this->assets->css('grid');
		$this->data['lobster'] = $this->assets->css('lobster');
		$this->data['logo'] = $this->assets->img('logo');
		$this->data['thumb'] = $this->config->item('thumb');
		$this->upload_config = $this->config->item('upload');
		$this->load->model('views_model', '', true);
		$this->load->model('categories_model', '', true);
		
	}
	
	public function index() {
		
		$this->data['content'] = 'index';
		$this->load->view('admin/template', $this->data);
		
	}
	
	public function generate_thumbnails($start = false) {
		
		if( $start ) {
		
			$all = $this->pinups->get( 'all', array(
													'limit'=>array('limit'=>10),
													'where'=>array(
																'where'=>'where',
																'field'=>'p.id',
																'values' => 1647
															) )
										);
			
			if( count( $all ) == 1 ) {
				
				$current_thumb = ROOT.$this->upload_config['upload_path'].$all->path_to_file.$all->thumbnail;
				$file = ROOT.$this->upload_config['upload_path'].$all->path_to_file.'original/'.$all->filename;
				
				$config['width'] 	= $this->data['thumb']['width'];
				$config['height']	= $this->data['thumb']['height'];
				$config['crop'] 	= $this->data['thumb']['crop'];
				$config['position'] = $this->data['thumb']['position'];
				$config['prefix'] 	= $this->data['thumb']['prefix'];
				$config['suffix'] 	= $this->data['thumb']['suffix'];
				$config['size']		= 'thumbnail';
				$config['path']		= ROOT.$this->upload_config['upload_path'].$all->path_to_file.$config['prefix'].$all->filename;
				
				if( $this->pinups->image_exists( $current_thumb ) ) {
					
					unset( $current_thumb );
					if( $this->pinups->transform( 'resize', $file, $config ) ) {}
					
				
				}
			
			} else {
				
				foreach ($all as $key => $image) {
					
					$current_thumb = ROOT.$this->upload_config['upload_path'].$image->path_to_file.$image->thumbnail;
					$file = ROOT.$this->upload_config['upload_path'].$image->path_to_file.'original/'.$image->filename;
					
					$config['width'] 	= $this->data['thumb']['width'];
					$config['crop'] 	= $this->data['thumb']['crop'];
					$config['prefix'] 	= $this->data['thumb']['prefix'];
					$config['suffix'] 	= $this->data['thumb']['suffix'];
					$config['size']		= 'thumbnail';
					$config['path']		= ROOT.$this->upload_config['upload_path'].$image->path_to_file.$config['prefix'].$image->filename;
					
					if( $this->pinups->image_exists( $current_thumb ) ) {
						
						unset( $current_thumb );
						if( $this->pinups->transform( 'resize', $file, $config ) ) {}
						
					
					}
					
					
				}
			
			}
		
		
		} else {
		
			echo '<a href="generate_thumbnails/start">Start</a>';
		
		}
		
	}
	
	public function plugin() {
		echo 'plugins';
	}
	
	public function update_poster_data() {
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
			$views['pinupup_id'] = $csv[0];
			$views['view'] = 1;
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
	
	public function update_view_data() {
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
			
			$views['created_on']= mysql_to_unix($csv[5]);
			$views['pinup_id'] = $csv[0];
			$views['view'] = $csv[3];
			
			$this->views_model->create($views);
		}
		
	
	}
	
	public function update_category_data() {
		$this->load->model('tags_model', 'tags', true);
		$this->load->model('links_model', 'links', true);
		$this->load->model('images_model', 'images', true);
		$this->load->helper('date');
		$config = $this->config->item('upload');
		$file = file('/srv/www/themoviepostersite.com/genres.csv');
		$data = '';
		$views = array();
		foreach ($file as $key => $value) {
			$csv = str_getcsv($value);
			
			$data['pinupid'] 		= $csv[2];
			$data['itemid'] 		= $csv[1];
			$data['item'] = 'category';
			
			$this->links->create($data);
			
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