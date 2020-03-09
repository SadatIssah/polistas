<?php  require (dirname(__FILE__).'/../inc/header.php');?>
<?php require (dirname(__FILE__).'/../inc/sidebar.php');?>
<?php require (dirname(__FILE__).'/../../classes/membership.php');?>



<?php
$members = new Members();

if(isset($_GET['uid'])){
    $email = $_GET['uid'];
    $namel = Session::get("namee");
	$delbrand = $members->passReset($email,$namel);

}

?>

<?php

if(isset($_GET['deluser'])){
	$cdelete = $_GET['deluser'];
	$delmember = $members->deletbyID($cdelete);

}

?>
<div class="grid_10">
    <div class="box round first grid">
		<h2>User Profile</h2>

				<?php
                if(isset($delmember)){
                    echo $delmember;
                }

                ?>

                <?php
                if(isset($delbrand)){
                    echo $delbrand;
                }

				?>
        <div class="block">
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Phone Number</th>
					<th>Email</th>
                    <th>Country</th>
                    <th>Status</th>
					<th>Login</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$getmembers = $members->membersDisplay();
				if($getmembers){
					while($result = $getmembers->fetch_assoc()){
			?>

				<tr class="gradeU">

					<td><?php echo $result['ID'];?></td>
					<td><?php echo $result['first_name'] ?></td>
					<td><?php echo $result['last_name'];?></td>
					<td><?php echo $result['phone'];?></td>
					<td><?php echo $result['email'];?></td>
                    <td><?php echo $result['country'];?></td>
                    <td><?php echo $result['approval'];?></td>
                    <td><?php echo $result['login'];?></td>

 					<td><a href="?uid=<?php echo $result['email']; ?>">Password Set</a>
					 || <a onclick="return confirm('Are you sure to delete')"
 					 href="?deluser=<?php echo $result['ID']; ?>">Remove</a></td>
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
