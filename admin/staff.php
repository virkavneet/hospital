
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';

    if (!logged_in()) {
        header('Location: login.php');
    }
    
    include 'includes/head.php';
    include 'includes/navbar.php';

    //Delete the staff 
    if (isset($_GET['delete'])) {
        $dId = $_GET['delete'];

        $db->query("UPDATE staff SET deleted = 1 WHERE id = '$dId'");
        header('Location: staff.php');
        $_SESSION['success_flash'] = 'Staff successfully deleted';        
    }

    if (isset($_GET['add'])) {
    	
        $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
        $sex = ((isset($_POST['sex']) && $_POST['sex'] != '')?sanitize($_POST['sex']):'');
        $address = ((isset($_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):'');
        $age = ((isset($_POST['age']) && $_POST['age'] != '')?sanitize($_POST['age']):'');
        $password = ((isset($_POST['password']) && $_POST['password'] != '')?sanitize($_POST['password']):'');
        $confirm_password = ((isset($_POST['confirm_password']) && $_POST['confirm_password'] != '')?sanitize($_POST['confirm_password']):'');
        $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):'');
        $phone = ((isset($_POST['phone']) && $_POST['phone'] != '')?sanitize($_POST['phone']):'');
        $specialisation = ((isset($_POST['specialisation']) && $_POST['specialisation'] != '')?sanitize($_POST['specialisation']):'');
        $permissions = ((isset($_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']):'');
        $dbpath ='';

    	$errors = array();
    	if ($_POST) {

    		//Form validation
    		//If the fileds are empty
    		if (empty($title)||empty($age)||empty($email)||empty($phone)||empty($specialisation)) {
    			$errors[] = 'All fileds are required to be filled';
    		}

    		//correct formats
    		if (!preg_match("/^[a-zA-z ]*$/",$title)) {
    			$errors[] = 'Only characters and whitespaces are allowed in name';
    		}

    		if (!preg_match("/^[0-9]*$/",$phone)) {
    			$errors[] = 'Invalid phone number';
    		}

    		if (!preg_match("/^[0-9]*$/",$age)) {
    			$errors[] = 'Invalid age';
    		}

    		if (!preg_match("/^[a-zA-z ]*$/",$specialisation)) {
    			$errors[] = 'Specialisation does not seem correct!';
    		}

    		if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    			$errors[] = 'Invalid email';
    		}

            if ($password != $confirm_password) {
                $errors[] = 'Password does not match';
            }

            if ($_FILES['photo']['name'] != '') {
                $photo = $_FILES['photo'];
                $name = $photo['name'];
                $nameArray = explode('.', $name);
                $fileName = $nameArray[0];
                $fileExt = $nameArray[1];
                $mime = explode('/', $photo['type']);
                $mimeType = $mime[0];
                $mimeExt = $mime[1];
                $tmpLoc = $photo['tmp_name'];
                $allowed = array('png','jpg','jpeg');
                $fileSize = $photo['size'];
                $uploadName = md5(microtime()).'.'.$fileExt;
                $uploadPath = BASEURL.'images/staff/'.$uploadName;
                $dbpath = '/hospital/images/staff/'.$uploadName;

                if ($mimeType != 'image') {
                    $errors[] = 'The file must be an image';
                }

                if (!in_array($fileExt, $allowed)) {
                    $errors[] = 'The photo must be a png,jpg or jpeg.';
                }
                if ($fileSize > 5000000) {
                    $errors[] = 'The file size must be under 5MB';
                }
                if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
                    $errors[] = 'File extension does not meet file';
                }
            }

    		if (!empty($errors)) {
    			echo display_errors($errors);
    		}else{                    
                move_uploaded_file($tmpLoc,$uploadPath);
                $password = password_hash($password,PASSWORD_DEFAULT);
    			$insertSql = $db->query("INSERT INTO staff(`name`,`age`,`password`,`email`,`speciality`,`permissions`,`phone`,`address`,`sex`,`image`) VALUES('$title','$age','$password','$email','$specialisation','$permissions','$phone','$address','$sex','$dbpath')");
    			$_SESSION['success_flash'] = 'Staff successfully added';
    			header('Location: staff.php');
    		}


    	}
    

?>
		
		<!--Add a new staff-->
            <div class="header">
            	<h3 class="text-center">Add a new staff</h3>
            </div>

            <form action="staff.php?add=1" method="post" enctype="multipart/form-data" >
                <div class="container-fluid">
                    <div class="row no-gutters">
                
                        <div class="col-md-5">
                        	<div class="form-group">
	                            <label for="title">Name:</label>
	                            <input type="text" name="title" class="form-control" value="<?=$title;?>">
	                        </div>
	                        <div class="form-group">
	                            <label for="email">Email:</label>
	                            <input type="email" name="email" class="form-control" value="<?=$email;?>">
	                        </div>
	                        <div class="row no-gutters">
                             <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="age">Age:</label>
                                    <input type="text" name="age" class="form-control" value="<?=$age;?>">
                                </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="Sex">Sex:</label>
                                    <select class="form-control" name="sex">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                             </div>   
                            </div>
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm password:</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>photo image:</label>
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                        	<div class="form-group">
	                            <label for="specialisation">Specialisation:</label>
	                            <input type="text" name="specialisation" class="form-control" value="<?=$specialisation;?>">
	                        </div>
	                        <div class="form-group">
	                            <label for="permissions">Permissions:</label>
	                            <select class="form-control" name="permissions">
	                            	<option value="admin,staff">Admin</option>
	                            	<option value="staff">Staff</option>
	                            	<option value="none">None</option>
	                            </select>
	                        </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" name="phone" class="form-control" value="<?=$phone;?>">
                            </div>
	                        <div class="form-group">
	                            <label for="address">Address:</label>
	                            <textarea class="form-control" rows="5" name="address"><?=$address;?></textarea>
	                        </div>
	                       <input type="submit" name="submit" class="btn btn-success float-right" value="Add staff" > 
                        </div>
                   </div> 
                </div>
            </form>

  <?php  }
  else{

    ?>
<style>
	.icon {
        color: darkred;
    }
</style>
    <div class="header">
    	<h3 class="text-center">Staff details</h3>
    	<div class="row no-gutters">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mini-navbar">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mininavbar" aria-controls="mininavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="mininavbar">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="archive.php?staff">Archives</a>
                  </li>
                  <?php if(has_permission('admin')): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="staff.php?add=1">Add a new staff</a>
                  </li>
                  <?php endif; ?>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" id="searchform" action="search.php">
                  <input class="form-control mr-sm-2" type="text" placeholder="Search a staff" name="search_query" id="search_query" >
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

              </div>
            </nav>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    <?php
    	$speciality = $db->query("SELECT DISTINCT speciality FROM staff");

    ?>
    <div class="row no-gutters details">
    	<?php
    	while($results = mysqli_fetch_assoc($speciality)): 

    			$special = $results['speciality'];
    			$sQuery = $db->query("SELECT * FROM staff WHERE speciality = '$special' AND deleted = 0");
    			    		
    				?>
    	<div class="col-md-4">
    		<div class="header"><h4 class="text-center"><?=$results['speciality'];?></h4></div>
    		<table class="table table-condensed table-bordered table-striped">
		    	<thead>
                    <th></th>
		    		<th>Name</th>
		    		<th></th>
		    	</thead>
		    	<tbody>
		    		<?php while ($sResults = mysqli_fetch_assoc($sQuery)): ?>
		    		<tr>
                        <?php if(has_permission('admin')): ?>
                        <td><a href="staff.php?delete=<?=$sResults['id'];?>"><span class="oi oi-x icon"></span></a></td>
                        <?php endif; ?>
		   				<td><?=$sResults['name'];?></td>
		   				<td><a href="details.php?detail=<?=$sResults['id'];?>" class="btn btn-sm btn-primary">Full details</a></td>
		    		</tr>
		    		<?php endwhile; ?>
		    	</tbody>
		    </table>
    	</div>    	
    	<?php endwhile;?>
    </div>

    <?php  } include 'includes/footer.php'; ?>