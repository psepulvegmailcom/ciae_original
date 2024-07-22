

	<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->		
		<fieldset id='formulario_admin'> 	  
	<div class="fieldset_campos">
		<label>		Titulo </label>  
		<input name="form_titulo" id="form_titulo" class="inputtext"  maxlength="100"   value="{titulo}">  
	</div>
	<div class="fieldset_campos">
		<label>		Bajada </label> 
		<input name="form_bajada" id="form_bajada"  class="inputtext"  maxlength="100"   value="{bajada}">  
	</div>
	<div class="fieldset_campos"  id="form_tipo_id_focus">
		<label>		Tipo  </label> 
		<input  type="radio" name='form_tipo' value="principal" {checked_tipo_principal}> Principal<br>
		<input type="radio" name='form_tipo' value="pie" {checked_tipo_pie}> Pie<br> 	
		</div>	
	<div class="fieldset_campos"  id="form_activo_id_focus">
		<label>		Estado  </label> 
		<input  type="radio"   name='form_activo' value="1" {checked_activo_1}> Publicado<br>
		<input type="radio" name='form_activo' value="0" {checked_activo_0}> No Publicado<br> 
	</div>
	<div class="fieldset_campos"  id="form_idioma_id_focus">
		<label>		Idioma  </label> 
		<input  type="radio"   name='form_idioma' value="es" {checked_idioma_es}> Espa&ntilde;ol<br>
		<input type="radio" name='form_idioma' value="en" {checked_idioma_en}> Ingles<br> 
	</div>
	<div class="fieldset_campos">
		<label>		 Imagen </label>(dimensiones para banner prinicpal 900px/485px, pie 900px/148px, o tama&ntilde;os proporcionales)<br>
        <!--input class="inputtext" type="file" name="form_imagen"  /-->
            <input type="file" class="imagenMultiple" id="images1" name="images[]"/>
                <ul id="lista-imagenes1">	                </ul>
            <div id="response1"></div>
            <input type="hidden" id="ruta_imagen" value="{path_imagen}" name="ruta_imagen"/>
            
			<input type="hidden" id="nombre_campo_imagen1" value="form_imagen" name="nombre_campo_imagen1"/>
			<input type="hidden" name="form_imagen" id="form_imagen" value="{imagen}"> 
		 
        <!-- START BLOCK : bloque_form_imagen --> 
        <div>
   
<a     class="open_view" id='popup_interno_img_interno_banner' data-type="imageview.php?image=banner/{banner_imagen}">
            <img  border=0 src="www/images/iconos/download_act.png"> Ver imagen actual</a>
	   </div>
        
		<!-- START BLOCK : bloque_form_imagen -->
	</div>
	    <div class="fieldset_campos">
	  <label>		Fecha caducidad </label> (si no se define, no se desactivara automaticamente)<br  />
		<input  class="inputtext" type="text"   name="form_fecha_caducidad"  id="form_fecha_caducidad"  value="{fecha_caducidad_html}" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha_caducidad,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div>
	<div class="fieldset_campos">
		<label> Link</label>   		 
        <input class="inputtext" type="text"   name="form_link"  id="form_link" value="{link}" ></input>  		
    </div> 
	<div>
		<label>		Sitio </label><br  />
		<select name="form_id_site"  id="form_id_site"    > 
		 <!-- START BLOCK : bloque_form_id_site -->
		 <option value="{id_site}" {selected}>{titulo_site}</option>
		 <!-- END BLOCK : bloque_form_id_site -->
		</select>
	</div>    
	<div>
		<label>		Orden  </label><br  />
		<select name="form_orden"  id="form_orden"    > 
			<option value=""></option>
		 <!-- START BLOCK : bloque_form_orden -->
		 <option value="{orden}" {selected}>{orden}</option>
		 <!-- END BLOCK : bloque_form_orden-->
		</select>
	</div>     	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
	<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button>
	</fieldset>


<input type="hidden" name="id_banner_nuevo" value="{id_banner_nuevo}" />
<input type="hidden" value="{banner_id}" name="valor_id" id="valor_id" />
<input  class="inputtext" type="hidden" name="id_item" value="{id_banner}" id="id_item" />


<script type="text/javascript">
 
function editElement()
{     
	if(!validacionCampoTextoSimple('form_titulo'))
	{
		return false;
	} 	
	if(!validacionCampoCheckedSimple('form_tipo'))
	{
		return false;
	}   	
	if(!validacionCampoCheckedSimple('form_activo'))
	{
		return false;
	}   
	if(!validacionCampoCheckedSimple('form_idioma'))
	{
		return false;
	}   
	if(!validacionCampoTextoSimple('form_link'))
	{
		return false;
	} 
	if(!validacionCampoTextoSimple("form_id_site"))
	{
		return false;
	}  
	if(trim(document.main.form_imagen.value) == '')
	{
		alert('Debe ingresar imagen');
		return false;
	}  
	if(!validacionCampoTextoSimple("form_orden"))
	{
		return false;
	}  	
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}