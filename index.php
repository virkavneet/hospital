<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';
include 'includes/head.php'; ?>

<style>
	body{
		background-color: #f5f5f5;
		overflow-x: hidden;
	}
</style>

<button onclick="topFunction()" id="myBtn" title="Go to top"><span class="oi oi-arrow-top"></span></button>

<div class="index-header">
	<div class="row no-gutters">
			<div class="col-md-1 brand-logo"><a href="index.php"><img src="images/medical-logo.jpg" class="brand-logo"></a></div>
			<div class="col-md-3 brand-title">
				<h2><a href="index.php">National Institute of Medical Science</a></h2>
			</div>
	<div class="col-md-8">
		<?php include 'includes/navbar.php'; ?>
		<a href="#" class="fa fa-facebook"></a>
		<a href="#" class="fa fa-twitter"></a>
		<a href="#" class="fa fa-google"></a>
		<a href="#" class="fa fa-instagram"></a>
		<a href="#" class="fa fa-pinterest"></a>
		<a href="#" class="fa fa-yahoo"></a>
	</div>
	</div>
	<div class="header-content container-fluid">
		<div class="row no-gutters">
			<div class="col-md-4">
				<div class="header-text"><h1>We treat with love because <span style="color: #e62117;">Love</span> is the best medicine</h1></div>
			</div>
			<div class="col-md-8"></div>
		</div>
	</div>
	<div id="mySidenav" class="sidenav float-right">
  		<a href="#" data-toggle="modal" data-target="#feedback" class="feedback"><span class="oi oi-check"></span> Feedback</a>
  	</div>
</div>
<?php

$currentquery = $db->query("SELECT * FROM patient WHERE deleted = 0");
$archivequery = $db->query("SELECT * FROM patient WHERE deleted = 1");
$staffquery = $db->query("SELECT * FROM staff");

$currentCount = mysqli_num_rows($currentquery);
$archiveCount = mysqli_num_rows($archivequery);
$staffCount = mysqli_num_rows($staffquery);

?>

	<div class="achivements">
		<div class="row grid-divider no-gutters">
			<div class="col-md-4 column">
				<h1><strong><?=$currentCount;?>+</strong></h1>
				<h3>Serving patients</h3>
			</div>
			<div class="col-md-4 column">
				<h1><strong><?=$archiveCount;?>+</strong></h1>
				<h3>Served Patients</h3>
			</div>
			<div class="col-md-4">
				<h1><strong><?=$staffCount;?>+</strong></h1>
				<h3>Highly trained doctors and staff</h3>
			</div>
		</div>
	</div>

	<div class="locations-section">
		<div class="row no-gutters container-fluid">
			<div class="col-md-3">
				<div class="location-text">
					<h1><small>Happily serving at</small> <strong><span class="number">3</span></strong> <small> locations</small></h1>
				</div>
			</div>
			<div class="col-md-2"><div class="location-text">
				
			</div></div>
			<div class="col-md-5"></div>
			<div class="col-md-2"><div class="location-btn">
			<a href="locations.php" id="location-btn" class="btn btn-info btn-lg float-right"><span>See our locations</span></a>
		</div></div>
		</div>
		
	</div>

<?php
	$physicianQ = $db->query("SELECT * FROM staff WHERE speciality = 'physician'");
	$neurologistQ = $db->query("SELECT * FROM staff WHERE speciality = 'neurologist'");
	$cardiologistQ = $db->query("SELECT * FROM staff WHERE speciality = 'cardiologist'");

	$physicianCount = mysqli_num_rows($physicianQ);
	$neurologistCount = mysqli_num_rows($neurologistQ);
	$cardiologistCount = mysqli_num_rows($cardiologistQ);
?>

	<div class="achivements">
		<div class="row grid-divider no-gutters">
			<div class="col-md-4 column">
				<h1><strong><?=$physicianCount;?>+</strong></h1>
				<h3>Physicians</h3>
			</div>
			<div class="col-md-4 column">
				<h1><strong><?=$cardiologistCount;?>+</strong></h1>
				<h3>Cardiologists</h3>
			</div>
			<div class="col-md-4">
				<h1><strong><?=$neurologistCount;?>+</strong></h1>
				<h3>Neurologists</h3>
			</div>
		</div>
	</div>

	<div class="contact-form">
		<div class="inner-form">
			<form>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" name="name" class="form-control">
						</div>
						<label class="container">Do you want to sign up for the daily newsletter:
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="feed">Query/Feedback:</label>
							<textarea rows="6" class="form-control" placeholder="Write your query or feedback"></textarea>
						</div>
						<button class="btn btn-lg btn-warning">Send</button>
					</div>		
					<div class="col-md-2"></div>
				</div>
			</form>
		</div>
	</div>

	<!-- Modal -->
		  <div class="modal fade" id="feedback" role="dialog">
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-body">
		          <div class="rb-box">

					  <!-- Radio Button Module -->
					  <p>1. Rate our website:</p>
					  <div id="rb-1" class="rb">
					    <div class="rb-tab" data-value="1">
					      <div class="rb-spot">
					        <span class="rb-txt">1</span>
					      </div>
					    </div><div class="rb-tab" data-value="2">
					      <div class="rb-spot">
					        <span class="rb-txt">2</span>
					      </div>
					    </div><div class="rb-tab" data-value="3">
					      <div class="rb-spot">
					        <span class="rb-txt">3</span>
					      </div>
					    </div><div class="rb-tab" data-value="4">
					      <div class="rb-spot">
					        <span class="rb-txt">4</span>
					      </div>
					    </div><div class="rb-tab" data-value="5">
					      <div class="rb-spot">
					        <span class="rb-txt">5</span>
					      </div>
					    </div>
					  </div>

					  <!-- Radio Button Module -->
					  <p>2. Rate our staff:</p>
					  <div id="rb-2" class="rb">
					    <div class="rb-tab" data-value="1">
					      <div class="rb-spot">
					        <span class="rb-txt">1</span>
					      </div>
					    </div><div class="rb-tab" data-value="2">
					      <div class="rb-spot">
					        <span class="rb-txt">2</span>
					      </div>
					    </div><div class="rb-tab" data-value="3">
					      <div class="rb-spot">
					        <span class="rb-txt">3</span>
					      </div>
					    </div><div class="rb-tab" data-value="4">
					      <div class="rb-spot">
					        <span class="rb-txt">4</span>
					      </div>
					    </div><div class="rb-tab" data-value="5">
					      <div class="rb-spot">
					        <span class="rb-txt">5</span>
					      </div>
					    </div>
					  </div>

					  <!-- Radio Button Module -->
					  <p>3. Rate our medical facilities:</p>
					  <div id="rb-3" class="rb">
					    <div class="rb-tab" data-value="1">
					      <div class="rb-spot">
					        <span class="rb-txt">1</span>
					      </div>
					    </div><div class="rb-tab" data-value="2">
					      <div class="rb-spot">
					        <span class="rb-txt">2</span>
					      </div>
					    </div><div class="rb-tab" data-value="3">
					      <div class="rb-spot">
					        <span class="rb-txt">3</span>
					      </div>
					    </div><div class="rb-tab" data-value="4">
					      <div class="rb-spot">
					        <span class="rb-txt">4</span>
					      </div>
					    </div><div class="rb-tab" data-value="5">
					      <div class="rb-spot">
					        <span class="rb-txt">5</span>
					      </div>
					    </div>
					  </div>

					  <!-- Radio Button Module -->
					  <p>4. Rate our resonse:</p>
					  <div id="rb-4" class="rb">
					    <div class="rb-tab" data-value="1">
					      <div class="rb-spot">
					        <span class="rb-txt">Extremly fast</span>
					      </div>
					    </div><div class="rb-tab" data-value="2">
					      <div class="rb-spot">
					        <span class="rb-txt">Super fast</span>
					      </div>
					    </div><div class="rb-tab" data-value="3">
					      <div class="rb-spot">
					        <span class="rb-txt">Fast</span>
					      </div>
					    </div><div class="rb-tab" data-value="4">
					      <div class="rb-spot">
					        <span class="rb-txt">Slow</span>
					      </div>
					    </div><div class="rb-tab" data-value="5">
					      <div class="rb-spot">
					        <span class="rb-txt">Super slow</span>
					      </div>
					    </div>
					  </div>

					  <!-- Radio Button Module -->
					  <p>5. Rate our appointment system:</p>
					  <div id="rb-5" class="rb">
					    <div class="rb-tab" data-value="4">
					      <div class="rb-spot">
					        <span class="rb-txt">1</span>
					      </div>
					    </div><div class="rb-tab" data-value="2">
					      <div class="rb-spot">
					        <span class="rb-txt">2</span>
					      </div>
					    </div><div class="rb-tab" data-value="5">
					      <div class="rb-spot">
					        <span class="rb-txt">3</span>
					      </div>
					    </div><div class="rb-tab" data-value="1">
					      <div class="rb-spot">
					        <span class="rb-txt">4</span>
					      </div>
					    </div><div class="rb-tab" data-value="3">
					      <div class="rb-spot">
					        <span class="rb-txt">5</span>
					      </div>
					    </div>
					  </div>

					  <!-- Button -->
					  <div class="button-box">
					    <button class="button trigger">Submit!</button>
					    <button class="button" data-dismiss="modal">Close</button>
					  </div>

					</div>
		        </div>
		      </div>
		    </div>
		  </div>

<script>
		var survey = []; //Bidimensional array: [ [1,3], [2,4] ]

		//Switcher function:
		$(".rb-tab").click(function(){
		  //Spot switcher:
		  $(this).parent().find(".rb-tab").removeClass("rb-tab-active");
		  $(this).addClass("rb-tab-active");
		});

		//Save data:
		$(".trigger").click(function(){
		  //Empty array:
		  survey = [];
		  //Push data:
		  for (i=1; i<=$(".rb").length; i++) {
		    var rb = "rb" + i;
		    var rbValue = parseInt($("#rb-"+i).find(".rb-tab-active").attr("data-value"));
		    //Bidimensional array push:
		    survey.push([i, rbValue]); //Bidimensional array: [ [1,3], [2,4] ]
		  };
		  //Debug:
		  debug();
		});

		//Debug:
		function debug(){
		  alert("Thankyou for the feedback");

				};

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}


</script>
<?php include 'includes/footer.php'; ?>

