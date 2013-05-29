  <html>
	<head>		
	<?php 
		include("header.php");
	 ?>
	</head>
	<body>
		<table class="list">
			<thead>
				<tr>
					<th>Email</th>
					<th>Employee</th>
					<th></th>
				</tr>	
			</thead>
			<tbody>
				<?php foreach (User::all() as $user){					
					$employee_id= $user->__get("employee_id");
					$employee= Employee::find($employee_id);
					$employee_name = isset($employee) && $employee != null ? $employee->__toString() : "";
					echo "<tr>
							<td>{$user->__get("email")}</td>
							<td>{$employee_name}</td>
							<td>
								<a class='button' href='forms/user_form.php?id={$user->__get("id")}'>Edit</a>
								<a class='button' href='controllers/user_remove.php?id={$user->__get("id")}'>Remove</a>
							</td>
						  </tr>";
				} ?>
			</tbody>
		</table>
		<div>
			<a href="reports/user.php"></a>
		</div>
	</body>

</html>	