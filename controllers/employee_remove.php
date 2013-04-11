<pre>
<?php
	include("../import.php");
	if(!isset($_SESSION["user_id"])){
		header("location:/company/login.php");
	}
	else
	{
		if(isset($_GET["id"])){
			$employee_id= $_GET["id"];
			$employee= Employee::find($employee_id);
			$employee->destroy();
		}
		header("location: /company/index.php");
	}	
?>
</pre>