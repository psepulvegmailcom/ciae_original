<table width="100%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%"><strong>Email personal (*) </strong></td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}"   onchange="javascript:consultarPorEmail();">    </td>
  </tr>
   <tr>
    <td  ><strong>Rut  (*) </strong></td>
    <td > 
        <input type="text" name="form_rut" style="width:50%" maxlength="255" value="{rut}"  >    </td>
  </tr>
  <tr>
    <td><strong>Nombre (*) </strong></td>
    <td>
        <input type="text" name="form_nombre" style="width:100%" value="{nombre}" maxlength="255"></td>
  </tr>
  <tr>
    <td><strong>Apellidos (*) </strong></td>
    <td>
        <input type="text" name="form_apellidos" value="{apellidos}" style="width:100%" maxlength="255"></td>
  </tr> 
 
      <tr>
  <td><strong>Comuna  de Residencia (*)</strong></td>
  <td>
  <select name="form_comuna" style="width:98%">
  <option value="">---</option>
  <!-- START BLOCK : bloque_comuna -->
  <option value="{comuna_id}">{comuna} - {region}</option>
  <!-- END BLOCK : bloque_comuna -->
  </select>
 
  </td> </tr>
   
  <tr>
    <td><strong>&aacute;rea de Especialidad Disponibles  (*) </strong></td>
    <td><strong>Si no pertenece a algunas de la especialidades disponibles (Educaci&oacute;n Media Matem&aacute;tica, Educaci&oacute;n Media F&iacute;sica &oacute; Educaci&oacute;n Media Qu&iacute;mica) POR FAVOR  NO se inscriba, pues los cupos en las otras especialidades ya se cerraron. Agradecemos su inter&eacute;s. </strong><br>
	<select name="form_cargo">
	 
  
	<option value="">--</option>
<!-- 	 <option value="Educaci&oacute;n Parvularia">Educaci&oacute;n Parvularia</option>   -->
 
<!-- <option value="Educaci&oacute;n B&aacute;sica">Educaci&oacute;n B&aacute;sica </option>  --> 
<!-- <option value="Educaci&oacute;n Media Lenguaje">Educaci&oacute;n Media Lenguaje </option> -->
<!-- <option value="Educaci&oacute;n Media Historia-Geograf&iacute;a y Ciencias Sociales">Educaci&oacute;n Media Historia-Geograf&iacute;a y Ciencias Sociales </option> -->

  <option value="Educaci&oacute;n Media Matem&aacute;tica">Educaci&oacute;n Media Matem&aacute;tica</option>  
  
<!-- <option value="Educaci&oacute;n Media Biolog&iacute;a">Educaci&oacute;n Media Biolog&iacute;a</option> -->  

<option value="Educaci&oacute;n Media F&iacute;sica">Educaci&oacute;n Media F&iacute;sica</option>

<option value="Educaci&oacute;n Media Qu&iacute;mica">Educaci&oacute;n Media Qu&iacute;mica</option> 

 

	</select>
	  
    </td>
  </tr>
 
    

  <tr>
    <td><strong>Tel&eacute;fono de Contacto (*) </strong></td>
    <td><input type="text" name="form_telefono"  value="{telefono}" style="width:100%" maxlength="50"></td>
  </tr>
  <tr>
    <td><strong>Tel&eacute;fono m&oacute;vil de Contacto </strong></td>
    <td><input type="text" name="form_telefono_movil"  value="{telefono_movil}" style="width:100%" maxlength="50"></td>
  </tr>
  
  <tr><td colspan="2"  >&nbsp;</td>  </tr>
     <tr>
  <td><strong>Disponibilidad  (*)</strong></td>
  <td>
  
	<input type="radio" name="form_campo_extra1" value="1-2"> Asistir&eacute;  Lunes 17 de diciembre 17:00 hrs y Martes 18 de diciembre 17:00 hrs<br> 
	<input type="radio" name="form_campo_extra1" value="1">
	Asistir&eacute; solo   Lunes 17 de diciembre 17:00 hrs<br> 
	<input type="radio" name="form_campo_extra1" value="2">
	Asistir&eacute;  solo Martes 18 de diciembre 17:00 hrs<br>
 
	 
 
  </td> </tr>
  
  <tr><td colspan="2"  >&nbsp;</td>  </tr>
     <tr>
  <td><strong>Seleccione local de rendici&oacute;n  (*)</strong></td>
  <td>
     <input type="radio" name="form_campo_extra2" value="Estaci&oacute;n Central"> Liceo Estaci&oacute;n Central, Calle Pur&iacute;sima 58, Estaci&oacute;n Central, Santiago. Estaci&oacute;n de Metro: Ecuador   <br> 
	<input type="radio" name="form_campo_extra2" value="La Florida "> Chilean Eagles College, Vicente Vald&eacute;s 80, La Florida, Santiago. Estaci&oacute;n de Metro:  Vicente Vald&eacute;s<br>
	<input type="radio" name="form_campo_extra2" value="Providencia"> Liceo 7 de Ni&ntilde;as, Monse&ntilde;or S&oacute;tero Sanz 60, Providencia, Santiago. Estaci&oacute;n de Metro:  Pedro de Valdivia<br>
	<input type="radio" name="form_campo_extra2" value="Concepcion"> Liceo Espa&ntilde;a, Avda. Roosevelt 1596, Concepci&oacute;n. <br>
	<input type="radio" name="form_campo_extra2" value="Temuco"> Liceo Pablo Neruda, Av. Balmaceda 659, Temuco. <br>
	<input type="radio" name="form_campo_extra2" value="Valpara&iacute;so"> Liceo de  Ni&ntilde;as M. Franck de Mac Dougall (EX. B-30), Avda. Argentina 731, Valpara&iacute;so. <br>
 
 
 
  </td> </tr>
  
  
  
 
  <tr>
    <td><strong>Comentario</strong></td>
    <td><textarea  style="width:100%; height:80px" name="form_comentario">{comentario}</textarea></td>
  </tr>
  
  <tr>
  <td colspan="2" style="text-align:center">
   <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
 
   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" />
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_inicia_rendicion_estudiante_revision.tpl -->  
  
 
</script>