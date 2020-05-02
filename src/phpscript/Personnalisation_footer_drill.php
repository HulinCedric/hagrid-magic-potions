<?php 
	echo "<div class=\"footer_drill\" ";
	if (isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
		switch ($user->clan_name) {
			case "Sorcier": echo "id=\"footer_drill_green\"";
				break;
			case "Necromancien": echo "id=\"footer_drill_red\"";
				break;
			case "Mage": echo "id=\"footer_drill_blue\"";
				break;
			default: echo "id=\"footer_drill_green\"";
		}
	}
	else echo "id=\"footer_drill_green\"";
	echo "></div>";
?>