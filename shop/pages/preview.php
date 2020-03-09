<?php include('../inc/header.php'); ?>

	<?php

	$pd = new Product();
	$cartobject = new ShopCart();
	$category1 = new Category();
	?>



	<?php
      if (!isset($_GET['proid']) || $_GET['proid'] == NULL ) {
          echo "<script>window.location = '404.php'; </script> ";
       }else{
    	$product_id = $_GET['proid'];
     }
	 ?>


	<?php  //listen to add to cart submit button
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sub'])) {
		$qty1 = $_POST['qty'];
		$cart1 = $cartobject->cartadd($qty1, $product_id);
		}
	?>


	 <?php
        $getPd = $pd->displaySingleProduct($product_id);
	 ?>


 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
				<?php
 	 $displaySingle = $pd->displaySingleProduct($product_id);
              if ($displaySingle) {
        while ($result = $displaySingle->fetch_assoc()) {
	 ?>

<div class="grid images_3_of_2">

	 <img style="width: 300px; height:200px" src="../admin/<?php echo $result['img']; ?>" alt="" />
	 </div>
	 <div class="desc span_3_of_2">
	 <h2><?php echo $result['product_name'];?> </h2>
	 <p><?php echo $result['descr'];?></p>
	 <div class="price">
	 <p>Price: <span>GHC<?php echo $result['price'];?></span></p>
	 <p>Category: <span><?php echo $result['catName'];?></span></p>
	 <p>Brand:<span><?php echo $result['brand_name'];?></span></p>
	   </div>
	 <div class="add-cart">
	 <form action=" " method="post">
	 <input type="number" class="buyfield" name="qty" value="1"/>
	 <input type="submit" class="buysubmit" name="sub" value="Add to Cart"/>
	</form>


	</div>
	 <?php if(isset($cart1)){
		echo $cart1;
		}?>



	</div>
		 <div class="product-desc">
		 <h2>Product Details</h2>
		 <?php echo $result['descr'];?>
	 </div>
	 <?php } } ?>
 </div>


				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>

				 <?php
					  $catdisplay = $category1->catDisplay();
					  if ($catdisplay) {
					 while ($result = $catdisplay->fetch_assoc()) {

					 ?>
					 <li><a href="productbycat.php?catID=<?php echo $result['catID']; ?>"><?php echo $result['catName']; ?></a></li>
					  <?php }  }  ?>

						</ul>

 				</div>
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
						<li><a href="about.php">About Us</a></li>
						<li><a href="faq.php">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.php"><span>Site Map</span></a></li>
						<li><a href="preview-2.php"><span>Search Terms</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.php">Sign In</a></li>
							<li><a href="cart.php">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="faq.php">Help</a></li>
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
</php>

