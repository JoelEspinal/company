
<?php 
	include("header.php");
?>
	<form method="post" action="controllers/authentication.php">
		<fieldset class="login">
			<legend>Login</legend>
				<div class="field">
					<label>User Name: </label>
					<input type="email" name="user_name">
				</div>
				<div class="field">
					<label>Password: </label>
					<input type="password" name="password">
				</div>
					<div class="field">
					<input type="submit" value="Submit">
				</div>
		</fieldset>
	</form>