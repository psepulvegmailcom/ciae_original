
{tag_volver}
<div class="fieldset_title">{caso_form} Centro de costos</div>
	
{mensaje_guardar}



<fieldset id='formulario_admin'> 
	 
	 
	<div>
		<label>		C&oacute;digo  </label><br  />
		<input type="text"  class="inputtext"   name="form_codigo"  id="form_codigo"  value="{codigo}" maxlength="50" >		
	</div>
	<div>
		<label>		Proyecto</label><br  />
		<textarea   class="inputtext"   name="form_proyecto"  id="form_proyecto">{centro_costo}</textarea>		
	</div>  
	
	<div>
		<label>		Cuenta corriente</label><br  />
		<input type="text"  class="inputtext"   name="form_cuenta_corriente"  id="form_cuenta_corriente"  value="{cuenta_corriente}" maxlength="250" >		
	</div>  
	<div>
		<label>		Investigador responsable  </label><br  />
		<select class="inputtext"  name='form_usuario_responsable'>
			<option value=""></option> 
		 <!-- START BLOCK : bloque_form_usuario_responsable -->
		 <option value="{user_id}" {selected}>{apellido_paterno}, {nombre}  &nbsp;&nbsp;&nbsp;&nbsp; {email} </option>
		  <!-- END BLOCK : bloque_form_usuario_responsable --> 
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

	if(!validacionCampoTextoSimple("form_codigo"))
	{
		return false;
	}    
	if(!validacionCampoTextoSimple("form_proyecto"))
	{
		return false;
	}  
	if(!validacionCampoTextoSimple("form_usuario_responsable"))
	{
		return false;
	}    
	if(!validacionCampoTextoSimple("form_activo"))
	{
		return false;
	}      
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}