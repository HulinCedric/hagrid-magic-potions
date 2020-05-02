function count_ingredient() {
	var i=1;
	while (document.getElementById("ingredient"+i)!=null) i++;
	return (i-1);
}

//
//
function createInputText(parent, i, name, max) {
	var input = document.createElement("input");
	input.setAttribute("name", name+i);
	input.setAttribute("type", "text");
	input.setAttribute("maxlength", max);
	parent.appendChild(input);
	return input;
}

//
//
function createTypeSelect(parent, i, name) {
	var select = document.createElement("select");
	select.setAttribute("name", name + i);
	select.setAttribute("id", i);

	fillSelect("phpscript/Obtention_types.php", "", "type", select);
	
	select.setAttribute("onchange", "changeType(this.id, this.value)");

	parent.appendChild(select);
}

// Retourne le type de l'ingredient
//
function createIngredientSelect(parent, i, name) {
	var select = document.createElement("select");
	select.setAttribute("name", name + i);
	select.setAttribute("id", i);

	fillSelect("phpscript/Obtention_ingredients.php", "", "name", select);
	
	select.setAttribute("onchange", "changeIngredient(this.id, this.value)");
	
	parent.appendChild(select);

	return file("phpscript/Obtention_type_ingredient.php", "name=" + select.firstChild.value);
}

//
//
function createScaleSelect(parent, i, name, type) {
	var select = document.createElement("select");
	select.setAttribute("name", name + i);
	select.setAttribute("id", name + i);

	fillSelect("phpscript/Obtention_scale_by_type.php", "type=" + type, "scale", select);

	if (select.firstChild)
		parent.appendChild(select);
}

//
//
function createFieldSet(i, id) {
	var fieldset = document.createElement("fieldset");
	fieldset.setAttribute("id", id + i);
	return fieldset;
}

//
//
function createLegend(parent, i, value) {
	var legend = document.createElement("legend");	
	var legendText = document.createTextNode(value + i);
	legend.appendChild(legendText);
	parent.appendChild(legend);
}

function add_newIngredient(formulaire) {
	var i=  count_ingredient() + 1;
	
	var fieldset = createFieldSet(i, "ingredient");
	
	createLegend(fieldset, i, "Ingredient ");

	createInputText(fieldset, i,"new_ingredient_name", "40");
	
	createTypeSelect(fieldset, i, "type");		

	createInputText(fieldset, i,"quantity", "5").setAttribute("class", "quantity");

	createScaleSelect(fieldset, i, "scale", "Liquide");
	
	var limit= document.getElementById("limit");
	
	formulaire.insertBefore(fieldset, limit);	
}

function add_ingredient(formulaire) {
	var i =  count_ingredient() + 1;
		
	var fieldset = createFieldSet(i, "ingredient");
	
	createLegend(fieldset, i, "Ingredient ");

	var type = createIngredientSelect(fieldset, i, "ingredient_name");

	createInputText(fieldset, i,"quantity", "5").setAttribute("class", "quantity");

	createScaleSelect(fieldset, i, "scale", type);
		
	var limit= document.getElementById("limit");
	
	formulaire.insertBefore(fieldset, limit);	
}

function del_ingredient(formulaire) {
	var i =  count_ingredient();
		
	if (i <= 0) return 0;
	
	var obj= document.getElementById("ingredient"+i);
	
	formulaire.removeChild(obj);
}

//
//
function fillSelect(nameFile, paramFil, ElementTag, select) {
	if (select == null) return null;

	var xhr_object = fileXML(nameFile, paramFil);
	
	var options = xhr_object.documentElement.getElementsByTagName(ElementTag);

	while (select.firstChild)
  		select.removeChild(select.firstChild);

 	for (i = 0 ; i < options.length ; i++) {
		var option = document.createElement("option");
		var text = document.createTextNode(options.item(i).firstChild.nodeValue);
		option.appendChild(text);
		select.appendChild(option);
	}	
}

// 
//
function changeIngredient(indiceParent, name) {
	var fieldset = document.getElementById("ingredient"+indiceParent);
	var type = file("phpscript/Obtention_type_ingredient.php", "name="+name);
		
	if (document.getElementById("scale"+indiceParent)==null) {
		createScaleSelect(fieldset, indiceParent, "scale", type);
		return;
	}
		
	fillSelect("phpscript/Obtention_scale_by_type.php", "type=" + type, "scale", document.getElementById("scale"+indiceParent));

	if (!document.getElementById("scale"+indiceParent).firstChild)
		fieldset.removeChild(document.getElementById("scale"+indiceParent));
}

//
//
function changeType(indiceParent, name) {
	var fieldset = document.getElementById("ingredient"+indiceParent);
	
	if (document.getElementById("scale"+indiceParent)==null) {
		createScaleSelect(fieldset, indiceParent, "scale", name);
		return;
	}
	
	fillSelect("phpscript/Obtention_scale_by_type.php", "type=" + name, "scale", document.getElementById("scale"+indiceParent));

	if (!document.getElementById("scale"+indiceParent).firstChild)
		fieldset.removeChild(document.getElementById("scale"+indiceParent));
}

function del(parent, id) {	
	var obj= document.getElementById(id);
	
	parent.removeChild(obj);
}

function showHideComment() {
	if (document.getElementById("comment_edit").style.display == "block")
		document.getElementById("comment_edit").style.display = "none";
	else 
		document.getElementById("comment_edit").style.display = "block";
}

function addComment() {
	showHideComment();
	var num_recipe = document.getElementById("num_recipe").value;
	var login = document.getElementById("login").value;
	file("phpscript/Creation_comment.php", "num_recipe="+num_recipe+"&login="+login+"&description="+document.getElementById("comment_edit_description").value);	
	document.location.reload();
}