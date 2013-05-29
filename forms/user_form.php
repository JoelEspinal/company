<?php include("../header.php") ?>
<?php 
	if(!isset($_SESSION["user_id"])){ 
		header("location:/company/login.php");
	}
	else{	
?>
<?php if(isset($_GET["id"])){
	$user= User::find($_GET["id"]);
}
?>
		<section>
			<!-- falta el action -->
			<form action="../controllers/user_save.php" method="post">
			
				<input type="hidden" name="id" value="<?php echo isset($user)? $_GET["id"] : "0";?>">
				<fieldset class="login">
					<legend>User</legend>
						<div class="field">
							<label>User Name: </label>
							<input type="text" name="email" value="<?php echo (isset($user))? $user->__get("email") : ""; ?>">
						</div>
						<div class="field">
							<label>Password: </label>
							<input type="password" name="password">
						</div>
						<div class="field">
							<label>Confirm Password: </label>
							<input type="password" name="password">
						</div>
						<div class="field">
							<label>Employee: </label>
							&nbsp; &nbsp;
							<select name="employee_id">
								<option value='0' selected='selected' ></option>
								<?php foreach (Employee::all() as $employee){	
									$employee_id= (isset($user))? $user->__get("employee_id") : "";
									$selected= ($employee_id == $employee->__get("id"))? "selected='selected'" : "";							
									echo "<option value='{$employee->__get("id")}' {$selected}>{$employee}</option>";
								} ?>
							</select>
						</div>
						<div class="field">
							<input type="submit" value="Submit">
						</div>
				</fieldset>
			</form>
       </section>
    </output>
<?php 
}
?>	