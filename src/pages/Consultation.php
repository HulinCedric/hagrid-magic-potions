<?php
	
	// --------------- Etape 1 ---------------
	// Situer la page de recette et connaitre
	// le nombre de recette total
	// ---------------------------------------
	
	// Nombre de recettes par page
	$nombreDeRecettesParPage = 5;
	
	// On récupère le nombre total de recettes
	$result = mysql_query('SELECT COUNT(*) AS nb_recettes FROM recipe');
	$data = mysql_fetch_array($result);
	$nombreTotalDesRecettes = $data['nb_recettes'];
	
	// Calcul du nombre de pages à créer
	$nombreDePages  = ceil($nombreTotalDesRecettes / $nombreDeRecettesParPage);
	
	// Recuperation du numero de la page courante
	if (isset($_GET['section']) && !empty($_GET['section']))	$page = $_GET['section'];
	else	$page = 1;
	
	// Faire attention au petit malin
	if ($page < 1 || $page > $nombreDePages)	$page = 1;

	// --------------- Etape 3 ---------------
	// Afficher les recette
	// ---------------------------------------

	// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
	$premiereRecetteAafficher = ($page-1) * $nombreDeRecettesParPage;
	
	$result = mysql_query('SELECT CAST( recipe_date AS DATE ) AS date, num_recipe, name, category, inventor
	FROM recipe
	GROUP BY recipe_date
	ORDER BY recipe_date DESC LIMIT ' . $premiereRecetteAafficher . ', ' . $nombreDeRecettesParPage);
 	
	setlocale(LC_TIME,"fr_FR");
	$time = "";
	
	// On fait une boucle pour lister tout ce que contient la table :
	while ($data = mysql_fetch_array($result)) {
	
		if ($time != $data["date"]) {
			$time = $data["date"];
			$title = "du " . strftime("%A %d %B", strtotime($data["date"]));
			$date_diff = floor((time() - strtotime($data["date"]))/(60*60*24));
				
			if ($date_diff == 0) $title = "d'aujourd'hui";
			if ($date_diff == 1) $title = "d'hier";
			
			echo "<div class=\"recette_div_title\"><h1>Recettes ". $title ."</h1></div>";
		}
			
		$tof= "images/recette/default.jpg";
		if(file_exists("images/recette/" . $data['num_recipe'] . ".jpg"))
			$tof= "images/recette/" . $data['num_recipe'] . ".jpg";
?>
  				
<div class="recette_div">
	<img class="recette_img" src="<?php echo $tof; ?>" alt="<?php echo $data['name']; ?>" />
	<div class="recette_title"><a href="index.php?page=recette&id=<?php echo $data['num_recipe']; ?>"><?php echo $data['name']; ?></a></div>
	<p class="recette_domaine">Domaine <?php echo $data['category']; ?></p>
	<p class="recette_inventor">par <a href="index.php?page=compte&login=<?php echo $data['inventor']; ?>"><?php echo $data['inventor']; ?></a></p>
	<p class="recette_stat">
	<?php
		echo EvaluationDB::getNbEval($data['num_recipe']) . " votes - ";
	
		echo CommentDB::getNbComment($data['num_recipe']) . " commentaires";
	?></p>
	<div class="recette_note">
<?php
	$nbStarOver = round (EvaluationDB::getAverage($data['num_recipe']));
	
	for ($i = 0 ; $i < $nbStarOver ; $i++)
		echo "<img src=\"images/StarOver.png\" />";
	
	for ($i = $nbStarOver ; $i < 5 ; $i++)
		echo "<img src=\"images/StarOut.png\" />";
?>
	</div>
</div>
			
<?php
	}

	// --------------- Etape 2 -----------------
	// On écrit les liens vers chacune des pages
	// -----------------------------------------
	 
	$ecart = 2;
	$min=$page-$ecart;
	$max=$page+$ecart;
	if($min < 1)	$min=1;
	if($max > $nombreDePages)	$max=$nombreDePages;
	
	echo '<div id="recette_bottom_links">Page ' . $page . ' sur '. $nombreDePages . ' : ';
	if($min != 1)
	{
		echo '<a href="index.php?page=consultation&section=1">1</a> ... ';
	}
	while($min <= $max && $min != $nombreDePages)
	{
		echo '<a href="index.php?page=consultation&section=' . $min . '">' . $min . '</a> ';
		$min++;
	}
	if($max == $nombreDePages)
	{
		echo '<a href="index.php?page=consultation&section=' . $nombreDePages . '">' . $nombreDePages . '</a></center>';
	}
	else
	{
		echo '... <a href="index.php?page=consultation&section=' . $nombreDePages . '">' . $nombreDePages . '</a></center>';
	}
	
	$p=$page-1;
	$s=$page+1;
	
	if($page == 1 && $page ==  $nombreDePages)	
	{
	}
	else
	if($page == 1)	
	{
		echo "<p><input class=\"recette_div_button\" type=\"button\" value=\"Suivant >>\"  onclick=\"window.location.href='index.php?page=consultation&section=" . $s . "';\" /></p>";
	}
	else
	if($page == $nombreDePages)
	{
		echo "<p><input class=\"recette_div_button\" type=\"button\" value=\"<< Precedent\" onclick=\"window.location.href='index.php?page=consultation&section=" . $p . "';\" /></p>";
	}
	else
	if($page != 1 && $page != $nombreDePages)
	{
		echo "<p><input class=\"recette_div_button\" type=\"button\" value=\"<< Precedent\" onclick=\"window.location.href='index.php?page=consultation&section=" . $p . "';\" /><input class=\"recette_div_button\" type=\"button\" value=\"Suivant >>\" onclick=\"window.location.href='index.php?page=consultation&section=" . $s . "';\" /></p>";	
	}
	echo '</div>';
?>