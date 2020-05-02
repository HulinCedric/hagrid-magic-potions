<?php
	$edit = false;

	if (isset($_POST) && !empty($_POST["token"]) && $_POST["token"] == $_SESSION["token"])
		if (!empty($_POST["oldpass"])) {		
			extract($_POST);

			if ($_POST["newpass"] == "")
				$_POST["newpass"] = $_POST["oldpass"];
			
			$user = new User($user->login, $_POST['newpass'], $_POST['mail'], $_POST['clan_name'], 
						 $_POST['postal_code'], $_POST['town'], $_POST['country'], stripslashes($_POST['description']), 
						 stripslashes($_POST['quotation']));
			
			UserDB::update($user);
			
			$_SESSION["user"] = $user;			
			
			if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0)		
				move_uploaded_file($_FILES['avatar']['tmp_name'], './images/avatar/' . $user->login . '.jpg');
		}
		else {
			$_SESSION["token"] = md5(microtime(TRUE)*100000);
			include "pages/Modification.php";
			$edit = true;
		}
		
	// Verification d'un utilisateur connu
	//
	$ok = false;
	if (isset($_GET["login"])) {
		$user = UserDB::getUser($_GET["login"]);
		if ($user != -1) $ok = true;
	}
	
	// Verification de l'appartenance a la session
	//
	$mine = false;
	if ($ok && isset($_SESSION["user"]) && $_SESSION["user"]->login == $user->login) $mine = true;
	
	if (!$edit) $_SESSION["token"] = md5(microtime(TRUE)*100000);
	
	if ($ok) {
		$title = $user->login . " est un " . $user->clan_name . " de niveau " . $user->level;
	
		$rank = $user->level > 0 ?
				"De part, ses potions en tous genres, " . $user->login . " a mont&eacute; les &eacute;chelons et est maintenant un " . UserDB::getRank($user) . "." :
				"Ce feignant de " . $user->login . " n'a toujours pas concoct&eacute; de potions, un manque certain d'inspiration !";

		$description = $user->description != null ?
					   $user->login . " se d&eacute;crit comme &eacute;tant " . $user->description . "." :
					   $user->login . " ne se d&eacute;crit gu&egrave;re, mais se laisse appr&eacute;cier.";
					
		$quotation = $user->quotation != null ?
					 "Un jour " . $user->login . " a dit : \"" . $user->quotation . "\"." :
					 $user->login . " n'a rien &agrave; d&eacute;clarer.";
		
		$town = 	$user->town != null ?
					"Localisable dans une contr&eacute;e appel&eacute;e " . $user->town . "." :
					"";		
		
		$postal_code = 	$user->postal_code != null ?
					" Sa contr&eacute;e se distinguerait par ce code "	. $user->postal_code . "." :
					"" ;
		
		$country =	$user->country != null ?
					" Il si&eacute;gerait actuellement en " . $user->country . "." :
					"";
					
		$domiciliation = $town . $postal_code . $country;
	}
	else $title = "Ce personnage est inconnu";
	
	echo "<div class=\"account\">";
	echo $ok ? "<h1 id=\"name_account\">" . $user->login . "</h1>" : "" ;
	echo "<h2>" . $title . "</h2>";
	echo "<h3>" . $rank . "</h3>";
	echo "<h4>" . $description . "</h4>";
	echo "<h4>" . $quotation . "</h4>";
	echo "<p>" . $domiciliation . "<p>";
	echo "</div>";

	if ($ok && $mine && !$edit)
		echo "	<form action=\"index.php?page=compte&login=".$user->login."\" method=\"post\" >
					<input type=\"hidden\" name=\"token\" value=".$_SESSION["token"]." />
					<input type=\"hidden\" name=\"login\" value=".$user->login." />
					<input class=\"red_button\" type=\"submit\" name=\"submit\" value=\"&Eacute;diter le profil\" />
				</form>";
	
	if ($ok && $user->level > 0) {

		echo "<div id=\"vos_recettes\">";
		if ($mine)
			echo "<h1>Vos Recettes</h1>";
		else
			echo "<h1>Ses Recettes</h1>";
		
		$result = mysql_query("	SELECT *
						 		FROM recipe
						 		WHERE inventor = \"" . $user->login . "\";");
		
		while($data = mysql_fetch_array($result)) {
		
			$nbStarOver = round (EvaluationDB::getAverage($data["num_recipe"]));

			echo "<div class=\"comment_div\" id=\"".$data["num_recipe"]."\">";
			echo "<div class=\"comment_login\"><a href=\"index.php?page=recette&id=".$data["num_recipe"]."\">".$data["name"]."</a></div>";
			echo "<p class=\"vos_recettes_stat\">";
			for ($i = 0 ; $i < $nbStarOver ; $i++)
				echo "<img src=\"images/StarOver.png\" />";
		
			for ($i = $nbStarOver ; $i < 5 ; $i++)
				echo "<img src=\"images/StarOut.png\" />";
			echo "</p>";
			if ($mine)
			echo "<p class=\"red_button_supp\" onclick=\"file('phpscript/Delete_recipe.php','id=".$data["num_recipe"]."');del(document.getElementById('vos_recettes'), ".$data["num_recipe"].");\">Supprimer</p>";
			
			echo "</div>";
		}
		
		echo "</div>";
	}
?>