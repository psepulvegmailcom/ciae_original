<script>
function textCounter(field, countfield, maxlimit) 
{
	var field = searchElement(field);
	if (field.value.length > maxlimit)  
	{
		field.value = field.value.substring(0, maxlimit);
	}
	else 
	{
		$(countfield).innerHTML  =   field.value.length+' caracteres de un máximo de '+ maxlimit;
	}
}
</script> 
<table class='Form' border='0' width='100%' cellpadding='0' cellspacing='0'>
 
<tr class='Form'>
<td class='Form'>Epígrafe</td>
<td class='Form'>
	<input type="text" name="noticia_epigrafe"  class='inputtext' value="{noticia_epigrafe}" maxlength="255">
</td>
</tr>
<tr class='Form'>
<td class='Form' width="25%">Título</td>
<td class='Form'>
<span id="noticia_titulo_max">{noticia_titulo_max} caracteres de un máximo de 255</span><br /> 
	<textarea onkeydown="textCounter('noticia_titulo','noticia_titulo_max',255);" rows="2" onkeyup="textCounter('noticia_titulo','noticia_titulo_max',255);" name="noticia_titulo"   id="noticia_titulo" class='inputtext' >{noticia_titulo}</textarea>
	 	   (*)
</td>
</tr>
<tr class='Form'>
<td class='Form' width="25%">Título Interno</td>
<td class='Form'>
<span id="noticia_titulo_interno_max">{noticia_titulo_interno_max} caracteres de un máximo de 255</span><br />
	 
	<textarea onkeydown="textCounter('noticia_titulo_interno','noticia_titulo_interno_max',255);" rows="2" onkeyup="textCounter('noticia_titulo_interno','noticia_titulo_interno_max',255);" name="noticia_titulo_interno"   id="noticia_titulo" class='inputtext' >{noticia_titulo_interno}</textarea>  
</td>
</tr>

<tr class='Form'>
<td class='Form'>Resumen Home</td>
<td class='Form'>  
<span id="noticia_bajada_home_max">{noticia_bajada_home_max} caracteres de un máximo de 600</span><br />
	<textarea onkeydown="textCounter('noticia_bajada_home','noticia_bajada_home_max',600);" rows="3" onkeyup="textCounter('noticia_bajada_home','noticia_bajada_home_max',600);" name="noticia_bajada_home" class='inputtext' rows="10"> {noticia_bajada_home} </textarea>   (*)
</td>
</tr>

<tr class='Form'>
<td class='Form'>Resumen Interior</td>
<td class='Form'>
<span id="noticia_bajada_noticia_max">{noticia_bajada_noticia_max} caracteres de un máximo de 600</span><br />
	 <textarea name="noticia_bajada_noticia" onkeydown="textCounter('noticia_bajada_noticia','noticia_bajada_noticia_max',600);" rows="3" onkeyup="textCounter('noticia_bajada_noticia','noticia_bajada_noticia_max',600);"  class='inputtext' rows="10"> {noticia_bajada_noticia} </textarea>    
</td>
</tr>


<tr class='Form'>
<td class='Form'>Noticia</td>
<td class='Form'>&nbsp; 
	
</td>
</tr>
<tr class='Form'>
<td class='Form' colspan="2"> 
	{text_noticia_noticia}  (*)
	<input type="hidden" name="noticia_noticia_original"  value=" "/>
</td>
</tr>

<tr class='Form'>
	<td class='Form'>Edición</td>
	<td class='Form'><input type="text" name="noticia_edicion" class='inputtext' value="{noticia_edicion}" maxlength="255"></td>
</tr>

<tr class='Form'>
<td class='Form'>Autor</td>
<td class='Form'>
	<input type="text" name="noticia_autor"  class='inputtext' value="{noticia_autor}" maxlength="255">
</td>
</tr>
<tr class='Form'>
<td class='Form'>Fuente</td>
<td class='Form'>
	<input type="text" name="noticia_fuente"  class='inputtext' value="{noticia_fuente}" maxlength="255">
</td>
</tr>

<tr class='Form'>
<td class='Form'>Imagen Resumen</td>
<td class='Form'>
	<input type="file" name="noticia_imagen_bajada">  
	<input type="hidden" name="has_noticia_imagen_bajada" value="{has_noticia_imagen_bajada}" />
	
	<!-- START BLOCK : noticia_imagen_bajada_bloque -->
	&nbsp;&nbsp;<img src="scripts/imageview.php?image={noticia_imagen_bajada}&case=img_news" width="70" height="70" />	
	<!-- END BLOCK : noticia_imagen_bajada_bloque -->
</td>
</tr>

<tr class='Form'>
<td class='Form'>Imagen Noticia</td>
<td class='Form'>
	<input type="file" name="noticia_imagen_noticia"> (*)
	<input type="hidden" name="has_noticia_imagen_noticia" value="{has_noticia_imagen_noticia}" />
	<!-- START BLOCK : noticia_imagen_noticia_bloque -->
	&nbsp;&nbsp;<img src="scripts/imageview.php?image={noticia_imagen_noticia}&case=img_news" width="70" height="70" />	
	<!-- END BLOCK : noticia_imagen_noticia_bloque -->
</td>
</tr>

<tr class='Form'>
<td class='Form'>Lado Imagen</td>
<td class='Form'>
	
	<select name="noticia_imagen_noticia_lado" class='inputtext'>
		<option value="">Seleccione Lado Imagen</option>
		<option {imagen_noticia_lado_right} value="right">Lado Derecho</option>
		<option {imagen_noticia_lado_left} value="left">Lado Izquierdo  </option> 
	</select> (*)
</td>
</tr>

<tr class='Form'>
<td class='Form'>Pie de Foto Noticia</td>
<td class='Form'>
	<input type="text" class='inputtext' name="noticia_imagen_noticia_descripcion" value="{noticia_imagen_noticia_descripcion}" maxlength="255">
</td>
</tr>



<tr class='Form'>
<td class='Form'>Fecha de Noticia</td>
<td class='Form'> 
	<input type="text"  class='inputtext' name="noticia_fecha_noticia"  value="{noticia_fecha_noticia}" maxlength="10" style="width:60px">&nbsp;<A HREF="#" onClick="cal.select(document.main.noticia_fecha_noticia,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="cea/images/buttons/cal.gif" border="0" /></A> (*)
</td>
</tr>

<tr class='Form'>
<td class='Form'>Fecha de Caducidad</td>
<td class='Form'>
	<input type="text"  class='inputtext' name="noticia_fecha_caducidad" value="{noticia_fecha_caducidad}" maxlength="10" style="width:60px">&nbsp;<A HREF="#" onClick="cal.select(document.main.noticia_fecha_caducidad,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="cea/images/buttons/cal.gif" border="0" /></A> (*)
</td>
</tr>

<tr class='Form'>
<td class='Form'>Idioma</td>
<td class='Form'>
	<select name="noticia_idioma" class='inputtext'>
		<option {noticia_idioma_nn} value="nn">Neutro</option>
		<option {noticia_idioma_es} value="es">Español</option>
		<option {noticia_idioma_en} value="en">Inglés</option>
	</select> (*)
</td>
</tr>

<tr class='Form'>
<td class='Form'>Publicación</td>
<td class='Form'>
	 <input type="checkbox" name="noticia_publicar_intranet"    {noticia_publicar_intranet_checked}> Publicar Intranet <br />
	 <input type="checkbox" name="noticia_publicar_cmm"   {noticia_publicar_cmm_checked}> Publicar CMM <br />
	 <input type="checkbox" name="noticia_publicar_dim" {noticia_publicar_dim_checked}> Publicar DIM  
</td>
</tr>

<tr class='Form'>
<td class='Form'>Grupo de Fotos (caso particular CMM)</td>
<td class='Form'>
	<select name="noticia_grupo_imagenes" class='inputtext'>
	<option value="">Seleccione Grupo de Fotos</option>
	<!-- START BLOCK : noticia_grupo_imagenes_bloque -->
	<option value="{noticia_grupo_imagenes_id}" {noticia_grupo_imagenes_selected}>{noticia_grupo_imagenes_text}</option>
    <!-- END BLOCK : noticia_grupo_imagenes_bloque --> 
	</select>
</td>
</tr>

  </table>
<input type="hidden" name="noticia_id_noticia" value="{noticia_id_noticia}">

<script>
function guardarNoticia(opcion)
{	 
syncTextarea() ;
	if(document.main.noticia_noticia.value == '')
	{
		alert('Debe ingresar la noticia');
		document.main.noticia_noticia.focus();
		return false;
	}
	if(document.main.noticia_titulo.value == '')
	{
		alert('Debe ingresar el título');
		document.main.noticia_titulo.focus();
		return false;
	}
	if(document.main.noticia_bajada_home.value == '')
	{
		alert('Debe ingresar la bajada home de la noticia');
		document.main.noticia_bajada_home.focus();
		return false;
	}  
	
	if(document.main.noticia_imagen_noticia_lado.value == '')
	{
		alert('Debe seleccionar el lado de aparición de la imagen');
		document.main.noticia_imagen_noticia_lado.focus();
		return false;
	}  
	if(document.main.has_noticia_imagen_noticia.value == 0 && document.main.noticia_imagen_noticia.value == '')
	{
		alert('Debe ingresar la imagen de bajada');
		document.main.noticia_imagen_bajada.focus();
		return false;
	}
	 
	if(document.main.noticia_fecha_caducidad.value == '')
	{
		alert('Debe ingresar fecha de caducidad de la noticia');
		document.main.noticia_fecha_caducidad.focus();
		return false;
	}
	if(document.main.noticia_fecha_noticia.value == '')
	{
		alert('Debe ingresar fecha de la noticia');
		document.main.noticia_fecha_noticia.focus();
		return false;
	}	 
	process(opcion,1);
}
</script>