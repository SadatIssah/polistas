<?php  require (dirname(__FILE__).'/../inc/header.php');?>
<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>
<?php require (dirname(__FILE__).'/../../classes/product.php');?>


<?php
$product = new Product();

// if(isset($_GET['delbrand'])){
// 	$bdelete = $_GET['delbrand'];
// 	$delbrand = $brand->deletbyID($bdelete);

//}

?>

<?php

if(isset($_GET['delproduct'])){
	$cdelete = $_GET['delproduct'];
	$delproduct = $product->deletbyID($cdelete);

}

?>
<div class="grid_10">
    <div class="box round first grid">
		<h2>Products</h2>

				<?php
                if(isset($delproduct)){
                    echo $delproduct;
				}
				?>
        <div class="block">
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$getproduct = $product->productDisplay();
				if($getproduct){
					while($result = $getproduct->fetch_assoc()){
			?>

				<tr class="gradeU">
					<td><?php echo $result['productID'];?></td>
					<td><?php echo $result['product_name'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brand_name'];?></td>
					<td><?php echo $result['descr'];?></td>
					<td><?php echo $result['price'];?></td>
					<td><img src="<?php echo '../'.$result['img'];?>" height=40px; width=60px;></td>
					<td><?php
					if ($result['typ'] == 0) {
		       		 echo "Featured";
						 }else {
			     			echo "General";
							 } ?>
					</td>
 					<td><a href="productedit.php?proid=<?php echo $result['productID']; ?>">Edit</a>
					 || <a onclick="return confirm('Are you sure to delete')"
 					 href="?delproduct=<?php echo $result['productID']; ?>">Delete</a></td>
				</tr>
					<?php }}?>
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
<?php include '../inc/footer.php';?>
