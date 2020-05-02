function createRequestObject() {
    if(window.XMLHttpRequest) // FIREFOX 
		return new XMLHttpRequest(); 
	else 
	if(window.ActiveXObject) // IE 
		return new ActiveXObject("Microsoft.XMLHTTP"); 
	else 
		return false; 
}

function createPostRequestObject(fichier, param) {
	var xhr_object = createRequestObject();

    xhr_object.open("POST", fichier, false);
	xhr_object.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr_object.send(param);
	
	return xhr_object;
}

function handleAJAXReturnText(xhr_object) {
 	if(xhr_object.readyState == 4 && xhr_object.status == 200)   { 
		//alert(xhr_object.responseText);
		return xhr_object.responseText;
   } else
       return false; 
}

function handleAJAXReturnXML(xhr_object) {
 	if(xhr_object.readyState == 4){
		//alert(xhr_object.responseText);
       	return xhr_object.responseXML;
  	}else
       return false; 
}

// fonction requet Post Text
//
function file(fichier, param) { 
	var xhr_object = createPostRequestObject(fichier, param);
		
	return handleAJAXReturnText(xhr_object);
} 

// fonction requet Post XML
//
function fileXML(fichier, param) {
	var xhr_object = createPostRequestObject(fichier, param);
		
	return handleAJAXReturnXML(xhr_object);
}