<?php include '../inc/header.php'; ?>

 <?php
  $login_session =  Session::get("userlogin");
  if ($login_session == false) {
  	header("Location:login.php");
  }

  ?>


<?php




   if (isset($_GET['txref'])) {

    $customer_Id =  Session::get("userId");
    $total_amount = Session::get("sum");

    $ref = $_GET['txref'];
    $amount =$total_amount; //Correct Amount from Server
    $currency = "GHS"; //Correct Currency from Server

    $query = array(
        "SECKEY" => "FLWSECK_TEST-e519b31f802ce125f39fdc7a5ce10b1a-X",
        "txref" => $ref
    );

    $data_string = json_encode($query);

    $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);

    $resp = json_decode($response, true);

    $paymentStatus = $resp['data']['status'];
    $chargeResponsecode = $resp['data']['chargecode'];
    $chargeAmount = $resp['data']['amount'];
    $chargeCurrency = $resp['data']['currency'];

    if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {

      $cart->add_order($customer_Id);
      $cart->deleteCustomerCartDetails();

      header("Location:onlinesuccess.php");

    } else {
        //Dont Give Value and return to Failure page
        header("Location:onlinepayment.php");
    }
}
else {
  die('No reference supplied');
}




 ?>
