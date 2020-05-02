<?php
	if (isset($_GET["page"])) {
		switch ($_GET["page"]) {
			case "accueil": include("pages/Accueil.php");
				break;
			case "histoire": include("pages/Histoire.php");
				break;
			case "inscription": include("pages/Inscription.php");
				break;
			case "connexion": include("pages/Connexion.php");
				break;
			case "lost_pass": include("pages/Lost_pass.php");
				break;
			case "blanche": include("pages/Magie_blanche.php");
				break;
			case "rouge": include("pages/Magie_rouge.php");
				break;
			case "noire": include("pages/Magie_noire.php");
				break;
			case "compte": include("pages/Compte.php");
				break;
			case "creation": include("Creation.php");
				break;
			case "consultation": include("pages/Consultation.php");
				break;
			case "recette": include("pages/Recette.php");
				break;
			case "erreur": include("pages/Erreur.php");
				break;
			default: include("pages/Construction.php");
		}
	}
	else include("pages/Accueil.php"); 
?>