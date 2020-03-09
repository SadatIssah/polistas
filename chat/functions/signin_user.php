<?php
session_start();

include("../database/db.php");

	if(isset($_POST['sign_in'])){

	$email = $_POST['email'];
	$pass = md5($_POST['pass']);

	$query = "select * from chat_users where email ='$email' AND pass ='$pass'";

	$result = mysqli_query($con,$query);

	$check_user = mysqli_num_rows($result);

	if($check_user==1){

	$_SESSION['user_email']=$email;

	$update_msg = mysqli_query($con, "UPDATE chat_users SET login='Online' WHERE email='$email'");

	$user = $_SESSION['user_email'];
	$get_user = "select * from chat_users where email='$user'";
	$run_user = mysqli_query($con,$get_user);
	$row=mysqli_fetch_array($run_user);

	$user_name = $row['first_name'];

	echo "<script>window.open('home.php?user_name=$user_name','_self')</script>";

	}
	else {
	echo "

	<div class='alert alert-danger'>
	  <strong>Check your email and password!</strong>
	</div>

	";
	}

	}


?>