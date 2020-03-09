<?php include '../inc/header.php';?>
<?php include '../inc/sidebar.php';?>
<?php include '../../classes/category.php';?>


<?php

if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
    echo "<script>window.location = 'catlist.php'; </script>";
}

else{
    $cat_id = $_GET['catid'];
}

?>

<?php
$cat = new Category();

if($_SERVER['REQUEST_METHOD'] ==  'POST'){

	$catName = $_POST['catname'];

	$updatecat = $cat->updateCat($cat_id, $catName);

}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock">

                <?php
                if(isset($updatecat)){
                    echo $updatecat;
                }
                ?>

                 <form  method="post", action=" ">
                    <table class="form">

                    <?php
					$getCat = $cat->getCatbyId($cat_id);
					if($getCat){
					$result = $getCat->fetch_assoc();
					?>
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium" value="<?php echo $result['catName']?>" name="catname"/>
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