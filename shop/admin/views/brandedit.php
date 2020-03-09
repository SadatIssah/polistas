<?php include '../inc/header.php';?>
<?php include '../inc/sidebar.php';?>
<?php include '../../classes/brand.php';?>


<?php

if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
    echo "<script>window.location = 'brandlist.php'; </script>";
}

else{
    $brand_id = $_GET['brandid'];
}

?>

<?php

$brand = new Brand();

if($_SERVER['REQUEST_METHOD'] ==  'POST'){

	$catName = $_POST['brandname'];

	$updatebrand = $brand->updateBrand($brand_id, $catName);

}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock">

                <?php
                if(isset($updatebrand)){
                    echo $updatebrand;
                }
                ?>

                 <form  method="post", action=" ">
                    <table class="form">

                    <?php
					$getbrand = $brand->getBrandbyId($brand_id);
					if($getbrand){
					$result = $getbrand->fetch_assoc();
					?>
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Brand Name..." class="medium" value="<?php echo $result['brand_name']?>" name="brandname"/>
                            </td>
                        </tr>

                        <?php } ?>
						<tr>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include '../inc/footer.php';?>