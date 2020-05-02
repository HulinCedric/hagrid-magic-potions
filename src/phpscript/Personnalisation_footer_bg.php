<?php 
	echo "<div class=\"footer\" ";
	if (isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
		switch ($user->clan_name) {
			case "Sorcier": echo "id=\"footer_green\"";
				break;
			case "Necromancien": echo "id=\"footer_red\"";
				break;
			case "Mage": echo "id=\"footer_blue\"";
				break;
			default: echo "id=\"footer_green\"";
		}
	}
	else echo "id=\"footer_green\"";
	echo ">";
?>