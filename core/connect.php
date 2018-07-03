<?php

$db = mysqli_connect("localhost","root","","hms");

require_once $_SERVER['DOCUMENT_ROOT'].'/hospital/config.php';
require_once BASEURL.'helpers.php';

session_start();

if (isset($_SESSION['Current_Staff'])) {
	$user_id = $_SESSION['Current_Staff'];
	$query = $db->query("SELECT * FROM staff WHERE id = '$user_id'");
	$user_data = mysqli_fetch_assoc($query);
	$fn = explode(' ',$user_data['name']);
	$user_data['first'] = $fn[0];
	$user_data['last'] = $fn[1];

}


if (isset($_SESSION['success_flash'])) {
	echo '<div class="alert alert-success text-center" role="alert">'.$_SESSION['success_flash'].'</div>';
	unset($_SESSION['success_flash']);
}

if (isset($_SESSION['error_flash'])) {
	echo '<div class="alert alert-danger text-center" role="alert">'.$_SESSION['error_flash'].'</div>';
	unset($_SESSION['error_flash']);
}