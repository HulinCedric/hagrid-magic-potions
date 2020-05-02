function VerifySpace(valeur) {
 	if(valeur.indexOf(' ',0) != -1)
        return false;
    return true;
}

function VerifyAlphabetic(valeur) { 
	if (valeur.match(/^[a-zA-Z]+$/))
		return true;
	return false;
}

function VerifyAlphabeticEspace(valeur) { 
	if (valeur.match(/^[a-zA-Z- 'éèàùîôûâêçïëüæœ]+$/))
		return true;
	return false;
}

function VerifyNumeric(valeur) { 
    for( var i=0; i< valeur.length; i++)
        if(isNaN(valeur))
            return false; 
    return true;
}

function VerifyMail(valeur) {
	var regex=/^[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]+(\.[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]+)*@(([a-z0-9]([-a-z0-9]*[a-z0-9]+)?){1,63}\.)+([a-z0-9]([-a-z0-9]*[a-z0-9]+)?){2,63}$/i;
	//'
    if (valeur.match(regex))
		return true;
  	return false;
}

function Validation_inscription(formulaire) {
	var ok=1;
	var erreur="";	
	
	// Traiter le login
	//
  	if(formulaire.login.value == "") {
 		formulaire.login.className = "invalid";
 		ok=0;
		erreur="<p>Votre login est vide</p>";
  	}
	else
	if(!VerifyAlphabetic(formulaire.login.value)) {
 		formulaire.login.className = "invalid";
 		ok=0;
		erreur="<p>Votre login doit &ecirc;tre alphab&eacute;tique</p>";
  	}
	else
	if(file("phpscript/Verification_login.php","login="+escape(formulaire.login.value))==1) {
		formulaire.login.className = "invalid";
		ok=0;
		erreur="<p>Ce login est deja pris</p>";
	} 
	else formulaire.login.className = "valid";
    
    // Traiter le mot de passe
    // 
  	if(formulaire.pass.value == "") {
 		formulaire.pass.className = "invalid";
 		ok=0;
		erreur=erreur+"<p>Votre mot de passe est vide</p>";
  	}
	else formulaire.pass.className = "valid";
 
     // Traiter le mail
    //
	if(formulaire.mail.value == "") {
		formulaire.mail.className = "invalid";
 		ok=0;
		erreur=erreur+"<p>Votre mail est vide</p>";
	}
	else
	if(!VerifyMail(formulaire.mail.value)) {
    	formulaire.mail.className = "invalid";
		ok=0;
		erreur=erreur+"<p>Votre mail est invalide </p>";
    }
	
	// Traitement de l'image
	//
	if (formulaire.avatar.value != "") {
		var extension= formulaire.avatar.value.substring(formulaire.avatar.value.length-4, formulaire.avatar.value.length);
		if (extension.toLowerCase() != ".jpg" && extension.toLowerCase() != ".png") {
		    formulaire.avatar.className = "invalid";
			ok=0;
			erreur=erreur+"<p>L'extension de votre image n'est pas .jpg ou .png</p>";
		}
		else formulaire.avatar.className = "valid";
	}
	
	// Traitement du code postale
	//
	if (formulaire.postal_code.value != "") {
		if(!VerifyNumeric(formulaire.postal_code.value)) {
		    formulaire.postal_code.className = "invalid";
			ok=0;
			erreur=erreur+"<p>Le code postale n'est pas numerique</p>";
		}
		else formulaire.postal_code.className = "valid";
	}
	
	// Traitement de la ville
	//
	if (formulaire.town.value != "") {
		if(!VerifyAlphabetic(formulaire.town.value)) {
		    formulaire.town.className = "invalid";
			ok=0;
			erreur=erreur+"<p>Le nom de la ville doit etre alphabetique</p>";
		}
		else formulaire.town.className = "valid";
	}
	
	// Traitement de la description
	//
	if (formulaire.description.value != "") 
 		formulaire.description.className = "valid";

	// Traitement de la description
	//
	if (formulaire.quotation.value != "") 
 		formulaire.quotation.className = "valid";

	// Traiter la reponse
    //
    if (ok)
    	return true;
    else
    {
		document.getElementById("finish").style.display = "block";
		document.getElementById("finish").className = "finishInvalid";
		document.getElementById("finish").innerHTML = erreur;
    	return false;
    }
}

function Validation_modification(formulaire)
{
	var ok=1;
	var erreur="";	
	
	// Traiter le login
	//
  	formulaire.login.className = "valid";
    
    // Traiter le vieux mot de passe
    // 
  	if(formulaire.oldpass.value == "") {
 		formulaire.oldpass.className = "invalid";
 		ok=0;
		erreur="<p>Votre mot de passe est vide</p>";
  	}
	else
	if(file("phpscript/Verification_pass.php", "login="+escape(formulaire.login.value)+"&pass="+escape(formulaire.oldpass.value))==0) {
		formulaire.oldpass.className = "invalid";
		ok=0;
		erreur="<p>Le mot de passe est incorrect</p>";
	} 
	else formulaire.oldpass.className = "valid";
	
	// Traiter le nouveau mot de passe
    // 
 	formulaire.newpass.className = "valid";
  
	 // Traiter le mail
    //
	if(formulaire.mail.value == "") {
		formulaire.mail.className = "invalid";
 		ok=0;
		erreur=erreur+"<p>Votre mail est vide</p>";
	}
	else
	if(!VerifyMail(formulaire.mail.value)) {
    	formulaire.mail.className = "invalid";
		ok=0;
		erreur=erreur+"<p>Votre mail est invalide </p>";
    }
	
	// Traitement de l'image
	//
	if (formulaire.avatar.value != "") {
		var extension= formulaire.avatar.value.substring(formulaire.avatar.value.length-4, formulaire.avatar.value.length);
		if (extension.toLowerCase() != ".jpg" && extension.toLowerCase() != ".png") {
		    formulaire.avatar.className = "invalid";
			ok=0;
			erreur=erreur+"<p>L'extension de votre image n'est pas .jpg ou .png</p>";
		}
		else formulaire.avatar.className = "valid";
	}
	
	// Traitement du code postale
	//
	if (formulaire.postal_code.value != "") {
		if(!VerifyNumeric(formulaire.postal_code.value)) {
		    formulaire.postal_code.className = "invalid";
			ok=0;
			erreur=erreur+"<p>Le code postale n'est pas numerique</p>";
		}
		else formulaire.postal_code.className = "valid";
	}
	
	// Traitement de la ville
	//
	if (formulaire.town.value != "") {
		if(!VerifyAlphabetic(formulaire.town.value)) {
		    formulaire.town.className = "invalid";
			ok=0;
			erreur=erreur+"<p>Le nom de la ville doit etre alphabetique</p>";
		}
		else formulaire.town.className = "valid";
	}
	
	// Traitement de la description
	//
	if (formulaire.description.value != "") 
 		formulaire.description.className = "valid";

	// Traitement de la description
	//
	if (formulaire.quotation.value != "") 
 		formulaire.quotation.className = "valid";

	// Traiter la reponse
    //
    if (ok)
    	return true;
    else
    {
		document.getElementById("finish").style.display = "block";
		document.getElementById("finish").className = "finishInvalid";
		document.getElementById("finish").innerHTML = erreur;
    	return false;
    }
}

function Validation_connexion(formulaire)
{
	var ok=1;
	var erreur="";	
		
	// Traiter le login
	//
  	if(formulaire.login.value == "") {
 		formulaire.login.className = "invalid";
 		ok=0;
		erreur="<p>Votre login est vide</p>";
  	}
	else 
	if(file("phpscript/Verification_login.php","login="+escape(formulaire.login.value))==0) {
		formulaire.login.className = "invalid";
		ok=0;
		erreur="<p>Le login est inconnu</p>";
	} 
	else formulaire.login.className = "valid";
    
    // Traiter le mot de passe
    // 
  	if(formulaire.pass.value == "") {
 		formulaire.pass.className = "invalid";
 		ok=0;
		erreur=erreur+"<p>Votre mot de passe est vide</p>";
  	}
	else
	if(erreur == "" && 
	   file("phpscript/Verification_pass.php", "login="+escape(formulaire.login.value)+"&pass="+escape(formulaire.pass.value))==0) {
		formulaire.pass.className = "invalid";
		ok=0;
		erreur="<p>Le mot de passe est incorrect</p>";
	} 
	else formulaire.pass.className = "valid";

	// Traiter la reponse
    //
    if (ok) {
		file("phpscript/Connexion.php", "login="+escape(formulaire.login.value));
		document.getElementById("finish").style.display = "block";
		document.getElementById("finish").className = "finishValid";
		document.getElementById("finish").innerHTML = "<p>Connexion r&eacute;alis&eacute;e !</p>";
	}
    else {
		document.getElementById("finish").style.display = "block";
		document.getElementById("finish").className = "finishInvalid";
		document.getElementById("finish").innerHTML = erreur;
    }
}

function Validation_lost_pass(formulaire)
{
	var ok=1;
	var erreur="";	
	
	// Traiter le login
	//
  	if(formulaire.login.value == "") {
 		formulaire.login.className = "invalid";
 		ok=0;
		erreur="<p>Votre login est vide</p>";
  	}
	else 
	if(file("phpscript/Verification_login.php", "login="+escape(formulaire.login.value))==0) {
		formulaire.login.className = "invalid";
		ok=0;
		erreur="<p>Le login est inconnu</p>";
	} 
	else formulaire.login.className = "valid";
    
    // Traiter le mail
    //
	if(formulaire.mail.value == "") {
		formulaire.mail.className = "invalid";
 		ok=0;
		erreur=erreur+"<p>Votre mail est vide</p>";
	}
	else
	if(!VerifyMail(formulaire.mail.value)) {
    	formulaire.mail.className = "invalid";
		ok=0;
		erreur=erreur+"<p>Votre mail est invalide </p>";
    }
	else
	if(erreur == "" && 
	   file("phpscript/Verification_mail.php", "login="+escape(formulaire.login.value)+"&mail="+escape(formulaire.mail.value))==0) {
		formulaire.mail.className = "invalid";
		ok=0;
		erreur="<p>Le mail ne correspond pas</p>";
	} 
	else formulaire.mail.className = "valid";

	// Traiter la reponse
    //
   if (ok) {
		file("phpscript/Lost_pass.php", "login="+escape(formulaire.login.value)+"&mail="+escape(formulaire.mail.value));
		document.getElementById("finish").style.display = "block";
		document.getElementById("finish").className = "finishValid";
		document.getElementById("finish").innerHTML = "<p>Mot de passe envoy&eacute; par mail</p>";
	}
    else
    {
		document.getElementById("finish").style.display = "block";
		document.getElementById("finish").className = "finishInvalid";
		document.getElementById("finish").innerHTML = erreur;
    }
}

function Validation_creation(formulaire)
{
	var ok=1;
	var erreur="";	
	
	// Traiter le nom
	//
  	if(formulaire.name.value == "") {
 		formulaire.name.className = "invalid";
 		ok=0;
		erreur="<p>Le nom de recette est vide</p>";
  	}
	else 
	if(file("phpscript/Verification_recipe.php", "name="+escape(formulaire.name.value))==1) {
		formulaire.name.className = "invalid";
		ok=0;
		erreur="<p>Le nom de recette est deja pris</p>";
	} 
	else formulaire.name.className = "valid";
    
	// Definition d'un prototype d'array
	//
	var i = 1;
	Array.prototype.contains = function (element) {
		for (var i = 0; i < this.length; i++)
			if (this[i] == element)
				return true;
		return false;
	}
	
	var array = new Array();

	if (count_ingredient() < 2)  {ok=0;erreur=erreur+"<p>Le nombre d'ingredient minimum est 2</p>";}
	while (document.getElementById("ingredient"+i)!=null) {
		
		// Traiter les nouveaux ingredients
    	//
		if (document.getElementsByName("new_ingredient_name"+i)[0]!= null) {
			if (document.getElementsByName("new_ingredient_name"+i)[0].value == "") {
				document.getElementsByName("new_ingredient_name"+i)[0].className = "invalid";
 				ok=0;
				erreur=erreur+"<p>Le nom de l'ingredient "+i+" est vide</p>";
			}
			else
			if (!VerifyAlphabeticEspace(document.getElementsByName("new_ingredient_name"+i)[0].value)) {
				document.getElementsByName("new_ingredient_name"+i)[0].className = "invalid";
 				ok=0;
				erreur=erreur+"<p>La nom de l'ingredient "+i+" doit etre alphabetique</p>";
			}
			else
			if(file("phpscript/Verification_ingredient.php", "name="+escape(document.getElementsByName("new_ingredient_name"+i)[0].value))==1) {
				document.getElementsByName("new_ingredient_name"+i)[0].className = "invalid";
 				ok=0;
				erreur=erreur+"<p>L'ingredient "+i+" est deja inscrit</p>";
			}
			else
			if(array.contains(document.getElementsByName("new_ingredient_name"+i)[0].value)) {
				document.getElementsByName("new_ingredient_name"+i)[0].className = "invalid";
 				ok=0;
				erreur=erreur+"<p>L'ingredient "+i+" est deja utilisee dans la recette</p>";
			}
			else {
				array.push(document.getElementsByName("new_ingredient_name"+i)[0].value);
				document.getElementsByName("new_ingredient_name"+i)[0].className = "valid";
			}
		}
		// Traiter les ingredients connus
		//
		else
		if(array.contains(document.getElementsByName("ingredient_name"+i)[0].value)) {
 			ok=0;
			erreur=erreur+"<p>L'ingredient "+i+" est deja utilisee dans la recette</p>";
		}
		else {
			array.push(document.getElementsByName("ingredient_name"+i)[0].value);
		}
		
		// Traiter les quantites
    	//
		if (document.getElementsByName("quantity"+i)[0].value == "") {
			document.getElementsByName("quantity"+i)[0].className = "quantityInvalid";
 			ok=0;
			erreur=erreur+"<p>La quantite de l'ingredient "+i+" est vide</p>";
		} 
		else
		if (!VerifyNumeric(document.getElementsByName("quantity"+i)[0].value)) {
			document.getElementsByName("quantity"+i)[0].className = "quantityInvalid";
 			ok=0;
			erreur=erreur+"<p>La quantite de l'ingredient "+i+" doit etre numerique</p>";
		}
		else document.getElementsByName("quantity"+i)[0].className = "quantityValid";
	
	
		i++;
	}

	// Traiter la preparation
    //
	if(formulaire.direction.value == "") {
		formulaire.direction.className = "invalid";
 		ok=0;
		erreur=erreur+"<p>La preparation est vide</p>";
	}
	else formulaire.direction.className = "valid";

	// Traiter la reponse
    //
   	if (ok) {
		i = 1;
		var ingredients = "";
		
		// Insertion des nouveaux ingredients
		//
		while (document.getElementById("ingredient"+i)!=null) {
			if (document.getElementsByName("new_ingredient_name"+i)[0] != null) {
				ingredients = "name=" + escape(document.getElementsByName("new_ingredient_name"+i)[0].value) + "&";
				ingredients = ingredients + "type=" + document.getElementsByName("type"+i)[0].value;
				file("phpscript/Creation_ingredient.php", ingredients);
			}
			i++;
		}
		
		// Insertion de la recette
		//
		var num_recipe = file("phpscript/Creation_recipe.php", 	"name=" + escape(formulaire.name.value) + 
																"&direction=" + escape(formulaire.direction.value) +
																"&category=" + formulaire.category.value);
		
		i = 1;
		// Faire le liens avec les ingredients
		//
		while (document.getElementById("ingredient"+i)!=null) {
			if (document.getElementsByName("new_ingredient_name"+i)[0]!= null)
				ingredients = "&name=" + document.getElementsByName("new_ingredient_name"+i)[0].value + "&";
			else
				ingredients = "&name=" + document.getElementsByName("ingredient_name"+i)[0].value + "&";
		
			ingredients = ingredients + "quantity=" + escape(document.getElementsByName("quantity"+i)[0].value) + "&";
		
			if (document.getElementsByName("scale"+i)[0] != null)
				ingredients = ingredients + "scale=" + document.getElementsByName("scale"+i)[0].value;
			file("phpscript/Link_ingredient.php", "num_recipe=" + num_recipe + ingredients);			
			i++;
		}
												
		document.getElementById("finish").style.display = "block";
		document.getElementById("finish").className = "finishValid";
		document.getElementById("finish").innerHTML = "<p>Votre recette est maintenant dans le grand livre d'Hagrid</p>";
	}
    else
    {
		document.getElementById("finish").style.display = "block";
		document.getElementById("finish").className = "finishInvalid";
		document.getElementById("finish").innerHTML = erreur;
    }
}