
<!-- INCLUDE BLOCK : ../templates/encuesta/barra_superior.tpl -->
 

<br>
<!-- START BLOCK : bloque_areas_pregunta_old -->
 <strong>Marque el/las áreas que responderá (al menos una).</strong><br />
	<!-- START BLOCK : bloque_areas_pregunta_lista -->
		<input type="checkbox" name="areas_responder[]"   value="{id_area}" onclick="javascript:guardarAreaSeleccionada({id_area})" />{orden} {area} <br /> 
	<!-- END BLOCK : bloque_areas_pregunta_lista -->
	<br /> <br />  
<!-- END BLOCK : bloque_areas_pregunta_old -->
 
<div id='texto_explicacion_navegacion' style="padding-bottom: 20px">
	<strong>En la versión, ingrese al dominio y luego al estándar a revisar. Siga atentamente las instrucciones.</strong> 
 </div>
<script>
hiddenId('texto_explicacion_navegacion');
</script>
<ul>
<!-- START BLOCK : bloque_areas -->
<script>var orden_area = {orden};</script>
<li   style=" padding: 3px 0 3px 0; "   ><a href="javascript:verComponente('{id_area}');">
<strong>Versión:</strong><span  id="texto_area"> {area}</span></a>
<script>
checkedValue('areas_responder[]',{id_area});
showId('texto_explicacion_navegacion');
</script>

<ul>

<!-- START BLOCK : bloque_componentes_extra -->
<li style="padding: 3px 0 3px 0;padding-left:25px; ">
<a href="javascript:verElementos('{id_componente}');"><strong>Dominio  :</strong><span  id='texto_componente'> {componente}</span></a>&nbsp;&nbsp;<strong> </strong>
</li>
<!-- END BLOCK : bloque_componentes_extra -->
<div style="border-bottom:1px dashed #666666; padding-top:20px; margin-bottom:20px;"></div>
<!-- START BLOCK : bloque_componentes -->
<script>var orden_componente = {orden};</script>
<li style="padding: 3px 0 3px 0;padding-left:25px; ">
<a href="javascript:verElementos('{id_componente}');"><strong>Dominio  :</strong><span  id='texto_componente'> {componente}</span></a>&nbsp;&nbsp;<strong> </strong>
	<ul>
	<!-- START BLOCK : bloque_elementos -->
		<script>var orden_elemento = {orden};</script>
		<li style="padding: 3px 0 3px 0;padding-left:25px"><a href="javascript:verElemento('{id_elemento}');">
		<strong>Est&aacute;ndar <!--<script>document.write(orden_area+"."+orden_componente);</script>.{orden}-->:</strong>
		<span id='texto_elemento'>  {elemento}  {descripcion}</span></a>&nbsp;&nbsp;<strong><!--({estado_elemento})--></strong>
		</li>	
	<!-- END BLOCK : bloque_elementos --> 
	</ul>
</li>



<!-- START BLOCK : bloque_elementos_continuacion -->
<br />
<table border="0" style="border:0px; width:98%">
<tr>
<td style="text-align:left; border:0px;"><small>
<!-- START BLOCK : bloque_elementos_continuacion_anterior -->
<a href="javascript:verElemento('{id_elemento_anterior}');">&laquo; Estándar Anterior</A>
<!-- END BLOCK : bloque_elementos_continuacion_anterior -->
</small></td>
<td style=" text-align:right; border:0px"><small>
<!-- START BLOCK : bloque_elementos_continuacion_siguiente -->
<a href="javascript:verElemento('{id_elemento_siguiente}');">Estándar Siguiente &raquo; </A>
<!-- END BLOCK : bloque_elementos_continuacion_siguiente -->
</small></td>
</tr>
</table>
<!-- END BLOCK : bloque_elementos_continuacion -->
	
<!-- END BLOCK : bloque_componentes -->


</ul>
</li>	
<!-- END BLOCK : bloque_areas -->
</ul>

 
<!-- START BLOCK : bloque_niveles -->
<script> 
showId('texto_explicacion_navegacion');
</script>

<!--<div class="fieldset_title">{nombre_estandar}</div>-->

<div class="fieldset_title">Definición del estándar</div>
<div style="padding-left:25px; ">{definicion_estandar}</div>

<div class="fieldset_title">Comentario sobre estándar</div>


<table style="width:98%"  id="tabla_noborder_admin">
 
<tr>
<td  colspan="6"   style="text-align:center; border:none"><textarea class="textarea_niveles" name="comentario_elemento">{comentario_elemento}</textarea></td>
</tr> 
<tr>
<td colspan="6">
<!-- START BLOCK : bloque_estandares_comentarios -->
<br /><br />
 <strong style=" margin-left:20px;">Comentarios</strong> 
<br /><br />
 
 
<table  class="tabla_comentarios_internos" >
<tr><th>Fecha</th><th>Usuario</th><th>Comentario</th></tr>
	<!-- START BLOCK : bloque_estandares_comentarios_detalles -->
	
	<tr>
	<td style="font-weight:normal"><small style="font-size:8px">{fecha}</small></td>
	<td style="font-weight:normal">{usuario}</td><td style="font-weight:normal">{respuesta}</td>
	</tr>
	
	<!-- END BLOCK : bloque_estandares_comentarios_detalles -->
	
	<!-- START BLOCK : bloque_estandares_comentarios_no_detalles -->
	
	<tr><td colspan="3">No hay comentarios </td></tr>
	
	<!-- END BLOCK : bloque_estandares_comentarios_no_detalles -->
	</table> 
<!-- END BLOCK : bloque_estandares_comentarios -->
</td>
</tr>
 

</td></tr>
</table>



<div class="fieldset_title">Indicadores</div>
<br>
En esta sección debe revisar la descripción de cada indicador. Si lo considera necesario realice comentarios en el espacio asignado.
 
<br><br>
<table style="width:97%"  id="tabla_noborder_admin" class = 'letra_simple' > 
 
<tr>
	<th class = 'letra_simple' >
	<big>Indicadores</big>	</th>
</tr>

 <!-- START BLOCK : bloque_indicadores -->
<tr>
<td class = 'letra_simple{class_color}' style=" vertical-align: middle; padding-top:10px;   "> <em style="font-weight:bold; text-decoration:underline">Indicador:</em> {indicador} <br /><br /> <textarea name="respuesta_indicador[{id_indicador}]" class="textarea_niveles">{respuesta}</textarea>

<!-- START BLOCK : bloque_indicadores_comentarios -->
<br /><br />
 <strong style=" margin-left:20px;">Comentarios</strong> 
<br /><br />
 
 
<table  class="tabla_comentarios_internos" >
<tr><th>Fecha</th><th>Usuario</th><th>Comentario</th></tr>
	<!-- START BLOCK : bloque_indicadores_comentarios_detalles -->
	
	<tr>
	<td style="font-weight:normal"><small style="font-size:8px">{fecha}</small></td>
	<td style="font-weight:normal">{usuario}</td><td style="font-weight:normal">{respuesta}</td>
	</tr>
	
	<!-- END BLOCK : bloque_indicadores_comentarios_detalles -->
	
	<!-- START BLOCK : bloque_indicadores_comentarios_no_detalles -->
	
	<tr><td colspan="3">No hay comentarios para este indicador</td></tr>
	
	<!-- END BLOCK : bloque_indicadores_comentarios_no_detalles -->
	</table> 
<!-- END BLOCK : bloque_indicadores_comentarios -->

 </td></tr>



 <!-- END BLOCK : bloque_indicadores --> 
 <!-- START BLOCK : bloque_no_indicadores -->
<tr><td class = 'letra_simple' style=" vertical-align: middle; padding-top:10px;  font-weight:normal; text-align:center   "> No hay indicadores para este estándar</td></tr> 
 <!-- END BLOCK : bloque_no_indicadores -->  
  
</table>

<!-- START BLOCK : bloque_ejemplos_global -->
<div class="fieldset_title">Ejemplos</div>
<br>
 
<p>En esta sección debe revisar la descripción de cada ejemplo. Si lo considera necesario realice comentarios en el espacio asignado</p>

<br><br>
<table style="width:98%"  id="tabla_noborder_admin" class = 'letra_simple' > 
 
<tr>
	<th class = 'letra_simple' >
	<big>Ejemplos</big>	</th>
</tr>

 <!-- START BLOCK : bloque_ejemplos -->
<tr><td class = 'letra_simple{class_color}' style=" vertical-align: middle; padding-top:10px;   ">
 <em style="font-weight:bold; text-decoration:underline">Ejemplo:</em> {ejemplo} <br /><br /> <textarea name="respuesta_ejemplo[{id_ejemplo}]" class="textarea_niveles">{respuesta}</textarea>
<!-- START BLOCK : bloque_ejemplos_comentarios -->
<br /><br />
 <strong style=" margin-left:20px;">Comentarios</strong> 
<br /><br />
 
 
<table  class="tabla_comentarios_internos" >
<tr><th>Fecha</th><th>Usuario</th><th>Comentario</th></tr>
	<!-- START BLOCK : bloque_ejemplos_comentarios_detalles -->
	
	<tr><td style="font-weight:normal"><small style="font-size:9px">{fecha}</small></td><td style="font-weight:normal">{usuario}</td><td style="font-weight:normal">{respuesta}</td></tr>
	
	<!-- END BLOCK : bloque_ejemplos_comentarios_detalles -->
	
	<!-- START BLOCK : bloque_ejemplos_comentarios_no_detalles -->
	
	<tr><td colspan="3">No hay comentarios para este ejemplo</td></tr>
	
	<!-- END BLOCK : bloque_ejemplos_comentarios_no_detalles -->
	</table> 
<!-- END BLOCK : bloque_ejemplos_comentarios -->

 </td></tr>

 <!-- END BLOCK : bloque_ejemplos --> 
 <!-- START BLOCK : bloque_no_ejemplos -->
<tr><td class = 'letra_simple' style=" vertical-align: middle; padding-top:10px; font-weight:normal; text-align:center   "> No hay ejemplos para este estándar</td></tr> 
 <!-- END BLOCK : bloque_no_ejemplos --> 
  
</table>

<!-- END BLOCK : bloque_ejemplos_global -->



 
<br />
<div id='bloque_boton_nivel'>
<table style="width:98%; border:none;" >
<!--<tr>

<td    colspan="6" style="text-align:center"><input  type="button"   onclick="javascript:guardarNivelRespuesta('');"  value="Guardar Respuesta" style="height:60px"></td>
</tr> -->


<tr>

<td    colspan="2" style="text-align:center; border:none;"><input  type="button"   onclick="javascript:guardarNivelRespuesta('');"  value="Guardar Comentarios" style="height:60px; width:40%">&nbsp;
<!--<input  type="button"   onclick="javascript:guardarNivelRespuesta('continuar');"  value="Guardar Respuesta y Continuar" style="height:60px; width:40%">-->
</td>
</tr> 
</table>  
</div>

	<script>	
		<!-- START BLOCK : bloque_niveles_respuesta_sino -->
		var valor_aux = '{valor_respuesta}';
		for (var i=0;i < document.main.valor_nivel_{pregunta}.length;i++)
		{  
		   if (document.main.valor_nivel_{pregunta}[i].value == valor_aux) 
			 document.main.valor_nivel_{pregunta}[i].checked = true; 
		}	
		 <!-- END BLOCK : bloque_niveles_respuesta_sino --> 	 
	</script>

 
 
  <!-- END BLOCK : bloque_niveles -->
  <br><br>
  <!-- START BLOCK : bloque_pregunta -->
</div>


<!-- END BLOCK : bloque_pregunta -->


<!-- START BLOCK : bloque_pregunta_elemento -->
<script> 
showId('texto_explicacion_navegacion');
</script>

<div class="fieldset_title">Comentario sobre dominio</div>
<table style="width:98%"  id="tabla_noborder_admin">
<tbody>
 
</tbody>
<tr>
<td  colspan="6"   style="text-align:center; border:none"><textarea class="text_input" name="comentario">{comentario}</textarea></td>
</tr> 
<tr id='bloque_boton_componente'>
<td colspan="6"  style="text-align:center; border:none"><input  type="button" onclick="javascript:guardarComponenteRespuesta();" value="Guardar Comentario" style="height:60px"></td>
</tr>

</td></tr>
</table>

<!-- END BLOCK : bloque_pregunta_elemento -->


<!-- START BLOCK : bloque_pregunta_elemento_comentarios -->
<br /><br />
<div class="fieldset_title">Comentarios</div>
 
 
<table style="width:98%"  id="tabla_noborder_admin">
<tr><th>Fecha</th><th>Usuario</th><th>Comentario</th></tr>
	<!-- START BLOCK : bloque_pregunta_elemento_comentarios_detalles --> 
		<tr>
		<td><small style="font-size:9px">{fecha}</small></td>
		<td>{usuario}</td><td>{respuesta}</td>
		</tr> 
	<!-- END BLOCK : bloque_pregunta_elemento_comentarios_detalles -->
	</table> 
<!-- END BLOCK : bloque_pregunta_elemento_comentarios -->

 

<script>
document.main.id_area.value 		= {id_area}; 
document.main.id_componente.value 	= {id_componente};
document.main.id_elemento.value 	= {id_elemento};
var encuesta_enviada = {encuesta_enviada};
function verComponente(id_area)
{
	document.main.id_area.value = id_area;
	process('componentes',1);
}
function verElementos(id_componente)
{
	document.main.id_componente.value = id_componente;
	process('elementos',1);
}
function verElemento(id_elemento)
{	
	document.main.id_elemento.value = id_elemento;
	process('pregunta',1);
}

function guardarAreaSeleccionada(id_area)
{	 
	if(encuesta_enviada == 0)
		process('guardar_area',1);
}

function guardarNivelRespuesta(caso)
{
	document.main.valor_extra.value = caso;
	process('guardar_nivel',2);	
}

function guardarComponenteRespuesta()
{ 
	process('guardar_componente',2); 
}

if(encuesta_enviada == 1)
{  
	hiddenId('bloque_boton_componente'); 
	hiddenId('bloque_boton_nivel');
}

</script>
<input  type="hidden" name="valor_extra" value="" /> 

<!-- INCLUDE BLOCK : ../templates/encuesta/barra_superior.tpl -->