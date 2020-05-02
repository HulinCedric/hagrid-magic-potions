<h1 class="bubble">Bienvenue 
	<?php 
	echo isset($_SESSION["user"]) ? 
		$_SESSION["user"]->login : 
		" jeune inconnu, pour rejoindre la communaute des sorciers, cliques <a href='index.php?page=inscription'>ici</a>"; 
	?>
</h1>
<div id="hagrid_dessin">
	<img src="images/hagrid_dessin.png" alt="Hagrid" />
</div>