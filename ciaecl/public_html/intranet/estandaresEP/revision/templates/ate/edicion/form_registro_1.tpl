 
/* primera partes de cambios de sedes */
<!-- START BLOCK : bloque_sede_ingreso -->
agregarSede(total_sede); 
total_sede = total_sede + 1; 
var input_region 		= searchElement('ate_nosede_{sede_div}_region_id');
input_region.value 		= 	{region_id};  
changeTextId('ate_sede_{sede_div}_sede_estado','{sede_estado}'); 
<!-- END BLOCK : bloque_sede_ingreso -->

document.main.ate_institucion_rut.disabled 				= true;
document.main.ate_institucion_dv.disabled 				= true ;
document.main.ate_institucion_agno_fundacion.disabled	= true ;  

<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_generico.tpl --> 

function chequeoTipoDatosEdicion()
{ 	
	var variables 	= new Array();	
	var mensajes 	= new Array();
	var i=0;
	variables[i] 	= 'ate_institucion_razon_social';
	mensajes[i] 	= "La raz�n social de la instituci�n no puede quedar vac�o";
	i++;
	variables[i] 	= 'ate_institucion_nombre_fantasia';
	mensajes[i] 	= "El nombre de fantasia de la instituci�n no puede quedar vac�o";
	i++;
	variables[i] 	= 'ate_institucion_giro';
	mensajes[i] 	= "El Objeto Social / Giro de la Instituci�n no puede quedar vac�o";
	i++;
	variables[i] 	= 'ate_institucion_representante';
	mensajes[i] 	= "El Nombre del Representante Legal de la Instituci�n no puede quedar vac�o"; 
	i++;
	variables[i] 	= 'ate_institucion_representante_apellido_paterno';
	mensajes[i] 	= "El apellido paterno del Representante Legal de la Instituci�n no puede quedar vac�o";
	i++;
	variables[i] 	= 'ate_institucion_representante_apellido_materno';
	mensajes[i] 	= "El apellido materno del Representante Legal de la Instituci�n no puede quedar vac�o";
	i++;
	variables[i] 	= 'ate_institucion_direccion';
	mensajes[i] 	= "La direcci�n de la Instituci�n no puede quedar vac�o";
	i++;
	variables[i] 	= 'ate_institucion_comuna_id';
	mensajes[i] 	= "Debe seleccionar la comuna de la Instituci�n";
	i++;
	variables[i] 	= 'ate_institucion_telefono_codigo';
	mensajes[i] 	= "El c�digo de tel�fono y el tel�fono de la Instituci�n no pueden quedar vac�o";
	i++;
	variables[i] 	= 'ate_institucion_telefono';
	mensajes[i] 	= "El c�digo de tel�fono y el tel�fono de la Instituci�n no pueden quedar vac�o";
	i++;
	variables[i] 	= 'ate_institucion_email';
	mensajes[i] 	= "El email de la Instituci�n no puede quedar vac�o";
	i++;
	mensajes[i] 	= "El nombre del responsable de la Instituci�n no puede quedar vac�o";
	variables[i] 	= "ate_responsable_nombre";	
	i++;
	mensajes[i] 	= "El apellido paterno del responsable de la Instituci�n no puede quedar vac�o";
	variables[i] 	= "ate_responsable_apellido_paterno";	
	i++;
	mensajes[i] 	= "El apellido materno del responsable de la Instituci�n no puede quedar vac�o";
	variables[i] 	= "ate_responsable_apellido_materno";	
	i++;
	mensajes[i] 	= "La direcci&oacute;n del responsable de la Instituci�n no puede quedar vac�o";
	variables[i] 	= "ate_responsable_direccion";
	i++;
	mensajes[i] 	= "El email del responsable  de la Instituci�n no puede quedar vac�o";
	variables[i] 	= "ate_responsable_email";	
	i++;
	mensajes[i] 	= "El cargo del responsable  de la Instituci�n no puede quedar vac�o";
	variables[i] 	= "ate_responsable_cargo";

	for (var i=0 ; i < variables.length ; i++)
	{
		var aux = searchElement(variables[i]);
		if(isEmpty(aux.value))
		{
			showAlert(mensajes[i]);
			aux.focus();  				
			return false; 
		} 	
	}
	 
	if(isEmpty(document.main.ate_responsable_telefono_codigo.value) && isEmpty(document.main.ate_responsable_telefono.value) && isEmpty(document.main.ate_responsable_celular_codigo.value) && isEmpty(document.main.ate_responsable_celular.value))
	{
		showAlert("De ingresar un tel�fono de contacto del responsable de la instituci�n tel�fono fijo o celular"); 				
		return false; 
	}  
	return true;
}




/* segunda partes de cambios de sedes */
<!-- START BLOCK : bloque_sede_actualizacion -->
changeFormValue('ate_sede_{sede_div}_direccion','{direccion}'); 
changeFormValue('ate_sede_{sede_div}_telefono','{telefono}');   
selectValue('ate_sede_{sede_div}_telefono_codigo','{telefono_codigo}'); 
changeFormValue('ate_sede_{sede_div}_email','{email}');  
var input_region 		= searchElement('ate_nosede_{sede_div}_region_id');
input_region.value 		= 	{region_id};  
ate_sede_comuna_id_nueva = '{comuna_id}';
showComuna('ate_nosede_{sede_div}_region_id','ate_sede_{sede_div}_comuna_id',{comuna_id}) ;
var input_comuna 		= searchElement('ate_sede_{sede_div}_comuna_id'); 
setTimeout('input_comuna.value = 	{comuna_id}',500);
<!-- END BLOCK : bloque_sede_actualizacion -->


