<?php
	abstract class RecipeDB {
        public static function insert(Recipe $recipe) {	      
        	mysql_query("INSERT INTO recipe
        										(
        											name,
													direction,
													category,
													inventor
										 		)
							 			VALUES	(
							 						\"" . ucfirst(utf8_encode($recipe->name)) . "\", 
										 			\"" . utf8_encode($recipe->direction) . "\", 
										 		 	\"" . $recipe->category . "\",
										 		 	\"" . $recipe->inventor . "\"
										 		 );");
						
			$result = mysql_query("	SELECT *
						 			FROM recipe
						 			WHERE name = \"" . ucfirst(utf8_encode($recipe->name)) . "\";");
			
			$data = mysql_fetch_assoc($result);
												
			if(empty($data["num_recipe"])) return -1;
			
			return $data["num_recipe"];
        }
        
		public static function linkIngredient($num_recipe, $name, $quantity, $scale) {	      
        	return mysql_query("INSERT INTO composition
        										(
        											num_recipe,
													name,
													quantity,
													scale
										 		)
							 			VALUES	(
							 						\"" . $num_recipe . "\", 
										 			\"" . ucfirst($name) . "\", 
										 		 	\"" . $quantity . "\",
										 		 	\"" . $scale . "\"
										 		 );");
        }
        
		public static function update(Recipe $recipe) {			      
			mysql_query("	UPDATE 	recipe 
        					SET 	name = \"" . ucfirst(utf8_encode($recipe->name)) . "\", 
									direction = \"" . utf8_encode($recipe->direction) . "\",
									category = \"" . $recipe->category . "\"
							WHERE 	num_recipe = " . $recipe->num_recipe . ";");
        }
        
		public static function delete($num_recipe) {
			mysql_query("	DELETE FROM comment 
							WHERE num_recipe = \"" . $num_recipe . "\";");	
			mysql_query("	DELETE FROM evaluation 
							WHERE num_recipe = \"" . $num_recipe . "\";");
			mysql_query("	DELETE FROM composition 
							WHERE num_recipe = \"" . $num_recipe . "\";");
			mysql_query("	DELETE FROM recipe 
							WHERE num_recipe = \"" . $num_recipe . "\";");
        }
        
		public static function getRecipe($num_recipe) {
			$num_recipe = mysql_real_escape_string(htmlspecialchars($num_recipe));

			if ($num_recipe == null || $num_recipe == "") return -1;
						
			$result = mysql_query("	SELECT *
						 			FROM recipe
						 			WHERE num_recipe = " . $num_recipe . ";");
			
			$data = mysql_fetch_assoc($result);
												
			if(empty($data["num_recipe"])) return -1;
			   					   		
			return new Recipe(	$data["name"],
								$data["direction"],
								$data["category"], 
								$data["inventor"], 
								$data["num_recipe"], 
						 		$data["recipe_date"]
						 	 );			
		}
		
		public static function getNbRecipe($login) {			      
        	if ($login == null || $login == "") return 0;
						
			$result = mysql_query("	SELECT COUNT(*) as nbRecipe
						 			FROM recipe
						 			WHERE inventor = \"" . $login . "\";");
			
			$data = mysql_fetch_array($result);
			return $data["nbRecipe"];
	 	}
    }
?>