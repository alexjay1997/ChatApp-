<?php
include 'includes/select.class.php';

$conn_read_contacts = new Select_class();
$read_all_contacts = $conn_read_contacts->select_contacts();

?>
<!Doctype html>
<html>
<head>
<title>ChatApp</title>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
  <div class="page-container">
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
         </div>   
    </div>	 
</div>
</body>
</html>
