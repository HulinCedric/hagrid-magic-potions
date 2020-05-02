<?php 
	include "phpscript/Loader.php";
	include "phpscript/DBConnection.php";
	include "phpscript/Personnalisation_user.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta name="keywords" content="hagrid, magic, potion, recette, magique" />
		<meta name="author" content="C&eacute;dric Hulin" />
		<meta name="robots" content="all" />
		
		<title>Hagrid's Magic Potions</title>
		<meta name="description" content="Hagrid's magic potions permet d'&eacute;changer et de proposer des recettes, des jeux, des exp&eacute;riences autour de la magie." />

		<meta http-equiv="content-language" content="fr" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="pragma" content="no-cache" />
		
		<!-- Tag facebook -->
		<meta property="og:title" content="Hagrid&#039;s Magic Potions" />
		<meta property="og:type" content="drink" />
		<meta property="og:url" content="http://hagridsmagicpotions.free.fr" />
		<meta property="og:image" content="http://hagridsmagicpotions.free.fr/images/hagrid_dessin.png" />
		<meta property="og:site_name" content="Hagrid&#039;s Magic Potions" />
		<meta property="fb:admins" content="1265177825" />
		
		<!-- Lien de l'icone -->
		<link rel="icon" href="images/favicon.png" type="image/x-icon" />
		<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />

		<!-- Inclusion du css -->
		<link rel="stylesheet" type="text/css" href="style.css" />
		
		<!-- Inclusion des css des pages additionnels -->
		<link rel="stylesheet" type="text/css" href="stylesheet/accueil.css" />
		<link rel="stylesheet" type="text/css" href="stylesheet/formulaire.css" />
		<link rel="stylesheet" type="text/css" href="stylesheet/histoire.css" />
		<link rel="stylesheet" type="text/css" href="stylesheet/compte.css" />
		<link rel="stylesheet" type="text/css" href="stylesheet/recette.css" />
		
		<!-- Inclusion des scripts javascript -->
		<script type="text/javascript" src="javascript/expandMenu.js"></script>
		<script type="text/javascript" src="javascript/AjaxRequest.js"></script>
		<script type="text/javascript" src="javascript/formVerif.js"></script>
		<script type="text/javascript" src="javascript/formDynamic.js"></script>
		<script type="text/javascript" src="javascript/infoBulle.js"></script>
		<script type="text/javascript" src="javascript/starEval.js"></script>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	</head>
	<body onload="init();NotationSystem();">
		<div id="site">
			
			<!-- Header -->
			<?php include "phpscript/Personnalisation_header_bg.php"; ?>
				<div id="title"><a href="index.php?page=accueil"><?php echo $title ?></a></div>
				<div id="subtitle"><?php echo $subtitle ?></div>
				<?php include "phpscript/Personnalisation_header_logo.php"; ?>
				<div id="button"><?php echo $button ?></div>
				<?php include "phpscript/Personnalisation_header_drill.php"; ?>
					<!-- Resou le bug de coulure -->
               		<a onclick="expandMenu('histoire')"><img id="imgmap" src="images/histoire.gif" alt="" /></a>
				</div>
			</div>
		
			<!-- Center -->
			<div id="body">
				
				<!-- Menu -->
				<div id="menu">
					<ul>
						<li class="menu_li"><p>Histoire</p></li>
					</ul>
					<div class="submenu" id="histoire">
						<ul>
							<li><a href="index.php?page=blanche">Magie Blanche</a></li>
							<li><a href="index.php?page=rouge">Magie Rouge</a></li>
							<li><a href="index.php?page=noire">Magie Noire</a></li>
						</ul>
					</div>
					<ul>
						<li class="menu_li" onclick="expandMenu('recette')"><p>Recette</p></li>
					</ul>
					<div class="submenu" id="recette">
						<ul>
							<li><a href="index.php?page=creation">Cree</a></li>
							<li><a href="index.php?page=consultation&section=1">Consulter</a></li>
						</ul>
					</div>
					<ul>
						<li class="menu_li"><a href="index.php?page=descriptif">Descriptif</a></li>
					</ul>
					<ul>
						<li class="menu_li"><a href="index.php?page=video">Les Tours</a></li>
					</ul>
				</div>
					
				<!-- Container -->
				<div id="container">
					<?php include "phpscript/Orientation.php"; ?>
					<?php include "phpscript/Personnalisation_footer_drill.php"; ?>
				</div>
				<div id="footer_drill"></div>
			</div>
			
			<!-- Footer -->
			<?php include "phpscript/Personnalisation_footer_bg.php"; ?>
				<p>&copy; 2011 <a href="mailto:hulin.cedric@gmail.com">C&eacute;dric Hulin</a> - <a href="mailto:chakir.bahammou@gmail.com">Chakir Bahammou</a></p>
				<iframe id="facebook" src="http://www.facebook.com/plugins/like.php?href=http://hagridsmagicpotions.free.fr&amp;layout=button_count&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0"  allowTransparency="true"></iframe>
				<div id="tweeter">
					<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://hagridsmagicpotions.free.fr" data-text="Viens concocter une potion sur Hagrid's Magic Potions" data-count="horizontal" data-via="PonayMort" data-lang="fr">Tweet</a>
				</div>
			</div>
		</div>
	</body>
</html>