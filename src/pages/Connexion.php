<div class="formulaire">
	<form id="formulaire">
		<h1>Connexion</h1>
		<p>
			<label for="login">Login</label>
			<input name="login" id="login" type="text" maxlength="9" />
		</p>
		<p>
			<label for="pass">Mot de passe</label>
			<input name="pass" id="pass" type="password" maxlength="12" />
		</p>
		<p>
			<input type="button" id="submit" value="Envoyer" onClick="Validation_connexion(document.getElementById('formulaire'))"/> ou <input id="reset" type="reset" value="annuler" />
		</p>
		<p>
			<a id="lost_pass" href="index.php?page=lost_pass">mot de passe oubli&eacute; ?</a>
		</p>
		<div id="finish" ></div>
	</form>
</div>