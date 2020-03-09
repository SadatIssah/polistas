<?php  require (dirname(__FILE__).'/../inc/header.php');?>
<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>
<?php require (dirname(__FILE__).'/../../classes/customers.php');?>


 <?php
  if (!isset($_GET['custId'])  || $_GET['custId'] == NULL ) {
     echo "<script>window.location = 'adminorderpage.php';  </script>";
  }else {
    $id = $_GET['custId'];
  }
 ?>

<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'adminorderpage.php';  </script>";
    }
    ?>

  <div class="grid_10">
     <div class="box round first grid">
        <h2>Customer Details</h2>
    <div class="block copyblock">

     <?php

         $cus = new Customers();
        $getCust = $cus->retrieveCustomerDetails($id);
        if ($getCust) {
           while ($result = $getCust->fetch_assoc()) {
     ?>

  <form action=" " method="post">
    <table class="form">
    <tr>
        <td> Customer Name </td>
        <td>
              <input type="text" readonly="readonly" value="<?php echo $result['fname'] ." ".$result['lname']; ?>" class="medium" />
        </td>
    </tr>

    <tr>
        <td> Customer Address </td>
        <td>
            <input type="text" readonly="readonly" value="<?php echo $result['addr']; ?>" class="medium" />
        </td>
        </tr>

    <tr>
    <td> Customer City </td>

        <td>
            <input type="text" readonly="readonly" value="<?php echo $result['city']; ?>" class="medium" />
         </td>
    </tr>
        <tr>
            <td> Customer Country </td>
            <td>
                <input type="text" readonly="readonly" value="<?php echo $result['country']; ?>" class="medium" />
            </td>
        </tr>

    <tr>
        <td> Customer Zip </td>

        <td>
            <input type="text" readonly="readonly" value="<?php echo $result['zip']; ?>" class="medium" />
        </td>
    </tr>

    <tr>
        <td> Customer Phone </td>
        <td>
            <input type="text" readonly="readonly" value="<?php echo $result['phone']; ?>" class="medium" />
        </td>
    </tr>

    <tr>
        <td> Customer Email </td>
        <td>
            <input type="text" readonly="readonly" value="<?php echo $result['email']; ?>" class="medium" />
        </td>
    </tr>

    <tr>
        <td>
            <input type="submit" name="submit" Value="Ok" />
        </td>
    </tr>
</table>
</form>
        <?php    }  }  ?>


 </div>
</div>
</div>
<?php  require (dirname(__FILE__).'/../inc/footer.php');?>