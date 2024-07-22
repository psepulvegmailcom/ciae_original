
{tag_volver}
<div class="fieldset_title">Mensaje</div>

<fieldset>
<div>
<label>Asunto</label><br />
<input type="text" name="asunto" value="{asunto_mensaje}">
</div>


<!-- START BLOCK : bloque_masivo_usuarios_to -->
<div>
<label>Para</label><br />
<input type="text" name="to" value="">
</div>
<!-- END BLOCK : bloque_masivo_usuarios_to -->

<div>


<label>Mensaje</label><br />
 <strong>({explicacion_mensaje}. NO AGREGUE FIRMA)</strong>
<br />
 


<textarea  class="textarea_revision"  style=" height:200px;" name="email" class=""></textarea>
<br />{detalle_usuario}
</div>

 

<!-- START BLOCK : bloque_masivo_usuarios -->
<div>
	<label>Tipo Usuario Receptor</label><br />
	
  	<input  type="checkbox"  class="inputcheckbox"  disabled="disabled" checked="checked" name='usuarios[]' value='1'>Super Administrador <br />
	<input type="hidden" name="usuarios[]" value="1">
  <!-- START BLOCK : lista_permiso_item -->
  	<input  type="checkbox"  class="inputcheckbox" name='usuarios[]' value='{list_item_valor}'   {list_item_checked} >{list_item_texto} <br />
  <!-- END BLOCK : lista_permiso_item -->
	</div>
	
<!-- END BLOCK : bloque_masivo_usuarios -->
<button type="button" onClick="javascript:sendEmailMasivo();"><span>Enviar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
</fieldset>

<script type="text/javascript">
function sendEmailMasivo()
{
	if(document.main.email.value == '')
	{
		showAlert('Debe ingresar el contenido del email');
		return false;
	}
	if(document.main.asunto.value == '')
	{
		showAlert('Debe ingresar el asunto del email');
		return false;
	}
	if(confirm('¿Estan todos los datos correctamente? ¿Esta seguro de enviar este correo?'))
	{
		process('guardar',1);
	}
}
</script>