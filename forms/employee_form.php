<?php include("../header.php") ?>
<?php
	 if(!isset($_SESSION["user_id"])){
	header("location:/company/login.php");
	 }
	 else
	{	
?>
		<section>
			<form id="formCars" name="generalForm" method="post" action="../controllers/employee_save.php" enctype="multipart/form-data">
				<fieldset class="login">
					<legend>Employee</legend>
						 <?php
						 	if(isset($_GET["id"])){
							 	$emp= Employee::find($_GET["id"]);
						 	}
					 		foreach (array_keys(Person::getFields()) as $name) {	 
					 			$value= "";
					 			if(isset($emp)){
					 				$pe= Person::find($emp->__get("person_id"));
					 				$value= $pe->__get("{$name}");
					 			}		
					 			if ($name == "gender") {
					 				echo "<div class='field'>
										<label>Gender</label>
							 				<label class='gender'><input type='radio' class='input' name='gender' value='M' checked='checked'>M</label>
											<label class='gender'><input type='radio' class='radio' name='gender' value='F'>F</label><br>";
					 				echo "</div>";
					 				continue;	
					 			}
					 			if($name == "dob"){
					 				echo"<div class='field'><label>" . Format::humanize($name) .
					 				"</label> <input type='date' name='{$name}'  class='input' value='{$value}'/>
					 				</div>";
					 			}
					 			if($name == "id"){
					 				continue;
					 			}
					 			echo"<div class='field'><label>" . Format::humanize($name) .
					 			 		"</label> <input type='text' name='{$name}'  class='input' value='{$value}'/> 
					 				</div>";
					 		}
					 		foreach (array_keys(Employee::getFields()) as $name) {
					 			$value= "";
					 			if(isset($emp)){
					 				$value= $emp->__get("{$name}");
					 			}
					 			if($name == "id"){
					 				$value = isset($emp)? $_GET["id"] : "0";
					 				echo "<input type='hidden' name='id' id='id' value='{$value}'>";
					 				continue;
					 			}

					 			if($name == "active"){
					 				$checked= ($value == "1")? "checked='checked'" : "";
					 				echo"<div class='field'><label>" . Format::humanize($name) .
											"</label> <input type='checkbox' {$checked} name='{$name}' id='{$name}' class='input' value='1'/>
										</div>";
					 				continue;
					 			}
					 			if($name == "url_img"){
						 			echo"<div class='field'><label>" . Format::humanize($name) . "</label> <input type='file' id='file' name='{$name}' onchange='imgChanged();' class='file'/><br>";
						 			if (isset($emp) && $value!="") {
						 				echo "<input type='hidden' name='{$name}' id='{$name}' value='{$value}' >";
						 				echo "<a href='{$value}' target='_blank'><img src='{$value}' width='200' alt='No Image Selected'></a>";
						 			}
						 			echo "</div>";
					 				continue;
								}
								if($name == "superior_id"){
									echo "<div class='field'><label>" . Format::humanize($name) . "</label><select name='superior_id'>
						 						<option value='0' selected='selected' ></option>";
									foreach (Employee::all() as $employee){
										if((isset($emp) && $employee->__get("id")!=$_GET["id"])||!isset($emp)){
											$employee_id= (isset($emp))? $emp->__get("id") : "";
											$selected= ($employee_id == $employee->__get("id"))? "selected='selected'" : "";
											echo "<option value='{$employee->__get("id")}' {$selected}>{$employee}</option>";
										}
									} 
						 			echo "</select></div>";
						 			continue;
								}
								if($name == "person_id"){
									continue;
								}
						 		echo "<div class='field'>
					 				<label>" . Format::humanize($name) . "</label> <input type='text' id='{$name}' name='{$name}'  class='input' value='{$value}'/>
						 		 </div>";
						 		
					 		}
						  ?>
						  <br>
						<button class="supmit">Save</button>
						
					</fieldset>	
			</form>		
		</section>
    </output>
<?php 
}
?> 