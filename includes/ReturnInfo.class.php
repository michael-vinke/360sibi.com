<?php
	/**
	* ReturnInfo class
	* @author fenicesun<kevin.samuel.sun@gmail.com>
	* @date 2014/12/28
	*
	*/

	
	class ReturnInfo {

		public $return_code;
		public $return_msg;
		public $data;	

		public function __construct($code = '', $msg = '', $data = array() ) {
			$this->set_return_info($code, $msg, $data);
		}

		public function set_return_info($code, $msg, $data = array()) {
			$this->return_code = $code;
			$this->return_msg  = $msg;
			$this->data = $data;
		}


	}

	/*	
	$data = array();
	$data['hello'] = "world";
	$ret = new ReturnInfo(1, "OK");	
	echo json_encode($ret);
	*/	
?>