

	<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->		
		<fieldset id='formulario_admin'> 	  

 
    <div class="fieldset_campos"> 
		<label>		Men&uacute;</label>   
		<input name="texto" id="texto" class="inputtext"  maxlength="100"   value="{id_texto}" disabled>  
	</div>
    <div class="label_fieldset">
    <label>		texto espa&ntilde;ol  </label><br  />
    {form_texto_editor}
    <textarea class="texto_edicion"  type="text"   name="form_texto_es"  id="form_texto_es"  style="height:200px " >{texto_es} </textarea> 
    </div>
    <div class="fieldset_campos">
    <label>		texto ingl&eacute;s  </label><br  />
 
<textarea  class="texto_edicion" type="text"   name="form_texto_en"  id="form_texto_en" rows="7"  >{texto_en}</textarea>   
    </div>   
     <div>
		<label>		Imagen</label><br  />
			<input type="file" class="imagenMultiple" id="images1" name="images[]"/>
			<ul id="lista-imagenes1">				</ul>
			<div id="response1"></div>
			<input type="hidden" id="ruta_imagen" value="{path_imagen}" name="ruta_imagen"/>
			<input type="hidden" id="nombre_campo_imagen1" value="form_imagen" name="nombre_campo_imagen1"/>
			<input type="hidden" name="form_imagen" id="form_imagen" value="{imagen}"> 
			
			
	<!-- START BLOCK : bloque_form_imagen -->
	<div>
   
<a     class="open_view"  id='popup_interno_img_interno_noticias' data-type="imageview.php?image=noticias/{imagen}">
            <img  border=0 src="www/images/iconos/download_act.png"> Ver imagen actual</a>
	   </div>
	<!-- END BLOCK : bloque_form_imagen -->
	</div>
	
	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
	<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button>
	</fieldset>


<input type="hidden" name="id_texto_nuevo" value="{id_texto_nuevo}" />
<input type="hidden" value="{texto_id}" name="valor_id" id="valor_id" />
<input  class="inputtext" type="hidden" name="id_item" value="{id_texto}" id="id_item" />


<script type="text/javascript">
 
function editElement()
{     
	if(!validacionCampoTextoSimple('form_texto_es') || !validacionCampoTextoSimple('form_texto_en'))
	{
		return false;
	} 	
  		
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}