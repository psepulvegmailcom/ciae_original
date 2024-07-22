{tag_volver}
<div class="fieldset_title">{caso_form} Elemento</div>
	 
<fieldset>
<div>
<label>Título</label><br />
<input type="text" name="{prefijo_form}titulo"  value="{titulo}"/>
</div>
<div>
<label>Contenido</label><br />
<textarea name="{prefijo_form}texto" style="  height:200px">{texto}</textarea> 
</div>

<div>
<label>Permiso</label><br />
 <select name="{prefijo_form}id_permiso" {disabled}>
  <option value="0">Permiso por Defecto</option>
  <!-- START BLOCK : lista_select_permiso -->
  <option value="{id_permiso}" {selected}> &nbsp;{descripcion}</option>
  <!-- END BLOCK : lista_select_permiso -->
 </select>
</div>
 

<button onclick="javascript:guardarElemento();" type="button" title="Guardar Elemento("><span>Guardar</span></button> 
<button onclick="javascript:process('',1);" type="button" title="Cancelar"><span>Cancelar</span></button> 
</fieldset> 

{tag_volver}



<script>
function guardarElemento()
{	  
	if(document.main.{prefijo_form}titulo.value == '')
	{
		alert('Debe ingresar el título');
		document.main.{prefijo_form}titulo.focus();
		return false;
	}
	if(document.main.{prefijo_form}texto.value == '')
	{
		alert('Debe ingresar el contenido');
		document.main.{prefijo_form}texto.focus();
		return false;
	}	 
	process('guardar',1);
}
</script>