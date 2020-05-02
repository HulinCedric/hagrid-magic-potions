<?php 
	include "Configuration.php";
    
	session_start(); // On appelle session_start() APRÈS avoir enregistré l'autoload

    $_SESSION["connection"] = DBConnection::getInstance($host, $user, $pass, $db);
?>