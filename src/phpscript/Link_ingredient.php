<?php
	include "LoaderAjax.php";
	include "DBConnection.php";

	if(isset($_POST) && !empty($_POST["num_recipe"]) && !empty($_POST["name"]) && !empty($_POST["quantity"])) {
		extract($_POST);
		
		RecipeDB::linkIngredient($_POST["num_recipe"], $_POST["name"], $_POST["quantity"], $_POST["scale"]);
	}
?>