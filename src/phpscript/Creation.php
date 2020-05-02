<?php
	if (isset($_SESSION['user']))
		include "pages/Creation.php";
	else
		include "pages/Sorry.php";
?>