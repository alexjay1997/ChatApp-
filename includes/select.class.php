<?php
include 'dbh.inc.php';

class Select_class extends Database{

public function __construct(){

	$this->db_connect();


}

public function select_contacts(){

	$query="Select * from tbl_users";
	$result=mysqli_query($this->connection,$query);
	return $result;
}

}

?>
