
<?php include '../inc/header.php'; ?>

 <?php
  $login_session =  Session::get("userlogin");
  if ($login_session == false) {
  	header("Location:login.php");
  }

  ?>

  <?php
  //if (isset($_GET['order_id']) && $_GET['order_id'] == 'mtn' ) {

   $customer_Id =  Session::get("userId");

   $total_amount = Session::get("sum");
   //$vendor = $_GET['order_id'];
   $transaID = rand(8, 12);
  // $process_payment = $cart->processPayment($customer_Id, $total_amount,$vendor);

   //$ordeAdded = $cart->add_order($customer_Id);
   //$delcartData = $cart->deleteCustomerCartDetails();
     //header("Location:onlinesuccess.php");
   //}

 ?>

<?php
  if (isset($_GET['order_id']) && $_GET['order_id'] == 'Vodafone' ) {

   $customer_Id =  Session::get("userId");
   $total_amount = Session::get("sum");
   $vendor = $_GET['order_id'];
   $process_payment = $cart->processPayment($customer_Id, $total_amount,$vendor);

    // header("Location:onlinesuccess.php");
   }

 ?>

<?php
  if (isset($_GET['order_id']) && $_GET['order_id'] == 'airtelTigo' ) {

   $customer_Id =  Session::get("userId");
   $total_amount = Session::get("sum");
   $vendor = $_GET['order_id'];
   $process_payment = $cart->processPayment($customer_Id, $total_amount,$vendor);

     //header("Location:onlinesuccess.php");
   }

 ?>



<style>
 .division{width: 50%;float: left;}
 .tblone{width: 500px; margin: 0 auto; border: 2px solid #ddd; font-size: 13px;}
 .tblone tr td{text-align: justify;}

 .tbltwo{float:right;text-align:left; width: 50%;border: 2px solid #ddd;margin-right: 40px;margin-top: 12px;}
 .tbltwo tr td{text-align: justify; padding: 5px 10px;}

 .ordernow a{width:150px;margin: 5px auto 0;padding: 7px 0; text-align: center;display: block;background: #555;border: 1px solid #333;color: #fff;border-radius: 3px;font-size: 25px; margin-bottom: 40px;}


</style>

 <div class="main">
    <div class="content">
      <div class="section group">

      <div class="division">

<table class="tblone">
              <tr>
                <td>Sl</td>
                <td>Product</td>

                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>

              </tr>
    <?php
        $sum = 0;
          $get_cart_product = $cart->displayCartData();
          if ($get_cart_product) {
            $i = 0;
            $sum = 0;
            $qty = 0;
            while ($result = $get_cart_product->fetch_assoc()) {
               $i++;
                     ?>
                <tr>
                <td><?php echo $i;  ?></td>
                <td><?php echo $result['product_name'];  ?></td>

                <td>GHC <?php echo $result['price'];  ?></td>
                 <td> <?php echo $result['qty'];  ?></td>
                <td>

                </td>
                <td>GHC
                  <?php
                  $total = $result['price'] * $result['qty'];
                  echo $total;
                  ?>
                </td>
              </tr>
              <?php
                  $qty = $qty +  $result['qty'];
                 $sum = $sum + $total;
                 Session::set("sum", $sum);
               ?>
              <?php } }   ?>
            </table>

            <table class="tbltwo">
            <tr>
                <th>Grand Total :</th>
                <td>GHC
                <?php
                    $gtotal = $sum;
                  echo $gtotal;
                  ?> </td>


            </tr>
             </table>
      </div>



<div class="division">

<?php
   $id = Session::get('userId');
   $get_customer_data = $customer->retrieveCustomerDetails($id);
   if ($get_customer_data) {
     while ($result = $get_customer_data->fetch_assoc()) {
       $number = $result['phone'];
  ?>

    <table class="tblone">
       <tr>
          <td colspan="3"> <h2>  Your Profile Details </h2> </td>
      </tr>

      <tr>
          <td width="20%"> Name  </td>
          <td width="5%"> : </td>
          <td> <?php echo $result['fname']." ".$result['lname']; ?>  </td>
      </tr>
        <tr>
          <td> Phone  </td>
          <td> : </td>
          <td> <?php echo $result['phone']; ?> </td>
      </tr>

        <tr>
          <td> Email  </td>
          <td> : </td>
          <td> <?php echo $result['email']; ?>  </td>
      </tr>
        <tr>
          <td> Address  </td>
          <td> : </td>
          <td> <?php echo $result['addr']; ?>  </td>
      </tr>
        <tr>
          <td> City  </td>
          <td> : </td>
          <td><?php echo $result['city']; ?>  </td>
      </tr>
        <tr>
          <td> Zipcode  </td>
          <td> : </td>
          <td> <?php echo $result['zip']; ?>  </td>
      </tr>
        <tr>
          <td> Country  </td>
          <td> : </td>
          <td> <?php echo $result['country']; ?>  </td>
      </tr>


     <tr>
          <td>   </td>
          <td>  </td>
          <td><a href="editprofile.php"> Update Details </a> </td>
      </tr>


    </table>


  <?php   } }  ?>



    </div>


    <?php
$total_amount = Session::get("sum");
//$vendor = $_GET['order_id'];
$transaID = rand(12,20);


echo"<a href='#' onclick='mtn($transaID, $total_amount, $number)'><img src='../images/mtn.jpg' style='width: 100px; height:80px'></a>
|<a href='#' onclick='tigo($transaID, $total_amount, $number)'><img src='../images/tigo.jpg' style='width: 100px; height:80px'></a>
|<a href='#' onclick='vodafone($transaID, $total_amount, $number)'><img src='../images/voda.jpg' style='width: 100px; height:80px'></a>";

?>

 </div>

</div>









<?php include '../inc/footer.php'; ?>