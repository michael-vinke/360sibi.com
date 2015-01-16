<?php

   /**
   * Config Holder, this class decide which config file will be loaded
   * when the new request the come.
   *
   * @author mike mike@mikecoder.net
   * @date 2015-01-08 10:32 pm
   * @descrption proud created by VIM
   */
   class Config {
      // config
      private static $config = null;

      /**
      * construct function, get the request url and include the config file
      */
      public function __construct(){
         $URL = $_SERVER['REQUEST_URI'];
         // unit test, we have no request url
         if (!$URL || strstr($URL, "localhost")) {
            include("local.config.php");
         } else {
            include("online.config.php");
         }
         $this->config = $db_setting_array;
      }

      /**
      * get the config array
      * @return array
      */
      public function getConfig(){
         $res = array();
         var_dump($this->_config());
         die();
         foreach ($this->config as $key => $value) {
            $res[$key] = $value;
         } // deep copy
         return $res;
      }

      private function _config(){
         return $this->config;
      }
   }

