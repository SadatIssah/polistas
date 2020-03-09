<?php

include("../database/db.php");

$username = $_REQUEST['username'];
$user_name = $_REQUEST['user_name'];
?>


<?php

$update_msg = mysqli_query($con, "UPDATE chat_msg SET msg_status='read' WHERE sender_name='$username'
AND receiver_name='$user_name'");


$sel_msg = "select * from chat_msg where (sender_name='$user_name' AND receiver_name='$username') OR
(receiver_name='$user_name' AND sender_name='$username') ORDER by 1 ASC";
$run_msg = mysqli_query($con,$sel_msg);


while($row=mysqli_fetch_array($run_msg)){

$sender_username = $row['sender_name'];
$receiver_username = $row['receiver_name'];
$msg_content = $row['msg_content'];
$msg_status = $row['msg_status'];
$msg_date = $row['msg_date'];

?>
<ul>
<?php

if($user_name == $sender_username AND $username == $receiver_username){

    echo"
        <li>
            <div class='rightside-right-chat'>
                <span style='color: #fff'> $user_name <small>$msg_date</small> </span><br><br>
                <p>$msg_content</p>
            </div>
        </li>
    ";
}

else if($user_name == $receiver_username AND $username == $sender_username){
    echo"
        <li>
            <div class='rightside-left-chat'>
                <span style='color: #fff'> $username <small>$msg_date</small> </span><br><br>
                <p>$msg_content</p>
            </div>
        </li>
    ";
}

?>
</ul>
<?php

}

?>

