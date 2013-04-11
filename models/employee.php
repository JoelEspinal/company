<?php
	class Employee extends AbstractModel{

		private $active;		
		private $code;
		private $title;
		private $salary;
		private $afp;
		private $sca;
		private $isr;
		private $person_id;
		private $superior_id;
		private $url_img;
		
		public function __construct($active, $url_img, $code, $title, $salary, $afp, $sca, $isr, $person_id, $superior_id, $id= 0){
			$this->id= $id;
			$this->active= $active;
			$this->url_img= $url_img;
			$this->code= $code;
			$this->title= $title;
			$this->salary= $salary;
			$this->afp= $afp;
			$this->sca= $sca;
			$this->isr=$isr;
			$this->person_id= $person_id;
			$this->superior_id= $superior_id;
		}
		
		public function save() {
			$sql= "";
			$has_superior= $this->superior_id != 0;
			$is_person= $this->person_id != 0;
			if ($this->is_new()){
				$superior_sql= ($has_superior)?",`superior_id`": "";
				$value_sql=  ($has_superior)? ",". Util::sql_protected($this->superior_id) : "";
				$person_sql= ($is_person)? ",`person_id`" : "";
				$person_value= ($is_person)? ",". Util::sql_protected($this->person_id) : "";
				$sql= "insert into employees(`active`,`url_img`,`code`,`title`,`salary`,`afp`,`sca`,`isr`{$person_sql} {$superior_sql})
					 values(".$this->active.",".Util::sql_protected($this->url_img).",".Util::sql_protected($this->code).",
					 		".Util::sql_protected($this->title).",".Util::sql_protected($this->salary).",".Util::sql_protected($this->afp).",
					 		".Util::sql_protected($this->sca).",".Util::sql_protected($this->isr)."{$person_value}{$value_sql});";
			}
			else{

				$superior_sql= ($has_superior)?",superior_id=".Util::sql_protected($this->superior_id): "";
				$sql= "update employees set
				active=".$this->active.", url_img=".Util::sql_protected($this->url_img).", code=".Util::sql_protected($this->code).",
				title=".Util::sql_protected($this->title).", salary=".Util::sql_protected($this->salary).", afp=".Util::sql_protected($this->afp).",
				sca=".Util::sql_protected($this->sca).", isr=".Util::sql_protected($this->isr).", person_id=".Util::sql_protected($this->person_id).
				"{$superior_sql} where id={$this->id}";
			}
			
			DB::execute($sql);
			if($this->is_new())$this->after_save();
		}
		public static function find($id){			
			$rs = DB::query("select * from employees where id={$id};");
			if($rs){
				$employee = mysql_fetch_assoc($rs);
				return new Employee($employee["active"], $employee["url_img"], $employee["code"], $employee["title"], $employee["salary"], $employee["afp"], $employee["sca"], $employee["isr"], $employee["person_id"], $employee["superior_id"], $id);				
			}
			return false;
		}
		public static function all(){
			$employees= array();
			$rs = DB::query("select id from employees;");
			while ($employee = mysql_fetch_array($rs)){
				$employees [] = Employee::find($employee["id"]);
			}
			return $employees;
		}
		public function destroy() {
			DB::execute("delete from employees where id={$this->id};");			
		}
		protected function after_save() {
			$rs= DB::query("select max(people.id) as id from people;");
			$id=  mysql_fetch_assoc($rs);
			$this->id= $id["id"];
		}
		public static function getFields(){
			return  get_class_vars("Employee");
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
		public function __toString()
		{
			$person= Person::find($this->person_id);
			
			return $person->__get("name")." ".$person->__get("last_name")." - ". $this->title ." - ".$this->code;
		}
	}
?>