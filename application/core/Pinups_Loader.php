<?php

class Pinups_Loader extends CI_Loader {

	public function __construct() {
		parent::__construct();
		//Add site root path to views array
		$this->_ci_view_paths[$_SERVER['DOCUMENT_ROOT']] = TRUE;
	}

}