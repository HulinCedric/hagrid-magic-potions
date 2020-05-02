<?php
	header("Content-Type: text/xml; charset=utf-8"); 
	include "LoaderAjax.php";
	include "DBConnection.php";

	if(isset($_POST) && !empty($_POST["name"])) {
		extract($_POST);
		
		echo IngredientDB::getIngredient($_POST["name"])->type;
	}
?>