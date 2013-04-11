<?php
	class Format{
			
		public static function humanize($str){
			$str_replace= str_replace("_", " ", $str);
			return ucwords($str_replace);
		}

	}
?>