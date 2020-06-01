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

public function insert_new_user($firstname,$lastname,$username,$password){
	
	$query="Insert into tbl_users (fname,lname,username,password) values ('$firstname','$lastname','$username','$password')";
	$result=mysqli_query($this->connection,$query);
	return $result;
}


}


?>