<?php require (dirname(__FILE__).'/../inc/header.php');?>
<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>

<?php require (dirname(__FILE__).'/../../classes/membership.php');?>

<?php
if(!isset($_GET['uid']) || $_GET['uid'] == NULL){
    echo "<script>window.location = 'user_profile.php'; </script>";
}

else{
    $member_id = $_GET['uid'];
}
?>


<?php
$member = new Members();

// if($_SERVER['REQUEST_METHOD'] ==  'POST' && isset($_POST['submitt'])){
// 	$update = $prod->updateproduct($_POST, $_FILES,$product_id);

// }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update User Info</h2>
        <div class="block">
        <?php
        // if(isset($update)){
        //     echo $update;
        // }

        ?>

        <?php

        $memberbyID = $member->getMemberbyID($member_id);


		if($memberbyID){
		while($value = $memberbyID->fetch_assoc()){


        ?>


         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">

                <tr>
                    <td>
                        <label>First Name</label>
                    </td>
                    <td>
                        <input type="text" value = "<?php echo $value['first_name']?>" name="first_name" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Last Name</label>
                    </td>
                    <td>
                    <input type="text" value = "<?php echo $value['last_name']?>" name="last_name" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                    <input type="text" value = "<?php echo $value['phone']?>" name="phone" class="medium" />

                    </td>
                </tr>

				 <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="email" ><?php echo $value['email'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Country</label>
                    </td>
                    <td>
                        <input type="text" name="country"  value = "<?php echo $value['price']?>" class="medium" />
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

