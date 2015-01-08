<?php
   include ('config.php');
   $_SERVER['REQUEST_URI'] = "localhost";
   $config = new Config();
   var_dump($config->getConfig());

   $_SERVER['REQUEST_URI'] = "350sibi.com";
   $config = new Config();
   var_dump($config->getConfig());
