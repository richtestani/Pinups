<?php

class Pinups_Storage extends CI_Driver_Library {

	protected $valid_drivers = array(
										'pinups_storage_local'
									);
	public $CI;

	public function __construct($config = array()) {
	
		$this->CI =& get_instance();
		
		if ( ! empty($config))
		{
			$this->_initialize($config);
		}
		
		
	}
	
	private function _initialize($config)
		{        
			$default_config = array(
					'adapter',
					'local'
				);
	
			foreach ($default_config as $key)
			{
				if (isset($config[$key]))
				{
					$param = '_'.$key;
					
					$this->{$param} = $config[$key];
				}
			}
	
		}
		
	public function write($config) {
		$this->local->write($config);
	}
	
	public function get_uploaded() {
		return $this->local->uploaded();
	}
	
	public function get_error() {
		return $this->local->get_error();
	}
	
	public function upload_via_url($curl) {
	
	}

}