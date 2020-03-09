
<?php //include('../../classes/adminlogin.php'); ?>
<?php require (dirname(__FILE__).'/../../classes/adminlogin.php');?>

<?php
$admin = new AdminLogin();

if($_SERVER['REQUEST_METHOD'] ==  'POST'){

	$Uemail = $_POST['Email'];
	$Upass = md5($_POST['Pass']);

	$logincheck = $admin->adminLoginCheck($Uemail,$Upass);

}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>

			<span style="color:red; font:18px;">
				<?php
				if(isset($logincheck)){
					echo $logincheck;
				}
				?>

			</span>
			<div>
				<input type="text" placeholder="UserEmail" name="Email"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="Pass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->

	</section><!-- content -->
</div><!-- container -->
</body>
</html>