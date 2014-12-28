<?php
	
	/**
	* Action 
	* @author fenicesun <kevin.samuel.sun@gmail.com>
	* @date 2014/12/28
	* Action base class
	*
	*/
	require_once ('ReturnInfo.class.php');

	class Action {

		protected $request_data;

		public function __construct() {
			$this->request_data = $_REQUEST;		
		}

		/**
		* get request data by key, return $_REQUEST['key']
		* @param $key
		*
		*/
		public function get_request_by_key($key) {
			return $this->request_data[$key];	
		}

		/**
		* put response data in json
		* @param $data
		*
		*/
		public function put_response_in_json($data) {
			return json_encode($data);
		}

		/**
		* override this function in sub class
		* dispatch request handle by $action
		* @param $action
		* @param $param
		*
		*/		
		public function dispatch($action, $param) {

		}								

		/**
		* error handle
		*
		*
		*/
		public function error($error_code) {
			$location = "Location: http://www.360sibi.com/view/page/error.php?error_code = {$error_code}";	
			header($location);
		}

	}	


?>
