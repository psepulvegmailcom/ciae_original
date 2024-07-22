{tag_volver}


<input type="hidden" name="id_item" value="{id_item}">
<div class="fieldset_title">{caso_form} Agenda</div>
	 
<fieldset>
<div>
<label>T&Iacute;tulo</label><br /> 
<textarea  class='inputtext' name="titulo"  style="  height:50px">{titulo}</textarea> 
</div>
 
<div>
<label>Contenido</label><br /> 
{contenido_text} 
</div>
<div>
<label>Lugar</label><br /> 
<textarea  class='inputtext' name="lugar" style="  height:50px">{lugar}</textarea> 
</div>
<div>
<label>Organiza</label><br /> 
<textarea  class='inputtext' name="organiza" style="  height:50px">{organiza}</textarea> 
</div>
<div>
<label>Patrocina</label><br /> 
<textarea  class='inputtext' name="patrocina" style="  height:50px">{patrocina}</textarea> 
</div>
<div>
<label>Consultas</label><br /> 
<textarea  class='inputtext' name="consulta" style="  height:50px">{consulta}</textarea> 
</div>

 
<div>
<label>Fecha y Hora Inicio</label><br />
<input type="text" name="fecha_inicio"  value="{fecha_inicio_real}" maxlength='16'   style="width:30%"/> dd-mm-aaaa hh:mm
</div>

<div>
<label>Fecha y Hora T&eacute;rmino</label><br />
<input type="text" name="fecha_termino"  value="{fecha_termino_real}" maxlength='16'   style="width:30%"/> dd-mm-aaaa hh:mm
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

<input type="button" class="buttontype" onclick="javascript:guardarElemento();" type="button" title="Guardar Noticia" value="Guardar" />
<input type="button" class="buttontype" onclick="javascript:process('',1);" type="button" title="Cancelar" value="Cancelar" />

 
</fieldset> 
 


<script type="text/javascript">
function guardarElemento()
{	  
	syncTextarea() ;
	if(document.main.titulo.value == '')
	{
		alert('Debe ingresar el t&Iacute;tulo');
		document.main.titulo.focus();
		return false;
	}
	if(document.main.contenido.value == '')
	{
		alert('Debe ingresar el contenido');
		document.main.contenido.focus();
		return false;
	}	 
	if(document.main.fecha_inicio.value == '' || document.main.fecha_termino.value == '')
	{
		alert('Debe ingresar ambas fechas del evento'); 
		return false;
	}	 
	if(document.main.lugar.value == '')
	{
		alert('Debe ingresar el lugar');
		document.main.lugar.focus();
		return false;
	}	 

	process('guardar',1);
}
</script>