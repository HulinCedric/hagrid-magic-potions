<?php
	abstract class CommentDB {
      	public static function getNbComment($num_recipe) {			      
        	if ($num_recipe == null || $num_recipe == "") return 0;
						
			$result = mysql_query("	SELECT COUNT(*) as nbComment
						 			FROM comment
						 			WHERE num_recipe = \"" . $num_recipe . "\";");
			
			$data = mysql_fetch_array($result);
			return $data["nbComment"];
	 	}
	 	
	 	public static function insert($num_recipe, $login, $description) {			      
        	return mysql_query("INSERT INTO comment
        									(
        										num_recipe,
        										login,
        										description
										 	)
							 		VALUES	(
							 					\"" . $num_recipe . "\",
							 					\"" . $login . "\",
							 					\"" . $description . "\"
							 				);");
        }
    }
?>