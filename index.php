<?php 
	include("header.php");
 ?>
<html>
	<head>		
		<title>>Dash Board</title>
	</head>
	<body>
		<table class="list">
			<thead>
				<tr>
					<th>Name</th>
					<th>Last name</th>
					<th>Phone Number</th>
					<th>Gender</th>
					<th>City</th>	
					<th>Code</th>	
					<th>Title</th>	
					<th>Zodiac</th>	
					<th></th>	
				</tr>
			</thead>
			<tbody>
				<?php foreach (Employee::all() as $employee){
					$person= Person::find($employee->__get("person_id"));
				 	$zodiac= Zodiac::getSing($employee->__get("dob"));
					echo "<tr>
							<td>{$person->__get("name")}</td>
							<td>{$person->__get("last_name")}</td>
							<td>{$person->__get("phone_number")}</td>
							<td>{$person->__get("gender")}</td>
							<td>{$person->__get("city")}</td>
							<td>{$employee->__get("code")}</td>
							<td>{$employee->__get("title")}</td>
							<td>".Zodiac::getSing($person->__get("dob"))."</td>
							<td>	
								<a class='button' href='/company/forms/employee_form.php?id={$employee->__get("id")}'>Edit</a>
								<a class='button' href='/company/controllers/employee_remove.php?id={$employee->__get("id")}'>Remove</a>
							</td>
						</tr>";
				 } ?>
			</tbody>
		</table>
	</body>
</html>	
