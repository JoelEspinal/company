<html>
	<head>		
	<?php 
		include("../import.php");
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
		<?php 
			header('Content-type: application/vnd.ms-excel');
			header("Content-Disposition: attachment; filename=Payroll Report.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
		?>
		<table>
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
				<?php foreach (Employee::all() as $employee){
				 $person= Person::find($employee->__get("person_id"));
					echo "<tr>
							<td>{$person->__get("id")}</td>
							<td>{$person->__get("name")}</td>
							<td>{$person->__get("last_name")}</td>
							<td>{$employee->__get("salary")}</td>
							<td>{$employee->__get("afp")}</td>
							<td>{$employee->__get("sca")}</td>
							<td>{$employee->__get("isr")}</td>
						</tr>";
				 } ?>
			</tbody>
		</table>
	</body>
</html>	
<?php 
}
?>	