<?php include('../functions/pass_forgot_reset.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>

	<form class="login-form" action="signin.php" method="post" style="text-align: center;">
		<p>
			We sent an email to  <b><?php echo $_GET['email'] ?></b> to help you recover your account.
		</p>
	    <p>Please login into your email account and click on the link we sent to reset your password</p>
	</form>

</body>
</html>