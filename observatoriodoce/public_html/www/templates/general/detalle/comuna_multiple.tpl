
<div class="fieldset_title">Zona Cobertura</div>
<br />
<div id='bloque_botones_sup'>
	<center>
		<button type="button" onclick="javascript:process('comunas_multiple',0);"  ><span>Guardar </span></button>  <button type="button" onclick="javascript:process('comunas_multiple|cerrar',0);"  ><span>Guardar y Cerrar</span></button>    <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		  
	</center> 
</div>	
<br />

		  <img src="cea/images/Info.ico" border='0'   />	Para seleccionar m&aacute;s de una comuna mantenga presionada la tecla CTRL + click en el elemento a seleccionar &oacute; haga click en <em>Seleccionar Todo</em> para seleccionar todas las comunas de una regi&oacute;n
			<br />
		  <img src="cea/images/Info.ico" border='0'   />	Para deseleccionar una comuna mantenga presionada la tecla CTRL + click en el elemento a deseleccionar &oacute; haga click en <em>Deseleccionar Todo</em> para deseleccionar todas las comunas de una regi&oacute;n
			<br />
			<br /> 

<table  id="tabla_noborder">
	 
	<tr>
		<th>&nbsp;</th>
		<th   width="45%" >Regiones</th>
		<th>&nbsp;</th>
		<th   width="45%" >Comunas</th>
		<th>&nbsp;</th>
	</tr>		

	<!-- START BLOCK : array_fila_tabla -->
	<tr id='region_{region_id}'>
		<td style=" border-bottom:1px #333333 dotted;">&nbsp;</td>
		<td style=" border-bottom:1px #333333 dotted;">
			{region_nombre}		</td>
		<td style=" border-bottom:1px #333333 dotted;">&nbsp;</td>
		<td style=" border-bottom:1px #333333 dotted;">
			<input type="checkbox"  class="inputcheckbox"  name="sel_comuna_{region_id}" onclick="javascript:selectInputAll('comuna[{region_id}]');document.main.sel_comuna_{region_id}_none.checked=false;" />  <small> Seleccionar Todos</small>  
		 &nbsp;&nbsp;&nbsp;
			<input type="checkbox"  class="inputcheckbox"  name="sel_comuna_{region_id}_none" onclick="javascript:unselectInputAll('comuna[{region_id}]');document.main.sel_comuna_{region_id}.checked=false;" /> <small> Deseleccionar Todos   </small>
		<br  /> 	<br  /> 
			<select name="comuna[{region_id}][]"  multiple="multiple" size="5" style="height:auto" > 
			<!-- START BLOCK : array_fila_tabla_comuna -->
			<option value="{comuna_id}" {comuna_selected}>{comuna_nombre}</option>
			<!-- END BLOCK : array_fila_tabla_comuna -->
			</select>		</td>
		<td>&nbsp;</td>
	</tr>	
	<!-- END BLOCK : array_fila_tabla -->
</table>  
 <br />
<div id='bloque_botones_inf'>
	
	<center>
		<button type="button" onclick="javascript:process('comunas_multiple',0);"  ><span>Guardar </span></button> 
		<button type="button" onclick="javascript:process('comunas_multiple|cerrar',0);"  ><span>Guardar y Cerrar</span></button>    <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		  

	</center>
</div>	<br />

 <input type="hidden" name="guardar_caso" value="guardar">
<!-- START BLOCK : cerrar_ventana -->
<script type="text/javascript">
window.close();
</script>
<!-- END BLOCK : cerrar_ventana -->