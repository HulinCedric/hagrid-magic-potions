<?php
	include "LoaderAjax.php";
	include "DBConnection.php";

	if(isset($_POST) && !empty($_POST["num_recipe"]) && !empty($_POST["login"]) && !empty($_POST["mark"]) && !empty($_POST["inventor"])) {
		extract($_POST);
		
		EvaluationDB::insert($_POST["num_recipe"], $_POST["login"], $_POST["mark"]);
		
		UserDB::levelUp($_POST["inventor"]);
	}
?>