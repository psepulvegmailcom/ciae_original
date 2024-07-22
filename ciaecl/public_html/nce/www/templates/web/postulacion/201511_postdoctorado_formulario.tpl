

<table width="90%" border="0" cellpadding="3">

 <tr>
<td colspan="2"><br />
  
  </td>
 </tr>
 <tr><td></td><td style="width:70%"></td></tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  
 <tr>
    <td ><strong id='campo_email'>Email personal (*) </strong></td>
    <td > 
        <input type="text" name="form_email" id="form_email" style="width:100%" maxlength="255" value="{email}"  >    </td>
  </tr>
   
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
  <tr>
    <td><strong id='campo_institucion'>Instituci&Oacute;n donde se obtuvo PhD / Institution you got your PhD (*)  </strong></td>
    <td> 
	<input type="text" id="form_institucion"  name="form_institucion" style="width:100% " value="{institucion}" maxlength="255"> 
	</td>
  </tr>
    <tr>
    <td><strong id='campo_agno'>A&ntilde;o cuando obtuvo PhD / Year you got your PhD (*)  </strong></td>
    <td> 
	<input type="text" id="form_agno" name="form_agno" style="width:30% " value="{agno}" maxlength="50"> 
	</td>
  </tr>
  <tr>
    <td><strong id='campo_institucion'>&aacute;rea de investigaci&Oacute;n / Research Field (*)  </strong></td>
    <td> 
	<input type="text" name="form_campo_investigacion" id="form_campo_investigacion" style="width:100% " value="{campo_investigacion}" maxlength="255"> 
	</td>
  </tr>
   
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  <tr>
    <td><strong>Informaci&Oacute;n adicional / Additional information</strong></td>
    <td><textarea  style="width:100%; height:80px" name="form_informacion_adicional" id="form_informacion_adicional">{informacion_adicional}</textarea></td>
  </tr>
  
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  <tr>
    <td colspan="2"><strong>Declaraci&Oacute;n de motivaci&Oacute;n e investigaci&Oacute;n / Motivation and research statement (*) (PDF)  (Max 1,5 Mb) </strong></td></tr>
    <tr>
    <td colspan="2"> <input type="file" name="archivo_motivacion" id="archivo_motivacion"><br><small>m&aacute;ximo 4 p&aacute;ginas no incluir bibliograf&iacute;a / maximum 4 pages, not including bibliography </small></td>
  </tr>  
  
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  <tr>
    <td colspan="2"><strong>CV/Resum&eacute;  (*)  (PDF) (Max 1,5 Mb)</strong></td></tr>
    <tr>
    <td colspan="2"> <input type="file" name="archivo_cv" id="archivo_cv"> </td>
  </tr>  
  
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  <tr>
    <td colspan="2"><strong>T&iacute;tulo PhD / Certificate PhD  (*)  (PDF)  (Max 1,5 Mb)</strong></td></tr>
    <tr>
    <td colspan="2"> <input type="file" name="archivo_titulo" id="archivo_titulo"> </td>
  </tr>  
 <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
</table>
<script>
	changeTextId('campo_email','Email personal / Personal Email (*)');
	changeTextId('campo_apellido','Apellidos / Surname (*)');
	changeTextId('campo_nombre','Nombre / Name (*)');
	changeTextId('campo_institucion','Instituci&Oacute;n / Institution (*)');
</script>

<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="{page}">
<input type="hidden" name="guardar" value="guardar">
<script type="text/javascript">
 
 function enviarFormulario()
 {    
 	 if(!validacionCampoTextoSimple('form_email'))
	 	return false;	 
	if(!checkMail(document.main.form_email.value))
	{
		alert('Debe ingresar email con formato correcto');
		document.main.form_email.focus();
		return false;
	}	 
 	 if(!validacionCampoTextoSimple('form_nombre'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('form_apellidos'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('form_institucion'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('form_agno'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('form_campo_investigacion'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('form_informacion_adicional'))
	 	return false;	
 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->