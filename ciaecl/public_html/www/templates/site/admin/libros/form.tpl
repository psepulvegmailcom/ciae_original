
{tag_volver}
<div class="fieldset_title">{caso_form} Publicaci&oacute;n</div>
	
{mensaje_guardar}



<fieldset id='formulario_admin'> 
	 
	 
	<div>
		<label>		T&iacute;tulo Libro  </label><br  />
		<textarea cols="135" rows="2" name="form_titulo" id='form_titulo'>{titulo}</textarea>  
	</div>

	<!--div>
		<label>		T&iacute;tulo en ingl&eacute;s  </label><br  />
		<textarea class="textarea_simple" name="form_titulo_en" id='form_titulo_en'>{titulo_en}</textarea>  
	</div>
	<div>
		<label>		Resumen </label><br  />
		<textarea class="textarea_revision" name="form_resumen" id='form_resumen'>{resumen}</textarea>  
	</div-->
	
	
	<div>
		<label>		TIPO  </label><br  />
		<input type="radio" name='form_id_tipo' value="2" {checked_id_tipo_2}> Libro &nbsp;&nbsp;
		<input type="radio" name='form_id_tipo' value="4" {checked_id_tipo_4}> Cap&iacute;tulo Libro &nbsp;&nbsp;
	</div>
	
	<div>
		<label>	Cap&iacute;tulo de libro  </label><br  />
		 <textarea cols="135" rows="2" name="form_bib_capitulo" id='form_bib_capitulo'>{bib_capitulo}</textarea>  
	</div>
	
	<div>
		<label>	P&aacute;ginas  </label><br  />
		 <textarea cols="50" rows="1" name="form_bib_paginas" id='form_bib_paginas'>{bib_paginas}</textarea>  
	</div>				
	<!--div>
		<label>		Mes (en texto)</label><br  />
		<!--<input  class="inputtext" type="text"   name="form_mes"  id="form_mes"  value="{mes}" maxlength="50" > -->
        
        
        <!--select name="form_mes">
        <option value="{mes}">{mes}</option>
        <option value="Enero">Enero</option>
        <option value="Febrero">Febrero</option>
        <option value="Marzo">Marzo</option>
        <option value="Abril">Abril</option>        
        <option value="Mayo">Mayo</option>
        <option value="Junio">Junio</option>
        <option value="Julio">Julio</option>
        <option value="Agosto">Agosto</option>
        <option value="Septiembre">Septiembre</option>
        <option value="Octubre">Octubre</option>
        <option value="Noviembre">Noviembre</option>
        <option value="Diciembre">Diciembre</option>
        </select>
	</div-->
	<!--div-->
		<!--label>		Mes (en n&uacute;mero)</label><br  />
		<!--<input  class="inputtext" type="text"   name="form_mes_numero"  id="form_mes_numero"  value="{mes_numero}" maxlength="11" > -->
        <!--select name="form_mes_numero">
        <option value="{mes_numero}">{mes_numero}</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>        
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        </select>
	</div-->
	<div>
		<label>		Editor</label><br  />
		<input  class="inputtext" type="text"   name="form_bib_editor"  id="form_bib_editor"  value="{bib_editor}" maxlength="150" > 
	</div>	
	<div>
		<label>		A&ntilde;o </label><br  />
		<input type="text" name="form_agno"  id="form_agno"  value="{agno}" maxlength="11" > 
		<input hidden type="radio" name='form_documento_publico' value="si" checked>
	</div>	
	<!--div>
		<label>		Detalle de publicaci&oacute;n (numero p&aacute;ginas, editorial, etc) </label><br  />
		<textarea class="textarea_revision" name="form_texto" id='form_texto'>{texto}</textarea>  
	</div-->
	<!--div>
		<label>		Archivo de publicaci&oacute;n</label><br  />
		<input type="file" name="form_documento"><br>
		Archivo actual<a href="download.php?file=publicaciones/{documento}" style="border:0px "><img src="www/images/filetypes/pdf.png" style="width:32px " border="0"> </a>
	</div>
    
	<div>
		<label>		¿Se puede publicar el archivo en versi&oacute;n p&uacute;blica del sitio web?  </label><br  />
		<input hidden type="radio" name='form_documento_publico' value="si" {checked_documento_publico_si}> Si, se puede publicar<br>
		<input type="radio" name='form_documento_publico' value="no" {checked_documento_publico_no}> No, no se puede publicar<br> 
	</div-->
    <!--div>
		<label>		Factor q</label><br  />
		<!--<input  class="inputtext" type="text"   name="form_mes_numero"  id="form_mes_numero"  value="{mes_numero}" maxlength="11" > -->
        <!--select name="form_factor_Q">
        <option value="{factor_Q}">{factor_Q}</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>  
        </select>
	</div-->
	<!--div>
		<label>		Cooperaci&oacute;n nacional</label><br  />
		<input  class="inputtext" type="text"   name="form_cooperacion_nacional"  id="form_cooperacion_nacional"  value="{cooperacion_nacional}" maxlength="50" > 
	</div>
	<div>
		<label>		Cooperaci&oacute;n internacional</label><br  />
		<input  class="inputtext" type="text"   name="form_cooperacion_internacional"  id="form_cooperacion_internacional"  value="{cooperacion_internacional}" maxlength="50" > 
	</div-->
	
	
	<div>
		<label>		Ciudad </label>
		<input class="inputtext" type="text"  name="form_bib_ciudad"  id="form_bib_ciudad"  value="{bib_ciudad}" maxlength="25" >
		</div>
	<div>
		<label>		Pa&iacute;s </label>	
		<input class="inputtext" type="text"   name="form_bib_pais"  id="form_bib_pais"  value="{bib_pais}" maxlength="35"> 

	</div>
	<div>
		<label>		Editorial </label>	
		<input class="inputtext" type="text"   name="form_bib_editorial"  id="form_bib_editorial"  value="{bib_editorial}" maxlength="25"> 

	</div>	
	<!--div>
		<label>		URL externo</label><br  />
		<input  class="inputtext" type="text"   name="form_link"  id="form_link"  value="{link}" maxlength="250" > 
	</div-->	
	<!--div>
		<label>		Tipo de Publicaci&oacute;n </label><br  />
		<select name="form_id_tipo"  id="form_id_tipo"    > 
		 <!-- START BLOCK : bloque_form_id_tipo_publicacion -->
		 <!--option value="{id_tipo}" {selected}>{tipo}</option>
		 <!-- END BLOCK : bloque_form_id_tipo_publicacion -->
		<!--/select-->
	<!--/div-->
	<!--div>
		<label>		N&uacute;mero (Solo para documentos de trabajo)</label><br  />
		<input  class="inputtext" type="text"   name="form_numero"  id="form_numero"  value="{numero}" maxlength="11" > 
        
        
	</div-->	
	<div>
		<label>		&aacute;rea CIAE  </label><br  />
		<select name="form_id_area"  id="form_id_area"    > 
		 <option value="0" {selected}></option> 
		 <!-- START BLOCK : bloque_form_id_area -->
		 <option value="{id_area}" {selected}>{area}</option>
		 <!-- END BLOCK : bloque_form_id_area -->
		</select>
	</div>
	<div>
		<!--label>		Destacado (** opci&oacute;n para sitio web p&uacute;blico) </label><br  />
		<input  type="radio" name='form_destacado' value="1" {checked_destacado_1}> Destacado<br>
		<input type="radio" name='form_destacado' value="0" {checked_destacado_0}> No destacado<br--> 
		<input hidden type="radio" name='form_ver_detalle' value="0" checked>
		<input hidden type="radio" name='form_activo' value="1" checked>
	</div>
	<!--div>
		<label>		Ver detalle (para que se pueda ver la ficha )  (** opci&oacute;n para sitio web p&uacute;blico)  </label><br  />
		<input type="radio" name='form_ver_detalle' value="1" {checked_ver_detalle_1}> Ver detalle<br>
		<input type="radio" name='form_ver_detalle' value="0" {checked_ver_detalle_0}> No ver detalle<br> 
	</div-->  
	<!--div>
		<label>		Visible (** opci&oacute;n para sitio web p&uacute;blico)  </label><br  />
		<input  type="radio" name='form_activo' value="1" {checked_activo_1}> Visible<br>
		<input type="radio" name='form_activo' value="0" {checked_activo_0}> No visible<br> 
	</div-->
	    <!--div class="fieldset_campos">
		<label>		Palabras Clave </label> (ingresar separadas por coma ,  )<br  />
		<input  class="inputtext" type="text"   name="form_palabras_clave"  id="form_palabras_clave"  value="{palabras_clave}" maxlength="850"  > 
	</div--> 
	<!-- INCLUDE BLOCK : www/templates/site/admin/form_personas_sin_cargo.tpl -->
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	
	 	</fieldset>
	  
<input type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">

function editElement()
{      
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}