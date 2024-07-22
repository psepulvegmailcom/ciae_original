function verSitioLang(lang)
{
	document.main.langSite.value = lang;
	process('home',0);
}
  

function EnviarFormulario()
{ 
	process(document.main.lastAction.value,0);
}

function opcionInterna(id,subopcion)
{
	document.main.id_base.value = id;
	var aux = document.main.opcion.value + '|' + subopcion;
	process(aux,0);
}
  
function mostrarSubmenu(ubicacion)
{}

function ocultarSubmenu(padre)
{} 

function ocultarSiSubmenu(padre)
{}

function abrirImagen(imagen)
{
	
}

/* FUNCIONES DE BLOQUES DE ELEMENTOS */
function ocultarBloqueElemento(maximo,caso)
{ 
	var fila = 'listado_'+caso+'_id';
	while(true)
	{
		maximo++;
		fila_aux = fila+'_'+maximo; 
		if(document.getElementById(fila_aux))
		{
			//alert(fila_aux);
			hiddenId(fila_aux);  
		}
		else
		{
			break;
		} 
	}	
	showId('div_mas_'+caso);
	
	hiddenId('div_menos_'+caso);
	
	showId('div_mas_'+caso+'_superior');
	hiddenId('div_menos_'+caso+'_superior');
}

function mostrarBloqueElemento(maximo,caso)
{
	hiddenId('div_mas_'+caso);	
	showId('div_menos_'+caso);
	
	showId('div_menos_'+caso+'_superior');
	hiddenId('div_mas_'+caso+'_superior');
	
	
	
	var fila = 'listado_'+caso+'_id';
	while(true)
	{
		maximo++;
		fila_aux = fila+'_'+maximo; 
		if(document.getElementById(fila_aux))
		{
			showId(fila_aux);   
		}
		else
		{
			break;
		} 
	}	
}




/* administracion */
 function enviar_accion_admin(proceso,id)
 {
 	var accion =  proceso;
	document.main.id_item.value = id; 
 	process(accion,0);	 
 }
 
 
 
 function enviar_accion_eliminar_admin(proceso,id)
 {
	 if(confirm('Esta seguro de eliminar el elemento?'))
	 {
		enviar_accion_admin(proceso,id);
	 }
}

/* funcion jquery */
function findRutSII(rut,dv,id_show)
{	
	/*showId('carga_informacion');*/
	var input_rut 	= rut;	
	var input_dv 	= dv; 
	var valores 	= 'rut='+rut+'&dv='+dv;   
	var opciones 	= 'caso_revision=getrutsii&needlogin=1&'+valores; 
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
			//hiddenId('sii_spinner'); 
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());  	
}

function obtenerFormularioItinerario(fila,id_show)
{	
	/*showId('carga_informacion');*/ 
	var valores 	= 'fila='+fila;   
	var opciones 	= 'opcion=viaje_fila_itinerario&needlogin=1&'+valores; 
	var url 		= 'index_externo.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState == 4)
	   {	 
			var salida = ajax.responseText;  
			showId(id_show); 
			  document.main.itenerario_activo.value = fila;
			document.getElementById(id_show+'_interno').innerHTML =  salida+ "";
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());  
		
}

function buscadorListadoAdmin(page)
{ 
    var destino = 'admin.php?langSite=es&page='+page; 
	main.action = destino;   
	main.submit();  
}

function limpiezaEstadoLibros(texto)
{
	escribirSimplePantalla(texto.replace('_',' ')); 
}

function formatoCentroCosto(codigo)
{
	var largo = codigo.length;
	 
	if(largo == 15)
	{
		codigo = codigo.substr(0, 8)+'-'+codigo.substr(8, 4)+'-'+codigo.substr(12, 3);
	}
	else
	{
		if(largo == 31)
		{
			codigo = codigo.substr(0, 8)+'-'+codigo.substr(8, 4)+'-'+codigo.substr(12, 3)+'/'+codigo.substr(16, 8)+'-'+codigo.substr(24, 4)+'-'+codigo.substr(28, 3);
		}
	}
	escribirSimplePantalla(codigo);
}
