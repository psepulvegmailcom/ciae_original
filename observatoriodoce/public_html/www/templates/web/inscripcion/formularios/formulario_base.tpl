<table width="90%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%">Email personal (*) </td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}"  >    </td>
  </tr>
   
  <tr>
    <td>Nombre (*) </td>
    <td>
        <input type="text" name="form_nombre" style="width:100%" value="{nombre}" maxlength="255"></td>
  </tr>
  <tr>
    <td>Apellidos (*) </td>
    <td>
        <input type="text" name="form_apellidos" value="{apellidos}" style="width:100%" maxlength="255"></td>
  </tr> 
  <tr>
    <td>Instituci&oacute;n   (*) </td>
    <td>
        <input type="text" name="form_institucion"  value="{institucion}" style="width:100%" maxlength="255"></td>
  </tr>   
  <tr>
    <td>Direcci&oacute;n  </td>
    <td><textarea  name="form_direccion"  style="width:100%">{direccion}</textarea></td>
  </tr>
    <tr>
  <td>Comuna </td>
  <td>
  <select name="form_comuna" style="width:98%">
  <option value="">---</option>
	  <!-- START BLOCK : bloque_comuna -->
	  <option value="{comuna_id}">{comuna} - {region}</option>
	  <!-- END BLOCK : bloque_comuna -->
  </select>
 
  </td> </tr>
  <tr>
    <td>Tel&eacute;fono (*) </td>
    <td><input type="text" name="form_telefono"  value="{telefono}" style="width:100%" maxlength="50"></td>
  </tr>
  <tr>
    <td>Tel&eacute;fono movil    </td>
    <td><input type="text" name="form_telefono_movil"  value="{telefono_movil}" style="width:100%" maxlength="50"></td>
  </tr>