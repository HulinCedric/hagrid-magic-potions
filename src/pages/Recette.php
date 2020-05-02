<?php
	// Verification d'une recette connu
	//
	$ok = false;
	if (isset($_GET["id"])) {
		$recipe = RecipeDB::getRecipe($_GET["id"]);
		if ($recipe != -1) $ok = true;
	}
		
	if ($ok) {
	
	$tof= "images/recette/default.jpg";
	if(file_exists("images/recette/" . $recipe->num_recipe . ".jpg"))
		$tof= "images/recette/" . $recipe->num_recipe . ".jpg";
?>
<div class="recette_div" id="recette_div">
	<img class="recette_img" src="<?php echo $tof; ?>" alt="<?php echo $recipe->name ?>" />
	<div class="recette_title"><a><?php echo $recipe->name ?></a></div>
	<p class="recette_domaine">Domaine <?php echo $recipe->category ?></p>
	<p class="recette_inventor">par <a href="index.php?page=compte&login=<?php echo $recipe->inventor; ?>"><?php echo $recipe->inventor ?></a></p>
	<p class="recette_stat">

<?php
		echo EvaluationDB::getNbEval($recipe->num_recipe) . " votes - ";
	
		echo CommentDB::getNbComment($recipe->num_recipe) . " commentaires";
?>	
	</p>
	<div class="recette_note" id="recette_note">
<?php
	// Verification d'un utilisateur connu
	//	
	if (isset($_SESSION["user"]))
		$nbStarOver = EvaluationDB::getMark($recipe->num_recipe, $_SESSION["user"]->login);
	else 
		$nbStarOver = round (EvaluationDB::getAverage($recipe->num_recipe));
	
	if ($nbStarOver == 0 && isset($_SESSION["user"])) {
		for ($i = 0 ; $i < 5 ; $i++)
			echo "<img id=\"Star".($i+1)."\" src=\"images/StarOut.png\" />";
	}
	else {
		for ($i = 0 ; $i < $nbStarOver ; $i++)
			echo "<img src=\"images/StarOver.png\" />";
		
		for ($i = $nbStarOver ; $i < 5 ; $i++)
			echo "<img src=\"images/StarOut.png\" />";
	}
	
	if (isset($_SESSION["user"])) {
		echo "<input id=\"num_recipe\" type=\"hidden\" value=\"".$recipe->num_recipe."\" />";
		echo "<input id=\"login\" type=\"hidden\" value=\"".$_SESSION["user"]->login."\" />";
		echo "<input id=\"inventor\" type=\"hidden\" value=\"".$recipe->inventor."\" />";
	}
?>
	</div>
	<div id="recette_ingredients">
<?php
	$result = mysql_query("SELECT *
							FROM composition
							WHERE num_recipe =\"".$recipe->num_recipe."\"");
 	
	while ($data = mysql_fetch_array($result))
		echo "<p>- ".$data["name"]." : ".$data["quantity"]." ".$data["scale"]."</p>";
?>
	</div>
	<div id="recette_directory">
	<p><?php echo $recipe->direction ?></p>
	</div>
</div>
<?php
		
		$result = mysql_query("	SELECT *
						 		FROM comment
						 		WHERE num_recipe = \"" . $recipe->num_recipe . "\";");
?>
<div id="comments">
	<h1>Commentaires</h1>
	
<?php		if (isset($_SESSION["user"])) { ?>

	<p class="recette_div_button" id="comment_post" onclick="showHideComment()">commenter</p>
	<div id="comment_edit">
		<textarea id="comment_edit_description"></textarea>
		<p class="recette_div_button" id="comment_edit_button" onclick="addComment()">poster</p>
	</div>
<?php
			}
	$i=1;
	while($data = mysql_fetch_array($result)) {
		echo "<div class=\"comment_div\" id=".$i++.">";
		echo	"<div class=\"comment_login\"><a href=\"index.php?page=compte&login=".$data["login"]."\">".$data["login"]."</a></div>";
			
			setlocale(LC_TIME,"fr_FR");
			$heure = strftime(" à %H:%M", strtotime($data["comment_date"]));
			$title = strftime("%A %d %B", strtotime($data["comment_date"])) . $heure; 
			$date_diff = floor((time() - strtotime($data["comment_date"]))/(60*60*24));
				
			if ($date_diff == 0) $title = "Aujourd'hui" . $heure;
			if ($date_diff == 1) $title = "Hier" . $heure;
					
		echo	"<div class=\"comment_date\">".$title."</div>";
		echo	"<div class=\"comment_description\">".$data["description"]."</div>";
		echo "</div>";
 	} 
?>
</div>
<?php
		
	}
	else echo "<div id=\"account\"><h2>Cette recette est inconnu</h2></div>";	
?>