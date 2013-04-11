<html>
<head>
<?php
include("../header.php");
?>
	 <?php
	 if(!isset($_SESSION["user_id"])){
		header("location:/company/login.php");
	 }
	 else
	{	
	?>
	</head>
	<body>
		<table class="list noDatatable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Last name</th>
					<th>Day Of Birth</th>
					<th>Gender</th>
					<th>State</th>
					<th>Position</th>
					<th>Zodiac Sing</th>
				</tr>
			</thead>
			<tbody>
				<?php $colors = array("odd", "even");
				$count = 1;
				foreach (Employee::all() as $employee){
					$person= Person::find($employee->__get("person_id"));
					$zodiac= Zodiac::getSing($employee->__get("dob"));
					echo "<tr class='{$colors[$count%2]}'>
							<td>{$person->__get("name")}</td>
							<td>{$person->__get("last_name")}</td>
							<td>{$person->__get("dob")}</td>
							<td>{$person->__get("gender")}</td>
							<td>{$employee->__get("active")}</td>
							<td>{$person->__get("gender")}</td>
							<td>".Zodiac::getSing($person->__get("dob"))."</td>
						</tr>";
					$count = $count + 1;
				 } ?>
			</tbody>
		</table>
		<a class='button' href="\company\exports\social.php">Export</a>
	</body>

</html>	
<?php 
}
?>	