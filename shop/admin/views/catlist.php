<?php  require (dirname(__FILE__).'/../inc/header.php');?>

<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>
<?php //include '../classes/category.php';?>
<?php require (dirname(__FILE__).'/../../classes/category.php');?>

<?php
$cat = new Category();

if(isset($_GET['delcat'])){
	$cdelete = $_GET['delcat'];
	$delcat = $cat->deletbyID($cdelete);

}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
				<?php
                if(isset($delcat)){
                    echo $delcat;
				}
				?>
                    <table class="data display datatable" id="example">
					<thead>

						<tr>
							<th>ID</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php
					$getCat = $cat->catDisplay();
					if($getCat){
						while($result = $getCat->fetch_assoc()){
					?>
						<tr class="odd gradeX">
							<td><?php echo $result['catID'];?></td>
							<td><?php echo $result['catName'];?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catID']; ?>">Edit</a>
	 							|| <a onclick = "return confirm('Sure want to delete?')" href="?delcat=<?php echo $result['catID'];?>">Delete</a></td>
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

