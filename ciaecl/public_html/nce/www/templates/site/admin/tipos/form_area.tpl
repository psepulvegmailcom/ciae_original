
{tag_volver}
<div class="fieldset_title">{caso_form} &aacute;rea</div>
	
{mensaje_guardar}



<fieldset id='formulario_admin'> 
	 
	 
	<div>
		<label>		&aacute;rea  </label><br  />
		<input type="text"  class="inputtext"   name="form_area"  id="form_area"  value="{area}" maxlength="255" >		
	</div>
	<div>
		<label>		Clave </label><br  />
		<input type="text"  class="inputtext"   name="form_clave"  id="form_clave"  value="{clave}" maxlength="150" >		
	</div>
	<div>
		<label>		Descripci&Oacute;n</label><br  />
		<textarea class="textarea_revision" name="form_descripcion" id='form_descripcion'>{descripcion}</textarea>
	</div>

	<div>
		<label>		Orden  </label><br  />
		<select class="inputtext"  name='form_orden'>
		 <!-- START BLOCK : bloque_form_orden -->
		 <option value="{orden}" {selected}>{orden}</option>
		  <!-- END BLOCK : bloque_form_orden -->
		
		</select>
		
	</div>
	
	<div>
		<label>		Estado  </label><br  />
		<select  class="inputtext"   name='form_activo'> 
		 <option value="1"  >Activo</option> 
		 
		 <option value="0"  >No activo</option> 
		 <option value="{activo}"  selected > {activo_html} </option>
		
		</select>
		
	</div>

	 
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>
	  
<input type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">

function editElement()
{   
	if(isEmpty(document.getElementById('form_area').value))
	{
		alert('Ingresar area');
		document.main.form_area.focus();
		return false;
	}    
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}