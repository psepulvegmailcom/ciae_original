<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Confirmaci&oacute;n de inscripci&oacute;n al seminario “¿Contribuye la Asistencia T&eacute;cnica Educativa a la profesi&oacute;n docente? Evidencia desde las escuelas”
</div>

<input type="hidden" name="form_tipo_inscripcion" value="{opcion_extra}">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:60% ">
<div id='inscripcion_ficha'> 

Estimadas y estimados: <br><br>
Confirmamos que hemos recibido su solicitud de inscripci&oacute;n para el Seminario. Dada la gran cantidad de inscritos, le solicitamos que re-confirme su participaci&oacute;n. <br> 
Les informamos tambi&eacute;n que el Seminario es gratuito y no cuenta con certificaci&oacute;n. <br> <br>


 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_simple_buscar.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 </div>
 
 
 
  
 <div id='inscripcion_programa'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/atedocente_programa.tpl -->
 </div>
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> 15 de diciembre de 2011 </li> 
 <li  class="lateral_inscripcion"style="font-size:13px; "  ><strong>Hora:</strong> 10:00 a 13:00 horas  </li>
  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar:</strong> Casa Amanda Labarca<br /> Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n <br /> Universidad de Chile<br />Calle Periodista Jos&eacute; Carrasco Tapia (Ex Belgrado) nº 75.<br />Metro Baquedano<br />
Santiago, Chile
  </li>  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Contacto: </strong>
978 10 56 
<br /><a href="mailto:ciae@uchile.cl">ciae@uchile.cl</a>
</li> 
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');">Inscripci&oacute;n  </a></li>
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_programa');">Programa  </a></li>
 
 
 
  
   
	 
     <!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />
 <p> 
 </p>
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
ocultarDiv();
mostrarDiv('inscripcion_ficha');

</script>