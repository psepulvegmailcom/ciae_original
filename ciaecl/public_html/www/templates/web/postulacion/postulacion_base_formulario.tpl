

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
    <td><strong id='campo_institucion'>Instituci&oacute;n donde se obtuvo PhD / Institution you got your PhD (*)  </strong></td>
    <td> 
	<input type="text" id="form_institucion"  name="form_institucion" style="width:100% " value="{institucion}" maxlength="255"> 
	</td>
  </tr>
    <tr>
    <td><strong id='campo_agno'>A&ntilde;o cuando obtuvo PhD / Year you got your PhD (*)  </strong></td>
    <td> 
	<input type="text" id="form_agno" name="form_agno" style="width:30% " value="{agno}" maxlength="4"> 
	</td>
  </tr>
  <tr>
    <td><strong id='campo_institucion2'>&Aacute;rea de investigaci&oacute;n / Research Field (*) </strong></td>
    <td> 
	<input type="text" name="form_campo_investigacion" id="form_campo_investigacion" style="width:100% " value="{campo_investigacion}" maxlength="255"> 
	</td>
  </tr>
   
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  <tr>
    <td><strong>Informaci&oacute;n adicional / Additional information</strong></td>
    <td><textarea  style="width:100%; height:80px" name="form_informacion_adicional" id="form_informacion_adicional">{informacion_adicional}</textarea></td>
  </tr>
  
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  <tr>
    <td colspan="2"><strong>Declaraci&oacute;n de motivaci&oacute;n  / Motivation statement (*) (PDF)  (Max 1,5 Mb) </strong></td></tr>
    <tr>
    <td colspan="2"> <input type="file" name="archivo_motivacion" id="archivo_motivacion"><br>
    <small>m&aacute;ximo 2 p&aacute;ginas / maximum 2 pages</small></td>
  </tr>  
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  <tr>
    <td colspan="2"><strong>Propuesta de investigaci&oacute;n  / Research Proposal (*) (PDF)  (Max 1,5 Mb) </strong></td></tr>
    <tr>
    <td colspan="2"> <input type="file" name="archivo_propuesta" id="archivo_propuesta"><br>
    <small>m&aacute;ximo 3000 palabras, que incluye bibliograf&iacute;a / maximum 3000 words, this include bibliography</small></td>
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
 <tr>
<td colspan="2"><br />
  Despu&eacute;s de enviar los datos solicitados, el sistema enviar&aacute; el link donde deber&aacute; ingresar las cartas de recomendaci&oacute;n solicitadas. Recuerde enviar este link a las personas que enviar&aacute;n sus cartas de recomendaci&oacute;n,  de no ingresar  2 cartas de recomendaci&oacute;n su postulaci&oacute;n se declarar&aacute; como no v&aacute;lida. <br />
  <br /> 
  After sending the requested data, the system will send the link where you must upload the reference letters requested. Remember to send the link for the  reference letters. Applications which do not get al least two  recent reference letters by the postulation deadline will be declared abandoned.
  </td>
 </tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
</table>
<script>
	changeTextId('campo_email','Email personal / Personal Email (*)');
	changeTextId('campo_apellido','Apellidos / Surname (*)');
	changeTextId('campo_nombre','Nombre / Name (*)');
	changeTextId('campo_institucion','Instituci&oacute;n / Institution (*)');
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
	 
  	 if(!validacionCampoTextoSimple('archivo_motivacion'))
	 	return false;
  	 if(!validacionCampoTextoSimple('archivo_cv'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('archivo_propuesta'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('archivo_titulo'))
	 	return false;	
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