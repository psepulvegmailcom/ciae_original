// JavaScript Document


/*submit del formulario especifico*/
function chequeoPass() 	{ 

	if(document.main.login_nombre.value != '' && document.main.login_clave.value != '') {
		sendUserdata(); 
	}
	else 	{
		alert('Debe ingresar datos necesarios para ingresar al sistema');
		if(document.main.login_nombre.value == '')
			document.main.login_nombre.focus();
		if(document.main.login_clave.value == '')
			document.main.login_clave.focus();
		return false;
	}
}
function sendUserdata(){

	var jsBase64 = new JavaScriptBase64;
	jsBase64.JavaScriptBase64("");		
	jsBase64.string = document.main.login_clave.value;
	 
	
	str = MD5(document.main.login_nombre.value) + ":" + jsBase64.encode() + ":" + MD5(document.main.login_challenge.value);
	
		  
	document.main.login_response.value 	= str;		
	document.main.login_username.value 	= document.main.login_nombre.value;
	document.main.login_password.value 	= jsBase64.encode();
	document.main.login_clave.value 	= '';
	document.main.lastAction.value 		= '';
	document.main.submit();	 
}
 