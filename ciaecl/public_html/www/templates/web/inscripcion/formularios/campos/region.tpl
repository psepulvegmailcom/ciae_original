  <tr>
    <td><strong>Regi&oacute;n  (*)  </strong></td>
    <td> 
	<select name="form_region" id="form_region">
	<option value="" selected></option>
	<!-- START BLOCK : bloque_region -->
	<option value="{region_id}">{region}</option>
	<!-- END BLOCK : bloque_region --> 
	</select> 
	</td>
  </tr>
  <script>
  selectValue('form_region','{region}');
  </script>