 
document.main.ate_legal_archivo_universidad_estatutos.disabled 			= true; 
document.main.ate_legal_archivo_universidad_patrocinio.disabled 		= true;
document.main.ate_legal_archivo_universidad_reconocimiento.disabled 	= true; 
document.main.ate_legal_archivo_universidad_patrocinio_privada.disabled = true; 

if(document.getElementById('documento_universidad_acreditacion'))
{	 
	document.main.ate_legal_archivo_universidad_acreditacion_privada.disabled = true;
}
else
{	 
	document.main.ate_legal_archivo_universidad_acreditacion.disabled = true;
}

/* visualizacion de cambio de documentos */

<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_registro_2_doc_laboral.tpl -->
<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_generico.tpl -->




