<!-- INCLUDE BLOCK : www/templates/evaluaciones/base_header.tpl -->
 

<p>Evalué la retroalimentación que le hicieron a su trabajo según las preguntas a continuación.</p>
<table class="tabla_noborder_admin"    > 


<!-- START BLOCK : bloque_lista_envio_revision -->

<tr><td colspan="2" style="padding:0 10px 50px 10px;">
    <table class="tabla_noborder_admin"      >
    	<tr><th>Retroalimentaci&oacute;n Recibida</th></tr>

	  <!-- START BLOCK : bloque_lista_envio_revision_pregunta --> 
      
      <tr><td>
      <strong><u>Pregunta {fila}</u></strong>
      </td></tr>
      
      <tr><td style="padding-left:20px">
      <strong>Nota:</strong> {nota}
      </td></tr>
      
      <tr><td style="padding-left:20px">
      <strong>Retroalimentací&oacute;n:</strong> {texto}<br><br>
      </td></tr>
      <!-- END BLOCK : bloque_lista_envio_revision_pregunta --> 
</table>
</td></tr>
<!-- END BLOCK : bloque_lista_envio_revision -->
 
 <!-- START BLOCK : bloque_lista_envio -->
 


 
<tr><td colspan="2" style="padding:0 10px 50px 10px;">

<!-- INCLUDE BLOCK : www/templates/evaluaciones/revision/formulario_revision_simple_etapa3.tpl -->
</td></tr> 
 <!-- START BLOCK : bloque_lista_envio -->
 <tr><td colspan="2"  style="text-align:center ">
<button type="button" onClick="javascript:guardarFormulario();"><span>Guardar</span></button> 
<button onclick="javascript:cancelarFormulario();" type="button" title="Cancelar"><span>Cancelar</span></button> 
</td></tr>
 </table>
 
 
<!-- INCLUDE BLOCK : www/templates/evaluaciones/revision/formulario_revision_chequeo.tpl -->
  <!-- INCLUDE BLOCK : www/templates/evaluaciones/base_footer.tpl -->
<script>
document.main.guardar_caso.value = 'guardar_revision';
</script>