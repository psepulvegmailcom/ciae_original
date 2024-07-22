<fieldset id='formulario_admin'> 
	 
	  <table style="width:99% " border="0">
	  <tr> 
	  <td style="vertical-align:top "  width="30%">
	  	 
	  Porcentaje doble corregido
	  
	  </td><td style="vertical-align:top ">
	  	 <input type="text" name="doble_corregido" class='inputtext'  value="30">
	  
	  
	  </td></tr> 
 <tr> 
	  <td style="vertical-align:top "  width="30%">
	  	 
	  Asignaci&oacute;n diaria
	  
	  </td><td style="vertical-align:top ">
	  	 <input type="text" name="asignacion_diaria" class='inputtext'  value="40"> 
	  </td></tr> 	  
	  <tr>
	   <td style="vertical-align:top " >	 Tipo usuario	  </td>
	  <td style="vertical-align:top ">
	  	 <input type="radio" name="tipo_usuario" value="evaluador" checked> Corrector<br>
	  	 <input type="radio" name="tipo_usuario" value="supervisor" > Supervisor<br> 
	  </td></tr>
	  
	   <tr>
	   <td style="vertical-align:top " >	Sufijo  </td>
	  <td style="vertical-align:top ">
	  	 <input type="text" name="sufijo" class='inputtext'   maxlength="255">
	  </td></tr>
	   <tr>
	   <td style="vertical-align:top " >	 Descripci&oacute;n  </td>
	  <td style="vertical-align:top ">
	  	 <input type="text" name="descripcion" class='inputtext'   maxlength="255">
	  </td></tr>
	  <tr><td></td><td><button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> </td></tr>
	  </table>
	  </fieldset>
	  
	    

<script type="text/javascript">
function editElement()
{       
	process('{opcion_modulo}|guardar',0);	 
}


</script>