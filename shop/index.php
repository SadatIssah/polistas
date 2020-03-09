<?php include('inc/indexheader.php'); ?>
<?php

$product = new Product();
$category1 = new Category();

?>
<?php include('inc/slider.php'); ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3 style="color:#F7C221;">Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

		  <?php
 		 $festuredProducts = $product->displayFeaturedProducts();
            if ($festuredProducts) {
            	while ($result = $festuredProducts->fetch_assoc()) {
            	     ?>

	<div class="grid_1_of_4 images_1_of_4">
	  <a href="pages/preview.php?proid=<?php echo $result['productID']; ?>">
	  <img style="width: 300px; height:200px" src="admin/<?php echo $result['img']; ?>" alt="" /></a>
	  <h2><?php echo $result['product_name']; ?> </h2>
	  <p><?php echo $result['descr']; ?></p>
	  <p><span class="price">GHC<?php echo $result['price']; ?></span></p>
	<div class="button"><span><a href="pages/preview.php?proid=<?php echo $result['productID']; ?>" class="details">Details</a></span></div>
	</div>

		<?php  }  }  ?>
	</div>

			<div class="content_bottom">
    		<div class="heading">
    		<h3 style="color:#F7C221;">Latest Release</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
            $newProducts = $product->displayNewProducts();
            if ($newProducts) {
            	while ($result = $newProducts->fetch_assoc()) {

              ?>
			<div class="grid_1_of_4 images_1_of_4">
			<a href="pages/preview.php?proid=<?php echo $result['productID']; ?>">
			<img style="width: 300px; height:200px" src="admin/<?php echo $result['img']; ?>" alt="" /></a>
			<h2><?php echo $result['product_name']; ?> </h2>

			<p><span class="price">GHC<?php echo $result['price']; ?></span></p>
			<p><?php echo $result['descr']; ?></p>
			<div class="button"><span><a href="pages/preview.php?proid=<?php echo $result['productID']; ?>" class="details">Details</a></span></div>
			</div>

	 	 <?php  }  }  ?>

	 </div>

			</div>
    </div>
 </div>
</div>
<?php include('inc/indexfooter.php'); ?>