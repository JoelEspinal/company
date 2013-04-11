<?php
	include("../import.php");	

	$user_id= User::autenticate($_POST["user_name"], $_POST["password"]);
	if($user_id == 0){
		session_destroy();
		header("Location:../login.php");
	}
	
	$_SESSION["user_id"]= $user_id;
	$user= User::find($user_id);
	$url= ($user->admin())? "/company/": "/company/forms/employee_form.php?{$user->__get("employee_id")}";
	header("Location:".$url);
?>