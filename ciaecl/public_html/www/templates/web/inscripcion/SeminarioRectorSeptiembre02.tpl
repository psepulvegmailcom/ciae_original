<a name="formulario"></a>
 <div class="contenido_titulo_separador">	 Seminario “Fortalecer la educaci&oacute;n p&uacute;blica: &iquest;de qu&eacute; estamos hablando?” 
</div>

<input type="hidden" name="form_tipo_inscripcion" value="{opcion_extra}">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:60% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_simple.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
</div>
 
 
 
  
 <div id='inscripcion_programa'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/SeminarioRectorSeptiembre02_programa.tpl -->
 </div>
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> 02 de septiembre de 2011 </li> 
 <li  class="lateral_inscripcion"style="font-size:13px; "  ><strong>Hora:</strong> 9:00 a 13:30 horas  </li>
  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar:</strong> Aula Magna<br /> Facultad de Econom&iacute;a y Negocios <br /> Universidad de Chile<br />Diagonal Paraguay 257<br />
Santiago, Chile
  </li>  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Contacto: </strong>
978 10 56 
<br /><a href="mailto:confirmaciones@uchile.cl">confirmaciones@uchile.cl</a>
</li> 
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');">Inscripci&oacute;n  </a></li>
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_programa');">Programa  </a></li>
 
 
 
  
   
	 
     <!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />
 <p>
 <a href="http://www.uchile.cl"><img src="https://www.ciae.uchile.cl/mail_list/email/imagenes/invitacion36.jpg" alt="Logo Universidad de Chile" width="250px" border="0"></a>
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