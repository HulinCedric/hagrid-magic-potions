<?php 
	echo "<div class=\"header_drill\" ";
	if (isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
		switch ($user->clan_name) {
			case "Sorcier": echo "id=\"header_drill_green\"";
				break;
			case "Necromancien": echo "id=\"header_drill_red\"";
				break;
			case "Mage": echo "id=\"header_drill_blue\"";
				break;
			default: echo "id=\"header_drill_green\"";
		}
	}
	else echo "id=\"header_drill_green\"";
	echo ">";
?>