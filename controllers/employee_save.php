<pre>
<!-- Recuerdda quitar la etiqueta pre -->
<?php
	include("../import.php");
	$id = 0;
	if(!isset($_SESSION["user_id"])){
		header("location:/company/login.php");
	}
	else
	{
		if(isset($_POST["id"])){
			$employee= Employee::find($_POST["id"]);
			$id = $_POST["id"];
			if(isset($_POST["url_img"]) && $_POST["url_img"]!=""){
				$employee->__set("url_img", $_POST["url_img"]);
			}
			else{
				$name = "../imgs/employees/{$_POST["id"]}.jpg";
				$error= $_FILES["url_img"]["error"];
				if(file_exists($name)){
					unlink($name);
				}
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["url_img"]["tmp_name"];
					move_uploaded_file($tmp_name, $name);
					$employee->__set("url_img", $name);
				}
			}
			$employee->__set("active", isset($_POST["active"])? $_POST["active"]: 0);
			$employee->__set("code", $_POST["code"]);
			$employee->__set("title", $_POST["title"]);
			$employee->__set("salary", $_POST["salary"]);
			$employee->__set("afp", $_POST["afp"]);
			$employee->__set("isr", $_POST["isr"]);
			$employee->__set("superior_id",isset($_POST["superior_id"])? $_POST["superior_id"]: 0);
			
	
			$person= new Person($_POST["name"], $_POST["last_name"], $_POST["dob"], $_POST["gender"], $_POST["id_card"], $_POST["city"], $_POST["main_address"], $_POST["phone_number"],$employee->__get("person_id"));
			$person->save();
	
			$employee->__set("person_id", $employee->__get("person_id"));
			$employee->save();
		}
		else{
			$person= new Person($_POST["name"], $_POST["last_name"], $_POST["dob"], $_POST["gender"], $_POST["id_card"], $_POST["city"], $_POST["main_address"], $_POST["phone_number"], ($_POST["id"] != null)? $_POST["id"]: 0 );
			$person->save();
			
			echo "Person id para guardarse en employee:::: {$person->__get("id")}";
			
			// construct($active, $url_img, $code, $title, $salary, $afp, $sca, $isr, $person_id, $superior_id, $id= 0)
			$employee= new Employee(isset($_POST["active"])? $_POST["active"]: 0, "", $_POST["code"], $_POST["title"], $_POST["salary"], $_POST["afp"], $_POST["sca"], $_POST["isr"], $person->__get("id"), isset($_POST["superior_id"])? $_POST["superior_id"]: 0);
			$employee->save();
			
			$name = "../imgs/employees/{$employee->__get("id")}.jpg";
			$error= $_FILES["url_img"]["error"];
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["url_img"]["tmp_name"];
				move_uploaded_file($tmp_name, $name);
				$employee->__set("url_img", $name);
				$employee->save();
			}
			$id = $employee->__get("id");
		}
		header("Location: ../forms/employee_form.php?id={$id}");
	}
	?>	
	</pre>