<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';
	include 'includes/head.php';

	$username = ((isset($_POST['username']))?sanitize($_POST['username']):'');
	$username = trim($username);
	$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
	$password = trim($password);

	$errors = array();
?>
<style>
	body{
		background: url('../images/6352.jpg');
		background-size: cover;
		background-repeat: no-repeat;
		background-attachment: fixed;
		overflow: hidden;
	}


	.login-img img{
		width: 180px;
		height: auto;
	}

	.login-form{
		padding-right: 60px;
		padding-left: 60px;
	}
	.outer-login{
		background-color: whitesmoke;
		opacity: 0.8;
		width: 500px;
		height: 300px;
		box-shadow: 8px 8px 4px gray;
	}
	.outer-login h3{
		padding-top: 30px;
		padding-bottom: 30px;
	}
</style>

<div>
	<?php 
	if ($_POST) {
		//Validations

		//Empty
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$errors[] = 'All the fields are required to be filled';
		}

		$checked_username = check_email($username);

		if ($checked_username) {
			$query = $db->query("SELECT * FROM staff WHERE email = '$username'");
		}else{
			$query = $db->query("SELECT * FROM staff WHERE phone = '$username'");
		}

		$staff = mysqli_fetch_assoc($query);
		$count = mysqli_num_rows($query);

		if ($count < 1) {
			$errors[] = 'No such user exists';
		}

		if (!empty($errors)) {
			echo display_errors($errors);
		}
		else{
			$staff_id = $staff['id'];
			login($staff_id);
		}
		
	}
 ?>
</div>

		<div class="row no-gutters">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="login-img text-center"><img src="../images/enterprise-logo-300x300.png"></div>
				<div class="outer-login">
				<h3 class="login-header text-center"><strong>Member's Login</strong></h3>
					<form action="login.php" method="post" class="login-form">
						<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Email or phone">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password">
							<a href="forget-password.php">Forget Password?</a>
						</div>
						<button type="submit" class="btn btn-success">Login</button>
						<a href="/hospital/index.php" class="float-right">NIMS Website</a>
					</form>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>



<?php include 'includes/footer.php'; ?>