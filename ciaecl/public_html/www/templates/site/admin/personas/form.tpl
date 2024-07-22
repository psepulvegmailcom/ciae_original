
{tag_volver}
<div class="fieldset_title">{caso_form} Elemento</div>
	
{mensaje_guardar}



<fieldset id='formulario_admin'> 
	 
	 
	<div>
		<label>		Nombre  </label><br  />
		<input  class="inputtext" type="text"   name="form_nombre"  id="form_nombre"  value="{nombre}" maxlength="250"   onChange="javascript:nombreReferenciaNuevo();" >
		
	</div>
	<div>
		<label>		Apellidos </label><br  />
		<input  class="inputtext" type="text"   name="form_apellido_paterno"  id="form_apellido_paterno"  value="{apellido_paterno}" maxlength="250"  onChange="javascript:nombreReferenciaNuevo();"> 
	</div> 

	<div>
		<label>		Nombre de aparici&oacute;n para referencias </label><br  />
		<input  class="inputtext" type="text"   name="form_nombre_publicacion"  id="form_nombre_publicacion"  value="{nombre_publicacion}" maxlength="250" > 
	</div>	

	<div>
		<label>		Afiliaci&oacute;n </label><br  />
		 
		<textarea   class="textarea_simple"     name="form_afiliacion"  id="form_afiliacion" >{afiliacion}</textarea>
	</div>	

	<div>
		<label>		Universidad (solo caso de categor&iacute;as) </label><br  /> 
		<select name='form_id_universidad'>
		 <!-- START BLOCK : bloque_form_id_universidad -->
		 <option value="{id_universidad}" {selected}>{universidad}</option>
		  <!-- END BLOCK : bloque_form_id_universidad -->
		
		</select>
	</div>	
	<div>
		<label>		Grados Acad&eacute;micos</label><br  />
		<textarea   class="textarea_simple"     name="form_grado"  id="form_grado" >{grado}</textarea>
	</div>
	<div>
		<label>		Cargo </label><br  />
		<input  class="inputtext" type="text"   name="form_cargo"  id="form_cargo"  value="{cargo}" maxlength="250" > 
	</div>
	
	
	<div>
		<label>		&aacute;rea CIAE  </label><br  />
		<select name="formexterno_area[]"  id="formexterno_area" multiple size="5"    > 
		 <!-- START BLOCK : bloque_form_id_area -->
		 <option value="{id_area}" {selected}>{area}</option>
		 <!-- END BLOCK : bloque_form_id_area -->
		</select>
	</div>
	
	<div>
		<label>		Tipo persona  </label><br  />
		<select name="formexterno_tipo_persona[]"  id="formexterno_tipo_persona"  multiple size="5"    > 
		 <!-- START BLOCK : bloque_form_id_tipo_persona -->
		 <option value="{id_tipo}" {selected}>{tipo}</option>
		 <!-- END BLOCK : bloque_form_id_tipo_persona -->
		</select>
	</div>
    
	<div>
		<label>		Debe aparecer en listado anexos CIAE? </label><br  />
		<select name="form_anexo"  id="form_anexo"   onChange="javascript:anexoSeleccion();"    > 
        <option value="si">Si</option>
        <option value="no">No</option>
        </select>
        
	</div>
    
	<div>
		<label>		Anexo </label><br  />
		<input  class="inputtext" type="text" onChange="javascript:ajusteAnexo();"   name="form_anexo_numero"  id="form_anexo_numero"  value="{anexo_numero}" maxlength="50" > 
	</div>
	
	<div>
		<label>		Tel&eacute;fono </label> <small>(Debe agregar el n&uacute;mero completo con c&oacute;digo de pa&iacute;s y ciudad)</small><br  />
		<input  class="inputtext" type="text"   name="form_telefono"  id="form_telefono"  value="{telefono}" maxlength="50" > 
	</div>
	<div>
		<label>		Url </label><br  />
		<input  class="inputtext" type="text"   name="form_url"  id="form_url"  value="{url}" maxlength="250" > 
	</div>
	
	<div>
		<label>		Email</label><br  />
		<input  class="inputtext" type="text"   name="form_email"  id="form_email"  value="{email}" maxlength="150" > 
	</div>
	 
	<div>
		<label>		CV</label><br  />
		<textarea  class="textarea_revision" name="form_cv" id='form_cv'>{cv}</textarea>
	</div>
	<div>
		<label>		CV Archivo</label><br  />
		<input type="file" name="form_cv_archivo"><br>
		CV actual<a href="download.php?file=cv/{cv_archivo}" style="border:0px "><img src="www/images/filetypes/pdf.png" style="width:32px " border="0"> </a>
	</div>
	<div>
		<label>		Perfil</label><br  />
		<textarea class="textarea_revision" name="form_perfil" id='form_perfil'>{perfil}</textarea>
	</div>
     
	<div>
		<label>		Imagen</label><br  />
			<input type="file" class="imagenMultiple" id="form_imagen" name="form_imagen"/>
            <ul id="lista-imagenes">			
            </ul>
            <div id="response"></div> 
		Imagen actual: <img src="imageview.php?image=personas/{imagen}" width="100px" >
	</div>

	<div>
		<label>		Estado aparici&oacute;n sitio web <small>(Para que aparezca en el sitio web debe estar como activo)</small></label><br  />
		 		<select name="form_activo"  id="form_activo"     > 
        <option value="1">Si</option>
        <option value="0">No</option>
        </select>
	</div>
	
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>
	  
<input  class="inputtext" type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">

function editElement()
{    
	if(isEmpty(document.getElementById('form_nombre').value) || isEmpty(document.getElementById('form_apellido_paterno').value))
	{
		alert('Debe ingresar al menos nombre y apellido paterno');
		document.main.form_nombre.focus();
		return false;
	}   
	if(isEmpty(document.getElementById('form_afiliacion').value))
	{
		alert('Debe afiliacion');
		document.main.form_afiliacion.focus();
		return false;
	}   
	if(isEmpty(document.getElementById('form_email').value) || !checkMail(document.getElementById('form_email').value))
	{
		alert('La direccion de email debe ser valida');
		document.main.form_email.focus();
		return false;
	}	
	process('{opcion_modulo}|guardar',0);	 
}


function ajusteAnexo()
{ 	
	if(trim(document.main.form_anexo_numero.value) != '')
	{
		selectValue('form_anexo','si');
		document.main.form_telefono.value = "+56 2 297 "+document.main.form_anexo_numero.value;
	}
	else
	{
		selectValue('form_anexo','no');
	}
}
ajusteAnexo();
function anexoSeleccion()
{ 
	if(document.main.form_anexo.value == 'no')
	{
		document.main.form_anexo_numero.value = "";
	} 
}
anexoSeleccion(); 

function activoSeleccion()
{
	
	if('{activo}' == '1')
	{
		selectValue('form_activo','1'); 
	}
	else
	{
		if('{activo}' == '')
			selectValue('form_activo','1');
		else
			selectValue('form_activo','0');
	} 
}
activoSeleccion();

function nombreReferenciaNuevo()
{
	if(document.main.id_item.value == '')
	{
		nombreReferencia();
	}
}
function nombreReferencia()
{
	var aux = document.main.form_nombre.value;
	document.main.form_nombre_publicacion.value = trim(document.main.form_apellido_paterno.value) + ', ' + aux.substring(0,1) + '.';		
}
if(trim(document.main.form_nombre_publicacion.value) == '')
{	
	nombreReferencia()
}
</script>
{tag_volver}