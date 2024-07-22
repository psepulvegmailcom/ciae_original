// JavaScript Document
/********************************************************************************************
		FUNCIONES PARA BLOQUEO DEL FORMULARIO EN EL CASO DE 
		USUARIOS CON DEVULUCION DE FORMULARIO
********************************************************************************************/
function desbloquearFormularioDevuelto()
{		 
	if(document.main.restriccionBloqueo.value != '')
	{ 
		var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{			      			
			if(x[i].disabled )
			{		
				x[i].disabled 	= false; 	
			}
		}	
	} 
}

function bloqueoHabilitarActivar(elemento)
{	
	if(document.main.restriccionBloqueo.value != '')
	{
		var input 		= searchElement(elemento);	 
		input.disabled = false;
		input.focus();
	}
}

function bloquearFormularioDevuelto()
{
	if(document.main.restriccionBloqueo.value != '')
	{
		var restriccionBloqueo = document.main.restriccionBloqueo.value;
		/* bloqueos de todo el formulario de los oferentes */
		
		/*document.getElementById('test_bloqueorevision').innerHTML = '<a href="javascript:desbloquearFormularioDevuelto();revisarBloqueoRevisiones()">Probar </a><br><br>'+restriccionBloqueo+'<br><br>';*/
		var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{			      			
			if(x[i].type != 'hidden' && x[i].name != '' && x[i].name)
			{		
				var find = restriccionBloqueo.indexOf('|'+x[i].name+'|');	 					 				
				if(find > -1)
				{
					continue; 			
				} 
				if((x[i].type == 'checkbox'  || x[i].type == 'radio')  && !x[i].checked)
				{
					x[i].disabled = true;
					continue;
				}  
				x[i].disabled 	= true;   
				 
				bloqueoRevisionTesteo(x[i].name );
			}
		}
		
		var lista_id_bloquear = new Array ('ate_institucion_zona_cobertura_boton','boton_borrar_titulo','boton_borrar_postitulo','boton_borrar_postitulo2','boton_borrar_titulo','boton_borrar_postitulo','boton_eliminar_titulo','boton_eliminar_declaracion_obligaciones_laborales','boton_eliminar_certificado_obligaciones_laborales','boton_eliminar_persona_acreditacion_2','boton_eliminar_persona_acreditacion','boton_eliminar_persona_acreditacion_3','boton_eliminar_persona_acreditacion_4','boton_eliminar_financiera_dicom','boton_eliminar_empresa_vigencia','boton_eliminar_empresa_socio','boton_eliminar_empresa_cbrs','boton_eliminar_empresa_copia_arriendo','boton_eliminar_universidad_estatutos','boton_eliminar_universidad_acreditacion','boton_eliminar_universidad_patrocinio','boton_eliminar_universidad_reconocimiento','boton_eliminar_universidad_acreditacion_privada','boton_eliminar_universidad_patrocinio_privada');
		for (var i=0 ; i < lista_id_bloquear.length ; i++)
		{			  
			if(document.getElementById(lista_id_bloquear[i]))
			{
				hiddenId(lista_id_bloquear[i]);
			}
		} 
		 
		capas=document.getElementsByTagName('span');
		for (i=0;i<capas.length;i++)
		{
			var nombre_id = capas[i].id;
			var find_editar = nombre_id.indexOf('bloque_botones_experiencia_');
			var find_borrar = nombre_id.indexOf('bloque_botones_oferta_');	 					 				
			if(find_editar > -1 || find_borrar > -1)
			{					
				hiddenId(capas[i].id);	 
				bloqueoRevisionTesteo(' span bloqueado '+ capas[i].id );
			} 
			else
			{
				continue;	
			} 
		}  
		capas=document.getElementsByTagName('a');
		for (i=0;i<capas.length;i++)
		{
			var nombre_id = capas[i].id;
			var find_editar = nombre_id.indexOf('boton_editar_capital_humano_');
			var find_borrar = nombre_id.indexOf('boton_borrar_capital_humano_');	 					 				
			if(find_editar > -1 || find_borrar > -1)
			{					
				hiddenId(capas[i].id);	 
				bloqueoRevisionTesteo(' a  bloqueado '+ capas[i].id );
			} 
			else
			{
				continue;	
			} 
		}		 
	}
}

function bloqueoRevisionTesteo(texto)
{
	/* document.getElementById('test_bloqueorevision').innerHTML = document.getElementById('test_bloqueorevision').innerHTML + texto +'<br>';  */	
}