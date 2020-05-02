<div class="formulaire">
	<div id="curseur" class="infobulle"></div>
	<form id="formulaire">
		<h1>creation de potion</h1>
		<p>
			<label for="name">Nom</label>
			<input name="name" id="name" type="text" maxlength="40" />
		</p>
		<p>
			<label for="category">Categorie</label>
			<select name="category" id="category">
				<option>Desalterant</option>
				<option>Euphorisant</option>
				<option>Curratif</option>
			</select>
		</p>
		<p id="limit">
			<input type="button" id="plus" value="+" onmouseover="montre('Ajoute un ingredient parmi la liste<br/>que propose la comunaut&eacute;')" onmouseout="cache()" onClick="add_ingredient(document.getElementById('formulaire'))"/>
			<input type="button" id="new" value="Nouveau" onmouseover="montre('Ajoute un ingredient que vous <br/>d&eacute;finirez pour vous et les autres')" onmouseout="cache()" onClick="add_newIngredient(document.getElementById('formulaire'))"/>
			<input type="button" id="minus" value="-" onmouseover="montre('Supprime le dernier ingredient')" onmouseout="cache()" onClick="del_ingredient(document.getElementById('formulaire'))"/>
		</p>
		<p >
			<label for="direction">Pr&eacute;paration</label>
			<textarea name="direction" id="direction" ></textarea>
		</p>
		<p>
			<input type="button" id="submit" value="Envoyer" onmouseover="montre('Un minimum de 2 ingredients est requis')" onmouseout="cache()" onClick="Validation_creation(document.getElementById('formulaire'))"/> ou <input id="reset" type="reset" value="annuler" />
		</p>
		<div id="finish" ></div>
	</form>
</div>