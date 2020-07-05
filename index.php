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

//select message

$conn_getmessage = new Select_class();
$contact_id = $_GET['contact_id'];
$current_user = $_SESSION['id'];
$read_message = $conn_getmessage->get_messages($contact_id,$current_user);

$conn_getContact_name =new Select_class();
$contact_name = $_GET['contact_id'];
$read_contact_name =$conn_getContact_name->get_contact_name($contact_name);
$fetch_current_contact_name=mysqli_fetch_assoc($read_contact_name);


//search_contact
if(isset($_POST['search-btn'])){
	
	$conn_search_contact = new Select_class();
	$search_text= $_POST['search_contact'];
	$read_all_contacts=$conn_search_contact->search_contact($search_text);
	
	if(mysqli_num_rows($read_all_contacts)>0){
		
		$read_all_contacts;
	}
		elseif(mysqli_num_rows($read_all_contacts)<=0) {
		
		$read_all_contacts=$conn_read_contacts->select_contacts();
	}
	
}
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
		<label style="font-size:24px;">Ufriends</label>
	</div>
	<div class="user" style="text-align:right;">
  <?php


	echo "<a href=edit_profile.php?user_id=".$current_user." style='text-decoration:none;color:#ffffff;'>" .ucfirst($fetch_data['fname'])." ".ucfirst($fetch_data['lname']). "</a>";
	

 ?>
<a href='functions/logout.func.php?user_id=<?php echo $fetch_data['user_id'];?>' style="text-decoration:none;color:#ffffff;">&nbsp; | Logout</a>
	</div>
	</div>
</div>
 </div><br>
 <div class="container2">
    <div class="chatapp-wrapper">
      <div class="side-panel">
        <h2>Friends</h2>
		<div class="search-section">
		 <form method="Post" action="">
		  <input type="text" class="search_friends" name="search_contact" placeholder="Search...">
		  <input type="submit" name="search-btn" class="search-friends-btn" value="Search"/>
		</form>
		</div>
	
	   <?php
	      while($row=mysqli_fetch_assoc($read_all_contacts)){
		?>
	  <div class="contacts">
        	<a href="index.php?contact_id=<?php echo $row['user_id'];?>"><div class="contact_list"><?php echo "<img src='".$row['profile_image']."'  />";?><?php echo ucfirst($row['fname'])." ".ucfirst($row['lname']);?></div></a>
           </div>
	   	<?php
		}	
		?>
      </div>
        <div class="chat-section">
		
			
			 <div class="current_chat">
				<div class="current_chat_container">
			 <?php echo "<img src='".$fetch_current_contact_name['profile_image']."'  />";?><?php echo " <label class='chat_name'>  ".ucfirst($fetch_current_contact_name['fname'])." ".ucfirst($fetch_current_contact_name['lname'])."</label>";?>
				</div>
				
			 </div>
			
			 
			 <div class="chats_wrapper" id="chats_wrapper" style="overflow-y:auto;height:327px;padding:5px;">

				 <?php
				 while($fetch_message=mysqli_fetch_assoc($read_message)){
					$date_sent = date_create($fetch_message['sent_on']);
				
			

					$sender_names=  "<label style='color:#eee;'>from:"." " .$fetch_message['fname']." ".$fetch_message['lname']."</label><br>"; 
					$messages = $fetch_message['message'];
					$sent_messages_date = "<section style='text-align:right;border:px solid red;max-width:100%;font-size:14px;'>". date_format($date_sent, 'd/m/Y  g:i A')."</section>";
					
								 
				 ?>
					 <div class="message" style="overflow:hidden;background:eaeaeaa3;color:#484848;width:max-width:100%;;height:auto;margin:10px;border-bottom:1px solid #ccc;padding:15px;">
					 <?php
					
						// for alternate message design  ---****** start ***** ----
					 $current_user_sender ="<label style='line-height:30px;color:#0e2a7f;font-style:italic;'>You:<br></label>";
					 // condiiton if sender is equal to current user then background color of the message is Blue 
					 
					 if($fetch_message['sender_id'] == $current_user){
						
						$messages_wrapper_start = "<div style='float:right;padding:10px;max-width:70%;overflow:hidden;border-radius:15px;background:#2da2d8'>";
					
						$messages = "<div style='color:#ffffff;padding:10px;float:right;max-width:100%;overflow:hidden;padding:10px;'>". $current_user_sender.$messages."</div></br>";
						
						$sent_messages_date = "<div style='float:right;margin:5px;max-width:100%;'>".$sent_messages_date."</div>";
						$messages_wrapper_end = "</div>";
					 }
					 // condiiton else if sender is equal to current contact choice then background is green
					 else if($fetch_message['sender_id'] == $contact_id){
 
					   $messages_wrapper_start = "<div style='float:left;padding:20px;max-width:70%;overflow:hidden;border-radius:15px;background:#73c263;'>";
						$messages = "<div style='color:#ffffff;padding:10px;float:left;max-width:100%;'>".$messages."</div></br></br>";
						$sent_messages_date = "<div style='float:left;margin:px;max-width:100%;'>".$sent_messages_date."</div>";
						$messages_wrapper_end = "</div>";
					 }

						 // for alternate message design  ---****** end  ***** ----
						 
					 // echo messages -------- start ---------------
				
				
					 echo $messages_wrapper_start.$sender_names;

					 // put smiley if message is  == :) ---------------- start ---------------
					 if ($fetch_message['message']==':)') {
						
						echo "<img src ='emoji/smile.png' style='width:25px;'/> ";
						 // put smiley if message is  == :) ---------------- end ---------------
					
					}
					if ($fetch_message['message']==':D') {
						
						echo "<img src ='emoji/laugh.png' style='width:25px;'/> ";
						 // put smiley if message is  == :) ---------------- end ---------------
					
					}
					
				
					 echo $messages."<br>";
					
					 echo $sent_messages_date.$messages_wrapper_end;

					  // echo messages -------- end ---------------
					 
					 ?>
	
				 </div>
				 <?php
				 }
				 ?>
				 	
				</div><br>
				<div class="type_sect" style="position:absolute;bottom:0;padding:15px;height:auto;background:#ffffff;">

					<form method="post" action="functions/send_message.func.php?contact_id=<?php echo $_GET['contact_id'];?>">
						<div class="textarea_message" style="border:none;border-radius:20px;overflow:hidden;float:left;background:#eee;">
						<textarea type="text" name="type-message" placeholder="Message..." style="outline:none;background:#eee;resize:none;padding:8px;width:350px;height:20px;margin:3px;overflow:auto;border:none;"></textarea>
						</div>
						<input type="submit" name="send-btn" value="Send" style="border:none;border-radius:20px;background:#2da2d8;color:#ffffff;padding:10px;margin:3px;width:100px;"/>
					
					</form>
				</div>
         </h4>   
    </div>	 
	</div>
</div>
<script>
// scroll to bottom of the chat 
let chatHistory = document.getElementById("chats_wrapper");
chatHistory.scrollTop = chatHistory.scrollHeight;
// end

</script>
</body>
</html>
