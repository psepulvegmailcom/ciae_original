
		<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->
		<fieldset id='formulario_admin'> 
	 
	 
	<div class="fieldset_campos">
		<label>		T&iacute;tulo </label><br  />
		<input  class="inputtext" type="text"   name="form_titulo"  id="form_titulo"  value="{titulo}" maxlength="250"  > 
	</div>
	
	<div class="fieldset_campos">
		<label>		Bajada </label><br  />
		<input  class="inputtext" type="text"   name="form_bajada"  id="form_bajada"  value="{bajada}" maxlength="250"  > 
	</div>
		<div class="fieldset_campos">
		<label>		Medio </label><br  />
		<input  class="inputtext" type="text"   name="form_medio"  id="form_medio"  value="{medio}" maxlength="250"  > 
	</div>
		<div class="fieldset_campos">
		<label>		Tema </label><br  />
		<input  class="inputtext" type="text"   name="form_tema"  id="form_tema"  value="{tema}" maxlength="250"  > 
	</div>
 		
	 	<div>
		<label>		Tipo de Medio  </label><br  />
		<select name='form_tipo_medio' id="form_tipo_medio"> 
		 <option value="Tv"  >TV</option> 
		 <option value="Radio"  >Radio</option>
         <option value="Web"  >Web</option>
         <option value="Prensa escrita"  >Prensa escrita</option>
         <option value="Otro"  >Otro</option>
		 <option value="{tipo_medio}"  selected > {tipo_medio} </option>		
		</select>		
	</div> 

	 	<div>
		<label>		Tipo de Cobertura  </label><br  />
		<select name='form_tipo_cobertura' id="form_tipo_cobertura"> 
		 <option value="Cronica"  >Cr&oacute;nica</option> 
		 <option value="Entrevista"  >Entrevista</option>
         <option value="Opinion"  >Opini&oacute;n</option>
         <option value="Difusion"  >Difusi&oacute;n</option>
		 <option value="{tipo_cobertura}"  selected > {tipo_cobertura} </option>		
		</select>		
	</div> 
	
		<div class="fieldset_campos">
		<label>		Investigador </label><br  />
		<input  class="inputtext" type="text"   name="form_investigador"  id="form_investigador"  value="{investigador}" maxlength="250"  > 
	</div>	
 	
	 	<div>
		<label>		Tipo Aparici&oacute;n  </label><br  />
		<select name='form_tipo_aparicion' id="form_tipo_aparicion"> 
		 <option value="Compartida"  >Compartida</option> 
		 <option value="Exclusiva"  >Exclusiva</option>
		 <option value="{tipo_aparicion}"  selected > {tipo_aparicion} </option>		
		</select>		
	</div> 			
	<div class="fieldset_campos">
		<label>		Url </label>(ingresar completa con http://)<br  />
		<input  class="inputtext" type="text"   name="form_url"  id="form_url"  value="{url}" maxlength="250"  > 
	</div>
		 
	<div class="fieldset_campos">
		<label>		Fecha </label><br  />
		<input  class="inputtext" type="text"   name="form_fecha"  id="form_fecha"  value="{fecha_html}" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div>
		<div>
		<label>		&aacute;rea CIAE  </label><br  />
		<select name="form_id_area"  id="form_id_area"    > 
		 <option value="6" {selected}></option> 
		 <!-- START BLOCK : bloque_form_id_area -->
		 <option value="{id_area}" {selected}>{area}</option>
		 <!-- END BLOCK : bloque_form_id_area -->
		</select>
	</div>
	
	 
	
	
	
	<div class="fieldset_campos">
		<label>		Documento respaldo </label> 
            <input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
        <input type="hidden" name="form_pdf" id="form_pdf" value="{pdf}"> 
                <ul id="lista-archivoUnico1">	                </ul>
            <input type="hidden" id="ruta_archivo1" value="{path_archivo}" name="ruta_archivo1"/>
            
			<input type="hidden" id="nombre_campo_archivo1" name="nombre_campo_archivo1" value="form_pdf"/>
			
		 
        <!-- START BLOCK : bloque_form_archivo --> 
        
        <div>   
        
<a     class="open_view"  id='popup_interno_pdf_interno_enlaprensa' data-type="download.php?file=en_la_prensa/{pdf}" >
            <img  border=0 src="www/images/iconos/download_act.png"> Ver archivo actual</a>      
	   </div>
       
		<!-- END BLOCK : bloque_form_archivo -->
	</div>
	
	
	
	
	<!-- START BLOCK : bloque_sitios_usuarios -->
	{contenido}
	<!-- END BLOCK : bloque_sitios_usuarios -->
	
	
	
	
	<div class="fieldset_campos">
		<label>		Palabras Clave </label> (ingresar separadas por coma <strong>","</strong>. Agregue los nombre de las personas relacionadas)<br  />
		<input  class="inputtext" type="text"   name="form_palabras_clave"  id="form_palabras_clave"  value="{palabras_clave}" maxlength="850"  > 
	</div>  
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>
 


 



<input  class="inputtext" type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">

function editElement()
{    
	
	<!-- START BLOCK : bloque_sitios_usuarios_validacion -->
	{contenido}
	<!-- END BLOCK : bloque_sitios_usuarios_validacion -->
		
	if(isEmpty(document.getElementById('form_titulo').value))
	{
		alert('Debe ingresar el titulo');
		document.main.form_titulo.focus();
		return false;
	}    
	if(isEmpty(document.getElementById('form_fecha').value))
	{
		alert('Debe ingresar el fecha');
		document.main.form_fecha.focus();
		return false;
	}    
	if(isEmpty(document.getElementById('form_url').value))
	{
		alert('Debe ingresar el url');
		document.main.form_url.focus();
		return false;
	}    
	if(isEmpty(document.getElementById('form_medio').value))
	{
		alert('Debe ingresar el medio');
		document.main.form_medio.focus();
		return false;
	}    
	enviar_accion_admin('{opcion_modulo}|guardar',document.main.id_item.value);	 
}
</script>
{tag_volver}