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


 