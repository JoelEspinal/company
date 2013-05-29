<html>
<head>
	<?php 
		include("header.php");
	?>	
</head>
<body>
	<table class="list">
		<thead>
			<th>Employee</th>
			<th>active</th>	
			<th></th>		
		</thead>
		<tbody>
			<?php
				foreach (Employee::all() as $employee) {
					$active= ($employee->__get("active")) == 1? "Active" : "No";
					echo "<tr>
							<td>
								{$employee->__toString()}
							</td>
							<td>
							{$active}
							</td>
							<td>
								<a class='button' href='forms/employee_form.php?id={$employee->__get("id")}'>Edit</a>
								<a class='button' href='controllers/employee_remove_remove.php?id={$employee->__get("id")}'>Remove</a>
							</td>
						</tr>";
				}
			?>
		</tbody>
	</table>
</body>
</html>