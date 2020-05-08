<?php
include_once 'dbh.inc.php';

class Select_class extends Database{

public function __construct(){

	$this->db_connect();


}

public function select_contacts(){

	$query="Select * from tbl_users";
	$result=mysqli_query($this->connection,$query);
	return $result;
}

// login select User

public function select_account($username,$password){

	$query="Select * from tbl_users where username='$username' && password='$password'";
	$result=mysqli_query($this->connection,$query);
	return $result;
}

// display current login user details //
public function select_details($current_user){

	$query="Select * from tbl_users where user_id ='".$current_user."'";
	$result=mysqli_query($this->connection,$query);
	return $result;
}

// get message 

public function get_messages($contact_id,$current_user){




$query ="Select tbl_chat.message, tbl_chat.sent_on,tbl_users.user_id, tbl_users.fname, tbl_users.lname From tbl_users 

CROSS JOIN tbl_chat ON  tbl_chat.reciever_id= '$contact_id' WHERE tbl_chat.sender_id= tbl_users.user_id AND tbl_chat.sender_id=tbl_users.user_id 

";


$result =mysqli_query($this->connection,$query);



return $result;

}



}

?>
