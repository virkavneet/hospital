<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';

	include 'includes/head.php';
	include 'includes/navbar.php';

	$query = $db->query("SELECT * FROM staff ORDER BY speciality");
?>
<div class="row no-gutters">
	<div class="col-md-2">
		<div class="left-menu">
			<div class="container-fluid text-center">
				<h4 class="header text-center"><strong>Numbers</strong></h4>
				<?php 
					$Nquery = $db->query("SELECT DISTINCT speciality FROM staff");
					while($speciality = mysqli_fetch_assoc($Nquery)){
						$specialisation = $speciality['speciality'];
						$Fquery = $db->query("SELECT * FROM staff WHERE speciality = '$specialisation'");
						$count = mysqli_num_rows($Fquery);
				?>
						<div class="count-data table-success">
							<h5><?=$speciality['speciality'];?>s</h5>
							<div class="count">
								<h4><strong><?=$count;?></strong></h4>
							</div>
						</div>
						<?php }  ?>

			</div>
		</div>
	</div>
	<div class="col-md-10">
		<div class="container-fluid">
			<div class="row no-gutters">
			<?php while($staff = mysqli_fetch_assoc($query)): ?>
				<div class="col-md-6">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td><img width="auto;" height="100px;" src="<?=$staff['image'];?>" class="staff-img"></td>
								<td><h5><?=$staff['name'];?><br><small><b><?=$staff['age'];?></b></small></h5></td>
								<td><h6><?=$staff['speciality'];?></h6></td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php'; ?>