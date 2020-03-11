<?php

include_once (dirname(__FILE__).'../../lib/database.php');
include_once (dirname(__FILE__).'../../helper/format.php');
?>


<?php

class Customers{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function userRegistration($data){

        $fname   	 =  mysqli_real_escape_string($this->db->link, $data['fname'] );
        $lname   	 =  mysqli_real_escape_string($this->db->link, $data['lname'] );
        $address     =  mysqli_real_escape_string($this->db->link, $data['addr'] );
        $city   	 =  mysqli_real_escape_string($this->db->link, $data['city'] );
        $country     =  mysqli_real_escape_string($this->db->link, $data['country'] );
        $zip    	 =  mysqli_real_escape_string($this->db->link, $data['zip'] );
        $phone       =  mysqli_real_escape_string($this->db->link, $data['phone'] );
        $email       =  mysqli_real_escape_string($this->db->link, $data['email'] );
        $pass        =  mysqli_real_escape_string($this->db->link, md5($data['pass']));
        if ($fname == "" || $lname =="" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == ""  || $email == ""  || $pass == "" ) {
            $msg = "<span style='color: red; font-size: 18px;'>Field must not be empty!</span>";
                   return $msg;
        }
        $check_mail = "SELECT * FROM shop_users WHERE email='$email' LIMIT 1";
        $mailchk = $this->db->select($check_mail);
        if ($mailchk != false) {
            $msg = "<span style='color: red; font-size: 18px;'>Mail already registered!</span>";
                   return $msg;
        }else {

            $query = "INSERT INTO shop_users(fname,lname,city, zip, email,addr, country, phone, pass)
            VALUES('$fname','$lname','$city','$zip','$email','$address','$country','$phone','$pass')";

            $insert = $this->db->insert($query);
            if ($insert) {
                  $msg = "<span style='color: Green; font-size: 18px;'>Account Created Successfully.</span> ";
                  return $msg;
              }else {
                  $msg = "<span style='color: red; font-size: 18px;'>Account Not Created</span> ";
                  return $msg;
              }

        }



    }

    public function userLogin($data){
        $email = mysqli_real_escape_string($this->db->link, $data['email'] );
        $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
        if ($email == ""  || $pass == "" ) {
            $msg = "<span style='color: red; font-size: 18px;'>Field Must Not be empty .</span> ";
                   return $msg;
        }

        $query = "SELECT * FROM shop_users WHERE email='$email' AND pass='$pass' ";
        $result = $this->db->select($query);
        if ($result != false) {
         $value = $result->fetch_assoc();
         Session::set("userlogin", true);
         Session::set("userId", $value['userID']);
         Session::set("cus_email", $value['email']);
         Session::set("userName", $value['Fname']);
         header("Location:payment.php");
         }else {
             $msg = "<span style='color: red; font-size: 18px;'>Email Or Password Not Matched</span> ";
                   return $msg;
         }

    }



    public function retrieveCustomerDetails($id){
        $query = "SELECT * FROM shop_users WHERE userID ='$id' ";
           $result = $this->db->select($query);
           return $result;
        }


    public function customerDetailsUpdate($data, $user_id){
        $fname   	 =  mysqli_real_escape_string($this->db->link, $data['fname'] );
        $lname   	 =  mysqli_real_escape_string($this->db->link, $data['lname'] );
        $address     =  mysqli_real_escape_string($this->db->link, $data['address'] );
        $city   	 =  mysqli_real_escape_string($this->db->link, $data['city'] );
        $country     =  mysqli_real_escape_string($this->db->link, $data['country'] );
        $zip    	 =  mysqli_real_escape_string($this->db->link, $data['zip'] );
        $phone       =  mysqli_real_escape_string($this->db->link, $data['phone'] );
        $email       =  mysqli_real_escape_string($this->db->link, $data['email'] );

     if ($fname == "" || $lname == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == ""  || $email == "" ) {
            $msg = "<span style='color: red; font-size: 18px;'>Field Must Not be empty .</span> ";
                   return $msg;
        } else {
            $query = "UPDATE shop_users
               SET
               fname 		= '$fname',
               lname 		= '$lname',
               addr 	    = '$address',
               city 		= '$city',
               country  	= '$country',
               zip 		    = '$zip',
               phone		= '$phone',
               email   		= '$email'
               WHERE userID     = '$user_id' ";
            $update_row  = $this->db->update($query);
            if ($update_row) {
            	$msg = "<span style='color: green; font-size: 18px;'>Customer Data Updated Successfully.</span> ";
            	return $msg;
            }else {
            	$msg = "<span style='color: red; font-size: 18px;'>Customer Data Not Updated .</span> ";
    			return $msg;
            }
      }

    }

}

    ?>