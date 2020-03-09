<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">

				<div class="rightsidebar1 span_3_of_1">
					<h1>CATEGORIES</h1>
					<ul>

				 <?php
					  $catdisplay = $category1->catDisplay();
					  if ($catdisplay) {
					 while ($result = $catdisplay->fetch_assoc()) {

					 ?>
					 <li><a href="pages/productbycat.php?catID=<?php echo $result['catID']; ?>"><?php echo $result['catName']; ?></a></li>
					  <?php }  }  ?>

					</ul>

 				</div>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->

			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">


		<?php
            $newProducts = $product->displayNewProducts();
            if ($newProducts) {
            	while ($result = $newProducts->fetch_assoc()) {

			  ?>
			  <li>
			<a href="pages/preview.php?proid=<?php echo $result['productID']; ?>">
			<img style="width: 600px; height:200px" src="admin/<?php echo $result['img']; ?>" alt="" /></a>
			</li>
			  <?php  }  }  ?>

				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>