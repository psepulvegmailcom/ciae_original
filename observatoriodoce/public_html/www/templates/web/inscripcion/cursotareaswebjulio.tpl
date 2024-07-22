<a name="formulario"></a>
 <div class="contenido_titulo_separador">	CURSO:
TAREAS WEB 2.0 PARA
LA ENSE&ntilde;ANZA BASADA EN MET&aacute;FORAS
</div>

<input type="hidden" name="form_tipo_inscripcion" value="{opcion_extra}">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:65% ">
<div id='inscripcion_ficha'>

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario.tpls -->
  

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 </div>
 
 
 
  
 <div id='inscripcion_programa'>
   
 
 </div>
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 
 <li  class="lateral_inscripcion" ><strong>Fecha:</strong> 21 y 22 de Julio 2011 </li>
 <li  class="lateral_inscripcion" ><strong>Horario:</strong> 09:00 - 18:00 </li>
 
 <li  class="lateral_inscripcion" ><strong> C&oacute;digo Sence:</strong> 12-37-8059-51 </li>
 
 <li class="lateral_inscripcion" ><strong>Matricula:</strong> $97.000 pp  </li> 
 <li class="lateral_inscripcion" ><strong>Horas Sence:</strong> 16  </li> 
 <li class="lateral_inscripcion" ><strong>P&Uacute;blico Objetivo:</strong> Profesores de Educaci&oacute;n General B&aacute;sica; Profesores de Matem&aacute;ticas </li> 
 <li class="lateral_inscripcion" ><strong>Sede:</strong> Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n<br />
Laboratorio Casa Amanda Labarca<br />
Periodista Jos&eacute; Carrasco Tapia 75<br />
Santiago Chile
  </li>  
 <li class="lateral_inscripcion" ><strong>Contacto: </strong>
Mar&Iacute;a Ang&eacute;lica Palavicino<br />
Coordinadora de Capacitaci&oacute;n<br /> 
<a href="mailto:mpalavic@uchile.cl">mpalavic@uchile.cl</a>
<br />
56-2-9782590<br />
09-2226178
</li>
 
 
 
  
<!-- <li><big><a href="javascript:mostrarDiv('inscripcion_programa');">Programa</a></big></li>  -->
		  
	 
     <!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <div><br />
 <strong>Organiza :</strong><br />
  <a href="http://www.metaforas.cl/" target="_blank"><img src="http://cdn.metaforas.cl/images/logo-metaforas.png"  border="0" ></a>
 </div>
</td>
 </tr> 
</table>
<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('inscripcion_ficha'); 
	/*hiddenId('inscripcion_programa');	 */
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
mostrarDiv('inscripcion_ficha');

</script>