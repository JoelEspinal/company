<pre>
<?php 
	include("../import.php");
	if(!isset($_SESSION["user_id"])){
		header("location:/company/login.php");
	}
	else
	{
		print_r($_POST);
		$user= new User($_POST["email"], $_POST["password"], isset($_POST["employee_id"])? $_POST["employee_id"]: 0 , isset($_POST["id"])? $_POST["id"]: 0 );
		$user->save();
	}
?>
</pre>