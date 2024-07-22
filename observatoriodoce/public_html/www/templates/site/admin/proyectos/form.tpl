
{tag_volver}
<div class="fieldset_title">{caso_form} Proyecto</div>
	
{mensaje_guardar}



<fieldset id='formulario_admin'> 
	 	<div>
		<label>		Proyecto (espa&ntilde;ol)  </label><br  /> 
		<textarea class="textarea_simple" name="form_proyecto" id='form_proyecto'>{proyecto}</textarea>
		
	</div>
	<div>
		<label>		Proyecto (ingl&eacute;s)  </label><br  />
		<textarea class="textarea_simple" name="form_proyecto_en" id='form_proyecto_en'>{proyecto_en}</textarea>
		
	</div>
	 
	<div>
		<label>		C&oacute;digo </label><br  />
		<input  class="inputtext" type="text"   name="form_codigo"  id="form_codigo"  value="{codigo}" maxlength="250" > 
	</div>
	 
	<div>
		<label>		A&ntilde;o Inicio </label><br  />
		<input  class="inputtext" type="text"   name="form_agno_inicio"  id="form_agno_inicio"  value="{agno_inicio}" maxlength="11" > 
	</div>
	 
	<div>
		<label>		Mes Inicio </label><br  />
		 <select name="form_mes_inicio">
        
         
		 <option value=""  >--</option>
		 <!-- START BLOCK : bloque_form_id_mes_inicio_proyecto -->
		 <option value="{mes_inicio}" {selected}>{mes_inicio}</option>
		 <!-- END BLOCK : bloque_form_id_mes_inicio_proyecto -->
         </select>
	</div>
	<div>
		<label>		Url </label><br  />
		<input  class="inputtext" type="text"   name="form_url"  id="form_url"  value="{url}" maxlength="250" > 
	</div>
	 
	<div>
		<label>		Antecedentes </label><br  />
		<textarea class="textarea_revision" name="form_antecedentes" id='form_antecedentes'>{antecedentes}</textarea> 
	</div>
	<div>
		<label>		Objetivos </label><br  />
		<textarea class="textarea_revision" name="form_objetivos" id='form_objetivos'>{objetivos}</textarea> 
	</div>
	<div>
		<label>		Metodolog&Iacute;a </label><br  />
		<textarea class="textarea_revision" name="form_metodologia" id='form_metodologia'>{metodologia}</textarea> 
	</div>
	<div>
		<label>		Periodo </label><br  />
		<input  class="inputtext" type="text"   name="form_periodo"  id="form_periodo"  value="{periodo}" maxlength="250" > 
	</div>
	<div>
		<label>		Fuente de financiamiento</label><br  />
		<input  class="inputtext" type="text"   name="form_financiamiento"  id="form_financiamiento"  value="{financiamiento}" maxlength="250" > 
	</div>
	<div>
		<label>		Mandante</label><br  />
		<input  class="inputtext" type="text"   name="form_mandante"  id="form_mandante"  value="{mandante}" maxlength="250" > 
	</div>
	<div>
		<label>		Productos</label><br  />
		<textarea class="textarea_revision" name="form_productos" id='form_productos'>{productos}</textarea> 
	</div>
	<div>
		<label>		Cooperaci&oacute;n nacional con investigadores de otros centros nacionales (especificar)</label><br  />
		<textarea class="textarea_simple" name="form_cooperacion_nacional" id='form_cooperacion_nacional'>{cooperacion_nacional}</textarea> 
	</div>
	<div>
		<label>		Cooperaci&oacute;n internacional con investigadores de centros en el extranjero (especificar)</label><br  />
		<textarea class="textarea_simple" name="form_cooperacion_internacional" id='form_cooperacion_internacional'>{cooperacion_internacional}</textarea> 
	</div> 
	<div>
		<label>		&aacute;reas CIAE</label><br  />
		<ul>
		<!-- START BLOCK : bloque_form_area_ciae -->
		<li>{area}</li>
		<!-- END BLOCK : bloque_form_area_ciae -->
		</ul>
	</div> 

	<div>
		<label>		Visible (en sitio web p&Uacute;blico) </label><br  />
		<input  type="radio" name='form_activo' value="1" {checked_1}> Visible<br>
		<input type="radio" name='form_activo' value="0" {checked_0}> No Visible<br>
		 
		 
		
	</div>
	<div>
		<label>		Tipo Proyecto  </label><br  />
		<select name="form_id_tipo"  id="formexterno_id_tipo"    > 
		 <!-- START BLOCK : bloque_form_id_tipo_proyecto -->
		 <option value="{id_tipo}" {selected}>{tipo}</option>
		 <!-- END BLOCK : bloque_form_id_tipo_proyecto -->
		</select>
	</div>
	<div>
		<label>		Tipo &aacute;rea proyecto  </label><br  />
		<select name="form_id_tipo_area_proyecto"  id="form_id_tipo_area_proyecto"    > 
		<option value="0" {selected}></option>
		 <!-- START BLOCK : bloque_form_id_tipo_area_proyecto -->
		 <option value="{id_tipo}" {selected}>{tipo}</option>
		 <!-- END BLOCK : bloque_form_id_tipo_area_proyecto -->
		</select>
	</div>
	<!-- INCLUDE BLOCK : www/templates/site/admin/form_personas.tpl -->
	 
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