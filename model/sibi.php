<?php
/**
 * Class sibi
 * @author Mike mike@mikecoder.net
 * @date 2014-12-16
 */
include ('../includes/DBoper.class.php');

class Sibi {
    private $db_handle;

    public function __construct() {
       $this->db_handle = DBoper::getInstance();
       var_dump($this);
    }

    private function get_db_handle() {
        return $this->db_handle;
    }

    public function storeSibi($content, $userId){
        $sql = "INSERT INTO sibi_item(msg) values (?)";
        $stmt = $this->get_db_handle()->create_statement($sql);
        $stmt->bind_param("s", $content);
        $stmt->execute();
     }


}

$Sibi = new Sibi();
$Sibi->storeSibi("haha", 12);


?>
