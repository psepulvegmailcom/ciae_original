  <tr>
    <td><strong>G&eacute;nero (*)  </strong></td>
    <td> 
	<input type="radio" name="form_genero" id="form_genero" value="F" onClick="javascript:definirTratamiento('a')"> Femenino<br>
	<input type="radio" name="form_genero" id="form_genero" value="M" onClick="javascript:definirTratamiento('o')"> Masculino<br>
	<input type="radio" name="form_genero" id="form_genero" value="O" onClick="javascript:definirTratamiento(u')"> 
	No indica
	</td>
  </tr>
  <input type="hidden" name="form_tratamiento" id="form_tratamiento" value='{tratamiento}'>
  <script>
   checkedValue('form_genero','{genero}');
   function definirTratamiento(tratamiento)
   {
	   document.main.form_tratamiento.value = tratamiento;
   }
  </script>