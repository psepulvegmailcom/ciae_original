<div class="fieldset_title_separador" style="text-align: right;">
<a onclick="javascript:hiddenId('ventanaInternaDatos');"><small>Cerrar Ventana</small></a></div>
  
<div  class="fieldset_title_separador" id='ficha_evaluacion_datos_general'>Resoluciones Oferta</div> 
<fieldset> 
 <div class="fieldset_title_interno">Resoluciones Oferta</div>
 <div  style=" height:auto; max-height:300px; overflow:auto">
 <!-- START BLOCK : bloque_evaluacion_resoluciones_por_oferente_sin_info -->
 No hay resoluciones 
 <!-- END BLOCK : bloque_evaluacion_resoluciones_por_oferente_sin_info -->
<!-- START BLOCK : bloque_evaluacion_resoluciones_por_oferente -->
<div id='resolucion_oferente_{id_resolucion}'>
<label>Resoluci�n {fecha_real}</label><br>
<a href="javascript:showId('resolucion_oferente_{id_resolucion}_detalle'); ">Ver Detalle Resoluci�n</a>
<div id='resolucion_oferente_{id_resolucion}_detalle' style="padding-left:20px; visibility:hidden; height:0px;">
<strong>Fecha Resoluci�n:</strong> {fecha_real}<br>
<strong>Revisor Resoluci�n:</strong> {revisor_resolucion}<br>
<strong>Categor�a Resoluci�n:</strong> {categoria}<br>
<strong>Documento Resoluci�n:</strong> 
 <!-- INCLUDE BLOCK : ../templates/ate/general/file_actual_simple.tpl -->
<br><strong>Comentario Resoluci�n:</strong> {comentario_resolucion}<br>
<a href="javascript:hiddenId('resolucion_oferente_{id_resolucion}_detalle')">Ocultar Detalle Resoluci�n</a>
</div>
<script>hiddenId('resolucion_oferente_{id_resolucion}_detalle'); </script>
</div>
<!-- END BLOCK : bloque_evaluacion_resoluciones_por_oferente -->
 </div>
 
<!-- START BLOCK : bloque_evaluacion_resoluciones_por_oferente_formulario -->
 <div class="fieldset_title_interno">Nueva Resoluci�n Oferta</div>
 
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/formulario_resolucion.tpl -->
<!-- END BLOCK : bloque_evaluacion_resoluciones_por_oferente_formulario -->
</fieldset>


<div class="fieldset_title_separador" style="text-align: right;">
<a onclick="javascript:hiddenId('ventanaInternaDatos');"><small>Cerrar Ventana</small></a></div>

<script> 
	document.main.buscar_id_oferente.value 	= document.main.id_oferente.value; 
	document.main.buscar_id_oferta.value	= {id_oferta};

</script> 
 