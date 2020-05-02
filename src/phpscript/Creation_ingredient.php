<?php
	include "LoaderAjax.php";
	include "DBConnection.php";

	if(isset($_POST) && !empty($_POST["name"]) && !empty($_POST["type"])) {
		extract($_POST);

		$ingredient = new Ingredient($_POST["name"], $_POST["type"]);
		
		IngredientDB::insert($ingredient);
	}
?>