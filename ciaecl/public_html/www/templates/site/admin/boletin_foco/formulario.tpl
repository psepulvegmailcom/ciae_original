

	<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->		
		<fieldset id='formulario_admin'> 	  
	<!--div class="fieldset_campos">
		<label>		A&ntilde;o </label>  
		<input name="form_agno" id="form_agno" class="inputtext"  maxlength="100"   value="{agno}">  
	</div-->
       	<div>
		<label>	Noticia </label><br  />
		<select name="form_id_noticia"  id="form_id_noticia"    > 
        <option value=""></option>
		 <!-- START BLOCK : bloque_form_id_noticia-->
		 <option value="{id_noticia}" {selected}>{titulo}</option>
		 <!-- END BLOCK : bloque_form_id_noticia -->
		</select>
	</div> 
    <div class="fieldset_campos">
		<label>		T&iacute;tulo </label>  
		<input name="form_titulo" id="form_titulo" class="inputtext"  maxlength="300"   value="{titulo}">  
	</div>
    <div class="fieldset_campos">
    <label>		A&ntilde;o  </label><br  />
    <select name="form_agno"  id="form_agno"    > 
			<option value=""></option>
		 <!-- START BLOCK : bloque_form_agno -->
		 <option value="{agno}" {selected}>{agno}</option>
		 <!-- END BLOCK : bloque_form_agno-->
	</select>
    </div>
    
    <div class="fieldset_campos">
    <label>		Mes  </label><br  />
    <select name="form_mes"  id="form_mes"    > 
			<option value=""></option>
		 <!-- START BLOCK : bloque_form_mes -->
		 <option value="{mes}" {selected}>{mes}</option>
		 <!-- END BLOCK : bloque_form_mes-->
	</select>
    </div>
	<div class="fieldset_campos">
		<label>		Bolet&iacute;n en foco</label>
        <!--input class="inputtext" type="file" name="form_imagen"  /-->
            <input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
                <ul id="lista-archivoUnico1">	                </ul>
            <input type="hidden" id="ruta_archivo1" value="{path_archivo}" name="ruta_archivo1"/>
            
			<input type="hidden" id="nombre_campo_archivo1" value="form_imagen" name="nombre_campo_archivo1"/>
			
		 
        <!-- START BLOCK : bloque_form_archivo --> 
        
        <div>
   
<a     class="open_view"  id='popup_interno_pdf_interno_boletin' data-type="download.php?file=boletin/{boletin_archivo}">
            <img  border=0 src="www/images/iconos/download_act.png"> Ver archivo actual</a>    
	   </div>
       

     
        <input type="hidden" name="form_archivo" id="form_archivo" value="{boletin_archivo}"> 
		<!-- END BLOCK : bloque_form_archivo -->
	</div>
	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
	<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button>
	</fieldset>


<input type="hidden" name="id_boletin_nuevo" value="{id_boletin_nuevo}" />
<input type="hidden" value="{boletin_id}" name="valor_id" id="valor_id" />
<input  class="inputtext" type="hidden" name="id_item" value="{id_boletin}" id="id_item" />


<script type="text/javascript">
 
function editElement()
{   
	if(!validacionCampoTextoSimple('form_id_noticia'))
	{
		return false;
	} 	

  
	if(!validacionCampoTextoSimple('form_agno') || !validacionCampoTextoSimple('form_mes'))
	{
		return false;
	} 	
  		
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}