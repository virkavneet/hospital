<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';

	if (!logged_in()) {
		header('Location: login.php');
	}

	include 'includes/head.php';
	include 'includes/navbar.php';




// DELETE the Drug
if (isset($_GET['delete'])) {
	$deleteId = $_GET['delete'];

	$db->query("UPDATE drugs SET deleted = 1 WHERE id = '$deleteId'");
	header('Location: drugs.php');
}

//ADD and Edit drug
if (isset($_GET['add']) || isset($_GET['edit'])) {

	$sr = ((isset($_POST['sr']) && $_POST['sr']!= '')?sanitize($_POST['sr']):'');
	$name = ((isset($_POST['name']) && $_POST['name']!= '')?sanitize($_POST['name']):'');
	$price = ((isset($_POST['price']) && $_POST['price']!= '')?sanitize($_POST['price']):'');
	$quantity = ((isset($_POST['quantity']) && $_POST['quantity']!= '')?sanitize($_POST['quantity']):'');
	$description = ((isset($_POST['description']) && $_POST['description']!= '')?sanitize($_POST['description']):'');
	$dosage = ((isset($_POST['dosage']) && $_POST['dosage']!= '')?sanitize($_POST['dosage']):'');
	$precautions = ((isset($_POST['precautions']) && $_POST['precautions']!= '')?sanitize($_POST['precautions']):'');
	$errors = array();

	if (isset($_GET['edit'])) {
		$editId = $_GET['edit'];
		$editQ = $db->query("SELECT * FROM drugs WHERE id= '$editId'");

		$eDrugs = mysqli_fetch_assoc($editQ);

		$sr = ((isset($_POST['sr']) && $_POST['sr']!= '')?sanitize($_POST['sr']):$eDrugs['sr']);
		$name = ((isset($_POST['name']) && $_POST['name']!= '')?sanitize($_POST['name']):$eDrugs['name']);
		$price = ((isset($_POST['price']) && $_POST['price']!= '')?sanitize($_POST['price']):$eDrugs['price']);
		$quantity = ((isset($_POST['quantity']) && $_POST['quantity']!= '')?sanitize($_POST['quantity']):$eDrugs['quantity']);
		$description = ((isset($_POST['description']) && $_POST['description']!= '')?sanitize($_POST['description']):$eDrugs['description']);
		$dosage = ((isset($_POST['dosage']) && $_POST['dosage']!= '')?sanitize($_POST['dosage']):$eDrugs['dosage']);
		$precautions = ((isset($_POST['precautions']) && $_POST['precautions']!= '')?sanitize($_POST['precautions']):$eDrugs['precautions']);

	}

	if ($_POST) {
		//Form Validations
		if (empty($_POST['sr']) || empty($_POST['name']) || empty($_POST['price']) || empty($_POST['quantity'])) {
			$errors[] = 'All fields are required';
		}

		if (!empty($errors)) {
			echo display_errors($errors);
		}
		else{

			$insertQ = "INSERT INTO drugs(name,sr,price,quantity,description,dosage,precautions) VALUES('$name','$sr','$price','$quantity','$description','$dosage','$precautions')";
			if (isset($_GET['edit'])) {
				$insertQ = "UPDATE drugs SET name = '$name', sr = '$sr', price = '$price', quantity = '$quantity', description = '$description', dosage = '$dosage', precautions = '$precautions'";
			}
			
			$db->query($insertQ);
			header('Location: drugs.php');
		}

	
	}

	
	?>
	<style>
		input[type="text"],input[type="number"], select{
			padding: 4px 8px;
		}
		.add-form{
			font-size: 15px;
			font-weight: bolder;
		}
	</style>
	<div class="header text-center"><h3>Add a new drug</h3></div>
			<form action="drugs.php?<?=((isset($_GET['add']))?'add=1':'edit=$editId');?>" method="post">
				<div class="container-fluid">
					<div class="row no-gutters">
						<div class="col-md-5">
							<div class="form-group">
								<label for="sr">Sr.No.:</label>
								<input type="text" name="sr" class="form-control" value="<?=$sr;?>">
							</div>
							<div class="form-group">
								<label for="name">Name:</label>
								<input type="text" name="name" class="form-control" value="<?=$name;?>">
							</div>
							<div class="form-group">
								<label for="price">Price(per unit):</label>
								<input type="number" name="price" class="form-control" value="<?=$price;?>" min="0">
							</div>
							<div class="form-group">
								<label for="quantity">Quantity:</label>
								<input type="number" name="quantity" class="form-control" min="0" value="<?=$quantity;?>">
							</div>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="description">Description:</label>
								<textarea name="description" class="form-control" rows="3"><?=$description;?></textarea>
							</div>
							<div class="form-group">
								<label for="dosage">Dosage:</label>
								<textarea class="form-control" name="dosage" rows="3"><?=$dosage;?></textarea>
							</div>
							<div class="form-group">
								<label for="precautions">Precautions:</label>
								<textarea class="form-control" name="precautions" rows="3"><?=$precautions;?></textarea>
							</div>
							<div class="float-right">
								<a href="drugs.php" class="btn btn-sm btn-default">Cancel</a>
								<input type="submit" value="<?=((isset($_GET['add']))?'Add ':'Edit ');?> drug" class="btn btn-sm btn-primary">
							</div>
						</div>
					</div>
				</div>
			</form>
	<?php

}

//Sell a drug
elseif (isset($_GET['sell'])) {
	$sellId = $_GET['sell'];
	$Iquery = $db->query("SELECT * FROM drugs WHERE id = '$sellId'");
	$info = mysqli_fetch_assoc($Iquery);

		$sr = ((isset($_POST['sr']) && $_POST['sr']!= '')?sanitize($_POST['sr']):$info['sr']);
		$name = ((isset($_POST['name']) && $_POST['name']!= '')?sanitize($_POST['name']):$info['name']);
		$price = ((isset($_POST['price']) && $_POST['price']!= '')?sanitize($_POST['price']):$info['price']);
		$description = ((isset($_POST['description']) && $_POST['description']!= '')?sanitize($_POST['description']):$info['description']);
		$dosage = ((isset($_POST['dosage']) && $_POST['dosage']!= '')?sanitize($_POST['dosage']):$info['dosage']);
		$precautions = ((isset($_POST['precautions']) && $_POST['precautions']!= '')?sanitize($_POST['precautions']):$info['precautions']);
		$quantity = ((isset($_POST['quantity']) && $_POST['quantity']!= '')?sanitize($_POST['quantity']):'');
		$buyer = ((isset($_POST['buyer']) && $_POST['buyer']!= '')?sanitize($_POST['buyer']):'');
		$phone = ((isset($_POST['phone']) && $_POST['phone']!= '')?sanitize($_POST['phone']):'');
		$address = ((isset($_POST['address']) && $_POST['address']!= '')?sanitize($_POST['address']):'');
		$seller = ((isset($_POST['seller']) && $_POST['seller']!= '')?sanitize($_POST['seller']):'');
		$transid = randomString();
		$errors = array();
		if ($_POST) {

			$full_price = $price * $quantity;
			//Validations
			if (empty($quantity) || empty($buyer) ||empty($seller) ||empty($phone) ||empty($address) ) {
				$errors[] = 'All fields are required to be filled';
			}

			if (!empty($errors)) {
				echo display_errors($errors);
			}
			else{
				$transaction = $db->query("INSERT INTO transactions(name,sr,price,quantity,description,dosage,precautions,seller,buyer,phone,address,transid) VALUES('$name','$sr','$full_price','$quantity','$description','$dosage','$precautions','$seller','$buyer','$phone','$address','$transid')");

				if ($transaction) {
					header('Location: bill.php?trans='.$transid);
				}else{
					echo "Error";
				}
			}
		}

	?>

	<div class="header"><h3 class="text-center">Sell <?=$info['name'];?></h3></div>
				<form action="drugs.php?sell=<?=$sellId;?>" method="post">
					<div class="container-fluid">
						<div class="row no-gutters">
							<div class="col-md-3">
								<div class="form-group">
									<label for="buyer">Buyer:</label>
									<input type="text" name="buyer" class="form-control">
								</div>
								<div class="form-group">
									<label for="phone">Phone:</label>
									<input type="tel" name="phone" class="form-control">
								</div>
								<div class="form-group">
									<label for="address">Address:</label>
									<textarea name="address" class="form-control" rows="2"></textarea>
								</div>
								<div class="form-group">
									<label for="seller">Selling staff:</label>
									<input type="text" name="seller" class="form-control" value="">
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="sr">Sr.No.:</label>
									<input type="text" name="sr" class="form-control" value="<?=$info['sr'];?>" readonly>
								</div>
								<div class="form-group">
									<label for="name">Name:</label>
									<input type="text" name="name" class="form-control" value="<?=$info['name'];?>" readonly>
								</div>
								<div class="form-group">
									<label for="price">Price(per unit):</label>
									<input type="number" name="price" class="form-control" value="<?=$info['price'];?>" readonly>
								</div>
								<div class="form-group">
									<label for="quantity">Quantity:</label>
									<input type="number" name="quantity" class="form-control" min="0">
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="description">Description:</label>
									<textarea name="description" class="form-control" rows="3" readonly><?=$info['description'];?></textarea>
								</div>
								<div class="form-group">
									<label for="dosage">Dosage:</label>
									<textarea class="form-control" name="dosage" rows="3" readonly><?=$info['dosage'];?></textarea>
								</div>
								<div class="form-group">
									<label for="precautions">Precautions:</label>
									<textarea class="form-control" name="precautions" rows="3" readonly><?=$info['precautions'];?></textarea>
								</div>
								
								<div class="float-right">
									<a href="drugs.php" class="btn btn-sm btn-default">Cancel</a>
									<input type="submit" value="Sell" class="btn btn-sm btn-danger">
								</div>
							</div>
						</div>
					</div>
				</form>
	 <?php
}

else{

?>
<div class="header text-center">
	<h1>Drugs details</h1>
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
                    <a class="nav-link" href="archive.php?drugs">Archives</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="drugs.php?add=1">Add a new drug</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" id="searchform" action="search.php?drugs">
                  <input class="form-control mr-sm-2" type="text" placeholder="Search a patient" name="search_query" id="search_query" >
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

              </div>
            </nav>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php

$dQuery = $db->query("SELECT * FROM drugs WHERE deleted = 0");

?>
<style>
	.modal-body p{
		font-size: 15px;
	}

	.modal-content {
		background-image: url("../images/hearth-1674896_1280.png");
		background-size: cover;
		background-repeat: no-repeat;
		border-radius: 0;
	}

</style>
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<th></th>
		<th></th>
		<th>Sr-No.</th>
		<th>Name</th>
		<th>Price(per unit)</th>
		<th>Quantity</th>
		<th>Description</th>
		<th></th>
	</thead>
	<tbody>
		<?php while($drugs = mysqli_fetch_assoc($dQuery)): ?>
		<tr>
			<td><a href="drugs.php?edit=<?=$drugs['id'];?>"><span class="oi oi-pencil"></span></a></td>
			<td><a href="drugs.php?delete=<?=$drugs['id'];?>"><span class="oi oi-x"></span></a></td>
			<td><?=$drugs['sr'];?></td>
			<td><?=$drugs['name'];?></td>
			<td>Rs.<b><?=$drugs['price'];?></b></td>
			<td><?=$drugs['quantity'];?></td>
			<td><button data-toggle="modal" data-target="#<?=$drugs['id'];?>" class="btn btn-sm btn-info">Description</button></td>
			<td><a href="drugs.php?sell=<?=$drugs['id'];?>" class="btn btn-sm btn-success">Sell</a></td>
		</tr>
		 <!-- Modal -->
		  <div class="modal fade" id="<?=$drugs['id'];?>" role="dialog">
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-body">
		          <h3><?=$drugs['name'];?></h3>
		          <hr>
		          <h5>Description:</h5>
		          <p><?php echo nl2br($drugs['description']);?></p>
		          <h5>Dosage:</h5>
		          <p><?php echo nl2br($drugs['dosage']);?></p>
		          <h5>Precautions:</h5>
		          <p><?php echo nl2br($drugs['precautions']);?></p>
		        </div>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>

		<?php endwhile; ?>
	</tbody>
</table>

 


<?php } include 'includes/footer.php'; ?>