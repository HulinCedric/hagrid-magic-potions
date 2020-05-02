<?php
	header("Content-Type: text/xml; charset=utf-8"); 
	include "LoaderAjax.php";
	include "DBConnection.php";

	echo IngredientDB::getIngredientNameXML();
?>