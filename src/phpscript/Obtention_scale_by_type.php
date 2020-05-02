<?php
	header("Content-Type: text/xml; charset=utf-8"); 
	include "LoaderAjax.php";
	include "DBConnection.php";

	if(isset($_POST) && !empty($_POST["type"])) {
		extract($_POST);
		
		echo IngredientDB::getScaleTypeXML($_POST["type"]);
	}
?>