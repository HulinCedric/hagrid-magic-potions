<?php
	include "LoaderAjax.php";
	include "DBConnection.php";

	if(isset($_POST) && !empty($_POST["id"])) {
		extract($_POST);
		
		RecipeDB::delete($_POST["id"]);
		
		UserDB::levelUp($_SESSION["user"]->login);
	}
?>