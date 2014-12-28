<?php
   /**
    * Class user
    * @author Mike mikecoder.cn@gmail.com
    * @date 2014-12-16
    */
   require ('../includes/DBoper.class.php');

   class User {

      private $db_handle;

      public function __construct() {
          $this->db_handle = DBoper::getInstance();
      }

      public function get_db_handle() {
          return $this->db_handle;
      }

      /**
      * store new user
      * @param $user_name
      * @param $user_passwd
      *
      */
      public function store_user($user_name, $user_passwd){
          
          $sql_store = "INSERT INTO sibi360.user(username, password) values(?, ?)"; 
          $stmt = $this->get_db_handle()->create_statement($sql_store);

          $stmt->bind_param("ss", $user_name, $user_passwd);
          $stmt->execute();
          return true;   
      }

      /**
      * check user login
      * @param $user_name
      * @param $user_password
      */
      public function login_user($user_name, $user_password) {
            
          //此处可加上对 sql参数进行过滤, 暂时没做 

          $sql_exists = "SELECT COUNT(uid) as num FROM sibi360.user WHERE username = '{$user_name}' AND password = '{$user_password}'";
          $result = $this->get_db_handle()->fetch($sql_exists, 1);

          if ($result[0]['num'] < 1) {
              return false;
          } else {
              return true;
          }
      }

      /**
      * check is username exists
      * @param $user_name
      *
      */
      public function is_exists_user($user_name) {

          $sql_exists = "SELECT COUNT(*) as num FROM sibi360.user WHERE username = '{$user_name}'"; 
          $result = $this->get_db_handle()->fetch($sql_exists, 1); 

          if (count($result) < 1)
            return false;
          else
            return true;
      }

  }

  //$usr = new User();
  //echo $usr->storeUser("chirscai", "123456");
  //echo $usr->is_exists_user("fenicesun"); 
  //echo $usr->login_user("fenice", "123456"); 
?>
