
<!-- START BLOCK : bloque_edicion_generico_valor_text -->
changeFormValue('{variable}','{valor}'); 
<!-- END BLOCK : bloque_edicion_generico_valor_text --> 

<!-- START BLOCK : bloque_edicion_generico_valor_select --> 
selectValue('{variable}','{valor}'); 
<!-- END BLOCK : bloque_edicion_generico_valor_select -->
 
<!-- START BLOCK : bloque_edicion_generico_valor_id --> 
changeTextIdEdicion('{variable}','{valor}'); 
<!-- END BLOCK : bloque_edicion_generico_valor_id -->


<!-- START BLOCK : bloque_edicionrevision_generico_valor_id --> 
changeTextId('{variable}_estado','{tipo_actualizacion}'); 
if(document.main.{variable})
{
 	document.main.{variable}.disabled 				= true;
} 
<!-- END BLOCK : bloque_edicionrevision_generico_valor_id -->



<!-- START BLOCK : bloque_edicionrevision_generico_valor_id_sedes --> 
 	document.main.ate_sede_{numero_div}_comuna_id.disabled 				= true;
 	document.main.ate_sede_{numero_div}_direccion.disabled 				= true;
 	document.main.ate_sede_{numero_div}_telefono_codigo.disabled 		= true;
	document.main.ate_sede_{numero_div}_telefono.disabled 				= true;
	document.main.ate_sede_{numero_div}_email.disabled 					= true;
	document.main.ate_sede_{numero_div}_email.disabled 					= true;
<!-- END BLOCK : bloque_edicionrevision_generico_valor_id_sedes -->


 
<!-- START BLOCK : bloque_ate_documento_generico -->  
<!-- SE DISABILITA ES PODER SUBIR ARCHIVO Y SE MUESTRA TEXTO EDICIÓN -->
changeTextId('bloque_ate_documento_{variable}_estado','{tipo_actualizacion}');
if(document.main.ate_legal_archivo_{variable})
{
	document.main.ate_legal_archivo_{variable}.disabled = true; 
}
<!-- END BLOCK : bloque_ate_documento_generico -->

changeFormValue('caso_revision','edicion');