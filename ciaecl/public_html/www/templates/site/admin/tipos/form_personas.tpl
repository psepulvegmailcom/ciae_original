
{tag_volver}
<div class="fieldset_title">{caso_form} Tipo</div>
	
{mensaje_guardar}



<fieldset id='formulario_admin'> 
	 
	 
	<div>
		<label>		Tipo  </label><br  />
		<input type="text"    class="inputtext"   name="form_tipo"  id="form_tipo"  value="{tipo}" maxlength="150" >
		
	</div>
    	<div>
		<label>		Tipo English  </label><br  />
		<input type="text"    class="inputtext"   name="form_tipo_en"  id="form_tipo_en"  value="{tipo_en}" maxlength="150" >
		
	</div>

	<div>
		<label>		Orden  </label><br  />
		<select  class="inputtext"   name='form_orden'>
		 <!-- START BLOCK : bloque_form_orden -->
		 <option value="{orden}" {selected}>{orden}</option>
		  <!-- END BLOCK : bloque_form_orden -->
		
		</select>
		
	</div>
    	<div>
		<label>		Descripci&oacute;n  </label><br  />
		<input type="text"   class="textarea_revision"    name="form_descripcion"  id="form_descripcion"  value="{descripcion}" maxlength="350" align="top" >
		
	</div>
    	<div>
		<label>		Descripci&oacute;n English  </label><br  />
		<input type="text"   class="textarea_revision"    name="form_descripcion_en"  id="form_descripcion_en"  value="{descripcion_en}" maxlength="350" align="top" >
		
	</div>

		<div>
		<label>		Grupo  </label><br  />
		<input type="text"    class="inputtext"   name="form_grupo"  id="form_grupo"  value="{grupo}" maxlength="150" >		
	</div>
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>
	  
<input type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">

function editElement()
{   
	if(isEmpty(document.getElementById('form_tipo').value))
	{
		alert('Ingresar tipo');
		document.main.form_tipo.focus();
		return false;
	}    
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}