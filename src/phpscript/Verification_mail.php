<?php 
	include "LoaderAjax.php";
	include "DBConnection.php";

	$login =  utf8_encode($_POST["login"]);
	$mail =  utf8_encode($_POST["mail"]);

	$result = mysql_query("SELECT login FROM user WHERE login='".$login."' AND mail='".$mail."'");
	
	echo mysql_num_rows($result);
?> 
