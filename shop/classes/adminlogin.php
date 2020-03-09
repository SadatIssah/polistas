<?php require (dirname(__FILE__).'/../lib/database.php');?>
<?php require (dirname(__FILE__).'/../lib/session.php');?>
<?php require (dirname(__FILE__).'/../helper/format.php');?>
<?php
Session::checklogin();
?>


<?php

/**
 * class to allow for login authentication for admin
 */
class AdminLogin{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function adminLoginCheck($Uemail,$Upass){
        //check for special characters and escape characters

        $adminemail = $this->fm->validation($Uemail);
        $adminpass = $this->fm->validation($Upass);
        $adminemail = mysqli_real_escape_string($this->db->link,$Uemail);
        $adminpass = mysqli_real_escape_string($this->db->link,$Upass);

        if(empty($adminemail) || empty($adminpass) ){
            $loginmsg = "Email and Password Required";
            return $loginmsg;
        }else{
            $query = "SELECT * FROM shop_admin WHERE Email = '$adminemail' AND  Pass= '$adminpass'";
            $result = $this->db->select($query);

            if($result != false){
                $value = $result->fetch_assoc();
                //set session variables
                Session::set("adminlogin", true);
                Session::set("adminID", $value['ID']);
                Session::set("adminName", $value['Name']);
                Session::set("adminEmail", $value['Email']);
                Header("Location: dashboard.php");
            }
            else{
                $loginmsg = "username or password not matched";
                return $loginmsg;
            }
        }
    }
}
?>