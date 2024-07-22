{tag_volver}
<div class="fieldset_title">{caso_form} Noticia</div>
	 
<fieldset>
<div>
<label>Título</label><br />
<input type="text" name="titulo"  value="{titulo}"/>
</div>
<div>
<label>Contenido</label><br />
<textarea name="aviso" style="  height:200px">{aviso}</textarea> 
</div>

<div>
<label>Fecha</label><br />
<input type="text" name="fecha"  value="{fecha}" readonly="readonly" style="width:40%"/>
</div>

<div>
<label>Publicar</label><br />
<input type="radio"  class="inputcheckbox" name="publicar" value="0" {no_publicar_checked}/>No Publicar
<input type="radio"  class="inputcheckbox" name="publicar" value="1" {publicar_checked}  />Publicar
</div>
<div>
<label>Destacada</label><br />
<input type="radio"  class="inputcheckbox" name="popup" value="0" {no_popup_checked}/>No Destacada
<input type="radio"  class="inputcheckbox" name="popup" value="1" {popup_checked}  />Destacada
</div>

<button onclick="javascript:guardarNoticia();" type="button" title="Guardar Noticia"><span>Guardar</span></button> 
<button onclick="javascript:process('',1);" type="button" title="Cancelar"><span>Cancelar</span></button> 
</fieldset> 

{tag_volver}


<input type="hidden" name="id_noticia" value="{id_noticia}">

<script>
function guardarNoticia()
{	 
 
	if(document.main.titulo.value == '')
	{
		alert('Debe ingresar el título');
		document.main.titulo.focus();
		return false;
	}
	if(document.main.aviso.value == '')
	{
		alert('Debe ingresar el contenido');
		document.main.aviso.focus();
		return false;
	}	 
	process('guardar',1);
}
</script>