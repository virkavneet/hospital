<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/core/connect.php';

	unset($_SESSION['Current_Staff']);
	header('Location: login.php');

?>