var visible = false; // La variable i nous dit si la bulle est visible ou non

function move(e) {
	
	// Si la bulle est visible, on calcul en temps reel sa position ideale
	//
	if(visible) {
    
		// Si on est pas sous IE
	    //
	    if (navigator.appName!="Microsoft Internet Explorer") {
	    	document.getElementById("curseur").style.left=(e.pageX - 230)+"px";
	    	document.getElementById("curseur").style.top=(e.pageY - 210)+"px";
	    }
    	else {
    		if(document.documentElement.clientWidth>0) {
				document.getElementById("curseur").style.left=20+event.x+document.documentElement.scrollLeft+"px";
				document.getElementById("curseur").style.top=10+event.y+document.documentElement.scrollTop+"px";
    		} 
    		else {
				document.getElementById("curseur").style.left=20+event.x+document.body.scrollLeft+"px";
				document.getElementById("curseur").style.top=10+event.y+document.body.scrollTop+"px";
	     	}
    	}
  	}
}

function montre(text) {
 	if(!visible) {
  		document.getElementById("curseur").style.visibility = "visible"; // Si il est cacher on le rend visible.
  		document.getElementById("curseur").innerHTML = text;
  		visible=true;
  	}
}

function cache() {
	if(visible) {
		document.getElementById("curseur").style.visibility = "hidden"; // Si la bulle etais visible on la cache
		visible=false;
	}
}

document.onmousemove=move; // des que la souris bouge, on appelle la fonction move pour mettre a jour la position de la bulle.