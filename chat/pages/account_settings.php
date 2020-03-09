<!DOCTYPE html>
<?php
session_start();
include("../database/db.php");
include("../include/header.php");

?>
<?php

if(!isset($_SESSION['user_email'])){

  header("location: ../pages/signin.php");

}
else { ?>
<html>
<head>
  <title>Account Setting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<style>
  body{
    overflow-x: hidden;
  }
</style>
<body>
<div class="row">
  <div class="col-sm-2">
  </div>
  <?php
      $user = $_SESSION['user_email'];
      $get_user = "select * from chat_users where email='$user'";
      $run_user = mysqli_query($con,$get_user);
      $row=mysqli_fetch_array($run_user);

      $user_name = $row['first_name'];
      $last_name = $row['last_name'];
      $user_email = $row['email'];
      $user_profile = $row['profile'];
      $phone = $row['phone'];
      $user_country = $row['country'];
      $user_gender = $row['gender'];
  ?>
  <div class="col-sm-8">
    <form action="" method="post" enctype="multipart/form-data">
          <table class="table table-bordered table-hover">
            <tr align="center">
              <td colspan="6" class="active"><h2>Change Account Settings</h2></td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Change Your First Name</td>
              <td>
              <input class="form-control" type="text" name="u_name" required="required" value="<?php echo $user_name;?>"/>
              </td>
            </tr>

            <tr>
              <td style="font-weight: bold;">Change Your Last Name</td>
              <td>
              <input class="form-control" type="text" name="l_name" required="required" value="<?php echo $last_name;?>"/>
              </td>
            </tr>

            <tr>
              <td style="font-weight: bold;">Change Your Phone Number</td>
              <td>
              <input class="form-control" type="text" name="phone" required="required" value="<?php echo $phone;?>"/>
              </td>
            </tr>

            <tr><td></td><td><a class="btn btn-default" style="text-decoration: none;font-size: 15px;" href="upload.php"><i class="fa fa-user" aria-hidden="true"></i> Change Profile</a></td></tr>

            <tr>
              <td style="font-weight: bold;">Email</td>
              <td>
              <input class="form-control" type="email" name="u_email" required="required" value="<?php echo $user_email;?>"></td>
            </tr>

            <tr>
              <td style="font-weight: bold;">Country</td>
              <td>
              <input class="form-control" type="text" name="u_country" required="required" value="<?php echo $user_country;?>"></td>
            </tr>

            <tr>
              <td style="font-weight: bold;">Gender</td>
              <td>
              <select class="form-control" name="u_gender">
                <option><?php echo $user_gender;?></option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
              </select>
              </td>
            </tr>

            <tr align="center">
              <td colspan="6">
              <input class="btn btn-info" style="width: 250px;" type="submit" name="update" value="Update"/>
              </td>
            </tr>
          </table>
        </form>
        <?php

          if(isset($_POST['update'])){

          $user_name = htmlentities($_POST['u_name']);
          $last_name = htmlentities($_POST['l_name']);
          $phone = htmlentities($_POST['phone']);
          $email = htmlentities($_POST['u_email']);
          $u_country = htmlentities($_POST['u_country']);
          $u_gender = htmlentities($_POST['u_gender']);


          $update = "update chat_users set first_name='$user_name', last_name='$last_name', phone='$phone',
          email='$email',country='$u_country', gender='$u_gender' where email='$user'";

          //update the chat message table
          $run = mysqli_query($con,$update);

          if($run){


            echo "<script>window.open('account_settings.php','_self')</script>";

          }
        }

        ?>
  </div>
  <div class="col-sm-2">
  </div>
</div>
</body>
</html>
<script>
function show_password() {
    var x = document.getElementById("mypass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
<?php } ?>