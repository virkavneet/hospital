<style>
	body{
			padding-top: 60px;
	}
</style>
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-custom">
			 <div class="container-fluid">
			 	 <a href="index.php" class="navbar-brand">Hello <?=$user_data['first'];?> !</a>

			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			   <div class="collapse navbar-collapse" id="navbarSupportedContent">
			   	<ul class="navbar-nav mr-auto">
			   		<li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
			   		<li class="nav-item"><a class="nav-link" href="patient.php">Patient's details</a></li>
			   		<li class="nav-item"><a class="nav-link" href="drugs.php">Drugs details</a></li>
			   		<li class="nav-item"><a class="nav-link" href="staff.php">Staff details</a></li>
			   		<li class="nav-item"><a class="nav-link" href="ward.php">Ward's details</a></li>
			   		<li class="nav-item"><a class="nav-link" href="guide.php">Guidelines and Rules</a></li>
				   	<li class="nav-item dropdown"> 
				   		<a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"><span class="oi oi-user"></span>Settings</a>
				   		<div class="dropdown-menu">
				   			<a href="#" class="dropdown-item">My Profile</a>
				   			<a href="#" class="dropdown-item">Change Password</a>
				   			<a class="dropdown-item" href="logout.php"><span class="oi oi-power-standby"></span> Logout</a>
				   		</div>
				   	</li>
				   	<li class="nav-item"></li>
			   	</ul>
			 </div>
		</nav>