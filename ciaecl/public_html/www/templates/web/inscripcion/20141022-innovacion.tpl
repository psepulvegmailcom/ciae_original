<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Lanzamiento Primer Diagn&oacute;stico Nacional de Cultura de Innovaci&oacute;n para Establecimientos Educacionales
</div>

 
<table class="tabla_simple" border="0">
 

<td style="width:60% ">
  
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_20141022-innovacion.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 
 
 </div>
  
 
<div id='inscripcion_programa' style=" width:600px ">  
</div>
 
  
</td>
<td>

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

 
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> Mi&eacute;rcoles 22 de Octubre de 2014 </li>  
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Horario:</strong> 09:00 a 11:00 (Registro 08:30 - 09:00)</li>   
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Dirigido a:</strong> sostenedores, directores, profesores de establecimientos municipales, particulares subvencionados y privados.</li>   
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar presencial:</strong> Hotel Crowne Plaza, Santiago de Chile, Sal&oacute;n Patagonia.
  
 </li>    
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Costo:</strong> sin costo.
 </li>   
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Cupos:</strong> limitados.
 </li>   
     

   <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Consultas o dudas:</strong><big> <a href="mailto:seminarios@ciae.uchile.cl">seminarios@ciae.uchile.cl</a> </big></li> 
   
   <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Informaci&oacute;n proyecto:</strong>  <a href="http://www.podemosinnovar.cl/" target="_blank">http://www.podemosinnovar.cl/</a>  </li> 
   
  
  
  
   
    

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl -->  

 <p> 
 </p>
  
</td>
 </tr> 
 <tr>
 <td colspan="2">  <div style="text-align:center ">
 
 
 </div></td>
 </tr>
</table>

<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">
<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('inscripcion_ficha');    
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
ocultarDiv();
mostrarDiv('inscripcion_ficha');

 

</script>
<script type="text/javascript">  

function enviarFormulario()
{    
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/celular.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/region.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl -->     
	enviarFormularioBase();
}  
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->