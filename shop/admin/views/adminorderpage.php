<?php  require (dirname(__FILE__).'/../inc/header.php');?>
<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>
<?php require (dirname(__FILE__).'/../../classes/shopCart.php');?>

<?php $cart = new ShopCart();?>

<?php
     if (isset($_GET['shipid'])) {
     	$id = $_GET['shipid'];
     	$price = $_GET['price'];
     	$time = $_GET['time'];
     	$ship = $cart->shipProduct($id,$time,$price);

     }
?>

<?php
	if (isset($_GET['delproid'])) {
     	$id = $_GET['delproid'];
     	$price = $_GET['price'];
     	$time = $_GET['time'];
     	$delOrder = $cart->deleteShippedProduct($id,$time,$price);
	 }
?>

   <div class="grid_10">
    <div class="box round first grid">
      <h2>Customer Order</h2>
           <div class="block">
         <table class="data display datatable" id="example">
<thead>
    <tr>
	 <th>Order ID</th>
	 <th>Order Date</th>
	 <th>Product</th>
	 <th>quantity</th>
     <th>Price</th>
     <th>Customer ID</th>
     <th>Address</th>
	 <th>Action</th>
	</tr>

</thead>
		 <tbody>
    <?php
	 $allOrders = $cart->getAllOrderProduct();
	 if ($allOrders) {
	 while ($result = $allOrders->fetch_assoc()) {

	 ?>

	<tr class="odd gradeX">
	 <td><?php echo $result['orderID']; ?></td>
	 <td><?php echo $result['time'];  ?></td>
	 <td><?php echo $result['product_name']; ?></td>
     <td><?php echo $result['qty']; ?></td>
     <td><?php echo $result['price']; ?></td>
     <td><?php echo $result['userID']; ?></td>
	 <td><a href="customer.php?custId=<?php echo $result['userID']; ?>"> View Address</a></td>
	 <?php if ($result['status'] == '0') { ?>
    <td><a href="?shipid=<?php echo $result['userID']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['time']; ?>">Shipped</a></td>
    	 <?php	} else {    ?>
    <td><a href="?delproid=<?php echo $result['userID']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['time']; ?>">Remove</a></td>
         <?php } ?>





</tr>

<?php } }  ?>
		 </tbody>
	 </table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php  require (dirname(__FILE__).'/../inc/footer.php');?>