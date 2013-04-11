<?php

	class Person extends AbstractModel{
		
		private $name;
		private $last_name;
		private $dob;
		private $gender;
		private $city;
		private $id_card;
		private $main_address;
		private $phone_number;
		
		public function __construct($name, $last_name, $dob, $gender, $id_card, $city, $main_address, $phone_number, $id=0){
			$this->id= $id;
			$this->name= $name;
			$this->last_name= $last_name;
			$this->dob= $dob;
			$this->gender= $gender;
			$this->id_card= $id_card;
			$this->city= $city;
			$this->main_address= $main_address;
			$this->phone_number= $phone_number;
		}
		
		public function save() {		
			$sql= ($this->is_new())? "insert into people(`name`, `last_name`, `dob`, `gender`, `id_card`,`city`, `main_address`, `phone_number`)
											values(".Util::sql_protected($this->name).", ".Util::sql_protected($this->last_name).", ".Util::sql_protected($this->dob).",
											".Util::sql_protected($this->gender).",".Util::sql_protected($this->id_card).",".Util::sql_protected($this->city).",
											".Util::sql_protected($this->main_address).", ".Util::sql_protected($this->phone_number).");"												
											:													
											"update people set name=".Util::sql_protected($this->name).", last_name=".Util::sql_protected($this->last_name).",dob=".$this->dob.",
											 gender=".Util::sql_protected($this->gender).", city=".Util::sql_protected($this->city).",id_card=".Util::sql_protected($this->id_card).",
											main_address=".Util::sql_protected($this->main_address).",phone_number=".Util::sql_protected($this->phone_number)."
											where id={$this->id};";
				DB::execute($sql);
				if($this->is_new()) $this->after_save();
			
		}
		public static function find($id){
			$rs = DB::query("select * from people where id={$id}");
			if($rs){
				$person = mysql_fetch_assoc($rs);
				$date= date($person["dob"]);
				$format_date= strftime("%m-%d-%Y", strtotime($date));
				return (new Person($person["name"], $person["last_name"], $format_date, $person["gender"], $person["id_card"], $person["city"], $person["main_address"], $person["phone_number"], $id));
			}
			return  false;
		}
		public static function all(){
			$people= array();
			$rs = DB::query("select id from people");
			while ($person = mysql_fetch_array($rs)) {
				$people [] = Person::find($person["id"]);
			}
			return $people;
		}
		public function destroy() {
			DB::execute("delete from people where id={$this->id}");
		}
		protected function after_save() {
			$rs= DB::query("select max(id) as id from people;");
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
				//echo eval("\$this->{$property};");
				return $this->$property;
			}
		}
		public static function getFields(){
			return  get_class_vars("Person");
		}
	}
?>