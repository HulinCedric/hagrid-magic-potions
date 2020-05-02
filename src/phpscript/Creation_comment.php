<?php
	include "LoaderAjax.php";
	include "DBConnection.php";

	if(isset($_POST) && !empty($_POST["num_recipe"]) && !empty($_POST["login"]) && !empty($_POST["description"])) {
		extract($_POST);
		
		CommentDB::insert($_POST["num_recipe"], $_POST["login"], $_POST["description"]);
	}
?>