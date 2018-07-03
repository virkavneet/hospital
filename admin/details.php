<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';

		if (!logged_in()) {
		header('Location: login.php');
	}

	include 'includes/head.php';
	include 'includes/navbar.php';
	$dbpath ='';
	if (isset($_GET['detail'])) {
		$id = $_GET['detail'];

		$query = $db->query("SELECT * FROM staff WHERE id = '$id'");
		$staff = mysqli_fetch_assoc($query);
	}

	if (isset($_GET['edit'])) {
		$eID = (int)$_GET['edit'];
		$staffQ = $db->query("SELECT * FROM staff WHERE id = '$eID'");
		$staffResults = mysqli_fetch_assoc($staffQ);
		if (isset($_GET['delete_img'])) {
			$img_url = $_SERVER['DOCUMENT_ROOT'].$staffResults['image'];
			unlink($img_url);
			$deleteQ = $db->query("UPDATE staff SET image = '' WHERE id= '$eID'");
			header('Location: details.php?edit='.$staffResults['id']);
		}
		$name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$staffResults['name']);
		$email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$staffResults['email']);
		$age = ((isset($_POST['age']) && $_POST['age'] != '')?sanitize($_POST['age']):$staffResults['age']);
		$phone = ((isset($_POST['phone']) && $_POST['phone'] != '')?sanitize($_POST['phone']):$staffResults['phone']);
		$speciality = ((isset($_POST['speciality']) && $_POST['speciality'] != '')?sanitize($_POST['speciality']):$staffResults['speciality']);
		$address = ((isset($_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):$staffResults['address']);
		$sex = ((isset($_POST['sex']) && $_POST['sex'] != '')?sanitize($_POST['sex']):'');
		$permissions = ((isset($_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']):'');

		$image = (($staffResults['image'] != '')?$staffResults['image']:'');
		
		$errors = array();
    	if ($_POST) {

    		//Form validation
    		//If the fileds are empty
    		if (empty($name)||empty($age)||empty($email)||empty($phone)||empty($speciality)) {
    			$errors[] = 'All fileds are required to be filled';
    		}

    		//correct formats
    		if (!preg_match("/^[a-zA-z ]*$/",$name)) {
    			$errors[] = 'Only characters and whitespaces are allowed in name';
    		}

    		if (!preg_match("/^[0-9]*$/",$phone)) {
    			$errors[] = 'Invalid phone number';
    		}

    		if (!preg_match("/^[0-9]*$/",$age)) {
    			$errors[] = 'Invalid age';
    		}

    		if (!preg_match("/^[a-zA-z ]*$/",$speciality)) {
    			$errors[] = 'Specialisation does not seem correct!';
    		}

    		if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    			$errors[] = 'Invalid email';
    		}

            if (!empty($_FILES)) {
                $photo = $_FILES['photo'];
                $pname = $photo['name'];
                $nameArray = explode('.', $pname);
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
            
    			$updateSql = $db->query("UPDATE staff SET name = '$name', email = '$email', age = '$age', phone = '$phone', sex = '$sex', speciality = '$speciality', permissions = '$permissions', address = '$address', image = '$dbpath' WHERE id = '$eID'");
    			$_SESSION['success_flash'] = 'Staff successfully added';
    			header('Location: staff.php');
    		}


    	}


		?>
		<div class="header">
            	<h3 class="text-center">Edit details</h3>
            </div>

            <form action="details.php?edit=<?=$staffResults['id'];?>" method="post" enctype="multipart/form-data" >
                <div class="container-fluid">
                    <div class="row no-gutters">
                
                        <div class="col-md-5">
                        	<div class="form-group">
	                            <label for="title">Name:</label>
	                            <input type="text" name="name" class="form-control" value="<?=$name;?>">
	                        </div>
	                        <div class="form-group">
	                            <label for="email">Email:</label>
	                            <input type="email" name="email" class="form-control" value="<?=$email;?>">
	                        </div>
	                        <div class="form-group">
	                            <label for="age">Age:</label>
	                            <input type="text" name="age" class="form-control" value="<?=$age;?>">
	                        </div>
	                        <div class="form-group">
	                            <label for="Sex">Sex:</label>
	                            <select class="form-control" name="sex">
	                                <option value="Male">Male</option>
	                                <option value="Female">Female</option>
	                            </select>
	                        </div>
	                        <?php if ($image != '') { ?>
                            <div class="s-img">
                                <img src="<?=$image;?>">
                                <a href="details.php?delete_img=1&edit=<?=$staffResults['id'];?>">Delete image</a>
                            </div><?php  } else{ ?>
                            	<div class="form-group">
                            		<label>Profile image:</label>
                            		<input type="file" name="photo" class="form-control">
                            	</div>
                            <?php } ?>

                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                        	<div class="form-group">
	                            <label for="specialisation">Specialisation:</label>
	                            <input type="text" name="speciality" class="form-control" value="<?=$speciality;?>">
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
	                       <input type="submit" name="submit" class="btn btn-success float-right" value="Edit staff" > 
                        </div>
                   </div> 
                </div>
            </form>
		<?php

	} else{
?>

	<div class="header text-center">
		<img src="<?=$staff['image'];?>" style="height: 250px; width: 250px;" >
		<?php if(has_permission('admin')): ?>
		<h3><?=$staff['name'];?> <small><a href="details.php?edit=<?=$id;?>"><span class="oi oi-pencil"></span></a></small></h3>
		<?php endif; ?>
	</div>
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<table class="table table-bordered table-condensed table-striped table-sm">
				<tr>
					<th class="table-success">Age</th>
					<td><?=$staff['age'];?></td>
				</tr>
				<tr>
					<th class="table-success">Email</th>
					<td><?=$staff['email'];?></td>
				</tr>
				<tr>
					<th class="table-success">Sex</th>
					<td><?=$staff['sex'];?></td>
				</tr>
				<tr>
					<th class="table-success">Phone</th>
					<td><?=$staff['phone'];?></td>
				</tr>
				<tr>
					<th class="table-success">Specialisation</th>
					<td><?=$staff['speciality'];?></td>
				</tr>
				<tr>
					<th class="table-success">Address</th>
					<td><?=$staff['address'];?></td>
				</tr>	
					
			</table>
		</div>
		<div class="col-md-2"></div>
	</div>

<?php } include 'includes/footer.php'; ?>
