
<div class="fieldset_title">Zona Cobertura</div>
<div id='bloque_botones_sup'>
	<center>
		<button type="button" onclick="javascript:saveComunasParent();"  ><span>Guardar y Cerrar</span></button>    <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		  
	</center>
</div>	

<script type="text/javascript"> var regiones = new Array();
var ir=0;</script>
		 	<br />  <img src="cea/images/Info.ico" border='0'   />	Para seleccionar m&aacute;s de una comuna mantenga presionada la tecla CTRL + click en el elemento a seleccionar &oacute; haga click en <em>Seleccionar Todo</em> para seleccionar todas las comunas de una regi&oacute;n
			<br />
		  <img src="cea/images/Info.ico" border='0'   />	Para deseleccionar una comuna mantenga presionada la tecla CTRL + click en el elemento a deseleccionar &oacute; haga click en <em>Deseleccionar Todo</em> para deseleccionar todas las comunas de una regi&oacute;n
			<br />
			<br /> 
<table  id="tabla_noborder">
	<tr>
		<th>&nbsp;</th>
		<th   width="45%" class="form_tabla_campo"><strong>Regiones</strong></th>
		<th>&nbsp;</th>
		<th   width="45%"  class="form_tabla_campo"><strong>Comunas</strong></th>
		<th>&nbsp;</th>
	</tr>		

	<!-- START BLOCK : array_fila_tabla -->
	<tr id='region_{region_id}'>
	<script type="text/javascript">regiones[ir] = {region_id}; ir = ir+1;</script>
		<td style=" border-bottom:1px #333333 dotted;">&nbsp;</td>
		<td style=" border-bottom:1px #333333 dotted;">
			{region_nombre}		</td>
		<td style=" border-bottom:1px #333333 dotted;">&nbsp;</td>
		<td style=" border-bottom:1px #333333 dotted;height:auto">
			<input type="checkbox"  class="inputcheckbox" name="sel_comuna_{region_id}" onclick="javascript:selectInputAll('comuna[{region_id}]');document.main.sel_comuna_{region_id}_none.checked=false;" /><small> Seleccionar Todos  </small>
	<input type="checkbox"  class="inputcheckbox"  name="sel_comuna_{region_id}_none" onclick="javascript:unselectInputAll('comuna[{region_id}]');document.main.sel_comuna_{region_id}.checked=false;" /> <small> Deseleccionar Todos   </small>
		<br  /> 	<br  /> 
			<select name="comuna[{region_id}][]"  multiple="multiple" size="5"  style="height:auto" > 
			<!-- START BLOCK : array_fila_tabla_comuna -->
			<option value="{comuna_id}" {comuna_selected}>{comuna_nombre}</option>
			<!-- END BLOCK : array_fila_tabla_comuna -->
			</select>		</td>
		<td>&nbsp;</td>
	</tr>	
	<!-- END BLOCK : array_fila_tabla -->
</table>  
 
<div id='bloque_botones_inf'>
	<center>
		<button type="button" onclick="javascript:saveComunasParent();"  ><span>Guardar y Cerrar</span></button>    <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		  
	</center>
</div>	

 <script type="text/javascript">
<!-- START BLOCK : cerrar_ventana -->

window.close();
<!-- END BLOCK : cerrar_ventana -->
function getComunasParent()
{
	var comunas = searchParentElement('ext_ate_portafolio_comuna_id');
 
	var listaComunas = comunas.value;
	listaComunas = listaComunas.split("-");
	for(var k=0; k < listaComunas.length; k++)
	{ 
	 	for(var j=0; j < regiones.length; j++)
		{
			var r = searchElement('comuna['+regiones[j]+'][]');
			  
			for(i=0; i < r.length ; i++)
			{
				if( r[i].value == listaComunas[k]  )
				{
					r[i].selected = true;			
				}
			}	 
		}
	}
}
getComunasParent();

function saveComunasParent(){

 	var comunas_sel = '';
 	for(var j=0; j < regiones.length; j++)
	{
		var r = searchElement('comuna['+regiones[j]+'][]');
		  
		for(i=0; i < r.length ; i++)
		{
			if( r[i].selected )
			{
				if(comunas_sel != '')
				{
					comunas_sel= comunas_sel+'-'+r[i].value;			
				}
				else
				{
					comunas_sel=  r[i].value;
				}
			}
		}	 
 	}
	if(comunas_sel == '')
	{
		alert('Debe seleccionar al menos una comuna');
		return false;
	}
	else
	{
		 
		window.opener.document.main.ext_ate_portafolio_comuna_id.value = comunas_sel; 
		window.close();
	}
}
</script>