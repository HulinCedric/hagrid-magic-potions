<div class="formulaire">
	<form id="formulaire">
		<h1>Recuperation de pass</h1>
		<p>
			<label for="login">Login</label>
			<input name="login" id="login" type="text" maxlength="9" />
		</p>
		<p>
			<label for="mail">Mail</label>
			<input name="mail" id="mail" type="text" maxlength="30" />
		</p>
		<p>
			<input type="button" id="submit" value="Envoyer" onClick="Validation_lost_pass(document.getElementById('formulaire'))"/> ou <input id="reset" type="reset" value="annuler" />
		</p>
		<div id="finish" ></div>
	</form>
</div>