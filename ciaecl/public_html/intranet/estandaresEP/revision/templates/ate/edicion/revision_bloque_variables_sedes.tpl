<!-- START BLOCK : bloque_actualizacion_variables_bloque -->
<div class="fieldset_title" style="font-size:14px" id="titulo_{key}">
<img src="images/iconos/actualizacion{estado}.gif"> Sede {orden}  &nbsp;<small>({tipo_actualizacion}) {fecha_actualizacion_real}</small></div>


 <a href="javascript:AbrirBloqueRevision('bloque_{key}');" >Ver Datos</a>
<div  id='bloque_{key}' class="div_oculto"> 
<fieldset>

 <!-- FORMULARIO DE SEDES -->
  <div id='valores_originales_{key}'  class="{ocultar_original}">
	<div class="fieldset_title_interno">Valores originales   :</div> 
  <strong>Región de sede :</strong><br> {valor_original_region_html}<br>
  <strong>Comuna de sede :</strong><br> {valor_original_comuna_html}<br>
  <strong>Dirección de sede :</strong><br> {direccion_original}<br>
  <strong>Teléfono de sede :</strong><br> {telefono_codigo_original} - {telefono_original}<br>
  <strong>Email de contacto de sede :</strong><br> {email_original}<br>
   
  </div>
   
  

	<div id='valores_actualizados_{key}'>
	
	<div class="fieldset_title_interno">Valores actualizados   :</div>
	<label>Regi&oacute;n de sede</label><br  />
		<select name="ate_nosede_{key}_region_id" {modificacion_solo_lectura_disabled} onchange="javascript:showComuna('ate_nosede_{key}_region_id','ate_sede_{key}_comuna_id');" >
			{ate_sede_region_select}
		</select>
		<span>(*)</span><span>{ayuda_sede_region}</span>	
	 </div>
	 <div>
	<label>Comuna de sede</label><br  />
		<select name="ate_sede_{key}_comuna_id" {modificacion_solo_lectura_disabled} id="ate_sede_{key}_comuna_id">
		{ate_sede_comuna_select}
		</select> 
	 </div>
	 <div>
	<label>Direcci&oacute;n de sede </label><br  />
	
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {direccion}</div>
		<textarea name="ate_sede_{key}_direccion" id="ate_sede_{key}_direccion"   {modificacion_solo_lectura}>{direccion_revision}</textarea>		
		 <a href="javascript:convertirMinusculaInput('ate_sede_{key}_direccion','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
	 </div>
	 <div>
	<label>Tel&eacute;fono y c&oacute;digo de ciudad de la sede</label><br  />
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {telefono_codigo} {telefono}</div>
	<select id="ate_sede_{key}_telefono_codigo"  name="ate_sede_{key}_telefono_codigo"  {modificacion_solo_lectura_disabled}  style="width:60px; "  >
<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_area_option.tpl -->
<option value='{telefono_codigo}' selected="selected" >{telefono_codigo_revision}</option>
</select> 
	
	  <input type="text"  style="width:100px"  maxlength="7"  {modificacion_solo_lectura}  name='ate_sede_{key}_telefono'  id='ate_sede_{key}_telefono'  value="{telefono_revision}"  >		 
	 </div>
	 <div>
	<label>Email de contacto de sede</label><br  />
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {email}</div>
		 <input type="text"  name='ate_sede_{key}_email'   maxlength="255" {modificacion_solo_lectura_disabled} id='ate_sede_{key}_email' value="{email_revision}" >		
		 
	 </div> 
	  
	 
 <!-- FIN FORMULARIO DE SEDES-->
 

<!-- INCLUDE BLOCK : ../templates/ate/edicion/revision_formulario.tpl -->
 </fieldset>
 
 <a href="javascript:CerrarBloqueRevision('{key}');">Ocultar Datos</a>
 </div>
 
<!-- END BLOCK : bloque_actualizacion_variables_bloque -->

<!-- START BLOCK : bloque_actualizacion_variables_generales_nada -->
<div align="center">No hay elementos actualizados</div>
<!-- END BLOCK : bloque_actualizacion_variables_generales_nada -->

<input type="hidden" name="prefijo" value="{prefijo}"> 
