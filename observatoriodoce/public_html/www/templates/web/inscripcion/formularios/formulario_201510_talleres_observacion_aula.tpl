<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
  </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->   
   
   <tr>
    <td><strong>Taller a participar</strong> <!--(debe seleccionar SOLO un taller, son excluyentes por horario)--></td>
    <td> 
    
    
     <select name="form_tipo_inscripcion" >
     <option value=""></option> 
    
      <option value="201510_talleres_mejoramiento_escolar_observacion_apoyo_pedagogico"> El Apoyo Pedag&oacute;gico a los estudiantes   </option> 
     </select>  
     
     <!-- <option value="201510_talleres_mejoramiento_escolar_observacion_aula_gestion_aula">Gesti&oacute;n del Aula de Matem&aacute;tica </option> -->
     
     <br><br>
     
<strong>      La inscripci&oacute;n para el taller "Gesti&oacute;n del Aula de Matem&aacute;tica" se encuentra cerrada por cupos.</strong>
     
    </td>
  </tr> 
     
   
   
  <input type="hidden"  name="tipo_formulario_confirmacion" value='simple'> 
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
<td colspan="2"><br /> 
    </td>
</tr>

   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl --> 
 	 	
	if(!checkSelectedMultiple('form_tipo_inscripcion'))
	{
		showAlert('Debe seleccionar el taller que le interesa participar');
		document.main.form_tipo_inscripcion.focus();
		return false;
	}
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->