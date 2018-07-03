<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';

	if (!logged_in()) {
		header('Location: login.php');
	}

	include 'includes/head.php';
	include 'includes/navbar.php';

	$search = ((isset($_POST['search']))?sanitize($_POST['search']):'');
	$search = trim($search);

	$errors = array();

	if ($_POST) {
	 	
	
	 	if (empty($_POST['search'])) {
	 		$errors[] = 'Please insert a name or token to be searched';
	 	}

	 	if (!preg_match("/^[a-zA-Z ]*$/",$search) || !preg_match("/^[a-zA-Z0-9 ]*$/",$search) ) {
	 		$errors[] = 'Please insert a valid name or token to be searched';	
		 	}

		 if (!empty($errors)) {
		 		echo display_errors($errors);
		 	}
		 	else{
		 		$searchQ = $db->query("SELECT * FROM patient WHERE name = '$search' OR token = '$search'");
		 		$count = mysqli_num_rows($searchQ);

		 		if ($count < 1) {
		 			$_SESSION['error_flash'] = 'No such patient found!';
		 			header('Location: patient.php');
		 		}else{
		 			?>
		 				<div class="header">
						    <h3 class="text-center">Patient's details</h3>
						</div>
						<table class="table table-bordered table-striped table-condensed">
						    <thead>
						        <th></th>
						        <th>Token</th>
						        <th>Name</th>
						        <th>DOB</th>
						        <th>Phone</th>
						        <th>Address</th>
						        <th>Sex</th>
						        <th>Admitted on</th>
						        <th>Ward</th>
						        
						    </thead>
						    <tbody>
						        <?php   
						            while($patient = mysqli_fetch_assoc($searchQ)):
						            ?>

						        <tr>
						            <td><a href="patient.php?edit=<?=$patient['id'];?>" class="btn btn-xs btn-default"><span class="oi oi-pencil"></span></a>
						                    <a href="patient.php?delete=<?=$patient['id'];?>" class="btn btn-xs btn-default"><span class="oi oi-x icon"></span></a></td>
						            <td><?=$patient['token'];?></td>
						            <td><?=$patient['name'];?></td>
						            <td><?=$patient['dob'];?></td>
						            <td><?=$patient['phone'];?></td>
						            <td><?=$patient['address'];?></td>
						            <td><?=$patient['sex'];?></td>
						            <td><?=$patient['doa'];?></td>
						            <td><?=$patient['ward'];?></td>
						        </tr>
						    <?php endwhile; ?>
						    </tbody>
						</table>

		 			<?php
		 		}

		 	}	

	 } 

?>


<?php include 'includes/footer.php'; ?>