<?php

class Pinups_Storage_local extends CI_Driver {
	
	public $CI;
	protected $error;
	private $success;
	protected $uploaded = array();
	
	public function __construct() {
		$this->CI = get_instance();
	}

	public function write($config) {

		$this->CI->load->library('upload');
		$upload_config = $this->CI->config->item('upload');
		$config['upload_path'] = ROOT.$config['upload_path'];
		$this->CI->upload->initialize($config);

		if( !$this->CI->upload->do_upload() ) {
		
			$this->error = $this->CI->upload->display_errors();
			$this->success = 0;
			
		} else {
		
			$this->success = 1;
			$this->uploaded = $this->CI->upload->data();
			$this->uploaded['public_uri'] = 'http://'.$_SERVER['HTTP_HOST'].$upload_config['upload_path'];
		}
	}
	
	public function move($config) {
	
	}
	
	public function delete($file) {
		
	}
	
	public function is_success() {
		return $this->success;
	}
	
	public function get_error() {
		return $this->error;
	}
	
	public function uploaded() {
		return $this->uploaded;
	}
	
	public function upload_from_url($curl) {
	
	}

}