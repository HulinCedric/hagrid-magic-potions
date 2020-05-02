<?php
	abstract class IngredientDB {
        public static function insert(Ingredient $ingredient) {			      
        	return mysql_query("INSERT INTO ingredient
        									(
        										name,
        										type
										 	)
							 		VALUES	(
							 					\"" . ucfirst(utf8_encode($ingredient->name)) . "\",
							 					\"" . $ingredient->type . "\"
									 		);");
        }
        
		public static function update(Ingredient $ingredient) {			      
			return mysql_query("	UPDATE 	ingredient 
        							SET 	type = \"" . ucfirst(utf8_encode($ingredient->type)) . "\"
									WHERE 	name = \"" . $ingredient->name . "\";");
        }
        
		public static function getIngredient($name) {
			$name = ucfirst($name);

			if ($name == null || $name == "") return -1;
						
			$result = mysql_query("	SELECT *
						 			FROM ingredient
						 			WHERE name = \"" . $name . "\";");
			
			$data = mysql_fetch_assoc($result);
												
			if(empty($data["name"])) return -1;
			   					   		
			return new Ingredient(	$data["name"],
									$data["type"]
						 		 );			
		}
		
		public static function getScaleTypeXML($type) {
			if ($type == null || $type == "") return -1;
						
			$result = mysql_query("	SELECT scale
						 			FROM scale
						 			WHERE type = \"" . $type . "\";");
			
			$dom = new DOMDocument("1.0", "UTF-8");
			$scales = $dom->createElement("scales");
			
			while($data = mysql_fetch_array($result)) {
				$element = $dom->createElement("scale", $data["scale"]);
				$scales->appendChild($element);
			}
			
			$dom->appendChild($scales);
			
			return $dom->saveXML();
		}
		
		public static function getIngredientNameXML() {						
			$result = mysql_query("	SELECT name
						 			FROM ingredient;");
			
			$dom = new DOMDocument("1.0", "UTF-8");
			$scales = $dom->createElement("ingredients");
			
			while($data = mysql_fetch_array($result)) {
				$element = $dom->createElement("name", $data["name"]);
				$scales->appendChild($element);
			}
			
			$dom->appendChild($scales);
			
			return $dom->saveXML();
		}
		
		public static function getTypesXML() {						
			$result = mysql_query("SHOW COLUMNS FROM scale LIKE 'type'");
			 
			$ligne = mysql_fetch_row($result);
 
			$chaine = $ligne[1];

			$chaine = substr($chaine, 5, -1);
			 			 
			$chaine = explode(",", $chaine);
	
			$dom = new DOMDocument("1.0", "UTF-8");
			$scales = $dom->createElement("types");
			
			for($i=0; $i<count($chaine); $i++) {
				$ma_chaine = substr($chaine[$i], 1, -1);
				$element = $dom->createElement("type", $ma_chaine);
				$scales->appendChild($element);
			}
			
			$dom->appendChild($scales);
			
			return $dom->saveXML();
		}
    }
?>