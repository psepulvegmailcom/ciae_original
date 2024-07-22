 <a name="formulario"></a>
 <div class="contenido_titulo_separador">CONVOCATORIA PARA POSICIÓN POSTDOCTORAL</div>

<table class="tabla_simple" border="0">
 <tr>
<td style="width:65%; padding:0 20px 0 20px; ">

     
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpl -->
 
<div id='inscripcion_ficha'>  
    <!-- START BLOCK : bloque_formulario --> 
	   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_20231115_postdoctorado.tpl -->
    <!-- END BLOCK : bloque_formulario --> 
</div>
  

 
<div id='inscripcion_programa'  > 
  <!-- INCLUDE BLOCK : www/templates/web/inscripcion/20231115_postdoctorado-programa.tpl --> 

</div>
 

   
</td>
<td>
 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Postulaci&oacute;n </strong> </a></li>
 
 
 <li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Detalle</strong>  </a></li>  
 <li  class="lateral_inscripcion" style="font-size:13px; "  id="informacion_fecha" ><strong>Fecha Cierre Postulación:</strong><br />
  30 de noviembre de 2023 </li>
 
<br>
  </p>    
   <li  class="lateral_inscripcion" style="font-size:13px; "  id="informacion_consulta"><strong>Consultas o dudas:</strong>  <a href="mailto:postulacion.postdoc@ciae.uchile.cl?subject=Consulta+Convocatoria+para+posici%c3%b3n+postdoctoral+2023" target="_blank">postulacion.postdoc@ciae.uchile.cl</a> </li> 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl -->  

 <p style="text-align:center"> 
 
  <br> <br>
 <a href="https://www.ciae.uchile.cl/" target="_blank" style="border:0 ">
  <img src="www/imag/logos/ciae.jpg"   title="CIAE - Universidad de Chile"  style="padding:0px 10px 0px 10px " border="0" width="250px"> </a>
  <br> <br>
  <br> <br>
   
    
  <br>
  <br>
  
  
 </p>
   

</td>
 </tr> 
 
 <tr>
 <td colspan="2">  <div style="text-align:left ">
 
  
 </div></td>
 </tr>
</table>
<script type="text/javascript">
 

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/general_menu_textos.tpl -->

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/mostrar_ficha.tpls -->

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/cerradas_cupo_online.tpl --> 
 
function ocultarDiv()
{
	hiddenId('inscripcion_ficha'); 
	hiddenId('inscripcion_programa');  
}
ocultarDiv();

mostrarDiv('inscripcion_ficha');
</script>
