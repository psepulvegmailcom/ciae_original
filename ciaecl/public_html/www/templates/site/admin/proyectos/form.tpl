
{tag_volver}
<div class="fieldset_title">{caso_form} Proyecto</div>
	
{mensaje_guardar}



<fieldset id='formulario_admin'> 
	 	<div>
		<label>		Proyecto  </label><br  /> 
		<textarea rows="2" cols="135" name="form_proyecto" id='form_proyecto'>{proyecto}</textarea>
		
	</div>	 
	<div>
		<label>		C&oacute;digo </label><br  />
		<input type="text"   name="form_codigo"  id="form_codigo"  value="{codigo}" maxlength="250" style="width: 280px;"> 
	</div>
	 
	<div>
		<label>		Periodo</label>
		A&ntilde;o Inicio <input type="text"   name="form_agno_inicio"  id="form_agno_inicio"  value="{agno_inicio}" maxlength="11" >
		
		A&ntilde;o Termino <input type="text"   name="form_agno_termino"  id="form_agno_termino"  value="{agno_termino}" maxlength="11"> 

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
		<label>		&aacute;reas CIAE</label><br  />
		<ul>
		<!-- START BLOCK : bloque_form_area_ciae -->
		<li>{area}</li>
		<!-- END BLOCK : bloque_form_area_ciae -->
		</ul>
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