<?php include '../inc/header.php'; ?>
<?php
  $login =  Session::get("userlogin");
  if ($login == false) {
  	header("Location:login.php");
  }
  ?>

     <div class="main">
        <div class="content">

         <div class="section group">
         <h2> <span>Your Order Details</span>  </h2>
          <table class="tblone">
              <tr>
                <th>Product Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date Ordered</th>
                <th>Status</th>
                <th>Action</th>
              </tr>

           <?php
          $user_Id =  Session::get("userId");
          $getCustomerOrder = $cart->customer_order_details($user_Id);
          if ($getCustomerOrder) {
               while ($result = $getCustomerOrder->fetch_assoc()) {

            ?>
               <tr>

              <td><?php echo $result['product_name'];  ?></td>
              <td><img style="width: 100px; height:40px" src="../admin/<?php echo $result['img']; ?>" alt=""/></td>
              <td> <?php echo $result['qty'];  ?></td>

               <td>GHC
                 <?php
                 $total = $result['price'] * $result['qty'];
                 echo $total;
                 ?>
               </td>
               <td><?php echo $result['time'];  ?></td>
               <td>
         <?php
               if ($result['status'] == '0') {
                echo "Pending";
                 }else {
                echo "Shipped";
                 }
                    ?>
         </td>
       <?php
         if ($result['status'] == '1') { ?>
        <td><a onclick="return confirm('Sure want to Delete?');" href=" ">X</a></td>
             <?php }else {  ?>
             <td>N/A </td>

          <?php } ?>
          </tr>

       <?php } }   ?>
     </table>

  </div>
   <div class="clear"></div>
</div>
</div>
</div>

<?php include '../inc/footer.php'; ?>