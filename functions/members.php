<?php

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'db_polista');


if (isset($_POST['submit'])) {
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];

    if(empty($fname) || empty($lname) || empty($phone) || empty($email) || empty($gender) || empty($country)){

    }
    else{
          $query = "INSERT INTO chat_users(first_name, last_name, phone, gender,country,email)
          VALUES('$fname', '$lname', '$phone', '$gender','$country', '$email')";
          $results = mysqli_query($db, $query);


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

      //$mail->addAttachment('/var/tmp/file.tar.gz');
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
      $mail->isHTML(true);
      $mail->Subject = 'Membership Registration';
      $mail->Body    = "Hi " .$fname. " \n Thank you for registering to be a member of African Polistas, a team member
      will be intouch shortly to process your request. Should you be accepted as a member, you will have access
      to use our chat portal where you can interact with other members. Thank you";
      $mail->AltBody = "Hi" .$fname. "Thank you for registering to be a member of African Polistas, a team member
      will be intouch shortly to process your request. Should you be accepted as a member, you will have access
      to use our chat portal where you can interact with other members. Thank you";

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          //echo 'Message has been sent';

      }

    header('location: index.php');
    }
  }





  ?>