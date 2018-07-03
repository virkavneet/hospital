<?php 
		require_once 'core/connect.php';
		include 'includes/head.php'; 
	  	include 'includes/navbar.php';

	  	$name = ((isset($_POST['name']))?mysqli_real_escape_string($db,$_POST['name']):'');
	  	trim($name);
	  	$age = ((isset($_POST['age']))?mysqli_real_escape_string($db,$_POST['age']):'');
	  	trim($age);
	  	$phone = ((isset($_POST['phone']))?mysqli_real_escape_string($db,$_POST['phone']):'');
	  	trim($phone);
	  	$speciality = ((isset($_POST['speciality']))?mysqli_real_escape_string($db,$_POST['speciality']):'');
	  	$address = ((isset($_POST['sddress']))?mysqli_real_escape_string($db,$_POST['address']):'');
	  	trim($address);

	  	$errors = array();

	  	$speciality = $db->query("SELECT DISTINCT speciality FROM staff");

?>

<h1 class="text-center">Appointments at NIMS</h1>
<div class="row no-gutters">
	<div class="col-md-1"></div>
	<div class="col-md-4">
		<h3 class="text-center">Offline Appointments</h3>
		<h4>NIMS Delhi</h4>
		<h5>9000250250<br><small>8am to 5pm, Monday through Friday</small></h5>
		<br><br>
		<h4>NIMS Chandigarh</h4>
		<h5>9045250278<br><small>7am to 6pm, Monday through Friday</small></h5>
		<br><br>
		<h4>NIMS Children's Center</h4>
		<h5>9045255278<br><small>7am to 6pm, Monday through Friday</small></h5>
		<br><br>
		<hr>
		<legend>You can email us at-</legend>
		<h5>inquiry@hims.com</h5>
		<small>No appointments are made through emails. Emails are restricted to inquires only. All the appointments made through email will be discarded.</small>
	</div>
	<div class="col-md-1"></div>
	<div class="col-md-5">
		<h3 class="text-center">Online Appointments</h3>
		<form action="appoint.php" method="post">
			<div>
				<?php

					if ($_POST) {
						//Form Validations

						//Empty fields
						if (empty($_POST['name']) || empty($_POST['age']) || empty($_POST['phone']) || empty($_POST['address'])) {
							$errors[] = 'You must fill the name, age, phone and address!';
						}

					
						if (!empty($errors)) {
							echo display_errors($errors);
						} else {
							$query = $db->query("INSERT INTO appointments(name, age, phone, address, purpose, choice) VALUES('$name', '$age', '$phone', '$address', '$purpose', '$choice')");
							$check = mysqli_fetch_assoc($query);
							
							if ($check) {
								$_SESSION['error_flash'] = 'Unable to make appointment!';
								header('Location: appoint.php');
							} else {
								$_SESSION['success_flash'] = 'Appointment Successfully made';
								header('Location: appoint_fix.php');
							}
							
						}
						
					}

				?>
			</div>
			<div class="form-group">
				<label for="name">Name*:</label>
				<input type="text" name="name" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="age">Age*:</label>
				<input type="text" name="age" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="phone">Phone*:</label>
				<input type="text" name="phone" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="speciality">Who you are looking for:</label>
				<select class="form-control" name="speciality">
					<?php while($check = mysqli_fetch_assoc($speciality)): ?>
						<option value="<?=$check['id'];?>"><?=$check['speciality'];?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="address">Address*:</label>
				<textarea name="address" rows="4" class="form-control" required></textarea>
			</div>
			<small>All the fields with</small> * <small>are must required to be filled.</small>
			<input type="submit" name="submit" class="btn btn-primary float-right">


		</form>		
	</div>
	<div class="col-md-1"></div>
</div>

<?php include 'includes/footer.php'; ?>