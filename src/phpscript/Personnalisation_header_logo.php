<?php 
	$tof= "images/header_logo.png";
	if (isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
		if(file_exists("images/avatar/" . $user->login . ".jpg"))
			$tof= "images/avatar/" . $user->login . ".jpg";
	}
	echo "<img id=\"logo\" src=\"" . $tof . "\" alt=\"logo\" />";
?>