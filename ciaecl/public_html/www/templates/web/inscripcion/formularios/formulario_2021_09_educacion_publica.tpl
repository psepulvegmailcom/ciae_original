 <div class="contenido_titulo_separador">
     La educaci&oacute;n p&uacute;blica en la nueva Constituci&oacute;n
</div>
<table width="90%" border="0" cellpadding="3" class="tabla_simple">
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_sin_texto.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta_sin_comentario.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->   
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/comuna.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/region.tpl -->
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl -->    
  <tr>
  <td colspan="2" style="text-align:center">
   <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
  </table>

<script type="text/javascript">
 
 function enviarFormulario()
 {  
     
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl --> 
          
            
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/comuna.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/celular.tpl -->
     enviarFormularioBase();
 }
</script>