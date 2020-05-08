<?php
include 'dbh.inc.php';
class Insert_class extends Database{

public function __construct(){

    $this->db_connect();


}

public function add_message($message,$sender_id,$reciever_id){

    $query="insert into tbl_chat (message,sender_id,reciever_id) values ('$message','$sender_id','$reciever_id')";
    $result=mysqli_query($this->connection,$query);
    return $result;




}


}


?>