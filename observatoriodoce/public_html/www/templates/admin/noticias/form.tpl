{tag_volver}


<input type="hidden" name="id_noticia" value="{id_noticia}">
<div class="fieldset_title">{caso_form} Noticia</div>
	 
<fieldset>
<div>
<label>T&Iacute;tulo</label><br /> 
<textarea  class='inputtext' name="titulo"  style="  height:50px">{titulo}</textarea> 
</div>

<div>
<label>Bajada Home</label><br /> 
<textarea  class='inputtext' name="bajada_home" style="  height:50px">{bajada_home}</textarea> 
</div>
<div>
<label>Bajada Noticias</label><br /> 
<textarea  class='inputtext' name="bajada_noticia" style="  height:50px">{bajada_noticia}</textarea> 
</div>
<div>
<label>Contenido</label><br /> 
{noticia_text} 
</div>

<div>
<label>Imagen Home</label><br /> 
<input type="file" name="imagen_bajada" />

<img src='imageview.php?image=news/{imagen_bajada}'  style="max-width:50px; max-height:50px;">
</div>
<div>
<label>Imagen Noticias</label><br /> 
<input type="file" name="imagen_noticia" />

<img src='imageview.php?image=news/{imagen_noticia}'  style="max-width:50px; max-height:50px;">
</div>
<div>
<label>Fecha</label><br />
<input type="text" name="fecha"  value="{fecha}"   style="width:30%"/> dd-mm-aaaa
</div>

<div>
<label>Idioma</label><br />
{select_idioma}
</div>

<div>
<label>Publicar</label><br />
<input type="radio"  class="inputcheckbox" name="publicar" value="0" {no_publicar_checked}/>No Publicar
<input type="radio"  class="inputcheckbox" name="publicar" value="1" {publicar_checked}  />Publicar
</div>
<div>
<label>Home</label><br />
<input type="radio"  class="inputcheckbox" name="home" value="0" {no_popup_checked}/>No Destacada
<input type="radio"  class="inputcheckbox" name="home" value="1" {popup_checked}  />Destacada
</div>

<input type="button" class="buttontype" onclick="javascript:guardarNoticia();" type="button" title="Guardar Noticia" value="Guardar" />
<input type="button" class="buttontype" onclick="javascript:process('',1);" type="button" title="Cancelar" value="Cancelar" />

 
</fieldset> 
 


<script type="text/javascript">
function guardarNoticia()
{	  
	if(document.main.titulo.value == '')
	{
		alert('Debe ingresar el t&Iacute;tulo');
		document.main.titulo.focus();
		return false;
	}
	if(document.main.noticia.value == '')
	{
		alert('Debe ingresar el contenido');
		document.main.noticia.focus();
		return false;
	}	 

	syncTextarea() ;
	process('guardar',1);
}
</script>