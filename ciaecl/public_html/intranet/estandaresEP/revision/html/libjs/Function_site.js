/************************************************************************
			FUNCIONES PROPIAS DE LA APLICACION
************************************************************************/
var optionOpenW ="dependent=1,toolbar=0,status=0,menubar=0,personalbar=0,scrollbars=1,resizable=1,width=1000,height=600";
function verFormularioPopup(opcion,nombre)
{
	if(nombre == '')
		nombre = 'ventana_extra';
    var nuevo_ventana = window.open('indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option='+opcion,nombre,optionOpenW);
} 

/************************************************************************
			FUNCIONES PROPIAS DEL REGISTRO DE OFERENTES
************************************************************************/
function revisarBloqueoRevisiones()
{
	/* revisa si el formulario corresponde a un oferente que se le devolvio el formulario */
 
	var valores 	= 'caso_formulario='+document.main.lastAction.value;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=revisarbloqueorevisiones&needlogin=1&'+valores; 
	ate_evaluarSalidaPost(opciones); 
}
	 
function showComuna(input_name_region,input_name_comuna,comuna_sel)
{
	var input 		= searchElement(input_name_region);	 
	var valores 	= 'region='+input.value+'&comuna_name='+input_name_comuna+'&comuna_sel='+comuna_sel;  
  /* 
	var opciones 	= 'comuna_sel='+ate_sede_comuna_id_nueva+'&caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=agregarcomuna&needlogin=1&'+valores;  */ 
	
	var opciones 	= 'comuna_sel=&caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=agregarcomuna&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();      
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida 			= ajax.responseText; 
			var select_input 	= searchElement(input_name_comuna); 
			for(var i=0; i < select_input.length ; i++)
			{
				var obj 		= document.createElement('option');
				var value     	= '';
				var text      	= '';		
				obj.text 		= text;
				obj.value 		= value;     
				select_input.options[i] = obj; 
			}
			/*document.getElementById(input_name_comuna).innerHTML = salida; */
			eval(salida);
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());  
}
 

function obtenerRBD(input_pre,id_show)
{	 
	showId('rbd_spinner');
	var input_rbd 	= searchElement(input_pre);	 
	var valores 	= 'rbd='+input_rbd.value;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=getRBD&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;  
			
			if(salida == '')
			{
				showAlert('Debe ingresar un código RBD correcto');				
				input_rbd.value = '';
				input_rbd.focus();
				document.getElementById(id_show).innerHTML = "";
			}
			else
			{
				document.getElementById(id_show).innerHTML = "<strong>Establecimiento Educacional :</strong> "+salida;
				
			}
			hiddenId('rbd_spinner');
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());  	
}

function mostrarHHRecursos(rut,id_show,id_spinner)
{
	showId(id_spinner);
	var input_rut 	= rut;	 
	var valores 	= 'rut='+rut;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=gethhrecursos&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;   
			showId(id_show); showId(id_show+'_interno'); 
			document.getElementById(id_show+'_interno').innerHTML =   salida; 
			hiddenId(id_spinner); 
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());
} 

function ate_obtenerInformaciónOferentePorRevisar(info_porrevisar,veces)
{   
	var valores 	= 'oferentes='+info_porrevisar;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=revision_obteneroferenteporrevisar&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;   
			eval(salida);
			if(veces==0)
			{
				ate_obtenerInformaciónOferentePorRevisar(info_porrevisar,1);
			}			 
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());
}

function mostrarCargandoImagen(div_mostrar)
{
	var imagen = '<center><img src="images/spinner.gif"></center>';
	document.getElementById(div_mostrar).innerHTML = imagen; 
}

function quitarCargandoImagen(div_mostrar)
{
	document.getElementById(div_mostrar).innerHTML = ''; 
} 

function ate_mostrarCargandoOferente(info_porrevisar,funcion_exec,con_titulo)
{
	var valores 	= 'oferentes='+info_porrevisar;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=mostrarcargandooferente&con_titulo='+con_titulo+'&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;   
			eval(salida);
			eval(funcion_exec);
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());	
}

function ate_mostrarUltimoAcceso(info_porrevisar)
{
	ate_mostrarCargandoOferente(info_porrevisar,'ate_mostrarUltimoAcceso_exec(info_porrevisar)','si');
}

/* funcion generica para solicitar consulta de multiples oferentes */
function ate_mostrarInformacionMasivaOferente(info_porrevisar,opcion)
{
	var valores 	= 'oferentes='+info_porrevisar;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion='+opcion+'&needlogin=1&'+valores; 

	ate_evaluarSalidaPost(opciones);
}

function ate_evaluarSalidaPost(opciones)
{  
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;   
			eval(salida);
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());
}


function ate_mostrarSalidaPost(opciones,div_show)
{  
	
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;
			document.getElementById(div_show).innerHTML = salida; 
			showId(div_show);
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());
}


function ate_mostrarUltimoAcceso_exec(info_porrevisar)
{
	ate_mostrarInformacionMasivaOferente(info_porrevisar,'mostrarultimoacceso');
}

function ate_cambiarOferenteRevisor(info_porrevisar) 
{
	ate_mostrarInformacionMasivaOferente(info_porrevisar,'revision_cambiaroferenterevisor');
}
 
function ate_cambiarTipoOferente(info_porrevisar)
{
	ate_mostrarInformacionMasivaOferente(info_porrevisar,'cambiartipooferente');
} 
 
function ate_verFechaEnvioRevision(info_porrevisar)
{
	ate_mostrarInformacionMasivaOferente(info_porrevisar,'verfechaenviorevision');
} 

function ate_cambiarEstadoOferente(info_porrevisar)
{
	ate_mostrarInformacionMasivaOferente(info_porrevisar,'revision_cambiarestadooferente');
}

function ate_cambiarEstadoOferenteCambio(id_oferente,id_estado_original, estado_original,id_estado_nuevo,estado_nuevo)
{
	if(id_estado_original != id_estado_nuevo)
	{
		if(confirm('¿Está seguro de cambiar el estado actual '+estado_original+' por '+estado_nuevo+'? Si el oferente está en revisión, los cambios realizados se perderán'))
		{
			var div_cambio = 'info_estado_oferente_';
			mostrarCargandoImagen(div_cambio+id_oferente);
			var valores 	= 'action='+document.main.lastAction.value+'&id_estado_nuevo='+id_estado_nuevo;   
			var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+id_oferente+'&opcion=revision_cambiarestadooferentecambio&needlogin=1&'+valores; 
			var url 		= 'indexExt.php'; 
			var ajax 		= objetoAjax();       
			ajax.open("POST", url , true);
			ajax.onreadystatechange=function()
			{
			   if (ajax.readyState == 4)
			   {	 
					quitarCargandoImagen(div_cambio+id_oferente);
					var salida = ajax.responseText;   
					limpiarPaginamientoProcess(document.main.lastAction.value,0);  
/*document.getElementById('info_estado_oferente_'+id_oferente).innerHTML =  '<center><a  title="Cambiar Estado Postulaci&oacute;n" href="javascript:ate_cambiarEstadoOferenteVista('+id_oferente+');"><img src="images/iconos/cambiar.png" border=0></a> </center>'; */
			   }
			}           
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(opciones+repairAjaxIE());	
		}
	}
}

function ate_cambiarOferenteRevisorCambio(id_oferente,revisor_original, revisor_nuevo)
{
	if(confirm('¿Está seguro de cambiar el revisor '+revisor_original+' por '+revisor_nuevo+'?'))
	{
		mostrarCargandoImagen('info_oferente_porrevisar_'+id_oferente);
		var valores 	= 'revisor_nuevo='+revisor_nuevo;   
		var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+id_oferente+'&opcion=revision_cambiaroferenterevisorcambio&needlogin=1&'+valores; 
		var url 		= 'indexExt.php'; 
		var ajax 		= objetoAjax();       
		ajax.open("POST", url , true);
		ajax.onreadystatechange=function()
		{
		   if (ajax.readyState == 4)
		   {	 
				quitarCargandoImagen('info_oferente_porrevisar_'+id_oferente);
				var salida = ajax.responseText;   
				if(salida == 'si')
				{
					document.getElementById('info_oferente_'+id_oferente).innerHTML = revisor_nuevo;
				}
				else
				{
					showAlert('Ocurrió un error, no se pudo cambiar el revisor');
					document.getElementById('info_oferente_'+id_oferente).innerHTML = revisor_original;
				} 
				ate_cambiarOferenteRevisor(id_oferente);
		   }
		}           
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(opciones+repairAjaxIE());	
	}
}

function ate_cambiarTipoOferenteCambio(id_oferente,id_tipo_original, tipo_original, id_tipo_nuevo, tipo_nuevo)
{
	if(confirm('¿Está seguro de cambiar el tipo '+tipo_original+' del oferente a '+tipo_nuevo+'?'))
	{
		var div_show = 'info_tipo_oferente_';
		mostrarCargandoImagen(div_show+id_oferente);
		var valores 	= 'id_tipo_nuevo='+id_tipo_nuevo;   
		var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+id_oferente+'&opcion=cambiartipooferentecambio&needlogin=1&'+valores; 
		var url 		= 'indexExt.php'; 
		var ajax 		= objetoAjax();       
		ajax.open("POST", url , true);
		ajax.onreadystatechange=function()
		{
		   if (ajax.readyState == 4)
		   {	 
				quitarCargandoImagen(div_show+id_oferente);
				var salida = ajax.responseText;   
				  
				ate_cambiarTipoOferente(info_porrevisar);
				document.getElementById(div_show+id_oferente).innerHTML = tipo_nuevo + document.getElementById(div_show+id_oferente).innerHTML; 			
		   }
		}           
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(opciones+repairAjaxIE());	
	}
} 

function verDatosUsuario(id_info,id_spinner)
{	
	verInformacionComunOferente(id_info,id_spinner,'datosusuarioferentes');
}

function verHistorialOferente(id_info,id_spinner)
{	
	verInformacionComunOferente(id_info,id_spinner,'revision_historialoferentes');
}

function verSemejanzasOferente(id_info,id_spinner)
{	
	verInformacionComunOferente(id_info,id_spinner,'revision_semejanzasoferentes');
}

function verRevisionesAnteriores(id_info,id_spinner)
{	
	verInformacionComunOferente(id_info,id_spinner,'revision_revisionesanteriores');	
} 

function verInformacionComunOferente(id_info,id_spinner,opcion)
{	
	showId(id_spinner);     
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion='+opcion+'&needlogin=1'; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;   
			showId(id_info);  
			showId(id_info+'_interno');  
			document.getElementById(id_info+'_interno').innerHTML =   salida ; 
			hiddenId(id_spinner); 
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());
}

function findRutSII(rut,dv,id_show)
{	
	/*showId('carga_informacion');*/
	var input_rut 	= rut;	
	var input_dv 	= dv; 
	var valores 	= 'rut='+rut+'&dv='+dv;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=getrutsii&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;   
			
			showId(id_show); 
			document.getElementById(id_show+'_interno').innerHTML =  salida+ "";
				hiddenId('sii_spinner'); 
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());  	
}

function ate_checkFormNewUserComplete()
{ 
	var valores  = 'email='+document.getElementById('email').value;
	valores 	 = valores+'&username='+document.getElementById('new_username').value;   
	var opciones = 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=checkusername&needlogin=0'+'&'+valores; 
	var url = 'indexExt.php'; 
	var ajax = objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida = ajax.responseText;   
			if(salida == 'libre')
			{
				process('ingreso|guardar',0);
			}
			else
			{
				if(salida == 'username')
				{
					showAlert('El nombre de usuario ya existe en el sistema como parte de un registro anterior, por favor ingrese uno distinto e inténtelo nuevamente.');
					document.getElementById('new_username').value = '';
					document.main.new_username.focus();
					return false;
				}
				if(salida == 'email')
				{
					showAlert('El e-mail inscrito ya existe en el sistema como parte de un registro anterior, por favor ingrese uno distinto e inténtelo nuevamente');
					document.getElementById('email').value = '';
					document.main.email.focus();
					return false;
				}				
				if(salida == 'ocupado')
				{
					showAlert('El nombre de usuario y el e-mail ya existen en el sistema como parte de un registro anterior, por favor ingrese uno distinto e inténtelo nuevamente');
					document.getElementById('new_username').value = '';
					document.getElementById('email').value = '';
					document.main.new_username.focus();
					return false;
				}				 
			}
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());  
}

function checkFormPasswordUser()
{
	if(isEmpty(document.getElementById('new_password').value) || isEmpty(document.getElementById('new_repassword').value))
	{
		showAlert('Ambos casilleros de clave deben tener valor');
		document.main.new_password.focus();
		return false;
	}
	else
	{
		if(hasEmpty(document.getElementById('new_password').value)  || hasEmpty(document.getElementById('new_repassword').value))
		{
			showAlert('La clave no puede contener espacios en blanco');
			document.main.new_password.focus();
			return false;
		}		
		if(document.getElementById('new_password').value != document.getElementById('new_repassword').value)
		{
			showAlert('Ambos casilleros de clave deben ser iguales');
			document.main.new_password.focus();
			return false;
		}
		else
		{
			if(document.getElementById('new_password').value.length < 6)
			{
				showAlert('La clave ingresada debe tener al menos 6 caracteres');
				document.main.new_password.focus();
				return false;
			}
		}
		if(document.getElementById('new_password').value == document.getElementById('new_username').value)
		{
			showAlert('El nombre de usuario y su clave no pueden ser igual');
			document.main.new_password.focus();
			return false;
		}		
	}	
	return true;	
}

function ate_checkFormNewUser()
{   	 		 
	if(document.main.reglas_ok.checked == false)
	{
		showAlert('Debe leer y aceptar los término y condiciones del registro');
		document.main.reglas_ok.focus();
		return false;
	}	
	if(isEmpty(document.getElementById('new_captcha').value))
	{
		showAlert('Debe ingresar el código de seguridad del formulario');
		document.main.new_captcha.focus();
		return false;
	}
	if(isEmpty(document.getElementById('nombre_nombre').value) || isEmpty(document.getElementById('apellido_paterno').value) || isEmpty(document.getElementById('apellido_materno').value))
	{
		showAlert('El nombre de la persona debe ingresarse de manera completa');
		document.main.nombre_nombre.focus();
		return false;
	}	
	if(isEmpty(document.getElementById('email').value) || !checkMail(document.getElementById('email').value))
	{
		showAlert('La dirección de email debe ser válida');
		document.main.email.focus();
		return false;
	}	
	if(isEmpty(document.getElementById('new_username').value))
	{
		showAlert('Debe ingresar el nombre de usuario');
		document.main.new_username.focus();
		return false;
	}		
	else
	{
		var aux_username = document.getElementById('new_username').value;
		if(aux_username.length < 6)
		{
			showAlert('El nombre de usuario ingresado debe tener al menos 6 caracteres');
			document.main.new_username.focus();
			return false;
		}
		
		if(hasEmpty(aux_username))
		{
			showAlert('El nombre de usuario no puede contener espacios en blanco');
			document.main.new_username.focus();
			return false;
		}		
		if(hasAcentosComilla(aux_username))
		{
			showAlert('El nombre de usuario no puede contener acentos, ñ ni comillas (") ');
			document.main.new_username.focus();
			return false;
		}		
	}
	
	if(!checkFormPasswordUser())
	{
		return false;
	}
	
	if(isEmpty(document.getElementById('tipo_registro').value))
	{
		showAlert('Debe seleccionar Tipo de Oferente');
		return false;
	}		
	ate_checkFormNewUserComplete();
}

function ate_ir_registro()
{   
	showAlert('Recomendación: antes de registrarse como nuevo usuario descargue y lea con atención el "Manual del Usuario" diseñado para su tipo de oferente: Persona Natural, Persona Jurídica o Institución de Educación Superior. En él encontrará orientaciones claves para realizar con éxito su postulación.      Si desea continuar, sólo presione "Aceptar".');
	ate_ir_form_registro();
}

function agregarSede(total_sede)
{ 
	var valores = 'fila='+total_sede;   
	var opciones = 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=agregarsede&needlogin=1&'+valores; 
	var url = 'indexExt.php'; 
	var ajax = objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida = ajax.responseText;
			document.getElementById('ate_sedes_div_'+total_sede).innerHTML = salida;
			total_sede = total_sede + 1; 
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());  
	
}

function existeArchivoOferente(nombre_documento)
{ 
	var valores 	= 'nombre_documento='+nombre_documento;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=existefileoferente&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida = ajax.responseText;
			if(salida == 'ok')
				return true;
			else
				return false;
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());	
} 

function borrarArchivoOferente(nombre_documento)
{
	var valores 	= 'nombre_documento='+nombre_documento;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=deletefileoferente&needlogin=1&'+valores; 
	var div_ocultar = 'documento_'+nombre_documento;
	borrarArchivoGenerico(opciones,div_ocultar);
} 

function borrarArchivoTituloOferente(id_documento,rut)
{	
	var valores 	= 'id_documento='+nombre_documento+'&rut='+rut;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&opcion=deletefiletitulooferente&needlogin=1&'+valores; 
	var div_ocultar = 'documento_titulo_'+id_documento;
	borrarArchivoGenerico(opciones,div_ocultar);
} 

function borrarArchivoOferenteRecurso(id_titulo,rut)
{ 
	var valores 	= '&id_titulo='+id_titulo+'&rut='+rut;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=deletefileoferenterecurso&needlogin=1&'+valores; 
	var div_ocultar = 'documento_'+id_titulo; 
	borrarArchivoGenerico(opciones,div_ocultar); 
}

function borrarArchivoGenerico(opciones,div_ocultar)
{
	if(!confirm('¿Esta seguro de eliminar este documento?'))
	{
		return false;	
	}
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida = ajax.responseText;
			if(salida == 'ok')
			{
				hiddenId(div_ocultar); 
				showAlert('El documento fue eliminado exitosamente');
			}
			else
			{
				showAlert('Ocurrió un problema al intentar eliminar el documento, inténtelo nuevamente');
			}			
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());	
}
 

function quitarTitulo(id)
{
	if(confirm('Esta seguro de eliminar este título?'))
	{
		hiddenId('bloque_titulo_persona_'+id); 
		var input = searchElement('titulo_activo_'+id);
		input.value = 'no';
	}
} 

function agregarTitulo()
{ 
	var proximo 	= document.main.proximo_titulo.value;

	var proximo_sgte	 = document.main.proximo_titulo.value + 1; 
	var valores 	= 'proximo='+proximo+'&proximo_sgte='+proximo_sgte;   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&opcion=agregartitulo&needlogin=1&'+valores; 
	var url = 'indexExt.php'; 
	var ajax = objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida = ajax.responseText;
			document.getElementById('bloque_titulo_persona_n'+proximo+'').innerHTML = salida;
			document.main.total_titulos.value = document.main.total_titulos.value + '_-'+proximo; 
			document.main.proximo_titulo.value	 = proximo_sgte;
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());  	
}


function quitarSede(id)
{
	hiddenId('ate_sede_'+id+'_sede');
	//total_sede = total_sede - 1;
	var input = searchElement('ate_sede_'+id+'_oculto');
	input.value = 1;
}

function ate_ir_form_registro()
{ 
	 process('ingreso|registro',0); 
}
	 

function ate_view_faq(id_item)
{	 
	process('faq_interno|'+id_item,0);
}


function ate_view_item(action,id_item)
{	 
	process(action+'|'+id_item,0);
}
	 
	 
function ate_registro_paso(paso)
{  
 	document.main.guardar_caso.value = '';
	process('mi_registro|'+paso,0); 
}
function ate_edicion_paso(paso)
{  
 	document.main.guardar_caso.value = '';
	process('edicion|'+paso,0); 
}

/*area de atencion */ 
 
function registro_area_check_fila(fila)
{ 
	var name 				= 'ate_oferta_programa[]'; 
	var x = document.main.elements;	
	for (var i=0 ; i < x.length ; i++)
	{			 
		if(x[i].name == name && x[i].value == fila  )
		{ 
			x[i].checked = true;
			return;			 
		}
	} 	 
}
 
/*fichas de personas*/
function registro_fichapersona_eliminar(fila,rut)
{ 
	var valores 	= 'rut='+rut;  	   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=oferenterecursoeliminar&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida = ajax.responseText; 
			//showAlert(salida);
			/* chequeoTipoDatos(document.main.caso_revision.value+'|5',0); */
			chequeoTipoDatos(document.main.lastAction.value,0);
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE()); 
}

function registro_fichapersona_agregar(fila)
{	
	var nombre_input = searchElement('ate_capital_'+fila+'_nombre');
	var valores 	= 'nombre='+nombre_input.value; 
	nombre_input = searchElement('ate_capital_'+fila+'_apellido_paterno');
	valores 	= valores+'&apellido_paterno='+nombre_input.value; 
	nombre_input = searchElement('ate_capital_'+fila+'_apellido_materno');
	valores 	= valores+'&apellido_materno='+nombre_input.value; 
	nombre_input = searchElement('ate_capital_'+fila+'_rut');
	valores 	= valores+'&rut='+nombre_input.value; 
	nombre_input = searchElement('ate_capital_'+fila+'_dv');
	valores 	= valores+'&dv='+nombre_input.value; 
	   
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=oferenterecursoagregar&needlogin=1&'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida = ajax.responseText; 
			var prefijo = "<strong>";
			var sufijo = "</strong>";

			var nombre_input = searchElement('ate_capital_'+fila+'_nombre'); 
			document.getElementById('ate_capital_'+fila+'_nombre_col').innerHTML = prefijo+nombre_input.value+sufijo;
			nombre_input = searchElement('ate_capital_'+fila+'_apellido_paterno');
			document.getElementById('ate_capital_'+fila+'_apellido_paterno_col').innerHTML = prefijo+nombre_input.value+sufijo;
			nombre_input = searchElement('ate_capital_'+fila+'_apellido_materno');
			document.getElementById('ate_capital_'+fila+'_apellido_materno_col').innerHTML = prefijo+nombre_input.value+sufijo; 
			nombre_input = searchElement('ate_capital_'+fila+'_dv');
			var dv = nombre_input.value;
			nombre_input = searchElement('ate_capital_'+fila+'_rut');
			document.getElementById('ate_capital_'+fila+'_rut_col').innerHTML = prefijo+nombre_input.value+' - '+dv+sufijo;  
			
			document.getElementById('ate_capital_'+fila+'_del_col').innerHTML = '<a href=javascript:eliminarFichaRecurso("'+fila+'","'+nombre_input.value+'");><img src="images/delete.ico" border="0" /></a>';
			document.getElementById('ate_capital_'+fila+'_ver_col').innerHTML = '<a href="javascript:verFicha('+fila+');"><img src="images/Search.ico" border="0" /></a>';
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE()); 	
}

/***** MUESTRA EL SELECT DE REVISORES DISPONIBLES PARA CAMBIAR LOS REVISORES DE UNA REVISION *****/
function ate_cambiarOferenteRevisorVista(id_oferente)
{	
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+id_oferente+'&opcion=revision_cambiaroferenterevisorvista&needlogin=1'; 
	mostrarCargandoImagen('info_oferente_porrevisar_'+id_oferente);
	ate_evaluarSalidaPost(opciones);
} 

/***** MUESTRA EL SELECT DE TIPOS DE OFERENTES DISPONIBLES PARA CAMBIAR *****/
function ate_cambiarTipoOferenteVista(id_oferente)
{	
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+id_oferente+'&opcion=cambiartipooferentevista&needlogin=1'; 
	mostrarCargandoImagen('info_tipo_oferente_'+id_oferente);
	ate_evaluarSalidaPost(opciones);
} 

/***** MUESTRA EL SELECT ESTADOS DISPONIBLES PARA CAMBIAR LOS ESTADOS DE UNA REVISIÓN *****/
function ate_cambiarEstadoOferenteVista(id_oferente)
{	
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+id_oferente+'&opcion=revision_cambiarestadooferentevista&needlogin=1'; 
	mostrarCargandoImagen('info_estado_oferente_'+id_oferente);
	ate_evaluarSalidaPost(opciones);
} 

function showAreaCoberturaOferente()
{ 
	var valores 	= '&comunas=';
	var valueComuna = '';
	if(document.main.ext_ate_portafolio_comuna_id)
	{
		var valueComuna = document.main.ext_ate_portafolio_comuna_id.value;		 
		if(isEmpty(valueComuna))
			valueComuna = '0';
		valores 	= valores+valueComuna; 
	}	 
	
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=showcomuna&needlogin=1'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida = ajax.responseText;
			
			showId('area_cobertura_comunas');
			hiddenId('comuna_spinner');
			if(isEmpty(salida) || valueComuna == '0')
			{
				/*hiddenId('area_cobertura_comunas');*/
				salida = "Debe seleccionar al menos una comuna";
			}
			salida = "<br />" + salida + "<br />";
			document.getElementById('area_cobertura_comunas').innerHTML = salida;
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE()); 
}



function chequeoTipoDatos(action,level)
{ 
	process(action,level);	 
}


/* acceso de paginamiento de paginas*/
function showNuevaPagina(pagina,opcion)
{
	/* la opcion corresponde desde el nivel 1, no el cero*/
	document.main.pagina_sistema.value = pagina;
	process(opcion,1);
}

function showNuevaPaginaOrden(orden,opcion)
{
	/* la opcion corresponde desde el nivel 1, no el cero*/
	document.main.pagina_sistema_orden.value = orden;
	process(opcion,1);
}

function limpiarPaginamientoProcess(opcion)
{ 
	document.main.pagina_sistema.value 				= 0;
	document.main.pagina_sistema_orden.value 		= "";
	document.main.pagina_sistema_direccion.value 	= "";
	if(document.main.guardar_caso)
		document.main.guardar_caso.value 	= "";
	process(opcion,0);
}

/**************************************************************************
		ACTUALIZACION DE POSTULACIONES VALIDADAS
***************************************************************************/

function verActualizacion(prefijo,prefijo_particular)
{	 
	document.main.vista_revision_respaldo.value 			= prefijo; 	
	document.main.vista_revision_respaldo_particular.value 	= prefijo_particular; 	
	showActualizacionOferente(prefijo,prefijo_particular);	
} 

function showActualizacionOferente(prefijo,prefijo_particular)
{
	gotoHref('top');
	showVentanaInterna('ventanaInternaDatosSpin');	
	var valores 	= '&prefijo='+prefijo+'&lastAction='+document.main.lastAction.value;
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=revision_formulario_actualizacion&needlogin=1'+valores;  
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida 	= ajax.responseText;  
			document.getElementById('ventanaInternaDatos').innerHTML = salida;
			showVentanaInterna('ventanaInternaDatos');
			hiddenId('ventanaInternaDatosSpin'); 			
			AbrirBloqueRevision('bloque_'+prefijo_particular);  
			gotoHref('bloque_'+prefijo_particular); /* por si se me pasa algun template sin titulo*/
			gotoHref('titulo_'+prefijo_particular);
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE()); 
}  
 
function guardarActualizacion(option,prefijo,estado_revision,id_externo)
{ 
	var mensaje_oferente 		= searchElement('revision_mensaje_oferente_'+id_externo);
	var mensaje_interno 		= searchElement('revision_mensaje_interno_'+id_externo); 
	var modificacion_estado 	= searchElement('modifico_texto_respaldo'); 
	var enviar					= false;  
	if(estado_revision == 'rechazo')
	{
		if(isEmpty(mensaje_oferente.value))
		{
			showAlert('Debe ingresar el mensaje para el oferente');	
			mensaje_oferente.focus();
			return false;
		}
		if(modificacion_estado.value == 1)
		{
			enviar = confirm('¿Esta seguro de guardar estos cambios y rechazar la revisión?');	
		}
		else
		{
			enviar = confirm('¿Esta seguro de rechazar la revisión?');
		}
	}
	else
	{
		if(!isEmpty(mensaje_oferente.value))
		{
			showAlert('Si ingresa un mensaje para el postulante no puede aceptar la revisión, para continuar elimine el texto o rechace la revisión');	
			mensaje_oferente.focus();
			return false;
		} 
		if(modificacion_estado.value == 1)
		{
			enviar = confirm('¿Esta seguro de guardar estos cambios y aceptar la revisión?');	
		}
		else
		{
			enviar = confirm('¿Esta seguro de aceptar la revisión?');
		}
	}
	 
	if(enviar)
	{
		var estado_revision_input 		= searchElement(prefijo+'_revision_estado');
		estado_revision_input.value 	= document.main.caso_revision.value+'_'+estado_revision;
		
		document.main.estado_respaldo.value 			= estado_revision_input.value;
	 	document.main.mensaje_oferente_respaldo.value 	= mensaje_oferente.value;
	 	document.main.mensaje_interno_respaldo.value 	= mensaje_interno.value;
		
		if(id_externo == '')
			id_externo = 0;
			 
		if(document.main.id_externo.value == 0)
		 	document.main.id_externo.value 			= id_externo;			
			
		document.main.prefijo_revision.value 	= prefijo;		
		process(option+'|guardar_actualizacion',0);
	}
}
/**************************************************************************
		REVISION DE POSTULACIONES
***************************************************************************/
function verRevision(prefijo,prefijo_particular)
{	 
	document.main.vista_revision_respaldo.value 			= prefijo; 	
	document.main.vista_revision_respaldo_particular.value 	= prefijo_particular; 	
	showRevisionOferente(prefijo,prefijo_particular);	
} 

function liberarRevision(id_externo,option,prefijo)
{
	if(confirm('¿Esta seguro de desbloquear esta revisión, recuerde que perderá los cambios realizados?'))
	{
		if(id_externo == '')
			id_externo = 0;
			 
		if(document.main.id_externo.value == 0)
		 	document.main.id_externo.value 			= id_externo;			
		
		document.main.prefijo_revision.value 	= prefijo;
		process(option+'|liberar_revision',0);
	}
}

function guardarRevision(option,prefijo,estado_revision,id_externo)
{ 
	var mensaje_oferente 		= searchElement(prefijo+'_revision_mensaje_oferente_'+id_externo);
	var mensaje_interno 		= searchElement(prefijo+'_revision_mensaje_interno_'+id_externo);
	var modificacion_estado 	= searchElement('modifico_texto_respaldo'); 
	var enviar					= false; 
	
	if(estado_revision == 'rechazo')
	{
		if(isEmpty(mensaje_oferente.value))
		{
			showAlert('Debe ingresar el mensaje para el oferente');	
			mensaje_oferente.focus();
			return false;
		}
		if(modificacion_estado.value == 1)
		{
			enviar = confirm('¿Esta seguro de guardar estos cambios y rechazar la revisión?');	
		}
		else
		{
			enviar = confirm('¿Esta seguro de rechazar la revisión?');
		}
	}
	else
	{
		if(!isEmpty(mensaje_oferente.value))
		{
			showAlert('Si ingresa un mensaje para el postulante no puede aceptar la revisión, para continuar elimine el texto o rechace la revisión');	
			mensaje_oferente.focus();
			return false;
		} 
		if(modificacion_estado.value == 1)
		{
			enviar = confirm('¿Esta seguro de guardar estos cambios y aceptar la revisión?');	
		}
		else
		{
			enviar = confirm('¿Esta seguro de aceptar la revisión?');
		}
	}
	 
	if(enviar)
	{
		var estado_revision_input 		= searchElement(prefijo+'_revision_estado');
		estado_revision_input.value 	= document.main.caso_revision.value+'_'+estado_revision;
		
		document.main.estado_respaldo.value 			= estado_revision_input.value;
	 	document.main.mensaje_oferente_respaldo.value 	= mensaje_oferente.value;
	 	document.main.mensaje_interno_respaldo.value 	= mensaje_interno.value;
		
		if(id_externo == '')
			id_externo = 0;
			 
		if(document.main.id_externo.value == 0)
		 	document.main.id_externo.value 			= id_externo;			
			
		document.main.prefijo_revision.value 	= prefijo;		
		process(option+'|guardar_revision',0);
	}
}

function AbrirBloqueRevision(id_div,caso)
{	
	showId(id_div);	  
	nomodificacionTexto();
	AbrirBloqueRevisionParticular(id_div); /* importante en casos particulares */	 
	document.main.vista_revision_respaldo_particular_abierto.value 	= id_div; 	
}

function nomodificacionTexto()
{ 
	document.main.modifico_texto_respaldo.value = 0;	
}

function modificacionTexto(input_id)
{ 
	document.main.modifico_texto_respaldo.value = 1;	
}

function modificacionIdExterno(id)
{ 
	if(id != '')
		document.main.id_externo.value = id;	
}

function ocultarDivParticular(div_id,caso)
{
	if(caso != '')
	{
		hiddenId(div_id);	
	}
}


function noReadInputParticular(input,caso)
{
	if(caso != '')
	{
		var objeto = searchElement(input);
		objeto.readOnly = true;
	}
}

function convertirMinusculaInput(input,caso)
{  
	if(caso == '')
	{		 
		var objeto = searchElement(input);
		objeto.value = objeto.value.toLowerCase();   
		modificacionTexto(input);		 
	}
	else
	{
		showAlert('No puede cambiar el texto');	
	}
}


/**********************************************************************************************
			 BLOQUE DE EDICIONES
***********************************************************************************************/ 
function showEdicion(prefijo,prefijo_particular)
{	 
	document.main.vista_revision_respaldo.value 			= prefijo; 	
	document.main.vista_revision_respaldo_particular.value 	= prefijo_particular; 	
	showEdicionOferente(prefijo,prefijo_particular);	

} 
function showEdicionOferente(prefijo,prefijo_particular)
{
	showVentanaInterna('ventanaInternaDatosSpin');	
	var valores 	= '&prefijo='+prefijo+'&lastAction='+document.main.lastAction.value;
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=edicion_formulario&needlogin=1'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida 	= ajax.responseText;  
			document.getElementById('ventanaInternaDatos').innerHTML = salida;
			showVentanaInterna('ventanaInternaDatos');
			hiddenId('ventanaInternaDatosSpin'); 			
			AbrirBloqueRevision('bloque_'+prefijo_particular);  
			gotoHref('bloque_'+prefijo_particular); /* por si se me pasa algun template sin titulo*/
			gotoHref('titulo_'+prefijo_particular);
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE()); 
}


/**********************************************************************************************
			 BLOQUE DE REVISIONES
***********************************************************************************************/ 

function CerrarBloqueRevision(id_div,caso)
{	
	hiddenId('bloque_'+id_div);	  
	var prefijo = 'titulo_'; 
	if(document.getElementById( prefijo+id_div))
	{
		document.getElementById( prefijo+id_div).innerHTML = "<a name='"+ prefijo+id_div+"'></a>"+document.getElementById( prefijo+id_div).innerHTML;
		gotoHref( prefijo+id_div); 
	}
}
function showRevisionOferente(prefijo,prefijo_particular)
{
	showVentanaInterna('ventanaInternaDatosSpin');	
	var valores 	= '&prefijo='+prefijo+'&lastAction='+document.main.lastAction.value;
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=revision_formulario&needlogin=1'+valores; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida 	= ajax.responseText;  
			document.getElementById('ventanaInternaDatos').innerHTML = salida;
			showVentanaInterna('ventanaInternaDatos');
			hiddenId('ventanaInternaDatosSpin'); 			
			AbrirBloqueRevision('bloque_'+prefijo_particular);  
			gotoHref('bloque_'+prefijo_particular); /* por si se me pasa algun template sin titulo*/
			gotoHref('titulo_'+prefijo_particular);
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE()); 
}  
 
function extra_vista_postitulos(modificacion_div_ocultos,revision_persona_natural_modificacion_solo_lectura,postitulo2_institucion_revision,postitulo2_nombre_revision,postitulo_nombre,postitulo_institucion,postitulo2_nombre,postitulo2_institucion)
{  
	ocultarDivParticular('revision_persona_natural_postitulo2_nombre_div',modificacion_div_ocultos);
	ocultarDivParticular('revision_persona_natural_postitulo2_institucion_div',modificacion_div_ocultos);
	document.main.revision_persona_natural_postitulo2_institucion_revision.value = postitulo2_institucion_revision;
	document.main.revision_persona_natural_postitulo2_nombre_revision.value = postitulo2_nombre_revision;
	
	document.getElementById('postitulo_nombre_revision_span').innerHTML 		= postitulo_nombre;
	document.getElementById('postitulo_institucion_revision_span').innerHTML 	= postitulo_institucion;
	document.getElementById('postitulo2_nombre_revision_span').innerHTML 		= postitulo2_nombre;
	document.getElementById('postitulo2_institucion_revision_span').innerHTML 	= postitulo2_institucion;
	
	noReadInputParticular('revision_persona_natural_postitulo2_institucion_revision',revision_persona_natural_modificacion_solo_lectura);
	noReadInputParticular('revision_persona_natural_postitulo2_nombre_revision',revision_persona_natural_modificacion_solo_lectura); 
	  
	if('div_oculto' == modificacion_div_ocultos )
	{ 
		hiddenId('revision_persona_natural_postitulo2_nombre_div');	
	}			
}

function AbrirBloqueRevisionParticular(id_div)
{
	/* ACCIONES PARTICULARES DE CADA DIV DE LAS REVISIONES, QUE SE DEBEN */
 
	switch(id_div)
	{
		case 'bloque_revision_oferta_general_descripcion':
			textCounter('revision_oferta_general_descripcion_campo_revision', 'revision_oferta_general_descripcion_campo_revision_max',300);
		break;
		case 'bloque_revision_oferta_general_areageografica':
			javascript:showAreaCoberturaOferente(); 
			showId('area_cobertura_comunas_ocultar');
			showId('comuna_spinner');
		break;
		case 'bloque_revision_oferta_general_metodologia':
			textCounter('revision_oferta_general_metodologia_campo_revision','revision_oferta_general_metodologia_campo_revision_max',300);	
		break;
		case 'bloque_revision_persona_natural':
			extra_vista_postitulos(document.main.tmp_postitulo_modificacion_div_ocultos.value, document.main.tmp_postitulo_revision_persona_natural_modificacion_solo_lectura.value, document.main.tmp_postitulo_revision_persona_natural_postitulo2_institucion_revision.value, document.main.tmp_postitulo_revision_persona_natural_postitulo2_nombre_revision.value, document.main.tmp_postitulo_postitulo_nombre.value, document.main.tmp_postitulo_postitulo_institucion.value, document.main.tmp_postitulo_postitulo2_nombre.value, document.main.tmp_postitulo_postitulo2_institucion.value);
		break;
		default:
			var diferencia = id_div.split('-');  
			switch(diferencia[0])
			{
				case 'bloque_revision_portafolio_experiencia':
					textCounter('revision_portafolio_experiencia_'+diferencia[1]+'_nombre_revision','revision_portafolio_experiencia_'+diferencia[1]+'_nombre_revision_max',300); 
					textCounter('revision_portafolio_experiencia_'+diferencia[1]+'_descripcion_revision','revision_portafolio_experiencia_'+diferencia[1]+'_descripcion_revision_max',300);
					textCounter('revision_portafolio_experiencia_'+diferencia[1]+'_resultado_revision','revision_portafolio_experiencia_'+diferencia[1]+'_resultado_revision_max',300);
				break;
				case 'bloque_revision_portafolio_ofertas':
					textCounter('revision_portafolio_ofertas_'+diferencia[1]+'_descripcion_revision','revision_portafolio_ofertas_'+diferencia[1]+'_descripcion_revision_max',300);
					textCounter('revision_portafolio_ofertas_'+diferencia[1]+'_nombre_revision','revision_portafolio_ofertas_'+diferencia[1]+'_nombre_revision_max',255);
				break;
			} 
		break;
		
	}
}


/* FUNCIONES DE EDICION O ACTUALIZACION DE DATOS */
function changeTextIdEdicion(variable,valor)
{
	valor = '<img src="images/iconos/message-warning.gif" /><strong> '+valor+' </strong>';
	changeTextId(variable,valor);
}
 
/************************************** FUNCIONES DE EVALUACION ************************************/

function VerVistaOferente()
{
	document.main.caso_revision.value = 'vista';
	
	process('oferente_validado|vista|',0);
}

function verEvaluacionOferente()
{	
	process('evaluacion|oferente|ficha|',0);
}
function verActualizacionesOferente()
{	
	process('actualizacion|verficha|',0);
}

function verInscripcionOferta(id_oferta)
{   
	var valores 	= '';
	var opciones 	= 'id_oferta='+id_oferta+'&id_oferente='+document.main.id_oferente.value+'&opcion=evaluacion_ofertas_vistas&opcion_vista=evaluacion_ofertas_inscripcion&needlogin=1';
	abrirVentanaInterna(opciones);  
}
function verInscripcionConsolidadaOferta(id_oferta)
{   
	var valores 	= '';
	var opciones 	= 'id_oferta='+id_oferta+'&id_oferente='+document.main.id_oferente.value+'&opcion=evaluacion_ofertas_vistas&opcion_vista=evaluacion_ofertas_inscripcion_consolidada&needlogin=1';
	abrirVentanaInterna(opciones);  
}
 

function verEvaluacionConsolidadaOferta(id_oferta)
{ 
	var opciones 	= 'id_oferta='+id_oferta+'&id_oferente='+document.main.id_oferente.value+'&opcion=evaluacion_ofertas_vistas&opcion_vista=evaluacion_ofertas_satisfaccion_consolidada&needlogin=1'; 
	abrirVentanaInterna(opciones);  
}


function verResolucionOferta(id_oferta)
{   
	var valores 	= '';
	var opciones 	= 'id_oferta='+id_oferta+'&id_oferente='+document.main.id_oferente.value+'&opcion=evaluacion_ofertas_vistas&opcion_vista=evaluacion_ofertas_resolucion&needlogin=1';
	abrirVentanaInterna(opciones);  
}

function verEvaluacionOferta(id_oferta)
{ 
	var opciones 	= 'id_oferta='+id_oferta+'&id_oferente='+document.main.id_oferente.value+'&opcion=evaluacion_ofertas_vistas&opcion_vista=evaluacion_ofertas_satisfaccion&needlogin=1'; 
	abrirVentanaInterna(opciones);  
}


function verEncuestaRegistro(id_registro,rbd)
{ 
	var opciones 	= 'id_registro='+id_registro+'&id_oferente='+document.main.id_oferente.value+'&opcion=evaluacion_ofertas_vistas&opcion_vista=evaluacion_ofertas_encuesta&needlogin=1'; 
	var div_show = 'bloque_encuesta_'+id_registro+'-'+rbd;
	showId(div_show);
	mostrarCargandoImagen(div_show);
	ate_mostrarSalidaPost(opciones,div_show); 
}



function eliminarRegistro(id_oferta)
{
	aux = searchElement('evaluacion_resolucion_justificacion'+id_oferta); 
	if(trim(aux.value) == '')
	{
		showAlert('Debe ingresar las razones de la eliminación de este elemento del registro');
		aux.focus();
		return false;
	}
	
	document.main.buscar_id_oferente.value = document.main.id_oferente.value;
		
	if(id_oferta > 0)
	{
		document.main.evaluacion_resolucion_tipo_resolucion.value = 'oferta';
		document.main.buscar_id_oferta.value = id_oferta;
	}
	if(confirm('¿Esta de eliminar este elemento del registro?'))
	{
		process('eliminar',3);	
	}
}

function guardarResolucion(id_oferta)
{		
	document.main.buscar_id_oferente.value 	= document.main.id_oferente.value;
	document.main.buscar_id_oferta.value 	= id_oferta; 
	
	aux = searchElement('evaluacion_resolucion_comentario'+id_oferta); 
	
	msg = "Debe ingresar el texto de comentario de la resolución";
	if(isEmpty(aux.value))
	{
		showAlert(msg);
		aux.focus();				
		return false;
	}  
	aux = searchElement('evaluacion_resolucion_archivo'+id_oferta); 
	msg = "Debe ingresar el documento de la resolución";
	if(isEmpty(aux.value))
	{
		showAlert(msg);
		aux.focus();				
		return false;
	}  
	aux = searchElement('evaluacion_resolucion_categoria'+id_oferta); 
	msg = "Debe seleccionar la categoría de la resolución";
	if(isEmpty(aux.value))
	{
		showAlert(msg);
		aux.focus();				
		return false;
	} 
	process('guardar_resolucion',3);
}

function descargaBaseDatosEvaluacion()
{
	showId('carga_descarga');
	hiddenId('boton_descarga_base');
	var opciones = '';
	
	opciones 	= opciones+'&busqueda_evaluacion_tipo_oferente=';
	var x = document.main.elements;	
	for (var i=0 ; i < x.length ; i++)
	{			    
		if(x[i].name == 'busqueda_evaluacion_tipo_oferente[]' )
		{			 
			opciones 	= opciones+x[i].value+'-'; 
		}
	}
	if(document.main.busqueda_evaluacion_caso_consulta)
		opciones 	= opciones+'&busqueda_evaluacion_caso_consulta='+document.main.busqueda_evaluacion_caso_consulta.value;
	if(document.main.busqueda_evaluacion_agno)
		opciones 	= opciones+'&busqueda_evaluacion_agno='+document.main.busqueda_evaluacion_agno.value;
	if(document.main.busqueda_evaluacion_region)
		opciones 	= opciones+'&busqueda_evaluacion_region='+document.main.busqueda_evaluacion_region.value;
	if(document.main.busqueda_evaluacion_areas)
		opciones 	= opciones+'&busqueda_evaluacion_areas='+document.main.busqueda_evaluacion_areas.value;
	if(document.main.busqueda_evaluacion_mes)
		opciones 	= opciones+'&busqueda_evaluacion_mes='+document.main.busqueda_evaluacion_mes.value;
	if(document.main.busqueda_evaluacion_semaforo)
		opciones 	= opciones+'&busqueda_evaluacion_semaforo='+document.main.busqueda_evaluacion_semaforo.value;
	if(document.main.busqueda_evaluacion_semaforo)
		opciones 	= opciones+'&busqueda_evaluacion_semaforo='+document.main.busqueda_evaluacion_semaforo.value;
	if(document.main.buscar_rut)
		opciones 	= opciones+'&buscar_rut='+document.main.buscar_rut_filtro.value;
	if(document.main.buscar_nombre)
		opciones 	= opciones+'&buscar_nombre='+document.main.buscar_nombre_filtro.value; 
	
	opciones 	= 'lastAction='+document.main.lastAction.value+'descarga&evaluacion_caso_descarga='+document.main.evaluacion_caso_descarga.value+'&buscar_rut_filtro='+document.main.buscar_rut_filtro.value+'&buscar_nombre_filtro='+document.main.buscar_nombre_filtro.value+'&buscar_id_oferente='+document.main.buscar_id_oferente.value+'&buscar_id_oferta='+document.main.buscar_id_oferta.value+'&opcion=evaluacion_descarga_base&needlogin=1'+opciones; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;
			if(isEmpty(salida))
			{ 
				showId('boton_descarga_base');
				showId('carga_descarga_error'); 
				hiddenId('carga_descarga'); 
			}
			else
			{
				hiddenId('carga_descarga'); 
				showId('boton_descarga_base');
				openLink('download.php?caso=tmp&file='+salida+'&nombre=descarga_base_'+salida+''); 
			}
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());

} 

function descargaBaseDatosContenido(tipo,div_info,div_espera,div_boton)
{
	showId(div_espera);
	hiddenId(div_boton);
	var opciones 	= 'tipo='+tipo+'&contenido='+document.getElementById(div_info).innerHTML+'&opcion=descarga_informacion&needlogin=1'; 
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;
			hiddenId(div_espera); 
			showId(div_boton);
			if(isEmpty(salida))
			{  
				showId(div_boton+'_error');  
			}
			else
			{
				openLink('download.php?caso=tmp&file='+salida+'&nombre=descarga_'+tipo+'_'+salida+''); 
			}
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());

}