<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Seminario
"Los Educadores Tradicionales y la ense&ntilde;anza de mapudungun en el sistema escolar chileno"


</div>

 
<table class="tabla_simple" border="0">
 <tr>
<td style="width:60% ">
 
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_201411_educadores_tradicionales.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 
 
 </div>
 
  <div id='inscripcion_convocatoria' style=" width:600px ">  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/201411_educadores_tradicionales-programa.tpl -->
 </div>
 
<div id='inscripcion_programa' style=" width:600px ">  
</div>
 
  
   
</td>
<td>
 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_convocatoria');"><strong>Programa</strong>  </a></li> 
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong><br /> 28 de noviembre de 2014  09:00 - 11:30 hrs.  </li>      
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar presencial:</strong>  CIAE, Universidad de Chile.<br>
Calle Periodista Jos&eacute; Carrasco Tapia 75, Santiago,  Chile
 </li>   
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Organiza:</strong>  Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n (CIAE)  
 </li>     
       
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Costo:</strong> sin costo </li>     

  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Cupos:</strong> limitados, previa inscripci&oacute;n </li>     

   <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Consultas o dudas:</strong><big> <a href="mailto:seminarios@ciae.uchile.cl">seminarios@ciae.uchile.cl</a> </big></li> 
  

   
    

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
<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('inscripcion_ficha');   
	hiddenId('inscripcion_convocatoria'); 
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
ocultarDiv();
mostrarDiv('inscripcion_ficha');
 

function enviarFormulario()
{    
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/celular.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/region.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucion.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/cargo.tpl --> 
	enviarFormularioBase();
}  

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/mostrar_ficha.tpl -->
</script>

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->