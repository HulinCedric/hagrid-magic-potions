<?php 
	include "LoaderAjax.php";
	include "DBConnection.php";

	$name =  utf8_encode($_POST["name"]);

	$result = mysql_query("SELECT name FROM ingredient WHERE name='".$name."'"); 
	
	echo mysql_num_rows($result);
?> 
