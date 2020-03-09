<?php
$con = mysqli_connect("localhost","root","","db_polista") or die("Connection was not established");

	function search_user(){

		global $con;

		if(isset($_GET['search_btn'])){
		$search_query = htmlentities($_GET['search_query']);
		$get_user = "select * from chat_users where first_name like '%$search_query%' or country like '%$search_query%'";
		}
		else{
		$get_user = "select * from chat_users ORDER BY country,first_name DESC LIMIT 5";
		}

		$run_user = mysqli_query($con,$get_user);
       // var_dump($run_user);
		while($row_user = mysqli_fetch_assoc($run_user)){

		  $user_name = $row_user['first_name'];
		  $user_profile = $row_user['profile'];
		  $country = $row_user['country'];
		  $gender = $row_user['gender'];

			//now displaying all at once

			echo "
			<div class='card'>
		      <img src='$user_profile'>
		      <h1>$user_name</h1>
		      <p class='title'>$country</p>
		      <p>$gender</p>
		      <form method='post'>
		        <p><button name='add'>Chat with $user_name</button></p>
		      </form>
		    </div><br><br>
			";

		if(isset($_POST['add'])){
			echo "<script>window.open('../pages/home.php?user_name=$user_name','_self')</script>";
		}
		}

	 }
?>