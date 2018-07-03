<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';

	if (!logged_in()) {
		header('Location: login.php');
	}

include 'includes/head.php';

$transid = $_GET['trans'];

$query = $db->query("SELECT * FROM transactions WHERE transid = '$transid'");

$bill = mysqli_fetch_assoc($query);
?>

<div class="header">
	<div class="row no-gutters">
		<div class="col-md-1"></div>
		<div class="col-md-1 brand-logo"><a href="index.php"><img src="../images/medical-logo.jpg" class="brand-logo"></a></div>
		<div class="col-md-8 brand-title">
			<h2><a href="index.php">National Institute of Medical Science</a></h2>
		</div>
		<div class="col-md-1">
			<button class="btn btn-primary btn-sm float-right" onclick="window.print()">Print</button>
		</div>
		<div class="col-md-1 float-right">
			<a href="drugs.php" class="btn btn-default btn-sm">Go back</a>
		</div>
	</div>
</div>
<div class="row no-gutters">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="bill-details container-fluid">
			<table class="table table-bordered table-sm">
				<tbody>
					<tr>
						<thead>
							<th>Sr.No.</th>
							<th>Drug name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Sold on</th>
						</thead>
						<tbody>
							<td><?=$bill['sr'];?></td>
							<td><?=$bill['name'];?></td>
							<td class="table-success">Rs.<strong><?=$bill['price'];?></strong></td>
							<td><?=$bill['quantity'];?></td>
							<td><?=$bill['sell_date'];?></td>
						</tbody>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-sm">
				<tbody>		
					<tr>
						<thead>
							<th>Selling staff</th>
							<th>Buyer</th>
							<th>Buyer's phone</th>
							<th>Buyer's address</th>
						</thead>
						<tbody>
							<td><?=$bill['seller'];?></td>
							<td><?=$bill['buyer'];?></td>
							<td><?=$bill['phone'];?></td>
							<td><?=$bill['address'];?></td>
						</tbody>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-sm">
				<tbody>				
					<tr>
						<thead>
							<th>Description</th>
							<th>Dosage</th>
							<th>Precautions</th>
						</thead>
						<tbody>
							<td><?=$bill['description'];?></td>
							<td><?=$bill['dosage'];?></td>
							<td><?=$bill['precautions'];?></td>
						</tbody>
					</tr>
				</tbody>
			</table>
		</div>	
	</div>
	<div class="col-md-1"></div>
</div>


<?php  include 'includes/footer.php'; ?>