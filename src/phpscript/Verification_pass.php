<?php 
	include "LoaderAjax.php";
	include "DBConnection.php";

	$login =  utf8_encode($_POST["login"]);
	$pass =  utf8_encode($_POST["pass"]);

	$result = mysql_query("SELECT login FROM user WHERE login='".$login."' AND pass='".$pass."'");
	
	echo mysql_num_rows($result);
?> 
