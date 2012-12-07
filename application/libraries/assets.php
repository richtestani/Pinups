<?php


class Assets {
	
	protected $asset_path;
	protected $css;
	protected $js;
	protected $img;
	protected $files;
	protected $google;
	protected $error;
	
	/*
		pass in a path based on your root install
	*/
	public function set_asset_path($path) {
		
		if(file_exists(ROOT.$path)) {
			$this->asset_path = rtrim($path, '/').'/';
			return true;
		}
		
		$this->error[] = 'Your path does not exist';
		
	}

	public function css($file, $extended = false) {
				
		$file = $this->css[$file];
		if(!$extended) {
			if($file['absolute']) {
				return $file['file'];
			} else {
				return $this->asset_path.'css/'.$file['file'];
			}
		} else {
			return $file;
		}
	
	}
	
	
	public function js($file, $extended = false) {
		
		$file = $this->js[$file];
		if(!$extended) {
			if($file['absolute']) {
				return $file['file'];
			} else {
				return $this->asset_path.'js/'.$file['file'];
			}
		} else {
			return $file;
		}
		
	}
	
	
	public function img($file, $extended = false) {
		
		if($extended) {
			return $this->img[$file];
		} else {
			return $this->asset_path.'images/'.$this->img[$file]['file'];
		}
		
	}
	
	function set_asset($file, $type='', $name='', $absolute=false) {
		
		$attributes = array();
		
		if(!is_array($file)) {
			
			if(empty($type)) {
				$this->error[] = 'asset type not set';
			}
			
			$path = pathinfo($file);
			
			if(empty($name)) {
				
				$ext = (isset($path['extension'])) ? $path['extension'] : $type;
				$name = $path['filename'];
				$path = $this->asset_path.$path['dirname'];
			}
			
			$href = $name.'.'.$ext;
			
		} else {
		
			extract($file);
			$path = $this->asset_path;
			
		}
		
		
		$this->{$type}[$name] = array(
								'path'=> $path,
								'name'=>$name,
								'file'=>$href,
								'absolute' => $absolute,
								'type' => $type,
								'attributes' => $attributes
								);
		
	}
	
	function get_asset($asset) {
		
		return $this->asset_path.$asset;
		
	}
	
	public function display_errors($as_array = false) {
		if(!$as_array) {
			return $this->error;
		}
		
		
	}

}