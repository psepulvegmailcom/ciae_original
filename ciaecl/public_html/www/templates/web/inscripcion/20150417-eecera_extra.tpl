<a name="formulario"></a>
 <div class="contenido_titulo_separador">	 
  
 Seminario:
"Formaci&oacute;n, Inclusi&oacute;n y Pr&aacute;ctica Pedag&oacute;gica en Educaci&oacute;n Inicial: Contribuciones de la Investigaci&oacute;n Aplicada a la Pol&iacute;tica P&uacute;blica"

</div>

 
<table class="tabla_simple" border="0">
 <tr>
<td style="width:60% ">
 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpl -->
<div id='inscripcion_ficha'> 

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_20150417-eecera.tpl -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpls -->
 
 
 </div>
 
  <div id='inscripcion_convocatoria' style=" width:600px "> 
  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/20150417-eecera-programa.tpl -->
 </div>
 
<div id='inscripcion_programa' style=" width:600px ">  
</div>
 
  
   
</td>
<td>
 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 
<center><strong style="font-size:15px;"> Descripci&oacute;n </strong> </center>
<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_convocatoria');"><strong>Programa</strong>  </a></li> 
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> Viernes 17 de abril de 2015 </li>
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Horario:</strong> 08:30 a 13:30 hrs</li>        
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Organiza:</strong><br>Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n, Universidad de Chile.
 </li>     
        
  <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar presencial:</strong><br>Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n, calle Jos&eacute; Carrasco Tapia N&deg; 75, Metro Baquedano.<br>Santiago de Chile.
 </li>     
  
<li  class="lateral_inscripcion" style="font-size:13px; " > <strong>Costo:</strong> Gratuito, previa inscripci&oacute;n</li>
<li  class="lateral_inscripcion" style="font-size:13px; " >
<strong>Contacto:</strong> <a href='mailto:eecera2015@ciae.uchile.cl'> eecera2015@ciae.uchile.cl </a> <br /> </li>
  
  

   
    

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
mostrarDiv('inscripcion_convocatoria');


<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/mostrar_ficha.tpl -->

</script>