<?php


session_start();
$errors = [];
$user_id = "";
// connect to database
$db = mysqli_connect('localhost', 'root', '', 'db_polista');


if (isset($_GET['token'])) {
  $_SESSION['token']=mysqli_real_escape_string($db,$_GET['token']);
  }

if (isset($_POST['reset-password'])) {
    $email = $_POST['email'];
    // ensure that the user exists on our system
    $query = "SELECT email, approval FROM chat_users WHERE email='$email' and approval ='approved'";
    $results = mysqli_query($db, $query);

    if (empty($email)) {
      array_push($errors, "Your email is required");
    }else if(mysqli_num_rows($results) <= 0) {
      array_push($errors, "Sorry, no user exists on our system with that email");
    }
    // generate a unique random token of length 100
    $token = bin2hex(random_bytes(50));

    if (count($errors) == 0) {
      // store token in the password-reset database table against the user's email
      $sql = "INSERT INTO pass_reset(email, token) VALUES ('$email', '$token')";
      $results = mysqli_query($db, $sql);

      // Send email to user with the token in a link they can click on


      require 'PHPMailerAutoload.php';


      $mail = new PHPMailer;

      //$mail->SMTPDebug = 4;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'issahsadat84@gmail.com';                 // SMTP username
      $mail->Password = 'Sadat0248418148';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      $mail->setFrom('issahsadat84@gmail.com', 'African Polistas');
      $mail->addAddress($email);     // Add a recipient
     // $mail->addReplyTo('info@example.com', 'Information');
     // $mail->addCC('cc@example.com');
     // $mail->addBCC('bcc@example.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Password Reset';
      $mail->Body    = "Hi there, click on this <a href=\"localhost/chat/pages/new_pass.php?token=" . $token . "\">link</a> to reset your password on our site";
      $mail->AltBody = "Hi there, click on this <a href=\"localhost/chat/pages/new_pass.php=" . $token . "\">link</a> to reset your password on our site";

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          //echo 'Message has been sent';

      }



    header('location: pending.php?email=' . $email);
    }
  }




  // ENTER A NEW PASSWORD
  if (isset($_POST['new_password'])) {
    $new_pass = $_POST['new_pass'];
    $new_pass_c =  $_POST['new_pass_c'];

    // Grab to token that came from the email link
    $token = $_SESSION['token'];

    if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
    if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
    if (count($errors) == 0) {
      // select email address of user from the password_reset table
      $sql = "SELECT email FROM pass_reset WHERE token='$token' LIMIT 1";
      $results = mysqli_query($db, $sql);
      $email = mysqli_fetch_assoc($results)['email'];

      if ($email) {
        $new_pass = md5($new_pass);
        $sql = "UPDATE chat_users SET pass='$new_pass' WHERE email='$email'";
        $results = mysqli_query($db, $sql);
        header('location: signin.php');
      }
    }
  }
  ?>