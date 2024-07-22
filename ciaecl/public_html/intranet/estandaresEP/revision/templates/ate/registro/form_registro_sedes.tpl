<!-- abre bloque sedes -->
<br  />
<div id='ate_sede_{numero_div}_sede'>
<h4>Sede&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button"  onclick="javascript:quitarSede({numero_div})"><span>Quitar Sede</span></button></h4>  <font id='ate_sede_{numero_div}_sede_estado'    class="edicion_enrevision">{sede_estado} </font>
 
<input type="hidden" name="ate_nosede_{numero_div}_original" value="{ate_sede_original}">
<input type="hidden" name="ate_nosede_{numero_div}_orden" value="{ate_sede_orden}">
<fieldset>
	<div>
	<label>Regi&oacute;n de sede</label><br  />
		<select name="ate_nosede_{numero_div}_region_id"  onchange="javascript:showComuna('ate_nosede_{numero_div}_region_id','ate_sede_{numero_div}_comuna_id');" >
			{ate_sede_region}
		</select>
		<span>(*)</span><span>{ayuda_sede_region}</span>	
	 </div>
	 <div>
	<label>Comuna de sede</label><br  />
		<select name="ate_sede_{numero_div}_comuna_id" id="ate_sede_{numero_div}_comuna_id">
		{ate_sede_comuna}
		</select>
		<span>(*)</span><span>{ayuda_sede_comuna}</span>
	 </div>
	 <div>
	<label>Direcci&oacute;n de sede </label><br  />
		<textarea name="ate_sede_{numero_div}_direccion" id="ate_sede_{numero_div}_direccion">{ate_sede_direccion}</textarea>		
		<span>(*)</span><span>{ayuda_sede_direccion}</span>
	 </div>
	 <div>
	<label>Tel&eacute;fono y c&oacute;digo de ciudad de la sede</label><br  />
	<select id="ate_sede_{numero_div}_telefono_codigo"  name="ate_sede_{numero_div}_telefono_codigo" style="width:60px; "  >
<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_area_option.tpl -->
</select>
<script>
selectValue('ate_sede_{numero_div}_telefono_codigo','{ate_sede_telefono_codigo}');  
</script>
	
	
		<!--<input type="text"  style="width:35px"  maxlength="3" name="ate_sede_{numero_div}_telefono_codigo"  id="ate_sede_{numero_div}_telefono_codigo" value="{ate_sede_telefono_codigo}"  >--> - <input type="text"  style="width:100px"  maxlength="7"  name='ate_sede_{numero_div}_telefono'  id='ate_sede_{numero_div}_telefono'  value="{ate_sede_telefono}"  >		
		<span>(*)</span><span>{ayuda_sede_telefono}</span>
	 </div>
	 <div>
	<label>Email de contacto de sede</label><br  />
		 <input type="text"  name='ate_sede_{numero_div}_email'  id='ate_sede_{numero_div}_email' value="{ate_sede_email}" >		
		<span>(*)</span><span>{ayuda_sede_email}</span>
	 </div> 
	</fieldset>
<input type="hidden" name="ate_sede_{numero_div}_oculto" value="0" />
	</div>
	
<div id='ate_sedes_div_{numero_div_mas}'> 
</div>
<!-- cierre bloque sedes -->