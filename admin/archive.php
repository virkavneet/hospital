  <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';
    
        if (!logged_in()) {
        header('Location: login.php');
    }

    include 'includes/head.php';
    include 'includes/navbar.php';

//Add staff back to present staff list
    if (isset($_GET['staffback'])) {
        $staff_id = $_GET['staffback'];

        $db->query("UPDATE staff SET deleted = 0 WHERE id = '$staff_id'");
        header('Location: staff.php');
    }


//Add back to the current patient list

    if (isset($_GET['addback'])) {
    	$id = sanitize($_GET['addback']);
    	$db->query("UPDATE patient SET deleted = 0 WHERE id = '$id'");
    	header("Location: archive.php");
    }

    if (isset($_GET['drugs'])) {
        ?>
            <div class="header text-center"><h3>Archived drugs</h3></div>
            <div class="row no-gutters">
                <div class="col-md-5"></div>
                <div class="col-md-3">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light mini-navbar">
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mininavbar" aria-controls="mininavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="mininavbar">
                        <form class="form-inline my-2 my-lg-0" method="post" id="searchform" action="search.php">
                          <input class="form-control mr-sm-2" type="text" placeholder="Search a staff" name="search_query" id="search_query" >
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>

                      </div>
                    </nav>
                </div>
                <div class="col-md-4"></div>
            </div>
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                    <th>Sr.No.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php 
                        $drugQ = $db->query("SELECT * FROM drugs WHERE deleted = 1");
                    while($drugs = mysqli_fetch_assoc($drugQ)): ?>
                    <tr>
                        <td><?=$drugQ['sr'];?></td>
                        <td><?=$drugQ['name'];?></td>
                        <td><?=$drugQ['price'];?></td>
                        <td><?=$drugQ['quantity'];?></td>
                        <td><?=$drugQ['description'];?></td>
                        <td><a href="archive.php?drug_back=<?=$drugQ['id'];?>"></a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php
    }
  
    elseif (isset($_GET['staff'])) {
        ?>
            <div class="header">
                <h3 class="text-center">Archived staff details</h3>
                <div class="row no-gutters">
                <div class="col-md-5"></div>
                <div class="col-md-3">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light mini-navbar">
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mininavbar" aria-controls="mininavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="mininavbar">
                        <form class="form-inline my-2 my-lg-0" method="post" id="searchform" action="search.php">
                          <input class="form-control mr-sm-2" type="text" placeholder="Search a staff" name="search_query" id="search_query" >
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>

                      </div>
                    </nav>
                </div>
                <div class="col-md-4"></div>
                </div>
            </div>
            <?php
                $speciality = $db->query("SELECT DISTINCT speciality FROM staff");

            ?>
            <div class="row no-gutters details">
                <?php
                while($results = mysqli_fetch_assoc($speciality)): 

                        $special = $results['speciality'];
                        $sQuery = $db->query("SELECT * FROM staff WHERE speciality = '$special' AND deleted = 1");
                                    
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
                                <td><a href="archive.php?staffback=<?=$sResults['id'];?>" class="btn btn-light"><span class="oi oi-plus"></span></a></td>
                                <td><?=$sResults['name'];?></td>
                                <td><a href="details.php?detail=<?=$sResults['id'];?>" class="btn btn-sm btn-primary">Full details</a></td>                
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>      
                <?php endwhile;?>
            </div>
        <?php
    }
        else{
    ?>

   <div class="header">
   		<h3 class="text-center">Archives</h3>
   		<div class="row no-gutters">
        <div class="col-md-5"></div>
        <div class="col-md-3">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mini-navbar">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mininavbar" aria-controls="mininavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="mininavbar">
                <form class="form-inline my-2 my-lg-0" action="search.php" method="post">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search a patient" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
              </div>
            </nav>
        </div>
        <div class="col-md-4"></div>
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
        <th>Discharged on</th>

        
    </thead>
    <tbody>
        <?php
                $query = $db->query("SELECT * FROM patient WHERE deleted = 1");
                
            while($patient = mysqli_fetch_assoc($query)):
            ?>

        <tr>
            <td><a href="archive.php?addback=<?=$patient['id'];?>" class="btn btn-xs btn-default"><span class="oi oi-plus"></span></a></td>
            <td><?=$patient['token'];?></td>
            <td><?=$patient['name'];?></td>
            <td><?=$patient['dob'];?></td>
            <td><?=$patient['phone'];?></td>
            <td><?=$patient['address'];?></td>
            <td><?=$patient['sex'];?></td>
            <td><?=$patient['doa'];?></td>
            <td><?=$patient['ward'];?></td>
            <td><?=$patient['discharge'];?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

    <?php } include 'includes/footer.php' ?>