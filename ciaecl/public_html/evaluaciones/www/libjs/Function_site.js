function verSitioLang(lang)
{
	document.main.langSite.value = lang;
	process('home',0);
}
 
  
 
function wordCount(id_textarea) 
{ 
	textoArea = document.getElementById(id_textarea).value;
	
	numeroCaracteres = textoArea.length; 
	inicioBlanco = /^ /;
	finBlanco = / $/; 
	variosBlancos = /[ ]+/g ;
	
	textoArea = textoArea.replace(inicioBlanco,"");
	textoArea = textoArea.replace(finBlanco,"");
	textoArea = textoArea.replace(variosBlancos," ");
	
	textoAreaDividido = textoArea.split(" ");
	numeroPalabras = textoAreaDividido.length;
	
	tC = (numeroCaracteres==1)?" carácter":" caracteres";
	tP = (numeroPalabras==1)?" palabra":" palabras";
	return numeroPalabras;
	//  alert (numeroCaracteres + tC +"\n" + numeroPalabras + tP);
}
 
function revisionTexto(id_textarea,maximo)
{
 	var total = wordCount(id_textarea) ; 	
	var diff = maximo - total;	
	changeTextId('info_'+id_textarea,total+' de '+maximo+' palabras.');
	changeTextId('error_'+id_textarea,'');
	if(diff < 0)
	{ 
		var diffe = diff * -1;
		changeTextId('error_'+id_textarea,'El contenido no puede superar '+maximo+' palabras, tiene '+diffe+' palabras extras');
	} 
}