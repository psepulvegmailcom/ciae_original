function ocultarDiv()
{
	hiddenId('inscripcion_ficha');   
	hiddenId('inscripcion_programa');
	hiddenId('inscripcion_convocatoria');
	hiddenId('inscripcion_info_extra');
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
ocultarDiv();
mostrarDiv('inscripcion_ficha');
<!-- START BLOCK : bloque_formulario_cierre_extra -->
ocultarDiv();
mostrarDiv('inscripcion_convocatoria');
<!-- END BLOCK : bloque_formulario_cierre_extra --> 


function repetirTextoPrograma(id)
{
	if(document.getElementById(id) && document.getElementById(id+'_programa'))
    {    	
		document.getElementById(id+'_programa').innerHTML = document.getElementById(id).innerHTML;
    }
}
repetirTextoPrograma('informacion_consulta');
repetirTextoPrograma('informacion_fecha');
repetirTextoPrograma('informacion_horario');
repetirTextoPrograma('informacion_lugar');
repetirTextoPrograma('informacion_costo');