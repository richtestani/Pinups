<?php

class Tester {

	public $myVal;
	protected $proVal;
	private $priVal;

	public function my_func() {
		echo 'hello';
	}
	
	public function set_var($val) {
		$this->myVal = $val;
	}
	
	public function set_proVal($val) {
		$this->proVal = $val;
	}
	
	public function set_priVal($val) {
		$this->priVal = $val;
	}
	
	protected function getVals() {
		echo $this->proVal;
	}
	
	private function allVals() {
		echo $this->proVal;
	}
	

}