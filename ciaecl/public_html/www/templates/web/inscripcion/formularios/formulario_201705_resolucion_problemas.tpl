<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
   

 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_taller_arpa_matematica">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_resolucion_problemas_matematicas">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_matematicas_fisica_quimica">  
   
</td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
   
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl --> 
  <tr><td colspan="2">&nbsp;<br /></td></tr> 
  	 <tr><td><strong>Indique su inter&eacute;s a ponencia a asistir</strong></td><td>
	 <input type="radio"  name="form_campo_extra1" value="presencial_solo_jueves" > Asistir&eacute; solo a las presentaciones del d&iacute;a jueves 25 de mayo<br>
	 <input type="radio"  name="form_campo_extra1" value="presencial_solo_viernes" > Asistir&eacute; solo a las presentaciones del d&iacute;a viernes 26 de mayo<br>
	 <input type="radio"  name="form_campo_extra1" value="presencial_solo_viernes_mesa_redonda" > Asistir&eacute; solo a la mesa redonda del d&iacute;a viernes 26 de mayo<br>
	 <input type="radio"  name="form_campo_extra1" value="presencial_jueves_viernes_completo" > Asistir&eacute; a las presentaciones de ambos d&iacute;as, jueves 25 y viernes 26 de mayo, incluida mesa redonda.<br>
	 </td></tr>
	 
	 <tr>
    <td><strong>Forma&nbsp;de&nbsp;participaci&oacute;n&nbsp;(*)</strong></td>
    <td>
	 
		<strong>Cupos disponibles solo para participar de manera online</strong> <br><br>
	<input type="radio" name="form_tipo_inscripcion"      value="201705_resolucion_problemas_online" >  
	Participar de manera online, v&iacute;a streaming</strong> 
	 
	</td>
  </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr> 
   
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
  
<tr>
<td colspan="2"><br /> 
    </td>
</tr>
<tr>
	<td colspan="2">
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie.tpl -->
    </td>
</tr>

   
</table>

  <input type="hidden"  name="tipo_formulario_confirmacion" value='online'> 
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl -->  
		
	var aux = false;
	var seleccion = '';
	for(i=0; ele = document.main.form_campo_extra1[i];i++)
	{
		if(ele.checked) 
		{
			seleccion = ele.value;
			aux = true;
		}
	}	       
	if(!aux)
	{
		alert('Debe seleccionar interes de asistencia '); 
		return false;
	}
        
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->