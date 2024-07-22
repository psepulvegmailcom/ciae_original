<div  class="fieldset_title_separador">Identificación Legal</div> 

<div class="fieldset_title"  id='titulo_revision_registros_externos' >
<img src="images/iconos/revision{revision_registros_externos_estado_revision_img}.gif" /> Registros Inscrito  </div>
	 
<a href="javascript:AbrirBloqueRevision('bloque_revision_registros_externos');">Ver Datos</a>
<div  id='bloque_revision_registros_externos' class="div_oculto">
<fieldset>
	<div>
	<div class="fieldset_title_interno">Datos Postulación</div> 
	
		<label>Registros Seleccionados</label>
		  <br  />  
			 
			 	<select  name="ate_legal_otro_registros[]"  disabled="disabled" multiple="multiple" size="6" style="height:auto"  onchange="javascript:chequeo2otroregistro();" >
			<!-- START BLOCK : bloque_ate_legal_otro -->
			 
			<option value="{ate_legal_otro_id}" {ate_legal_otro_selected}  >{ate_legal_otro_registro}</option>
			<!-- END BLOCK : bloque_ate_legal_otro -->
			
			<option value="otro" {ate_legal_otro_registro_selected} >OTRO REGISTRO</option>
			  </select>
		<br />
		<label>Otro</label> {otro_registros_otro} 
		
		<div   class="{modificacion_div_ocultos}">
		 <span class="span_modificacion" >Modificación</span> <input {revision_registros_externos_modificacion_solo_lectura} type="text" name="revision_registros_externos_campo_revision"   onchange="javascript:modificacionTexto('revision_registros_externos_campo_revision');" maxlength='255' value="{revision_registros_externos_campo_revision}" /> 
		 <a href="javascript:convertirMinusculaInput('revision_registros_externos_campo_revision','{revision_registros_externos_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 </div>
		 
	</div>
	{revision_registros_externos_formulario} 
	</fieldset>
<a href="javascript:CerrarBloqueRevision('revision_registros_externos');">Ocultar Datos</a>
	</div>



	 
{tpl_documentos_tipo_oferente}
 
 

	