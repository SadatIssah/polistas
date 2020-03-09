<?php include('../inc/header.php'); ?>


<?php $cartobject = new ShopCart();?>
<?php $cartegoryobject = new Category();?>

<?php
  if (!isset($_GET['catID'])  || $_GET['catID'] == NULL ) {
     echo "<script>window.location = '404.php';  </script>";
  }else {
    $cart_id = $_GET['catID'];
  }
 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
			<?php
              $productByCat = $cartegoryobject->getCatbyId($cart_id);
              if ($productByCat) {
               while ($result = $productByCat->fetch_assoc()) {
               ?>

    	    <h3> <?php echo $result['catName']; ?> </h3>

     	    <?php    } } ?>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  <?php
      			 $displaycatitem = $cartobject->displayProductstByCat($cart_id);
       			 if ($displaycatitem) {
      				 while ($result = $displaycatitem->fetch_assoc()) {

      			 ?>
					<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.php?proid=<?php echo $result['productID']; ?>">
					<img style="width: 300px; height:200px" src="../admin/<?php echo $result['img']; ?>" alt="" /></a>
					<h2><?php echo $result['product_name']; ?> </h2>
					<p><?php echo $result['descr']; ?></p>
					<p><span class="price">$<?php echo $result['price']; ?></span></p>
					<div class="button"><span><a href="preview.php?proid=<?php echo $result['productID']; ?>" class="details">Details</a></span></div>
							</div>
						<?php    } } else {
							header("Location:404.php");
						}  ?>
				</div>

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

