<?php

	/*
	* Singltion DBoper (base on mysqli)
	* basic database operation
	*
	* @auther fenicesun <kevin.samuel.sun@gmail.com>
	* @date  2014-12-21
	*
	*
	*/


	class DBoper {

		private $_db;
		private static $_instance;

		private function __construct() {
			$this->_db = new mysqli();
			$this->connect_db();
		}

		/*
		* forbid clone
		*
		*/
		private function __clone() {}

		/**
		* get db instance
		*
		**/
		public static function getInstance() {
			if (! (self::$_instance instanceof self) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		* set db setting info
		* @param $host, $user, $psd, $dbname
		* @return $db_setting array
		*
		**/
	 	private function db_setting_info($host, $user, $psd, $dbname) {
	 		return $db_setting = array('db_host' => $host,
	 								   'db_user' => $user,
	 								   'db_psd'  => $psd,
	 								   'db_name' => $dbname);
		}

		/**
		*
		* connect db
		*
		**/
		public function connect_db() {
			//dbsetting
            //--[[ set db_setting param here
            include_once('../config/config.php');
            $db_setting_array = Config::getConfig();

            var_dump($db_setting_array);

			$DB_HOST = $db_setting_array['db_host'];
			$DB_USER = $db_setting_array['db_user'];
			$DB_PSD  = $db_setting_array['db_psd'];
			$DB_NAME = $db_setting_array['db_name'];
			//	]]--
			$db_setting = $this->db_setting_info($DB_HOST, $DB_USER, $DB_PSD, $DB_NAME);
			$this->_db->connect($db_setting['db_host'], $db_setting['db_user'], $db_setting['db_psd'], $db_setting['db_name']);

			if (mysqli_connect_error()) {
				echo "connect error : {mysqli_connect_error()}";
				exit();
			}
		}

		/**
		* query db by sql
		* @param $sql
		* @return result set
		*/
		public function query($sql) {
			$result = $this->_db->query($sql);
			return $result;
		}


		/**
		* fetch data from datatable
		* @param $sql, $type 0: row, 1: array(defalut), 2: object
		* @return dataset
		*
		**/
		public function fetch($sql, $type) {
			$result = array();
			$data = array();
			$data = $this->query($sql);

			if (!isset($type)) $type = 1;

			switch ($type) {
				case 0: {
						while($row = $data->fetch_row()) {
							$result[] = $row;
						}
						break;
					}
				case 1: {
						while ($assoc = $data->fetch_assoc()) {
							$result[] = $assoc;
						}
						break;
					}
				case 2: {
						while ($obj = $data->fetch_object()) {
							$result[] = $obj;
						}
						break;
					}
			}
			return $result;
		}

		/**
		*  create statement
		* @param statement sql (e.g. "insert into tablename values(?,?,?...)")
		*
		*
		**/
		public function create_statement($stmt_sql) {

			$sql_string = $stmt_sql;
			$stmt = $this->_db->prepare($sql_string);
			return $stmt;
		}


		/**
		* guide
		* how to use this class to operate db
		* i perform here and no not run this function code in project
		* keep safe !
		*
		**/
		public static function test() {
			$db = DBoper::getInstance();

			$sql = "SELECT * FROM sibi360.user";
			$result = $db->fetch($sql, 1);
			print_r($result);

			$sql = "insert into user(username, password) values(?, ?)";
			$stmt = $db->create_statement($sql);

			$name = "nickzhu";
			$password = "123456";
			$stmt->bind_param("ss", $name, $password);
			$stmt->execute();
			echo $stmt->affected_rows;

         }
      }


?>
