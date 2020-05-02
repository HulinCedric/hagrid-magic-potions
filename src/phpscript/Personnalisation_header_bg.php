<?php 
	echo "<div class=\"header\" ";
	if (isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
		switch ($user->clan_name) {
			case "Sorcier": echo "id=\"header_green\"";
				break;
			case "Necromancien": echo "id=\"header_red\"";
				break;
			case "Mage": echo "id=\"header_blue\"";
				break;
			default: echo "id=\"header_green\"";
		}
	}
	else echo "id=\"header_green\"";
	echo ">";
?>