<a name="formulario"></a>
 <div class="contenido_titulo_separador">	ACTIVAR LA RESOLUCI&oacute;N DE PROBLEMAS Y LA INDAGACI&oacute;N EN LAS AULAS
UN DESAF&iacute;O PARA LA ESCUELA DEL SIGLO XXI


(2da versi&oacute;n)</div>

 
<table class="tabla_simple" border="0">
 <tr>
<td style="width:60% ">
 
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpl -->
 <!--  : www/templates/web/inscripcion/formularios/formulario_2019_indagacion_en_aulas.tpl -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpls -->
 
 
 </div>
 
  <div id='inscripcion_convocatoria' style=" width:600px "> 

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/2019_indagacion_en_aulas-programa.tpl -->
 </div>
 
<div id='inscripcion_programa' style=" width:600px ">  
</div>
 
  
   
</td>
<td>
 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_convocatoria');"><strong>Programa</strong>  </a></li>
<!-- <li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong>  </a></li> -->
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> Mi&eacute;rcoles 2 de octubre de 2019 </li>
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Horario de inicio:</strong>  14:00 hrs.</li>     
        
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar:</strong><br>
    Z&oacute;calo, CIAE Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n,  Periodista Jos&eacute; Carrasco Tapia N&deg; 75, Metro Baquedano.<br>Santiago de Chile.
 </li>     
        
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Costo:</strong>  Gratuito, previa inscripci&oacute;n </li>   
  
  

   
    

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