<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Taller de Investigaci&oacute;n Cualitativa y Pol&Iacute;tica Educativa
</div>

<input type="hidden" name="form_tipo_inscripcion" value="{opcion_extra}">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:65% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_simple.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
</div>
 
 
 
  
 <div id='inscripcion_programa'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/tallerinvestigacion_programa.tpl -->
 </div>
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 
 <li  class="lateral_inscripcion" ><strong>Fecha:</strong> 18 y 19 de Agosto de 2011 </li> 
 <li  class="lateral_inscripcion" ><strong>Hora:</strong> 09:15 - 17:00 </li>
  
 <li class="lateral_inscripcion" ><strong>Lugar:</strong> Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n<br />
Laboratorio Casa Amanda Labarca<br />
Periodista Jos&eacute; Carrasco Tapia 75<br />
Santiago Chile
  </li>  
 <li class="lateral_inscripcion" ><strong>Contacto: </strong>
9782762
<br /><a href="mailto:ciae@uchile.cl">ciae@uchile.cl</a>
</li> 
<li class="lateral_inscripcion" ><a href="javascript:mostrarDiv('inscripcion_programa');">Programa  </a></li>
 
 
 
  
   
	 
     <!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 
</td>
 </tr> 
</table>
<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('inscripcion_ficha');  
	hiddenId('inscripcion_programa');	 
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
mostrarDiv('inscripcion_ficha');

</script>