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
					<th>ID</th>
					<th>Name</th>
					<th>Last name</th>
					<th>Net Salary</th>
					<th>AFP</th>
					<th>family health insurance</th>
					<th>income tax</th>
				</tr>
			</thead>
			<tbody>
				<?php $colors = array("odd", "even");
				$count = 1;
				foreach (Employee::all() as $employee){
					$person= Person::find($employee->__get("person_id"));
					echo "<tr class='{$colors[$count%2]}'>
							<td>{$person->__get("id")}</td>
							<td>{$person->__get("name")}</td>
							<td>{$person->__get("last_name")}</td>
							<td>{$employee->__get("salary")}</td>
							<td>{$employee->__get("afp")}</td>
							<td>{$employee->__get("sca")}</td>
							<td>{$employee->__get("isr")}</td>
						</tr>";
					$count = $count + 1;
				 } ?>
			</tbody>
		</table>
		<a class='button' href="/company/exports/payroll.php">Export</a>
	</body>

</html>	
<?php 
}
?>	