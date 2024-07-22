<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Seminario: "Relaci&oacute;n entre lenguaje oral y lectura en ni&ntilde;os con trastorno espec&Iacute;fico del lenguaje"

</div>

 
<table class="tabla_simple" border="0">
 <tr>
<td style="width:60% ">
 
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_201501_lenguaje.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 
 
 </div>
 
  <div id='inscripcion_convocatoria' style=" width:600px "> 

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/201501_lenguaje-programa.tpl -->
 </div>
 
<div id='inscripcion_programa' style=" width:600px ">  
</div>
 
  
   
</td>
<td>
 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_convocatoria');"><strong>Programa</strong>  </a></li>
<!-- <li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong>  </a></li> -->
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> Viernes 16 de enero de 2015 </li>
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Horario:</strong> Entre las 08:30 y 13:30 hrs.</li>        
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Organizan:</strong><br>Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n y Departamento de Fonoaudiolog&Iacute;a, Facultad de Medicina, Universidada de Chile.
 </li>     
        
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar presencial:</strong><br>Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n,  Jos&eacute; Carrasco Tapia N&deg; 75 (ex Belgrano), Metro Baquedano.<br>Santiago de Chile.
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