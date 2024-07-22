 <label>Indique a que sitio desear&aacute; que se asigne <img class="tooltip_admin" src="www/images/iconos/32x32/Info2.png" title="De no indicar ning&uacute;n sitio, el elemento no se visualizar&aacute;. <br><br><strong>Publicar:</strong> indica si deseamos publicar el elemento. <br><strong>Destacar:</strong> indica si deseamos que el elemento aparezca en el home, despu&eacute;s de tiempo el sistema cambiar&aacute; este estado de manera autom&aacute;tica.<br> <strong>Destacado Forzado:</strong> aunque pase el tiempo, el sistema no cambiar&aacute; el estado de destacado, permaneciendo fijo en home." >  </label> 

	<!-- START BLOCK : bloque_sitios_usuarios_global -->

	<div style="padding-left: 20px;">
		<label>		Sitio  {titulo_site}  </label><br  />
		
		<table style="width: 99%;  ">
		<tr>
		<td>		
		<input type="checkbox" name="sitios_id_site[{fila}]" value="{id_site}" {checked_id_site}> Asignar a sitio		
			</td>
		<!-- START BLOCK : bloque_sitios_usuarios_global_activo -->
			<td>Publicar <select name="sitios_activo[{fila}]" id="sitios_activo[{fila}]">
				<option></option>
				<option value='1' {selected_1}> Si</option>	
				<option value='0'  {selected_0}> No</option>			
			</select></td>
		<!-- END BLOCK : bloque_sitios_usuarios_global_activo -->
		<!-- START BLOCK : bloque_sitios_usuarios_global_destacado -->
			<td>Destacar <select name="sitios_destacado[{fila}]" id="sitios_destacado[{fila}]">
				<option></option>
				<option value='1' {selected_1}> Si</option>	
				<option value='0'  {selected_0}> No</option>				
			</select></td>
		<!-- END BLOCK : bloque_sitios_usuarios_global_destacado -->
		<!-- START BLOCK : bloque_sitios_usuarios_global_destacado_forzado -->
			<td>Destacar Forzado <select name="sitios_destacado_forzado[{fila}]" id="sitios_destacado_forzado[{fila}]">
				<option></option>
				<option value='1' {selected_1}> Si</option>	
				<option value='0'  {selected_0}> No</option>			
			</select></td>
		<!-- END BLOCK : bloque_sitios_usuarios_global_destacado_forzado -->		
		<!-- START BLOCK : bloque_sitios_usuarios_global_id_tipo -->
			<td>Tipo <select name="sitios_id_tipo[{fila}]" id="sitios_id_tipo[{fila}]">
				<option></option> 						
				<!-- START BLOCK : bloque_sitios_usuarios_global_id_tipo_elemento -->
				<option value='{id_tipo}' {selected}> {tipo}</option>		
				<!-- END BLOCK : bloque_sitios_usuarios_global_id_tipo_elemento -->	
			</select> 
			</td>
			<!-- START BLOCK : bloque_sitios_usuarios_global_id_tipo_selected -->
			<script>
				var selected_aux = searchElement('sitios_id_tipo[{fila}]');
				selectedValueSelect(selected_aux,'{valor}'); 
			</script>
			<!-- END BLOCK : bloque_sitios_usuarios_global_id_tipo_selected -->
		<!-- END BLOCK : bloque_sitios_usuarios_global_id_tipo -->
	
		<!-- START BLOCK : bloque_sitios_usuarios_global_id_tipo_estructura -->
			<td>Tipo <select name="sitios_id_tipo_estructura[{fila}]" id="sitios_id_tipo_estructura[{fila}]">
				<option></option> 						
				<!-- START BLOCK : bloque_sitios_usuarios_global_id_tipo_estructura_elemento -->
				<option value='{id_tipo_estructura}' {selected}> {tipo_estructura}</option>		
				<!-- END BLOCK : bloque_sitios_usuarios_global_id_tipo_estructura_elemento -->	
			</select> 
			</td>
			<!-- START BLOCK : bloque_sitios_usuarios_global_id_tipo_estructura_selected -->
			<script>
				var selected_aux = searchElement('sitios_id_tipo_estructura[{fila}]');
				selectedValueSelect(selected_aux,'{valor}'); 
			</script>
			<!-- END BLOCK : bloque_sitios_usuarios_global_id_tipo_estructura_selected -->
		<!-- END BLOCK : bloque_sitios_usuarios_global_id_tipo_estructura -->		
			
			</tr>
		</table>
		  
	</div>
<!-- END BLOCK : bloque_sitios_usuarios_global -->



<!-- START BLOCK : bloque_sitios_usuarios_global_seleccion -->
holalalalalalal ;9
<!-- END BLOCK : bloque_sitios_usuarios_global_seleccion -->
	
 