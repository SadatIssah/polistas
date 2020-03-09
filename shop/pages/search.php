<?php include '../inc/header.php'; ?>

 <?php
  if (!isset($_GET['search'])  || $_GET['search'] == NULL ) {
     echo "<script>window.location = '404.php';  </script>";
  }else {
    $search = $_GET['search'];

  }

 ?>




 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">



    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

          <?php
          $search = $product->searchProduct($search);
          if ($search) {
           while ($result = $search->fetch_assoc()) {

          ?>
            	<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.php?proid=<?php echo $result['productID']; ?>">
					 	<img src="../admin/<?php echo $result['img']; ?>" alt="" /></a>
					<h2><?php echo $result['product_name']; ?> </h2>
					 <p><?php echo $result['descr']; ?></p>
					  <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="preview.php?proid=<?php echo $result['productID']; ?>" class="details">Details</a></span></div>
				</div>
				 <?php    } } else { ?>
				  <p>  Your Search Product Is not Found </p>


				 <?php	}  ?>

				</div>
			</div>



    </div>
 </div>
</div>
   <?php include '../inc/footer.php'; ?>