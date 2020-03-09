<?php

$con = mysqli_connect("localhost","root","","db_polista");

    $email1 = $_SESSION['user_email'];
    $user_name = $_POST['user_name'];
    $username  = $_POST['username'];

    $msg = htmlentities($_POST['msg_content']);

        if($msg == ""){
            echo"

            <div class='alert alert-danger'>
              <strong><center>Message was unable to send!</center></strong>
            </div>

            ";
        }else if(strlen($msg) > 100){
            echo"

            <div class='alert alert-danger'>
              <strong><center>Message is Too long! Use only 100 characters</center></strong>
            </div>

            ";
        }
        else{
        $insert = "insert into chat_msg(sender_name,receiver_name,msg_content,msg_status,msg_date)
        values ('$user_name','$username','$msg','unread',NOW())";

        $run_insert = mysqli_query($con,$insert);

        }



?>