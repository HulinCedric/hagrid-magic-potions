<?php 
	include "LoaderAjax.php";
	include "DBConnection.php";

	$login =  utf8_encode($_POST["login"]);

	$result = mysql_query("SELECT login FROM valid_account WHERE login='".$login."' AND valid='1'"); 
	
	echo mysql_num_rows($result);
?>