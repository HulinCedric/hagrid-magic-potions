<?php include("phpscript/Inscription.php"); ?>
<div class="formulaire">
	<form id="start" enctype="multipart/form-data" action="index.php?page=inscription" method="post" onSubmit="return Validation_inscription(this)">
		<h1>Inscris toi jeune sorcier(e)</h1>
		<p>
			<label for="login">Login</label>
			<input name="login" id="login" type="text" maxlength="9" />
		</p>
		<p>
			<label for="pass">Mot de passe</label>
			<input name="pass" id="pass" type="password" maxlength="12" />
		</p>
		<p>
			<label for="mail">Mail</label>
			<input name="mail" id="mail" type="text" maxlength="30" />
		</p>
		<p>
			<label for="clan_name">Clan</label>
			<select name="clan_name" id="clan_name">
				<option>Sorcier</option>
				<option>Necromancien</option>
				<option>Mage</option>
			</select>
		</p>
	
		<div id="options">
			<p class="show">
				<a href="#options">Afficher + d'options</a>
			</p>
			<p class="hide">
				<a href="#start">Masquer les options</a>
			</p>
			<p>
				<label for="avatar">Avatar</label>
				<input name="avatar" id="avatar" type="file" />
			</p>
			<p>
				<label for="postal_code">Code Postal</label>
				<input name="postal_code" id="postal_code" type="text" maxlength="5" />
			</p>
			<p>
				<label for="town">Ville</label>
				<input name="town" id="town" type="text" maxlength="10" />
			</p>
			<p>
				<label for="country">Pays</label>
				<select name="country" id="country">
					<option></option>
					<option>France</option>
					<option>Allemagne</option>
					<option>Angleterre</option>
					<option>Espagne</option>
					<option>Italie</option>
					<option>Pays-Bas</option>
					<option>Russie</option>
				</select>
			</p>
			<p>
				<label for="description">Description</label>
				<textarea name="description" id="description"></textarea>
			</p>
			<p>
				<label for="quotation">Citation</label>
				<input name="quotation" id="quotation" type="text" maxlength="100" />
			</p>
		</div>
		<p>
			<input type="submit" id="submit" value="Envoyer" />  ou <input id="reset" type="reset" value="annuler" />
		</p>
		<?php include("phpscript/Inscription_valid.php"); ?>
		<div id="finish" ></div>
	</form>
</div>