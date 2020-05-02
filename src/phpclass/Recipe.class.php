<?php 
	class Recipe {
        private $name,
				$direction,
				$category,
				$inventor,
				$num_recipe,
				$recipe_date;
				        
        public function __construct() {
			$num = func_num_args();
 			 			
 			switch($num) {
 				case 6:
   					$this->recipe_date = func_get_arg(5);
   				case 5:
		       		$this->num_recipe = func_get_arg(4);
   				case 4:
		       		$this->name = func_get_arg(0);
					$this->direction = func_get_arg(1);
					$this->category = func_get_arg(2);
					$this->inventor = func_get_arg(3);
					break;
		   }
        }
		
		public function __get($property) {
			if (isset($this->$property))
                return $this->$property;
		}
		
		public function __set($property, $value) {
			if (isset($this->$property))
				if ($property != "num_recipe" && $property != "inventor")
					$this->$property = $value;
		}
		
		public function __toString() {
			return 	$this->name . " " .
					$this->direction . " " .
					$this->category . " " .
					$this->inventor . " " .
					$this->num_recipe . " " .
					$this->recipe_date;
		}
    }
?>