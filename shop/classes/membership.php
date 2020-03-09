<?php
include_once (dirname(__FILE__).'../../lib/database.php');
include_once (dirname(__FILE__).'../../helper/format.php');
?>


<?php


class Members{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function membersDisplay(){
        $query = "SELECT * from chat_users";
        $result = $this->db->select($query);
        return $result;
    }



    public function passReset($email, $namel){

        // generate a unique random token of length 100
        $token = bin2hex(random_bytes(50));

        // store token in the password-reset database table against the user's email
        $sql = "INSERT INTO pass_reset(email, token) VALUES ('$email', '$token')";
        $results = $this->db->insert($sql);



        $query = "UPDATE chat_users SET approval = 'approved' WHERE email = '$email'";
        $results1 = $this->db->insert($query);

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
          $mail->Body    = nl2br("Hi there"."\n you have being accepted as a member of African Polista. As a member, you will have access to our secured chat portal where you get to interact with other club members "."\n click on this <a href=\"localhost/chat/pages/new_pass.php?token=" . $token . "\">link</a> to reset your password on our site");
          $mail->AltBody = nl2br("Hi there"."\n you have being accepted as a member of African Polista. As a member, you will have access to our secured chat portal where you get to interact with other club members "."\n click on this <a href=\"localhost/chat/pages/new_pass.php?token=" . $token . "\">link</a> to reset your password on our site");

          if(!$mail->send()) {
            $msg = "<span class='error'>User not Removed.</span>";
            return $msg;
          } else {
            $msg = "<span class='success'>Email Sent Successfully.</span>";
            return $msg;
          }

        }





    public function deletbyID($cdelete){

        $deletequery = "DELETE FROM chat_users WHERE ID = '$cdelete' ";
            $deletedata = $this->db->delete($deletequery);
            if ($deletedata) {
                $msg = "<span class='success'>User Removed Successfully.</span> ";
            return $msg;
            }else {
                $msg = "<span class='error'>User Not Removed .</span> ";
                return $msg;
                }
}








}






?>