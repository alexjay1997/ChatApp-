<?php
class Database{

private $db_host;
private $db_username;
private $db_password;
private $db_name;


public function db_connect(){

$this->db_host="localhost";
$this->db_username="root";
$this->db_password="";
$this->db_name="ChatApp_db";

$this->connection = new mysqli($this->db_host,$this->db_username,$this->db_password,$this->db_name);

}

}
?>
