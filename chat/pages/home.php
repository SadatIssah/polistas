<!DOCTYPE html>
<?php
session_start();
include("../database/db.php");

if(!isset($_SESSION['user_email'])){

	header("location: ../pages/signin.php");

}
 ?>
<html>
<head>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div class="container main-section">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
				<div class="input-group searchbox">
					<div class="input-group-btn">
						<center><a href="../include/find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add new user</button></a></center>
					</div>
				</div>
				<div class="left-chat">
					<ul>
						<?php include("../functions/get_users_data.php"); ?>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
				<div class="row">
					<!-- getting the user information who is logged in -->
					<?php
						$user = $_SESSION['user_email'];
						$get_user = "select * from chat_users where email='$user'";
						$run_user = mysqli_query($con,$get_user);
						$row=mysqli_fetch_array($run_user);

						$user_id = $row['ID'];
						$user_name = $row['first_name'];

					?>

					<!-- getting the user data on which user click -->
					<?php
						if(isset($_GET['user_name'])){

						global $con;

						$get_username = $_GET['user_name'];

						$get_user = "select * from chat_users where first_name='$get_username'";

						$run_user = mysqli_query($con,$get_user);

						$row_user=mysqli_fetch_array($run_user);

						$username = $row_user['first_name'];
						$user_profile_image = $row_user['profile'];
						}

                        $total_messages = "select * from chat_msg where (sender_name='$user_name' AND receiver_name='$username')
                        OR (receiver_name='$user_name' AND sender_name='$username')";
						$run_messages = mysqli_query($con,$total_messages);
						$total = mysqli_num_rows($run_messages);
					?>
					<div class="col-md-12 right-header">
						<div class="right-header-img">
							<img src=<?php echo"$user_profile_image";?>>
						</div>
						<div class="right-header-detail">
							<form method="post">
								<p><?php echo"$username";?></p>
								<span><?php echo $total; ?> messages</span>&nbsp &nbsp
								<button name="logout" class="btn btn-danger">Logout</button>
							</form>
							<?php
								if(isset($_POST['logout'])){
									$update_msg = mysqli_query($con, "UPDATE chat_users SET login ='Offline' WHERE first_name='$user_name'");
									header("Location:logout.php");
									exit();
								}
							?>
						</div>
					</div>
				</div>
				<div class="row" >
				<div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat" style="background-color: #3A3A3A;">





				</div>

				</div>


				<div class="row">
					<div class="col-md-12 right-chat-textbox">
						<form method="post">
						<input autocomplete="off" type="text" id ="msg" name="msg_content" placeholder="Write your message...">
						<input autocomplete="off" type="hidden" id ="user1" value="<?php echo($username); ?>">
						<input autocomplete="off" type="hidden" id ="user2" value="<?php echo($user_name); ?>">
						<input autocomplete="off" type="hidden" id ="success" value="<?php echo "home.php?user_name=".($username); ?>">
						<a  class='btn1' id ="id"><button>send</button></a>
						<!-- // <a href='#' onclick='send11($U)'><button class='btn' name='submit' ><i class='fa fa-telegram'></i></button></a> -->


						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		// if(isset($_POST['submit'])){
		// 	$msg = htmlentities($_POST['msg_content']);

		// 	if($msg == ""){
		// 		echo"

		// 		<div class='alert alert-danger'>
		// 		  <strong><center>Message was unable to send!</center></strong>
		// 		</div>

		// 		";
		// 	}else if(strlen($msg) > 100){
		// 		echo"

		// 		<div class='alert alert-danger'>
		// 		  <strong><center>Message is Too long! Use only 100 characters</center></strong>
		// 		</div>

		// 		";
		// 	}
		// 	else{
		// 	$insert = "insert into chat_msg(sender_name,receiver_name,msg_content,msg_status,msg_date)
		// 	values ('$user_name','$username','$msg','unread',NOW())";

		// 	$run_insert = mysqli_query($con,$insert);

		// 	}
		// }
	?>

<script>
		// $('#scrolling_to_bottom').animate({
		// scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
	</script>
<script>
var user1 = $("#user1").val();
var user2 = $("#user2").val();
$(function() {
	setInterval(startRefresh, 0.1);
});

function startRefresh() {

    $.get('test.php',{username: user1, user_name: user2 }, function(data) {
		//alert(data);
		$('#scrolling_to_bottom').html(data);
		scroll();
    });
}

function scroll(){
	$('#scrolling_to_bottom').animate({
		scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 0.001);
}
</script>



	<script type="text/javascript">
		$(document).ready(function(){
	    	var height = $(window).height();
	    	$('.left-chat').css('height', (height - 92) + 'px');
	    	$('.right-header-contentChat').css('height', (height - 163) + 'px');
	    });
	</script>

	<script type="text/javascript" src="../js/main.js"></script>
</body>

</html>
