		
<?php	
	//echo "<link rel='stylesheet' type='text/css' href='style.css'/>";
	//echo "<script type='text/javascript' src='js/base.js'></script>";
	include("import.php");
?>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="/company/css/style.css" />
        <script type="text/javascript" src="/company/js/jquery.js"></script>
        <script type="text/javascript" src="/company/js/jqueryui.js"></script>
        <script type="text/javascript" src="/company/js/datatable.js"></script>
        <script type="text/javascript" src="/company/js/base.js"></script>
		<title>company</title>
		<?php 
			if(isset($_SESSION["user_id"])){
				echo
					 "<a href='/company/controllers/logout.php' id='logout'>Sing Out</a>";
			}
		?>
		</head>
	<body>
		<output>
				<?php if(isset($_SESSION["user_id"])){?>
				<menu>
					<ul>
						<li><a href="/company/user_dashboard.php">User List</a></li>
						<li><a href="/company/forms/user_form.php">User Form</a></li>
						<li><a href="/company/index.php">Employee List</a></li>
						<li><a href="/company/forms/employee_form.php">Employee Form</a></li>
						<li><a href="/company/reports/payroll.php">Payroll</a></li>
						<li><a href="/company/reports/social.php">Social</a></li>
					</ul>
				</menu>
	 			<?php } ?>
		