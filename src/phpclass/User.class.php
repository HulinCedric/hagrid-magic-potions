<?php 
	class User {
        private $login,
				$pass,
				$mail,
				$clan_name,
				$postal_code,
				$town,
				$country,
				$description,
				$quotation,
				$level;
				        
        public function __construct() {
			$num = func_num_args();
 			 			
 			switch($num) {
   				case 10:
 					$this->level = func_get_arg(9);
 				case 9:
   					$this->quotation = func_get_arg(8);
   				case 8:
		       		$this->description = func_get_arg(7);
   				case 7:
		       		$this->login = func_get_arg(0);
					$this->pass = func_get_arg(1);
					$this->mail = func_get_arg(2);
					$this->clan_name = func_get_arg(3);
					$this->postal_code = func_get_arg(4);
					$this->town = func_get_arg(5);
					$this->country = func_get_arg(6);
		         break;
		   }
        }
		
		public function __get($property) {
			if (isset($this->$property))
                return $this->$property;
		}
		
		public function sendMail($objet, $contenu, $entete) {
			mail($this->mail, $objet, $contenu, $entete);
		}
		
		public function __set($property, $value) {
			if (isset($this->$property))
				if ($property != "login")
					$this->$property = $value;
		}
		
		public function __toString() {
			return 	$this->login . " " .
					$this->pass . " " .
					$this->mail . " " .
					$this->clan_name . " " .
					$this->postal_code . " " .
					$this->town . " " .
					$this->country . " " .
					$this->description . " " .
					$this->quotation . " " .
					$this->level;
		}
    }
?>