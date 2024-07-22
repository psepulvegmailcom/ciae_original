<style>
.tabla_formulario td { padding:5px 5px 15px 5px; vertical-align:top;}
</style>
 <input type="hidden" name="form_tipo_inscripcion" value="2016silechile_propuestas">
 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_lenguaje"> 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_neurociencia"> 
 
<table width="90%" border="0" cellpadding="3" class="tabla_formulario">
  
   
   <!--inicio-->
    <tr>
    <td> <strong id="campo_email">Email  (*) </strong> </td>
    <td> 
        <input name="form_email" style="width:100%" maxlength="255" value="{email}" onchange="javascript:consultarPorEmail();" type="text">    </td>
  </tr>  
  <tr> <td> </td> <td>
<small>Para su inscripci&oacute;n debe utilizar su email personal, no de la instituci&oacute;n. La inscripci&oacute;n se identifica por  email, por esta raz&oacute;n no utilice un mismo email para distintas inscripciones, pues solo quedar&aacute; v&aacute;lido el &uacute;ltimo registro ingresado / For registration must use your personal email, not institutional. Registration is identified by email, for this reason do not use the same email for different inscriptions will be valid for only the last record entered</small>  <input name="email_consultado" value="" type="hidden">  </td> </tr>  

<tr><td> <strong id="campo_nombre">Nombre / Name (*) </strong> </td>
    <td>
        <input name="form_nombre" id="form_nombre" style="width:100%" value="{nombre}" maxlength="255" type="text"> </td>
  </tr>
  <tr>
    <td> <strong id="campo_apellido">Apellidos / Lastname (*) </strong> </td>
    <td>
        <input name="form_apellidos" id="form_apellidos" value="{apellidos}" style="width:100%" maxlength="255" type="text"> </td>
  </tr>    
  
  <tr>
    <td> <strong>Profesi&oacute;n / Profession  (*)  </strong> </td>
    <td> 
	<input name="form_profesion" style="width:100% " value="{profesion}" maxlength="255" type="text">  
     
	</td>
  </tr>  <tr>
    <td> <strong id="campo_institucion">Instituci&oacute;n / Institution (*)  </strong> </td>
    <td> 
	<input name="form_institucion" style="width:100% " value="{institucion}" maxlength="255" type="text"> 
	</td>
  </tr>   
   
     <tr>
    <td><strong>Pa&iacute;s / Country  (*)  </strong></td>
    <td> 
	<select name="form_pais">
	<option value="" selected></option>
	<!-- START BLOCK : bloque_pais -->
	<option value="{pais_id}">{pais}</option>
	<!-- END BLOCK : bloque_pais --> 
	</select> 
	</td>
  </tr>
    <tr>
    <td><strong>Tipo de presentaci&oacute;n / Presentation type  (*)  </strong></td>
    <td> 
	<input type="radio" name="form_campo_extra1" value="poster"  > Posters / Posters<br>
	<input type="radio" name="form_campo_extra1" value="trabajo"  > Comunicaciones orales / Oral Communication
	</td>
  </tr>
   <script>
   checkedValue('form_campo_extra1','{campo_extra1}');
    
  </script>
    <tr>
    <td colspan="2"><strong>Propuesta / Proposal </strong></td></tr>
    <tr>
    <td colspan="2"> <input type="file" name="archivo_extra1" id="archivo_extra1"> </td>
  </tr> 
    <!--fin-->  
  
       
   
   
  <tr>
  <td colspan="2" style="text-align:center"><br><br>
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
   

   
</table>

  <input type="hidden"  name="tipo_formulario_confirmacion" value='sile2016_envio'> 
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  

    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/tipo_inscripcion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucion.tpl -->   
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/profesion.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/pais.tpl -->
	if(!emptyCheck('form_campo_extra1'))
	{
		showAlert('Debe indicar tipo de trabajo');
		return false;
	}
    
  	 if(!validacionCampoTextoSimple('archivo_extra1'))
	 	return false;	
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->