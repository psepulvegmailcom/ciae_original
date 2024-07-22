<!-- START BLOCK : bloque_actualizacion_variables_bloque -->
<div class="fieldset_title" style="font-size:14px" id="titulo_{key}">
<img src="images/iconos/actualizacion{estado}.gif">  Experiencia   N° {fila} "{nombre_proyecto}" 

  <span class="{rut_capital_mostrar}"> 
	<br>Capital humano: {rut_capital_html} {nombre_capital_html}  
	</span>
 <small>({tipo_actualizacion}) {fecha_actualizacion_real}</small></div>


 <a href="javascript:AbrirBloqueRevision('bloque_{key}'); textCounter('portafolio_nombre_proyecto_{key}','portafolio_nombre_proyecto_{key}_campo_max',300);textCounter('portafolio_descripcion_proyecto_{key}','portafolio_descripcion_proyecto_{key}_campo_max',300);textCounter('portafolio_resultado_proyecto_{key}','portafolio_resultado_proyecto_{key}_campo_max',300);" >Ver Datos</a>
<div  id='bloque_{key}' class="div_oculto"> 
<fieldset>
 
 
	<div id='valores_actualizados_{key}'>
	
	<div class="fieldset_title_interno">Valores actualizados   :</div>
  
  <label>Área oferta :</label><br> {area}<br>
  <label>Subárea oferta :</label><br> {subarea}<br>
  
  <div class="{rut_capital_mostrar}"> 
	<label>Nombre Capital Humano  : </label><br /> {nombre_capital_html} <br />
	<label>Rut Capital Humano : </label><br /> {rut_capital_html}
	</div> 
  
  <label>Nombre del Proyecto :</label><br> 
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {nombre_proyecto}</div>
		 <span id='portafolio_nombre_proyecto_{key}_campo_max'> caracteres de un máximo de 300</span><br />
  <textarea name="portafolio_nombre_proyecto_{key}" id='portafolio_nombre_proyecto_{key}' {modificacion_solo_lectura} onKeyDown="textCounter('portafolio_nombre_proyecto_{key}','portafolio_nombre_proyecto_{key}_campo_max',300);" onKeyUp="textCounter('portafolio_nombre_proyecto_{key}','portafolio_nombre_proyecto_{key}_campo_max',300);"    >{nombre_proyecto_revision}</textarea><a href="javascript:convertirMinusculaInput('portafolio_nombre_proyecto_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a><br><br> 
  
  
  
  <label>Institución que contrató el servicio</label><br>
  <strong>{contratante_titulo}  </strong><br> {contratante_nombre}<br><br> 
  
  
  <label>Zona geográfica de ejecución</label><br>  
  <div id='area_cobertura_comunas' style="margin-left:30px">
{comunas_cobertura_lista}
  </div> 
  <label>Período Inicio</label><br>
 {mes_inicio} / {agno_inicio} <br>
  <label>Período Término</label><br>
   {mes_termino} / {agno_termino} <br>
  <label>Coordinador Proyecto</label><br>
  
  <div class="edicion_enrevision_interna" ><strong>Actualización usuario :</strong> {coordinador}</div>
   <input type="text" name="portafolio_coordinador_{key}"	 maxlength="255" value="{coordinador_revision}"	{modificacion_solo_lectura} />	<a href="javascript:convertirMinusculaInput('portafolio_coordinador_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <br>
  <label>Descripción Servicio</label><br> 
  
  <div class="edicion_enrevision_interna" ><strong>Actualización usuario :</strong> {descripcion_servicio}</div>
		 <span id='portafolio_descripcion_proyecto_{key}_campo_max'> caracteres de un máximo de 300</span><br />
  <textarea name="portafolio_descripcion_proyecto_{key}" id='portafolio_descripcion_proyecto_{key}' {modificacion_solo_lectura} onKeyDown="textCounter('portafolio_descripcion_proyecto_{key}','portafolio_descripcion_proyecto_{key}_campo_max',300);" onKeyUp="textCounter('portafolio_descripcion_proyecto_{key}','portafolio_descripcion_proyecto_{key}_campo_max',300);"  >{descripcion_servicio_revision}</textarea><a href="javascript:convertirMinusculaInput('portafolio_descripcion_proyecto_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a><br>
  <label>Resultado Servicio</label><br> 
  <div class="edicion_enrevision_interna" ><strong>Actualización usuario :</strong> {resultado_servicio}</div>
		 <span id='portafolio_resultado_proyecto_{key}_campo_max'> caracteres de un máximo de 300</span><br />
  <textarea name="portafolio_resultado_proyecto_{key}" id='portafolio_resultado_proyecto_{key}' {modificacion_solo_lectura}  onKeyDown="textCounter('portafolio_resultado_proyecto_{key}','portafolio_resultado_proyecto_{key}_campo_max',300);" onKeyUp="textCounter('portafolio_resultado_proyecto_{key}','portafolio_resultado_proyecto_{key}_campo_max',300);"   >{resultado_servicio_revision}</textarea><a href="javascript:convertirMinusculaInput('portafolio_resultado_proyecto_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a><br>
  
  
  <label>Nombre persona referencia proyecto</label><br>
  
  <div class="edicion_enrevision_interna" ><strong>Actualización usuario :</strong> {referencia_nombre}</div>
   <input type="text" name="portafolio_referencia_nombre_{key}"	 maxlength="255" value="{referencia_nombre_revision}"{modificacion_solo_lectura}	 />	<a href="javascript:convertirMinusculaInput('portafolio_referencia_nombre_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <br>
  <label>Cargo persona referencia proyecto</label><br>
  
  <div class="edicion_enrevision_interna" ><strong>Actualización usuario :</strong> {referencia_cargo}</div>
   <input type="text" name="portafolio_referencia_cargo_{key}"	 maxlength="255"  value="{referencia_cargo_revision}"	{modificacion_solo_lectura} />	<a href="javascript:convertirMinusculaInput('portafolio_referencia_cargo_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <br>
   
   
   	<label>Tel&eacute;fono y c&oacute;digo de persona referencia proyecto</label><br  />
  <div class="edicion_enrevision_interna" ><strong>Actualización usuario :</strong> {referencia_telefono_codigo} {referencia_telefono}</div>
	<select id="portafolio_referencia_telefono_codigo_{key}"  name="portafolio_referencia_telefono_codigo_{key}" {modificacion_solo_lectura_disabled}  style="width:60px; "  >
<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_area_option.tpl -->
<option value='{referencia_telefono_codigo}' selected="selected" >{referencia_telefono_codigo_revision}</option>
</select> 
	
	  <input type="text"  style="width:100px"  maxlength="7"  {modificacion_solo_lectura}  name='portafolio_referencia_telefono_{key}'  id='portafolio_referencia_telefono_{key}'  value="{referencia_telefono_revision}"  >
   <br>
  <label>Email persona referencia proyecto</label><br>
  <div class="edicion_enrevision_interna" ><strong>Actualización usuario :</strong> {referencia_email}</div>
   <input type="text" name="portafolio_referencia_email_{key}"	 maxlength="255" {modificacion_solo_lectura} value="{referencia_email_revision}"	 />	<a href="javascript:convertirMinusculaInput('portafolio_referencia_email_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <br>
   
  <label>Carta referencia</label><br>
   <a href="download.php?caso=oferente_documento_file&file={referencia_carta_archivo}&nombre=referencia_carta.{referencia_carta_extension}" target="_blank"  title="Bajar Documento Actual"><img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
  </div>
 

<!-- INCLUDE BLOCK : ../templates/ate/edicion/revision_formulario.tpl -->
 </fieldset>
 
 <a href="javascript:CerrarBloqueRevision('{key}');">Ocultar Datos</a>
 </div>
 
<!-- END BLOCK : bloque_actualizacion_variables_bloque -->

<!-- START BLOCK : bloque_actualizacion_variables_generales_nada -->
<div align="center">No hay elementos actualizados</div>
<!-- END BLOCK : bloque_actualizacion_variables_generales_nada -->

<input type="hidden" name="prefijo" value="{prefijo}"> 
