
	<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->
		<fieldset id='formulario_admin'> 
	 	 
	<div class="fieldset_campos">
		<label>		T&iacute;tulo </label><br  />
		<input  class="inputtext" type="text"   name="form_titulo"  id="form_titulo"  value="{titulo}" maxlength="250"  > 
	</div>
	
	<div class="fieldset_campos">
		<label>		Bajada </label><br  />
		<textarea  class="inputtext" type="text"   name="form_bajada"  id="form_bajada" rows="7"  >{bajada}</textarea> 
	</div>
    <div class="fieldset_campos">
		<label>		Descripci&oacute;n  </label><br  />
		<textarea class="inputtext" name="form_descripcion" id='form_descripcion' rows="7" >{descripcion}</textarea>		
	</div>
    	<div class="fieldset_campos">
		<label>		 Autor </label> <br  />
		<input  class="inputtext" type="text"   name="form_autor"  id="form_autor"  value="{autor}" maxlength="250"  > 
	</div>
    	<div class="fieldset_campos">
		<label>		 Editorial </label> <br  />
		<input  class="inputtext" type="text"   name="form_editorial"  id="form_editorial"  value="{editorial}" maxlength="250"  > 
	</div>
    	<div class="fieldset_campos">
		<label>		 P&aacute;ginas </label> <br  />
		<input  class="inputtext" type="text"   name="form_paginas"  id="form_paginas"  value="{paginas}" maxlength="250"  > 
	</div>
    	<div class="fieldset_campos">
		<label>		 Isbn </label> <br  />
		<input  class="inputtext" type="text"   name="form_isbn"  id="form_isbn"  value="{isbn}" maxlength="250"  > 
	</div>			
    	<div class="fieldset_campos">
		<label>		 Extra </label> <br  />
		<textarea class="inputtext" name="form_extra"  id="form_extra"rows="3"  > {extra}
			</textarea>
	</div>
    	<div class="fieldset_campos">
		<label>		 Iframe </label> <br  />
		<textarea class="inputtext" name="form_iframe"  id="form_iframe"rows="4"  > {iframe}
			</textarea>
	</div> 			
    <div class="fieldset_campos">
	  <label>		A&ntilde;o </label>
	  <br  />
	  <!-- <input  class="inputtext" type="text"   name="form_agno"  id="form_agno"  value="{agno}" maxlength="250"  > -->
	  
	  <select name="form_agno">
	  <option value="{agno}" selected>{agno}</option>
	  <!-- START BLOCK : bloque_agno_recurso -->
	  <option value="{agno_list}"  >{agno_list}</option>
	  <!-- END BLOCK : bloque_agno_recurso --> 
	  </select>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	</div>    
    
			<div><label>Los elementos de video, archivo e imagen, son opcionales, en el caso de subir un video la imagen no se mostrar&aacute; en la versi&oacute;n p&uacute;blica.</label></div>
    
   <div class="fieldset_campos">
		<label>		 Archivo </label>
		<br>
 
			<input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
			<ul id="lista-archivoUnico1">			</ul>
			<div id="responseArchivoUnico1"></div>
			<input type="hidden" id="ruta_archivo1" value="{path_recurso}" name="ruta_archivo1"/>
			<input type="hidden" id="nombre_campo_archivo1" value="form_archivo" name="nombre_campo_archivo1"/>
			<input type="hidden" name="form_archivo" id="form_archivo" value="{archivo}">
            
	<!-- START BLOCK : bloque_archivo_anterior -->
	<div>
   
<a     class="open_view"  id='popup_interno_pdf_interno_recursos' data-type="download.php?file=recursos/{archivo}">
            <img  border=0 src="www/images/iconos/download_act.png"> Ver archivo actual</a>
	   </div>
	<!-- END BLOCK : bloque_archivo_anterior -->

	</div> 
    
  <div class="fieldset_campos">
		<p>
		<label>		Video </label>
		
		<br  />
		(Para que este video se visualice en videos destacados de sitio, debe seleccionar sitio y destacar)
		<br  />
		https://www.youtube.com/watch?v=<input  type="text"   name="form_video"  id="form_video"  value="{video}" maxlength="50"  > 
	</p>
		<p>ej: https://www.youtube.com/watch?v=<strong>TqXMQVNiedQ</strong></p>
  </div> 

<div class="fieldset_campos">
		<p>
		<label>		Video Lista/Otro </label>
		<br  />
		<input  class="inputtext"type="text"   name="form_video_lista"  id="form_video_lista"  value="{video_lista}" maxlength="250"  > 
	</p>
		<p>ej: <strong>https://youtube.com/playlist?list=PLuppcB1HklPCeHLh_dCc1r2gTGg4YRP_q</strong></p>
  </div>			
			
 	 	<div class="fieldset_campos">
		<label>		Link libro digital </label>  <br  />
		<input  class="inputtext" type="text"  placeholder="Ej: http://www.repositorio/libro_digital1.cl"   name="form_libro_digital"  id="form_libro_digital"  value="{libro_digital}" maxlength="250"  > 
	</div> 
			
       	<div>
		<label>		Imagen</label><br  />
			<input type="file" class="imagenMultiple" id="images1" name="images[]"/>
			<ul id="lista-imagenes1">				</ul>
			<div id="response1"></div>
			<input type="hidden" id="ruta_imagen" value="{path_imagen}" name="ruta_imagen"/>
			<input type="hidden" id="nombre_campo_imagen1" value="form_imagen" name="nombre_campo_imagen1"/>
			<input type="hidden" name="form_imagen" id="form_imagen" value="{imagen}"> 
			
			
	<!-- START BLOCK : bloque_imagen_anterior -->
	<div>
   
<a     class="open_view"  id='popup_interno_img_interno_recursos' data-type="imageview.php?image=recursos/{imagen}">
            <img  border=0 src="www/images/iconos/download_act.png"> Ver imagen actual</a>
	   </div>
	<!-- END BLOCK : bloque_imagen_anterior -->
	</div>
 	
 	 	<div class="fieldset_campos">
		<label>		Texto link externo </label>  <br  />
		<input  class="inputtext" type="text"  placeholder="Ej: Ver link externo, Revisar entrevista, etc"   name="form_link_externo_texto"  id="form_link_externo_texto"  value="{link_externo_texto}" maxlength="250"  > 
	</div> 
	<div class="fieldset_campos">
		<label>		Link externo </label> (incluir prefijo http:// o https:// completo)<br  />
		<input  class="inputtext" type="text"   name="form_link_externo"  id="form_link_externo"  value="{link_externo}" maxlength="250"  > 
	</div> 
 	
 	
  	<div class="fieldset_campos" id="form_idioma_id_focus">
		<label>		Idioma  </label> 
        <div>
		<input type="radio" name='form_idioma' value="es" {checked_idioma_es}> Espa&ntilde;ol<br>
		<input type="radio" name='form_idioma' value="en" {checked_idioma_en}> Ingl&iacute;s<br> 
		<input type="radio" name='form_idioma' value="nn" {checked_idioma_nn}> Neutro<br> 
			
			 
		</div>
	</div>
    
     
    <div class="fieldset_campos">
	  <label>		Fecha </label><br  />
		<input  class="inputtext" type="text"   name="form_fecha"  id="form_fecha"  value="{fecha_html}" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div>
	<div class="fieldset_campos">
		<label>		Palabras Clave </label> (ingresar separadas por coma ,  )<br  />
		<input  class="inputtext" type="text"   name="form_palabras_clave"  id="form_palabras_clave"  value="{palabras_clave}" maxlength="850"  > 
	</div>  
			
			
	<!-- START BLOCK : bloque_sitios_usuarios -->
	{contenido}
	<!-- END BLOCK : bloque_sitios_usuarios -->

	   
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span>
</button> 
  
	
	 	</fieldset>
 

<input type="hidden" name="form_time_ingreso" value="{fecha_ingreso}" />
<input type="hidden" name="form_usuario" value="{usuario}" />
 

<script type="text/javascript">

document.main.id_item.value = '{id_item}';
document.main.item_id.value = '{prefijo_nombre_extra_archivo}'+document.main.id_item.value;
	
function editElement()
{      
	<!-- START BLOCK : bloque_sitios_usuarios_validacion -->
	{contenido} 
	<!-- END BLOCK : bloque_sitios_usuarios_validacion -->
		
	if(!validacionCampoTextoSimple('form_titulo'))
	{
		return false;
	} 
	if(!validacionCampoTextoSimple('form_bajada'))
	{
		return false;
	} 
	if(!validacionCampoTextoSimple('form_fecha'))
	{
		return false;
	}     
	if(!validacionCampoTextoSimple('form_palabras_clave'))
	{
		return false;
	}     
	
	if(!validacionCampoCheckedSimple('form_idioma'))
	{
		return false;
	}        
/*	if(trim(document.main.form_link_externo.value) != '')
	{
		if(!validacionCampoCheckedSimple('form_link_externo_texto'))
		{
			return false;
		}
	} 
	if(trim(document.main.form_link_externo.value) != '')
	{
		if(!validacionCampoCheckedSimple('form_link_externo'))
		{
			return false;
		}
	} */
	 

		
	enviar_accion_admin('{opcion_modulo}|guardar',document.main.id_item.value);	 
}
</script>
{tag_volver}