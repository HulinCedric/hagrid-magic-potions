<?php
	include "LoaderAjax.php";
	include "DBConnection.php";

	if(isset($_POST) && !empty($_POST["name"]) && !empty($_POST["direction"]) && !empty($_POST["category"])) {
		extract($_POST);

		$recipe = new Recipe($_POST["name"], $_POST["direction"], $_POST["category"], $_SESSION["user"]->login);
				
		echo RecipeDB::insert($recipe);
		
		UserDB::levelUp($_SESSION["user"]->login);
	}
?>