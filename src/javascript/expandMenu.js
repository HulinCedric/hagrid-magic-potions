function init() {
	document.getElementById('recette').style.display = "none";
	document.getElementById('histoire').style.display = "none";
}

function expandMenu(id) {
	if (document.getElementById(id).style.display == "none")
		document.getElementById(id).style.display = "block";
	else 
		document.getElementById(id).style.display = "none";
	if (id=="histoire")
		document.getElementById('recette').style.display = "none";
	else
		document.getElementById('histoire').style.display = "none";
}