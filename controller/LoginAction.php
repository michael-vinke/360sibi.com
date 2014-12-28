<?php

	/**
	* Action Login
	* @author fenicesun <kevin.samuel.sun@gmail.com>
	* @date 2014/12/28
	* deal with the request and reponse of login
	*
	*/
	require_once ('../model/user.php');
	require_once ('../includes/Action.class.php');

	class Login extends Action {

		private $user;

		public function __construct() {
			parent::__construct();
			$this->user = new User();
		}

		public function get_user() {
			return $this->user;
		}

		/**
		* init dispatch
		* call this function after new
		* fiter the param
		*/
		public function init() {
			$action = $this->get_request_by_key('action');
			$param = array();
			$param['username'] = $this->get_request_by_key('username');
			$param['password'] = $this->get_request_by_key('password');
			$this->dispatch($action, $param);
		}


		/**
		* override fun dispach in Action
		* dispatch handle by action
		* @param $action, $param
		*
		*/
		public function dispatch($action, $param_arr) {

			switch($action) {
				case 'register':
						$this->register($param_arr);
						break;
				case 'login':
						$this->login($param_arr);
						break;
				case 'check':
						$this->check_username_exists($param_arr);
						break;
				default:
						$this->error(404);
						break;
			}
		}

		/**
		*  deal with login
		* @param $param_arr (username, password)
		*
		*/
		public function login($param) {

			$username = $param['username'];
			$password = $param['password'];
			$result = $this->get_user()->login_user($username, $password);
			$ret = new ReturnInfo();
			$data = array();
			if ($result == true) {
				$data['name'] = $username;
				$ret->set_return_info(0, "登陆成功", $data);
			} else {
				$ret->set_return_info(-1, "用户名或密码错误", $data);
			}
			echo $this->put_response_in_json($ret);
			return;
		}

		/**
		* check the exist of username
		* @param $param_arr
		*
		*/
		public function check_username_exists($param) {
			$username = $param['username'];

			$result = $this->get_user()->is_exists_user($username);
			$ret = new ReturnInfo();
			if ($result == false) {
				$ret->set_return_info(-1, "用户名不存在");
			} else {
				$ret->set_return_info(0, "用户名存在");
			}
			echo $this->put_response_in_json($ret);
			return;
		}


		/**
		* deal with register
		* @param $param_arr (username, password)
		*
		*/
		public function register($param) {

			$username = $param['username'];
			$password = $param['password'];
			$ret = new ReturnInfo();
			//check username wheather it is exists
			if ($this->user->is_exists_user($username) == true) {
				$ret->set_return_info(-1, "该用户名已注册");
				echo $this->put_response_in_json($ret);
				return;
			}

			try {
				$this->user->store_user($username, $password);
				$ret->set_return_info(0, "注册成功!");
			} catch (Exception $e) {
				$ret->set_return_info(-1, "注册失败!");
			}
			echo $this->put_response_in_json($ret);
			return;
		}

	}

	$login = new Login();
	$login->init();

?>
