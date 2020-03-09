<?php require (dirname(__FILE__).'/../inc/header.php');?>
<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>
<?php require (dirname(__FILE__).'/../../classes/brand.php');?>
<?php require (dirname(__FILE__).'/../../classes/category.php');?>
<?php require (dirname(__FILE__).'/../../classes/product.php');?>

<?php
if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
    echo "<script>window.location = 'productlist.php'; </script>";
}

else{
    $product_id = $_GET['proid'];
}
?>


<?php
$prod = new Product();

if($_SERVER['REQUEST_METHOD'] ==  'POST' && isset($_POST['submitt'])){
	$update = $prod->updateproduct($_POST, $_FILES,$product_id);

}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block">
        <?php
        if(isset($update)){
            echo $update;
        }

        ?>

        <?php

        $productbyID = $prod->getProductbyID($product_id);


		if($productbyID){
		while($value = $productbyID->fetch_assoc()){


        ?>


         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">

                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value = "<?php echo $value['product_name']?>" name="product_name" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catID">
                            <option>Select Category</option>

                            <?php

                            $category = new Category();
                            $getCategory = $category->catDisplay();
                            if($getCategory){
                                while($result = $getCategory->fetch_assoc()){

                            ?>
                            <option

                            <?php
                            if($result['catID'] == $value['catID']){ ?>
                                selected = "selected";
                           <?php }

                            ?>

                            value="<?php echo $result['catID'];?>"><?php echo $result['catName'];?></option>

                            <?php
                             }
                            }
                                ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandID">
                            <option>Select Brand</option>
                            <?php

                            $brand = new Brand();
                            $getbrand = $brand->brandDisplay();

                            if($getbrand){
                                while($result = $getbrand->fetch_assoc()){

                            ?>
                            <option


                            <?php
                            if($result['brandID'] == $value['brandID']){ ?>
                                selected = "selected";
                           <?php }

                            ?>

                            value="<?php echo $result['brandID'];?>"><?php echo $result['brand_name'];?></option>

                            <?php
                             }
                            }
                                ?>
                        </select>
                    </td>
                </tr>

				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="descr" ><?php echo $value['descr'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price"  value = "<?php echo $value['price']?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo '../'.$value['img'];?>" height=40px; width=60px;>
                        <input type="file" name="img"  value = "<?php echo $value['img']?>"/>
                    </td>
                </tr>

				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="typ">
                        <option>Select Type</option>
                            <?php
                            if($value['typ'] == 0){?>
                                <option selected = "selected" value="0">Featured</option>
                                <option value="1">Non-Featured</option>

                            <?php } else {?>
                            }



                            <option value="0">Featured</option>
                            <option selected = "selected" value="1">Non-Featured</option>
                        <?php } ?>

                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submitt" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } }	?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="/../js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php require (dirname(__FILE__).'/../inc/footer.php');?>

