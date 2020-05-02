<?php
	include "LoaderAjax.php";
	include "DBConnection.php";
	
	UserDB::sendPass($_POST['login'], $_POST['mail']);				
?>