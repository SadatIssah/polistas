<?php  require (dirname(__FILE__).'/../inc/header.php');?>

<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>

<?php require (dirname(__FILE__).'/../../classes/brand.php');?>

<?php
$brand = new Brand();

if(isset($_GET['delbrand'])){
	$bdelete = $_GET['delbrand'];
	$delbrand = $brand->deletbyID($bdelete);

}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
				<?php
                if(isset($delbrand)){
                    echo $delbrand;
				}
				?>
                    <table class="data display datatable" id="example">
					<thead>

						<tr>
							<th>ID</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php
					$getbrand = $brand->brandDisplay();
					if($getbrand){
						while($result = $getbrand->fetch_assoc()){
					?>
						<tr class="odd gradeX">
							<td><?php echo $result['brandID'];?></td>
							<td><?php echo $result['brand_name'];?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandID']; ?>">Edit</a>
	 							|| <a onclick = "return confirm('Sure want to delete?')" href="?delbrand=<?php echo $result['brandID'];?>">Delete</a></td>
						</tr>
					<?php } } ?>


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

