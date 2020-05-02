StarOutUrl=		"images/StarOut.png";		//image par défaut
StarOverUrl=	"images/StarOver.png";		//image d'une étoile sélectionnée
StarBaseId=		"Star";						//id de base des étoiles
NbStar=			5;							//nombre d'étoiles
Evalued= false;								//Flag d'evaluation, stop les over out
Already= false;								//Flag de fin d'execution du click, ne reproduit pas le vote

LgtStarBaseId=StarBaseId.lastIndexOf('');

function NotationSystem() {
	for (i=1;i<NbStar+1;i++) {
		var img			=document.getElementById('Star'+i);
			
		img.onclick		= evaluation;
		//Réaction lors du clic sur une étoile
		//Evidemment, il faudrait compléter cette fonction pour la rendre vraiment utile.
		//Par exemple, envoyer la note dans une base de donnée via un XMLHttpRequest.
		
		img.alt			='Donner la note de '+i;
		//Texte au survol
		
		img.src			=StarOutUrl;
		img.onmouseover	=function() {StarOver(this.id);};
		img.onmouseout	=function() {StarOut(this.id);};
	}
}

function StarOver(Star) {
	if (Evalued) return;
	StarNb=Name2Nb(Star);
	for (i=1;i<(StarNb*1)+1;i++) {
		document.getElementById('Star'+i).src=StarOverUrl;
	}
}

function StarOut(Star) {
	if (Evalued) return;
	StarNb=Name2Nb(Star);
	for (i=1;i<(StarNb*1)+1;i++) {
		document.getElementById('Star'+i).src=StarOutUrl;
	}
}

function Name2Nb(Star) {
	//Le survol d'une étoile ne nous permet pas de connaître directement son numéro
	//Cette fonction extrait donc ce numéro à partir de l'Id
	StarNb=Star.slice(LgtStarBaseId);
	return(StarNb);
}

function evaluation() {
	Evalued = true;
	if (!Already) {
		var num_recipe = document.getElementById("num_recipe").value;
		var login = document.getElementById("login").value;
		var inventor = document.getElementById("inventor").value;
		file("phpscript/Evaluation.php","num_recipe="+num_recipe+"&login="+login+"&inventor="+inventor+"&mark="+Name2Nb(this.id));
	}
	Already = true;
}