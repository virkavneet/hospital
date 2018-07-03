<?php

function display_errors($errors){
	$display = '<div class="alert alert-danger">';
	foreach ($errors as $error) {
		$display .= '<div class="text-danger">'.$error.'</div>';
	}
	$display .= '</div>';
	return $display;
}

function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function check_email($username){
	if (filter_var($username,FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	else{
		return false;
	}		
}

function login($staff_id){
	$_SESSION['Current_Staff'] = $staff_id;
	global $db;
	$date = date("Y:m:d H:i:s");
	$db->query("UPDATE staff SET last_login = '$date' WHERE id = '$staff_id'");
	$_SESSION['success_flash'] = 'You are now logged in';
	header('Location: index.php');
}

function logged_in(){
	if (isset($_SESSION['Current_Staff']) && $_SESSION['Current_Staff'] > 0) {
		return true;
	}
	else {
		return false;
	}
}

function has_permission($permission = 'admin'){
	global $user_data;
	$permissions = explode(',', $user_data['permissions']);
	if (in_array($permission,$permissions,true)) {
		return true;
	}
	return false;
}
