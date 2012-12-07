<?php

class Setup extends CI_Hooks {

	protected $setup_array;

	public function __construct() {
	
		$this->CI = get_instance(); 
		
	}
	
	public function setup() {
		$this->CI->db->select('*');
		$this->CI->db->from('pinups_settings');
		$q = $this->CI->db->get();
		$result = $q->result_array();
		
		$group_name = '';
		/*
			$settings['setup']['themes'][0] = array();
			$settings['setup']['themes'][1] = array();
			$settings['setup']['settings'][0] = array();
		*/
		
		foreach ($result as $key => $value) {
			
			if($group_name != $value['group_name']) {
				
				$this->setup_array['pinups'][$value['group_name']][] = $value;
				
			} else {
				
				$this->setup_array['pinups'][$value['group_name']][] = $value;
				
			}
			
			$group_name = $value['group_name'];
		}
		
		$this->CI->config->set_item('setup', $this->setup_array);
		
	}

}