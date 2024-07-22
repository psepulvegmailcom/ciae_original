<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Conferencia Internacional: El Futuro del Trabajo y la Educaci&oacute;n
</div>

 
<table class="tabla_simple" border="0">
 
<td style="width:60%; vertical-align:top "> 
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_20141020-trabajo_educacion.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 
 
 </div>
 
  <div id='inscripcion_convocatoria' style=" width:600px "> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/20141020-trabajo_educacion-programa.tpl -->
 </div>
 
<div id='inscripcion_programa' style=" width:600px ">  
</div>
 
  
</td>
<td>

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_convocatoria');"><strong>Programa</strong>  </a></li>
<!-- <li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong>  </a></li> -->
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> Lunes 20 de Octubre de 2014 </li>  
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Horario:</strong> 16:30 a 20:00 </li>   
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Dirigido a:</strong> directores &aacute;rea educaci&oacute;n de municipalidades, autoridades educacionales, rectores y docentes de establecimientos educacionales, formadores de docentes e investigadores en educaci&oacute;n.</li>   
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar presencial:</strong> Centro Cultural Lo Prado, Paseo de las Artes N&deg;880, comuna Lo Prado. Ubicado al lado del  Metro Estaci&oacute;n Lo Prado (l&Iacute;nea 5).
 </li>   
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Organiza:</strong> Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n (CIAE) de la Universidad de Chile. <br /> Municipalidad de Lo Prado
 </li>
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Costo:</strong> sin costo.
 </li>   
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Cupos:</strong> limitados.
 </li>   
     

   <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Consultas o dudas:</strong><big> <a href="mailto:practicasdocentes@ciae.cl">practicasdocentes@ciae.cl</a> </big></li> 
  
  
  
   
    

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl -->  

 <p> 
 </p>
 <p>
 <img src="http://www.ciae.uchile.cl/imageview.php?image=noticias/lo_prado.jpg" />
 </p>
</td>
 </tr> 
 <tr>
 <td colspan="2">  <div style="text-align:center ">
 
 
 </div></td>
 </tr>
</table>
<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('inscripcion_ficha');   
	hiddenId('inscripcion_programa');
	hiddenId('inscripcion_convocatoria');
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
ocultarDiv();
mostrarDiv('inscripcion_ficha');


<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/mostrar_ficha.tpl -->

</script>