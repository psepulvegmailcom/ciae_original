<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Inscripci&oacute;n Charla informativa proyecto “Promoviendo una cultura innovadora en profesores y alumnos de establecimientos educacionales chilenos" 
</div>

 
<table class="tabla_simple" border="0">
 <input type="hidden"  name="form_tipo_inscripcion" value="20140924_proyecto_innovacion">
<tr>
<td style="width:60% ">
 
 <div id='inscripcion_programa'>  
  <p>&iquest;C&oacute;mo se puede desarrollar la creatividad e innovaci&oacute;n en las escuelas? &iquest;Qu&eacute; obst&aacute;culos enfrentan &eacute;stas para desarrollarlas? Estos ser&aacute;n algunos de los temas que ser&aacute;n abordados por la charla sobre <strong><em></em></strong>el proyecto CORFO - Innova “ <strong><em>Promoviendo una cultura innovadora en profesores y alumnos de establecimientos educacionales chilenos&quot;. </em></strong> </p>
  <p>Se invita a todos los directores, profesores de establecimientos educacionales municipalizados y particulares subvencionados de la Regi&oacute;n Metropolitana a participar de esa actividad, que ser&aacute; <strong>gratuita </strong> y con <strong>cupos limitados </strong>. </p>
  
  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_20140910_proyecto_innovacion.tpla -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
  </div>
  
 
  
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl -->  
 
   
 
 
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha :</strong><br>
      Mi&eacute;rcoles  24 de septiembre de 2014, 17:00 horas.</li>   
     <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar:</strong> Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n<br /> 
   Universidad de Chile<br /> 
   Periodista Jos&eacute; Carrasco Tapia 75<br />
Santiago, Chile  </li> 
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Organiza: </strong><br>    
    Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n (CIAE), Universidad de Chile  </li>     
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Costo: </strong><br>  sin costo  </li>      
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Consultas o dudas: </strong><br><a href="mailto:map@ciae.uchile.cl" >map@ciae.uchile.cl</a> </li>   
    
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />

 <p> 
 </p>
</td>
 </tr> 
 
</table>

<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

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
<div id='test'></div>
<script type="text/javascript">  

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
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->