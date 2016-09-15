<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 18:49
 */
class DbSingleton {
    private $_link;
    private static $_instance;

    public static function getInstance() {
        if(!self::$_instance) self::$_instance = new self();
        return self::$_instance;
    }

    private function __construct() {
        $db_host = MY_DB_HOSTNAME;
        $db_user = MY_DB_USERNAME;
        $db_pass = MY_DB_PASSWORD;
        $db_name = MY_DB_DATABASE;

        if(!IS_USE_MY_DB_SETTINGS){
            $db_host = DB_HOSTNAME;
            $db_user = DB_USERNAME;
            $db_pass = DB_PASSWORD;
            $db_name = DB_DATABASE;
        }
        $this->_link = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if(mysqli_connect_error()) {
            throw new Exception("Mysql connect failure: (" . $this->_link->errno . ") " . $this->_link->error);
        }
        if (!$this->_link->set_charset("utf8")) {
            throw new Exception("Error setup utf8: %s\n", $this->_link->error);
        }
    }
    public function getConnection() {
        return $this->_link;
    }
}
class DB{
    public $db;

    function __construct(){
        $this->db = DbSingleton::getInstance()->getConnection();
    }
    function query($q){
        $res = $this->db->query($q);
        if(!$res){
            throw new Exception("Mysql query failure: [".$q."] (" . $this->db->errno . ") " . $this->db->error);
        }
        return $res;
    }
    function escape($val){
        return $this->db->real_escape_string($val);
    }
}
?>