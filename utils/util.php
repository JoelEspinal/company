<?php
	class Util {
				
		public static function sql_protected($value){
			return "'".str_replace("'","´", $value)."'";
		}
	}

?>