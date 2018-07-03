<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';
	
	if (!logged_in()) {
		header('Location: login.php');
	}

	include 'includes/head.php';
	include 'includes/navbar.php';
?>



<?php include 'includes/footer.php'; ?>
	
