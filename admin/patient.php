
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';

    if (!logged_in()) {
        header('Location: login.php');
    }
    
    include 'includes/head.php';
    include 'includes/navbar.php';


// Delete patient from list

    if (isset($_GET['delete'])) {
        $id = sanitize($_GET['delete']);
        $discharge = date("Y-m-d");
        $db->query("UPDATE patient SET deleted = 1 WHERE id = '$id'");
        $query = $db->query("SELECT * FROM patient WHERE id = '$id'");
        $results = mysqli_fetch_assoc($query);
        (($results['discharge'] == '')?$db->query("INSERT INTO patient SET discharge = '$discharge' WHERE id = '$id'"):$db->query("UPDATE patient SET discharge = '$discharge' WHERE id = '$id'"));
        header('Location: patient.php');
    }

   // Adding a new patient 

    if (isset($_GET['edit']) || isset($_GET['add'])) {
        $pQuery = $db->query("SELECT * FROM patient");
        $token = randomString();
        $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):'');
        $dob = ((isset($_POST['dob']) && $_POST['dob'] != '')?sanitize($_POST['dob']):'');
        $phone = ((isset($_POST['phone']) && $_POST['phone'] != '')?sanitize($_POST['phone']):'');
        $address = ((isset($_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):'');
        $sex = ((isset($_POST['sex']) && $_POST['sex'] != '')?sanitize($_POST['sex']):'');
        $doa = ((isset($_POST['doa']) && $_POST['doa'] != '')?sanitize($_POST['doa']):'');
        $ward = ((isset($_POST['ward']) && $_POST['ward'] != '')?sanitize($_POST['ward']):'');

        if (isset($_GET['edit'])) {
           $editId = sanitize($_GET['edit']);
           $pResults = $db->query("SELECT * FROM patient WHERE id = '$editId'");
           $patient = mysqli_fetch_assoc($pResults);

           $token = $patient['token'];
           $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$patient['name']);
           $dob = ((isset($_POST['dob']) && $_POST['dob'] != '')?sanitize($_POST['dob']):$patient['dob']);
           $phone = ((isset($_POST['phone']) && $_POST['phone'] != '')?sanitize($_POST['phone']):$patient['phone']);
           $address = ((isset($_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):$patient['address']);
           $sex = ((isset($_POST['sex']) && $_POST['sex'] != '')?sanitize($_POST['sex']):$patient['sex']);
           $doa = ((isset($_POST['doa']) && $_POST['doa'] != '')?sanitize($_POST['doa']):$patient['doa']);
           $ward = ((isset($_POST['ward']) && $_POST['ward'] != '')?sanitize($_POST['ward']):$patient['ward']);

        }

        if ($_POST) {
            $errors = array();

            if (empty($token)||empty($name)||empty($dob)||empty($phone)||empty($address)||empty($sex)||empty($doa)||empty($ward)) {
                $errors[] = 'All fields are required to be filled!';
            }

            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                  $errors[] = 'Invalid name!'; 
                }

            if (!preg_match("/^[a-zA-Z0-9]*$/",$token)) {
                  $errors[] = 'Invalid token!'; 
                } 

            if (!preg_match("/^[a-zA-Z0-9]*$/",$ward)) {
                  $errors[] = 'Invalid ward details!'; 
                }        

            if (!empty($errors)) {
                    echo display_errors($errors);
                }
              else{
                // Insert data into database
                $insertQ = "INSERT INTO patient(token, name, dob, phone, address, sex, doa, ward) VALUES('$token','$name','$dob','$phone','$address','$sex','$doa','$ward')";
                if (isset($_GET['edit'])) {
                     $insertQ = "UPDATE patient SET token = '$token',name = '$name',dob = '$dob',phone = '$phone',address = '$address',sex = '$sex',doa = '$doa',ward = '$ward' WHERE id = '$editId'";
                }
                $db->query($insertQ);
                header("Location: patient.php");
              }      

        }

        ?>
            <!--Add/Edit a new product-->
            <h3 class="text-center"><?=((isset($_GET['edit']))?'Edit patient details':'Add a new patient');?></h3>

            <form action="patient.php?<?=((isset($_GET['edit']))?'edit='.$editId:'add=1');?>" method="post">
                <div class="container-fluid">
                    <div class="row no-gutters">
                   <div class="col-md-5">
                    
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="<?=$name;?>">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of birth:</label>
                            <input type="date" name="dob" class="form-control" value="<?=$dob;?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" class="form-control" value="<?=$phone;?>">
                        </div>
                        <div class="form-group">
                            <label for="Sex">Sex:</label>
                            <select class="form-control" name="sex" value="<?=$sex;?>">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                   </div>
                   <div class="col-md-1"></div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Admitted on:</label>
                            <input type="date" name="doa" class="form-control" value="<?=$doa;?>">
                        </div>
                        <div class="form-group">
                            <label for="ward">Ward:</label>
                            <input type="text" name="ward" class="form-control" value="<?=$ward;?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" rows="5" name="address" ><?=$address;?></textarea>
                        </div>
                       <input type="submit" name="submit" class="btn btn-<?=((isset($_GET['edit']))?'success':'primary');?> float-right" value="<?=((isset($_GET['edit']))?'Save':'Add');?>" > 
                   </div> 
                </div>
             
                </div>
            </form>
    <?php
    }
    else{


    ?>



<div class="header">
    <h3 class="text-center">Patient's details</h3>
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
                    <a class="nav-link" href="archive.php?patient">Archives</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="patient.php?add=1">Add a new patient</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" id="searchform" action="search.php">
                  <input class="form-control mr-sm-2" type="text" placeholder="Search a patient" name="search_query" id="search_query" >
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

              </div>
            </nav>
        </div>
        <div class="col-md-3"></div>
    </div>
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
                $query = $db->query("SELECT * FROM patient WHERE deleted = 0");
                
            while($patient = mysqli_fetch_assoc($query)):
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

<?php } include 'includes/footer.php'; ?>