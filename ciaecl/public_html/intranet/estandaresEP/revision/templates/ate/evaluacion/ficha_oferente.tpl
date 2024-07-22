  <div style="text-align:right">
  <a href="javascript:process(document.main.lastAction.value.replace('|ficha',''),0);">&laquo; Volver listado
  </a></div>
	<input type="hidden" name="evaluacion_resolucion_tipo_resolucion" value="{tipo_resolucion}">
<div  class="fieldset_title_separador" id='ficha_evaluacion_datos_general'> Ficha Oferente</div> 
<fieldset>
  <div class="fieldset_title_interno">Datos de Usuario</div>
 <a  href="javascript:verDatosUsuario('ventanaDatosUsuario','SpinDatosUsuario');">(Ver Datos)</a>
 <div id='SpinDatosUsuario'  style=' text-align:center; '  class="div_oculto" >
	 <img src="images/spinner.gif" /><br />Cargando Información
</div>
<div id='ventanaDatosUsuario'  style="height:230px;" >
<div id='ventanaDatosUsuario_interno' class="div_oculto" ></div>
<br />

<a href="javascript:hiddenId('SpinDatosUsuario');hiddenId('ventanaDatosUsuario_interno');hiddenId('ventanaDatosUsuario');">Ocultar Datos</a>
</div>
<script>
 verDatosUsuario('ventanaDatosUsuario','SpinDatosUsuario'); 
</script>
 

 
 <div class="fieldset_title_interno">Historial Estados Oferente</div>
 <!---->
 <a  href="javascript:verHistorialOferente('ventanaHistorialOferente','SpinHistorialOferente');">(Ver Historial Estados Oferente)</a>
 <div id='SpinHistorialOferente'  style=' text-align:center; '  class="div_oculto" >
	 <img src="images/spinner.gif" /><br />Cargando Información
	</div>

	<div id='ventanaHistorialOferente'  class="div_oculto" >
	<div id='ventanaHistorialOferente_interno'  class="div_oculto" ></div>
	<br />

	<a href="javascript:hiddenId('SpinHistorialOferente');hiddenId('ventanaHistorialOferente_interno');hiddenId('ventanaHistorialOferente');">Ocultar Datos</a>
	</div>
<!----> 

 <div class="fieldset_title_interno">Datos Postulación Oferente</div>
 <a href="javascript:VerVistaOferente();">Ver ficha datos oferente</a>
 
<!----> 
 
 <div class="fieldset_title_interno">Actualizaciones Postulación Oferente</div>
 <a href="javascript:verActualizacionesOferente();">Ver actualizaciones oferente</a>
 
 </fieldset> 
 
 
<div  class="fieldset_title_separador" id='ficha_evaluacion_datos_general'>Resoluciones Oferente</div> 
<fieldset> 
 <div class="fieldset_title_interno">Resoluciones Oferente</div>
 <div  style=" height:auto; max-height:300px; overflow:auto">
 <!-- START BLOCK : bloque_evaluacion_resoluciones_por_oferente_sin_info -->
 No hay resoluciones 
 <!-- END BLOCK : bloque_evaluacion_resoluciones_por_oferente_sin_info -->
<!-- START BLOCK : bloque_evaluacion_resoluciones_por_oferente -->
<div id='resolucion_oferente_{id_resolucion}'>
<label>Resolución {caso} <small>{fecha_real}</small></label><br>
<a href="javascript:showId('resolucion_oferente_{id_resolucion}_detalle'); ">Ver Detalle Resolución</a>
<div id='resolucion_oferente_{id_resolucion}_detalle' style="padding-left:20px;">
<strong>Fecha Resolución:</strong> {fecha_real}<br>
<strong>Revisor Resolución:</strong> {revisor_resolucion}<br>
<strong>Categoría Resolución:</strong> {categoria}<br>
<strong>Documento Resolución:</strong> 
 <!-- INCLUDE BLOCK : ../templates/ate/general/file_actual_simple.tpl -->
<br><strong>Comentario Resolución:</strong> {comentario_resolucion}<br>
<a href="javascript:hiddenId('resolucion_oferente_{id_resolucion}_detalle')">Ocultar Detalle Resolución</a>
</div>
<script>hiddenId('resolucion_oferente_{id_resolucion}_detalle'); </script>
</div>
<!-- END BLOCK : bloque_evaluacion_resoluciones_por_oferente -->
 </div>
 
<!-- START BLOCK : bloque_evaluacion_resoluciones_por_oferente_formulario -->
 <div class="fieldset_title_interno">Nueva Resolución Oferente</div>
 
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/formulario_resolucion.tpl -->
<!-- END BLOCK : bloque_evaluacion_resoluciones_por_oferente_formulario -->
</fieldset>


 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/ficha_semaforos.tpl -->

<div  class="fieldset_title_separador" id='ficha_evaluacion_datos_general'> Ofertas Inscrita por Oferente</div>
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/ficha_oferta_resultado.tpl -->
  <div style="text-align:right">
  <a href="javascript:process(document.main.lastAction.value.replace('|ficha',''),0);">&laquo; Volver listado
  </a></div>

 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/descarga.tpl -->
<script>  
var mostrar_bloque = true;

<!-- START BLOCK : bloque_evaluacion_por_oferente_guardar_resolucion -->
gotoHref('detalle_oferta_{id_oferta}');
verResolucionOferta('{id_oferta}');
mostrar_bloque = false;
	<!-- START BLOCK : bloque_evaluacion_por_oferente_guardar_resolucion_mensaje -->
	showAlert('{mensaje}');
	<!-- END BLOCK : bloque_evaluacion_por_oferente_guardar_resolucion_mensaje -->
<!-- END BLOCK : bloque_evaluacion_por_oferente_guardar_resolucion -->
<!-- START BLOCK : bloque_evaluacion_por_oferente_ir_oferta -->
gotoHref('detalle_oferta_{id_oferta}');
if(mostrar_bloque)
{
	if(document.main.busqueda_evaluacion_caso_consulta.value == 'inscripcion')
	{
		verInscripcionConsolidadaOferta('{id_oferta}');
	}
	if(document.main.busqueda_evaluacion_caso_consulta.value == 'satisfaccion')
	{
		verEvaluacionConsolidadaOferta('{id_oferta}');
	}
}
<!-- END BLOCK : bloque_evaluacion_por_oferente_ir_oferta --> 
</script>

