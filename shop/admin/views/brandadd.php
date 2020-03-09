<?php  require (dirname(__FILE__).'/../inc/header.php');?>
<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>
<?php require (dirname(__FILE__).'/../../classes/brand.php');?>


<?php
$brand = new Brand();

if($_SERVER['REQUEST_METHOD'] ==  'POST'){

	$brand_name = $_POST['brandName'];

	$addbrand = $brand->addBrabd($brand_name);

}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock">

                <?php
                if(isset($addbrand)){
                    echo $addbrand;
                }
                ?>

                 <form  method="post", action=" ">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Brand Name..." class="medium"  name="brandName"/>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php require (dirname(__FILE__).'/../inc/footer.php');?>