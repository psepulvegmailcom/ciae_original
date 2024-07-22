<a name="formulario"></a>
 <div class="contenido_titulo_separador">	International competition for post-doctorate position: Neuroscience and Cognition
</div>

 
<table class="tabla_simple" border="0">
 <tr>
<td style="width:70%; padding-right: 20px ">
  
 <!-- INCLUDE BLOCK : www/templates/web/postulacion/mensaje_postulacion.tpl -->
 <!-- START BLOCK : bloque_formulario_cierre --> 
 <!-- INCLUDE BLOCK : www/templates/web/postulacion/cierre_proceso.tpl -->
 <!-- END BLOCK : bloque_formulario_cierre --> 
  
    	<input type="hidden" name="form_postulacion" value="201711_postdoc_cognicion">
<div id='inscripcion_ficha'>  
    

    <!-- START BLOCK : bloque_formulario -->     
    	<!-- INCLUDE BLOCK : www/templates/web/postulacion/postulacion_base_formulario.tpl --> 
    <!-- END BLOCK : bloque_formulario --> 
    <!-- START BLOCK : bloque_formulario_carta -->     
    	<!-- INCLUDE BLOCK : www/templates/web/postulacion/postulacion_base_formulario_carta.tpl -->     
    <!-- END BLOCK : bloque_formulario_carta --> 
 
</div>
 
  <div id='inscripcion_convocatoria' > 
  <!-- INCLUDE BLOCK : www/templates/web/postulacion/201711_postdoc_cognicion_descripcion.tpl -->
 </div>
 
<div id='inscripcion_programa'  >  
</div>

   
</td>
<td>
 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>  Application Form  </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_convocatoria');"><strong> Post Doctoral Position  </strong>  </a></li>
<!-- <li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong>  </a></li> -->
 <li  class="lateral_inscripcion" style="font-size:13px; "  id="informacion_fecha" ><strong>  Application Deadline </strong><br /> 
December 31, 2017  </li>     
  
   
   <li  class="lateral_inscripcion" style="font-size:13px; "  id="informacion_consulta">   For more information   <br><a href="mailto:postulacion@ciae.uchile.cl?subject=Post-doctorate position: Neuroscience and Cognition 2017">postulacion@ciae.uchile.cl</a> </li> 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl -->  

 <p> 
 </p>
   

</td>
 </tr> 
 
 <tr>
 <td colspan="2">  <div style="text-align:center ">
   
 </div>
  </td>
 </td>
 </tr>
</table>
<script type="text/javascript">
 

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/general_menu_textos.tpl --> 

mostrarDiv('inscripcion_convocatoria');
hiddenId('inscripcion_ficha'); 
/*hiddenId('inscripcion_convocatoria');*/
/*mostrarDiv('inscripcion_ficha'); */
</script>
 <!-- START BLOCK : bloque_formulario_cierre_exito -->
 <script>
hiddenId('inscripcion_ficha');   
</script>
<!-- END BLOCK : bloque_formulario_cierre_exito -->
 
<!-- START BLOCK : bloque_formulario_formulario_cartas -->
  <script>
	mostrarDiv('inscripcion_ficha');
	hiddenId('inscripcion_convocatoria'); 
</script>
<!-- END BLOCK : bloque_formulario_formulario_cartas --> 