<?php include('../functions/pass_forgot_reset.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<form class="login-form" action="forgot_pass.php" method="post">
		<h2 class="form-title">Reset password</h2>
		<!-- form validation messages -->
	<?php  if (count($errors) > 0) : ?>
        <div class="msg">
  	        <?php foreach ($errors as $error) : ?>
  	         <span><?php echo $error ?></span>
    	<?php endforeach ?>
        </div>
    <?php  endif ?>
		<div class="form-group">
			<label>Your email address</label>
			<input type="email" name="email">
		</div>
		<div class="form-group">
			<button type="submit" name="reset-password" class="login-btn">Submit</button>
		</div>
	</form>
</body>
</html>