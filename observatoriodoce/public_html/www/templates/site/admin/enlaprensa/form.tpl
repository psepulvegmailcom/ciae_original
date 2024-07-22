


		<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->
		<fieldset id='formulario_admin'> 
	 
	 
	<div class="fieldset_campos">
		<label>		T&Iacute;tulo </label><br  />
		<input  class="inputtext" type="text"   name="form_titulo"  id="form_titulo"  value="{titulo}" maxlength="250"  > 
	</div>
	
	<div class="fieldset_campos">
		<label>		Bajada </label><br  />
		<input  class="inputtext" type="text"   name="form_bajada"  id="form_bajada"  value="{bajada}" maxlength="250"  > 
	</div>
		<div class="fieldset_campos">
		<label>		Medio </label><br  />
		<input  class="inputtext" type="text"   name="form_medio"  id="form_medio"  value="{medio}" maxlength="250"  > 
	</div>
		<div class="fieldset_campos">
		<label>		Url </label>(ingresar completa con http://)<br  />
		<input  class="inputtext" type="text"   name="form_url"  id="form_url"  value="{url}" maxlength="250"  > 
	</div>
		 
	<div class="fieldset_campos">
		<label>		Fecha </label><br  />
		<input  class="inputtext" type="text"   name="form_fecha"  id="form_fecha"  value="{fecha_html}" maxlength="10" readonly="readonly" style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div>
	  
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>
 


 



<input  class="inputtext" type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">

function editElement()
{    
	if(isEmpty(document.getElementById('form_titulo').value))
	{
		alert('Debe ingresar el titulo');
		document.main.form_titulo.focus();
		return false;
	}    
	if(isEmpty(document.getElementById('form_fecha').value))
	{
		alert('Debe ingresar el fecha');
		document.main.form_fecha.focus();
		return false;
	}    
	if(isEmpty(document.getElementById('form_url').value))
	{
		alert('Debe ingresar el url');
		document.main.form_url.focus();
		return false;
	}    
	if(isEmpty(document.getElementById('form_medio').value))
	{
		alert('Debe ingresar el medio');
		document.main.form_medio.focus();
		return false;
	}    
	enviar_accion_admin('{opcion_modulo}|guardar',document.main.id_item.value);	 
}
</script>
{tag_volver}