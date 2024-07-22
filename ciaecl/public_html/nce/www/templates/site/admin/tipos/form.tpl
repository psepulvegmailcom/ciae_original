
{tag_volver}
<div class="fieldset_title">{caso_form} Tipo</div>
	
{mensaje_guardar}



<fieldset id='formulario_admin'> 
	 
	 
	<div>
		<label>		Tipo  </label><br  />
		<input type="text"  class="inputtext"     name="form_tipo"  id="form_tipo"  value="{tipo}" maxlength="150" >
		
	</div>

	<div>
		<label>		Orden  </label><br  />
		<select  class="inputtext"   name='form_orden'>
		 <!-- START BLOCK : bloque_form_orden -->
		 <option value="{orden}" {selected}>{orden}</option>
		  <!-- END BLOCK : bloque_form_orden -->
		
		</select>
		
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