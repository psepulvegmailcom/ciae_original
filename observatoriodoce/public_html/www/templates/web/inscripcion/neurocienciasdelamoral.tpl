<a name="formulario"></a>
 <div class="contenido_titulo_separador">	 Seminario “Neurociencias de la Moral” 
</div>

<input type="hidden" name="form_tipo_inscripcion" value="{opcion_extra}">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:60% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_mensaje_preinscripcion.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_simple.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
</div>
 
 
 
  
 <div id='inscripcion_programa'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/neurocienciasdelamoral_programa.tpl -->
 </div>
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> 09 de Noviembre de 2011 </li> 
 <li  class="lateral_inscripcion"style="font-size:13px; "  ><strong>Hora:</strong> 14:30 a 19:00 horas  </li>
  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar:</strong> Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n,<br /> Universidad de Chile. Casa Amanda Labarca.<br />
Periodista Jos&eacute; Carrasco 75,<br /> Santiago.
 
  </li>  
  <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Inscripci&oacute;n:</strong> $10.000</li>
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Contacto: </strong>
978 2762
<br /><a href="mailto:confirmaciones@uchile.cl">webmaster@ciae.uchile.cl</a>
</li> 
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');">Inscripci&oacute;n  </a></li>
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_programa');">Programa  </a></li>
 
 
 
  
   
	 
     <!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />
 <p>
 <a href="http://www.uchile.cl"><img src="http://www.ciae.uchile.cl/mail_list/email/imagenes/invitacion36.jpg" alt="Logo Universidad de Chile" width="250px" border="0"></a>
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