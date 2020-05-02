<?php 
	class Ingredient {
        private $name,
        		$type;
				        
        public function __construct($name, $type) {
			$this->name = $name;
			$this->type = $type;
        }
		
		public function __get($property) {
			if (isset($this->$property))
                return $this->$property;
		}
		
		public function __toString() {
			return 	$this->name . " " .
					$this->type;
		}
    }
?>