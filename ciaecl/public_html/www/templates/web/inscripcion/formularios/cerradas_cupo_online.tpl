 
if(document.main.tipo_formulario_confirmacion.value == 'online' && document.main.tmp_estado_abierto.value == 'cerrado_cupo')
{ 
	changeTextId('bloque_cierre_cupo','<p><strong><big>Solo quedan cupos disponibles para participar online, via streaming</big></strong></p>');
	mostrarDiv('inscripcion_ficha');
	showId('bloque_inscripcion_online_mensaje');
	hiddenId('bloque_inscripcion_presencial');
}
 
 