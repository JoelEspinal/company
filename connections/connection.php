<?php
	class DB{
		
		static $connection = null;

		private function __construct(){
		
		}
		public function __destruct(){
			if($this->connection != null){
				mysql_close($this->connection);
			}
		}
		public static function connect(){
			if(DB::$connection == null){
				DB::$connection= mysql_connect(host, user, pass);
				mysql_select_db("information_schema", DB::$connection);
				mysql_query("CREATE SCHEMA ".db);
				mysql_select_db(db, DB::$connection);
				DB::createDataBase();
			}
		}
		public static function query($sql){
			//echo "{$sql}";
			$rs= mysql_query($sql);
			return $rs;
		}
		public static function execute($sql){
			//echo "{$sql}";
			mysql_query($sql);
			echo mysql_error();
		}
		public static function createDataBase(){
			global $schema;
			$error= false;
			foreach ($schema as $statement){
				mysql_query($statement);
				if(mysql_errno()!=0) $error= true;
			}
			//if (!$error) mysql_query("insert into users(email, password) values('admin@company.com','password');");
		}
	}
	
	
	
	DB::connect();
?>