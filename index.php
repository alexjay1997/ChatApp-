<?php

session_start();
include 'includes/select.class.php';
if(isset($_SESSION['id']) && $_SESSION['id']==true){


}


else{
header('location:login.page.php');	
}


$conn_read_contacts = new Select_class();
$read_all_contacts = $conn_read_contacts->select_contacts();


//display current login user details

$conn = new Select_class();
$current_user = $_SESSION['id'];
$read_login_user =$conn->select_details($current_user);
$fetch_data=mysqli_fetch_assoc($read_login_user);



?>
<!Doctype html>
<html>
<head>
<title>ChatApp</title>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
<div class="page-container">
  <div class="top-header">
  <div class="container">
  <div class="top-content">
	<div class="logo">
		<label style="font-size:24px;">UrFriends</label>
	</div>
	<div class="user" style="text-align:right;">
  <?php


	echo ucfirst($fetch_data['fname'])." ".ucfirst($fetch_data['lname']);
	

 ?>
<a href='functions/logout.func.php?user_id=<?php echo $fetch_data['user_id'];?>' style="text-decoration:none;color:#ffffff;">&nbsp; | Logout</a>
	</div>
	</div>
</div>
 </div><br>
 <div class="container2">
    <div class="chatapp-wrapper">
      <div class="side-panel">
        <h2>Friends</h2><br>
		<div class="search-section">
		 <form method="Post" action="">
		  <input type="text" class="search_friends" name="search_contact" placeholder="Search...">
		  <input type="submit" name="search-btn" value="Find"/>
		</form>
		</div>
	   <?php
	      while($row=mysqli_fetch_assoc($read_all_contacts)){
		?>
	  <div class="contacts">
        	<a href="index.php?contact_id=<?php echo $row['user_id'];?>"><?php echo ucfirst($row['fname'])." ".ucfirst($row['lname']);?></a>
           </div>
	   	<?php
		}	
		?>
      </div>
        <div class="chat-section">
         	<h3>Chats</h3>
			 <div class="chats_wrapper">
				</div><br>
				<div class="type_sect" style="position:fixed;bottom:0;padding:20px;">
					<form method="post" action="functions/send_message.func.php">
						<div contenteditable="true" type="text" name="type_message" data-placeholder="Message..." style="padding:7px;width:300px;height:20px;overflow:auto;border:1px solid #ccc;float:left;"></div>
						<input type="submit" name="send-btn" value="send" style="border:none;background:#2da2d8;color:#ffffff;padding:10px;width:100px;"/>
					</form>
				</div>
         </div>   
    </div>	 
	</div>
</div>
</body>
</html>
