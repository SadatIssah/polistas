<?php include('../functions/pass_forgot_reset.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<form class="login-form" action="new_pass.php" method="post">
		<h2 class="form-title">New password</h2>
		<!-- form validation messages -->
		<?php  if (count($errors) > 0) : ?>
        <div class="msg">
  	        <?php foreach ($errors as $error) : ?>
  	         <span><?php echo $error ?></span>
    	<?php endforeach ?>
        </div>
        <?php  endif ?>


		<div class="form-group">
			<label>New password</label>
			<input type="password" name="new_pass">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c">
		</div>
		<div class="form-group">
			<button type="submit" name="new_password" class="login-btn">Submit</button>
		</div>
	</form>
</body>
</html>