<?php
	if(isset($_POST) && !empty($_POST['valid']))
		echo "<div id=\"finishValid\" ><p>Mail de confirmation envoy&eacute;</p></div>";
	if(isset($_POST) && !empty($_POST['already']))
		echo "<div id=\"finishValid\" ><p>Inscription deja valid&eacute;e !</p></div>";
	if(isset($_POST) && !empty($_POST['confirmation']))
		echo "<div id=\"finishValid\" ><p>Inscription valid&eacute;e !</p></div>";
	if(isset($_POST) && !empty($_POST['bad_log']))
		echo "<div id=\"finishInvalid\" ><p>Login inexistant</p></div>";
	if(isset($_POST) && !empty($_POST['bad_key']))
		echo "<div id=\"finishInvalid\" ><p>Cle de confirmation incorrect</p></div>";
?>