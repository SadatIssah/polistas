<?php include('../inc/header.php'); ?>

<?php

$cartobject = new ShopCart();
?>


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$quant = $_POST['qty'];
	$cart_ID = $_POST['cartID'];

	if($quant <= 0){
		echo "<script type='text/javascript'>alert('Zero or Negative quantity not allowed');</script>";
	}
	else{
	$cartUpdate = $cartobject->cartquantupdat($cart_ID, $quant);
	}
    }
?>


<?php
     if (isset($_GET['del'])) {
     	 $id = $_GET['del'];
     	 $delete = $cartobject->deleteCartItem($id);
     }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">
			<div class="cartpage">
					<h2>Your Cart</h2>
					<?Php
	 				if(isset($delete)){
						 echo $delete;
					 }

					 ?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

						<?php
						$cart_data = $cartobject ->displayCartData();
						$total = 0;
						if($cart_data){
						while($result = $cart_data->fetch_assoc()){

						?>
							<tr>
								<td><?php echo $result['product_name'] ?></td>
								<td><img style="width: 200px; height:40px"  src="<?php echo '../admin/'.$result['img']?>" alt=""/></td>
								<td>GHC. <?php echo $result['price']?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="qty" value="<?php echo $result['qty']?>"/>
										<input type="hidden" name="cartID" value="<?php echo $result['cartID']?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
									<?php
         						if (isset($cartUpdate)) {
											echo $cartUpdate;
										}
           ?>
								</td>
								<?php $sub_total = $result['price'] * $result['qty'];
								 $total = $total + $sub_total;?>
								<td>GHC <?php echo $sub_total; ?></td>

								<td><a onclick="return confirm('sure want to Delete');" href="?del=<?php echo $result['cartID']; ?>">Delete</a></td>
							</tr>


							<?php } }?>
						</table>


						<table style="float:right;text-align:left;" width="40%">


							<tr>
								<th>Grand Total :</th>
								<td>GHC. <?php echo $total?> </td>
							</tr>
					   </table>
					</div>


					<div class="shopping">
						<div class="shopleft">
							<a href="../index.php"> <img src="../images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="../images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>
       <div class="clear"></div>
    </div>
 </div>
</div>
   <div class="footer">
   	  <div class="wrapper">
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Customer Service</a></li>
						<li><a href="#"><span>Advanced Search</span></a></li>
						<li><a href="#">Orders and Returns</a></li>
						<li><a href="#"><span>Contact Us</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="about.html">About Us</a></li>
						<li><a href="faq.html">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.html"><span>Site Map</span></a></li>
						<li><a href="preview-2.html"><span>Search Terms</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.html">Sign In</a></li>
							<li><a href="index.html">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="faq.html">Help</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
	<h4>Contact</h4>
						<ul>
							<li><span>support@easylearningbd.com</span></li>
							<li><span>www.easylearningbd.com</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>easy Learning project &amp; All rights Reseverd </p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
	 		};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html>

