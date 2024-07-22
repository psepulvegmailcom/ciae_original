<a name="formulario"></a>
 <div class="contenido_titulo_separador">	 Seminario "Algunos principios para la ense&ntilde;anza de la matem&aacute;tica escolar: reflexiones sobre las fracciones"
</div>

 <input type="hidden" name="form_tipo_inscripcion" value="20121219-Aharoni">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:60% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_simple.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 
 
 </div>
 
  <div id='inscripcion_programa' style=" width:600px "> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/20121219-programa.tpl -->
 </div>
 
  
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong>  </a></li>
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> 19 de diciembre de 2012</li>  
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Horario:</strong> 16:00 - 19:00 </li>  
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Expositor:</strong> Ron Aharoni, Israel Institute of Technology.</li>  
  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar:</strong> Casa Amanda Labarca<br /> Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n <br /> Universidad de Chile<br />Calle Periodista Jos&eacute; Carrasco Tapia (Ex Belgrado) nº 75.<br />Metro Baquedano<br />
Santiago, Chile
  </li>  
  
 <li class="lateral_inscripcion" style="font-size:13px; " > El seminario contar&aacute; con traducci&oacute;n simult&aacute;nea. </li> 
<li class="lateral_inscripcion" style="font-size:13px; " >Se entregar&aacute; certificado de asistencia. </li> 
  
 
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Contacto: </strong> <a href="mailto:seminarios@ciae.uchile.cl" >seminarios@ciae.uchile.cl</a> 
</li> 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />

 <p> 
 </p>
</td>
 </tr> 
 <tr>
 <td colspan="2">  <div style="text-align:center ">
 <a href="http://www.ciae.uchile.cl" target="_blank" style="border:0 "><img src="www/imagenes/logo_oficial.jpg" width="300px" style="padding:0px 10px 0px 10px " border="0"> </a>
  <a href="http://www.academia-ciencias.cl/" target="_blank" style="border:0 "><img src="www/imag/logos/logo_academia.jpg" width="120px"  style="padding:0px 10px 0px 10px " border="0"> </a>
  <a href="http://www.cmm.uchile.cl" target="_blank" style="border:0 "><img src="www/imag/logos/logo_cmm.jpg" width="120px"  style="padding:0px 10px 0px 10px " border="0"> </a>
  <a href="http://www.mineduc.cl/" target="_blank" style="border:0 "><img src="www/imag/logos/logo_mineduc.jpg" width="120px"  style="padding:0px 10px 0px 10px " border="0"> </a>
 </div></td>
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
mostrarDiv('inscripcion_programa');

</script>