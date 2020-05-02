<?php
	abstract class EvaluationDB {
		public static function insert($num_recipe, $login, $mark) {			      
        	return mysql_query("INSERT INTO evaluation
        									(
        										num_recipe,
        										login,
        										mark
										 	)
							 		VALUES	(
							 					\"" . $num_recipe . "\",
							 					\"" . $login . "\",
							 					\"" . $mark . "\"
									 		);");
        }
		
		public static function getStarSum($num_recipe) {			      
        	if ($num_recipe == null || $num_recipe == "") return 0;
        	        	
			$result = mysql_query("	SELECT mark
						 			FROM evaluation
						 			WHERE num_recipe = \"" . $num_recipe . "\";");
			$sum = 0;
			while($data = mysql_fetch_array($result))
				$sum = $sum + $data["mark"];
			
			return $sum;
	 	}
	 		 	
		public static function getStarSumByLogin($login) {			      
        	if ($login == null || $login == "") return 0;

        	$result = mysql_query("	SELECT num_recipe
						 			FROM evaluation
						 			WHERE login = \"" . $login . "\";");
        	
        	$nbStarSum=0;
        	while($data = mysql_fetch_array($result))
				$nbStarSum = $nbStarSum + self::getAverage($data["num_recipe"]);
        	
			return $nbStarSum;
	 	}
        
		public static function getAverage($num_recipe) {			      
        	if ($num_recipe == null || $num_recipe == "") return 0;

        	$nbEval = self::getNbEval($num_recipe);
        	
        	if ($nbEval == 0) return 0;
        	
        	$nbStar = self::getStarSum($num_recipe);
			
			return $nbStar/$nbEval;
	 	}
        
	 	public static function getNbEval($num_recipe) {			      
        	if ($num_recipe == null || $num_recipe == "") return 0;
						
			$result = mysql_query("	SELECT COUNT(*) as nbEval
						 			FROM evaluation
						 			WHERE num_recipe = \"" . $num_recipe . "\";");
			
			$data = mysql_fetch_array($result);
			return $data["nbEval"];
	 	}
	 	
		public static function getMark($num_recipe, $login) {			      
        	if ($num_recipe == null || $num_recipe == "") return 0;
        	if ($login == null || $login == "") return 0;
        	
			$result = mysql_query("	SELECT mark
						 			FROM evaluation
						 			WHERE num_recipe = \"" . $num_recipe . "\"
						 			AND login = \"" . $login . "\";");
			
			$data = mysql_fetch_array($result);
			
			if(empty($data["mark"])) return 0;
			
			return $data["mark"];
	 	}
    }
?>