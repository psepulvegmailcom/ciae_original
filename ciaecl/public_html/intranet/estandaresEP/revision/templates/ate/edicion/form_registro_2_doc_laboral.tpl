
<!-- START BLOCK : bloque_ate_documento_certificado_obligaciones_laborales --> 
hiddenId('bloque_ate_legal_archivo_declaracion_obligaciones_laborales');
showId('bloque_ate_legal_archivo_certificado_obligaciones_laborales');
document.main.doc_obligaciones_laborales[0].checked = true;
/*changeTextId('bloque_ate_documento_certificado_obligaciones_laborales_archivo','{valor}');*/
<!-- END BLOCK : bloque_ate_documento_certificado_obligaciones_laborales -->

<!-- START BLOCK : bloque_ate_documento_declaracion_obligaciones_laborales --> 
hiddenId('bloque_ate_legal_archivo_certificado_obligaciones_laborales');	
showId('bloque_ate_legal_archivo_declaracion_obligaciones_laborales');
document.main.doc_obligaciones_laborales[1].checked = true;
/*changeTextId('bloque_ate_documento_declaracion_obligaciones_laborales_archivo','{valor}');*/
<!-- END BLOCK : bloque_ate_documento_declaracion_obligaciones_laborales --> 


<!-- START BLOCK : bloque_ate_documento_obligaciones_laborales --> 
cambiarDocumentoLaboral('{caso}') 
document.main.ate_legal_archivo_{caso}_obligaciones_laborales.disabled = true;
hiddenId('documento_{caso_contrario}_obligaciones_laborales');
/*changeTextId('bloque_ate_documento_{caso}_obligaciones_laborales_archivo','{valor}'); */
<!-- END BLOCK : bloque_ate_documento_obligaciones_laborales --> 