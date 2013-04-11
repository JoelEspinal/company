<?php
	class Zodiac{
		
		private static function sings(){
			return array(
					"121-219" => "Acuario",
					"220-320" => "Pisis",
					"321-420" => "Aries",
					"421-521" => "Tauro",
					"522-621" => "Gemisis",
					"622-723" => "Cancer",
					"724-823" => "Leo",
					"824-923" => "virgo",
					"924-1023" => "Libra",
					"1024-1122" => "Escorpio",
					"1123-1221" => "Sagitario",
					"1222-120" => "Capricornio"
			);
		}
		
		public static function getSing($dob){
			$dob= strftime("%m%d", strtotime($dob));
			foreach (Zodiac::sings() as $key => $sing){
				$range= explode("-", $key);
				$from= $range[0];
				$to= $range[1];
				if($from <= $dob && $to >= $dob){
					return $sing;
				}
			}
			$values= array_values(Zodiac::sings());
			return end($values);
		}
	}
?>