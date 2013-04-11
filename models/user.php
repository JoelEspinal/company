<?php
	
	class User extends AbstractModel{
			
		private $email;
		private $password;
		private $employee_id;
		
		public function __construct($email, $password, $employee_id, $id=0){
			$this->id= $id;
			$this->email= $email;
			$this->password= $password;
			$this->employee_id= $employee_id;
		}
		
		public function save() {
			$sql;
			$has_employee= $this->employee_id != 0;
			if($this->is_new()){
				$employee_sql= ($has_employee)? ",`employee_id`": "";
				$evalue_sql= ($has_employee)? ",".Util::sql_protected($this->employee_id) : "";
				$sql= "insert into users(`email`,`password`{$employee_sql}) values(".Util::sql_protected($this->email).",".Util::sql_protected($this->password).$evalue_sql.")";
			}
			else{				
				$emp_sql= ($has_employee)? "employee_id=": "Util::sql_protected($this->employee_id)";
				$password= ($this->password != "")? ", password=".Util::sql_protected($this->password) : "";
				$sql= "update people set email=".Util::sql_protected($this->email).$password.", employee_id=".Util::sql_protected($this->employee_id)."where id= {$this->id}";
			}
									
			DB::execute($sql);
			if($this->is_new()) $this->after_save();
		}
	
		public static function find($id){
				$rs= DB::query("select * from users where id={$id}");
				if($rs){
					$user = mysql_fetch_assoc($rs);
					return (new User($user["email"], $user["password"], $user["employee_id"], $id));
				}
				return false;
		}
		public static function all(){
			$users= array();
			$rs= DB::query("select id from users");
			while ($user = mysql_fetch_array($rs)) {
				$users [] = User::find($user["id"]);
			}
			return $users;
		}
		public static function autenticate($email, $password){
			$rs= DB::query("select id from users where email=".Util::sql_protected($email)." and password=".Util::sql_protected($password));
			if($rs != null){
				$user = mysql_fetch_assoc($rs);
				return $user["id"];				
			}
			return 0;
		}
		public function admin(){
			return ($this->employee_id != null);		
		}
		public function destroy() {
			DB::execute("delete from users where id={$this->id}");
			
		}
		protected function after_save() {
			$rs= DB::query("select max(id) as id from users;");
			$id=  mysql_fetch_assoc($rs);
			$this->id= $id["id"];
		}
		public function __set($property, $value) {
			if (property_exists($this, $property)) {
				$this->$property = $value;
			}
		}
		public function __get($property) {
			if (property_exists($this, $property)) {
				echo eval("\$this->{$property};");
				return $this->$property;
			}
		}
		public static function getFields(){
			return  get_class_vars("User");
		}		
	}
	
?>