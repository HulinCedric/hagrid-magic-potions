<?php 
	if (isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
		$title = $user->login;
		$subtitle = UserDB::getRank($user);
		$button = "<a href='index.php?page=compte&login=".$user->login."'>Ton Compte</a>";
	}
	else { 
		$title = "Hagrid's";
		$subtitle = "Echange de recettes autour de la magie";
		$button = "<a href='index.php?page=connexion'>Connexion</a>";
	}
?>