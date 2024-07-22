<!-- START BLOCK : bloque_actualizacion_variables_bloque -->
<div class="fieldset_title" style="font-size:14px" id="titulo_{key}">
<img src="images/iconos/actualizacion{estado}.gif">  {paso} {variable_html} <small>({tipo_actualizacion}) {fecha_actualizacion_real}</small></div>


 <a href="javascript:AbrirBloqueRevision('bloque_{key}');textCounter('valor_actualizado_{key}','valor_actualizado_{key}_campo_max',300);" >Ver Datos</a>
<div  id='bloque_{key}' class="div_oculto"> 
<fieldset>


	<div id='valores_originales_{key}'>
	
	<div class="fieldset_title_interno">Valores originales   :</div> 
<strong>Valor Original :</strong><br> {valor_original}<br>
  </div>
  
  
	<div id='valores_actualizados_{key}'>
	
	<div class="fieldset_title_interno">Valores actualizados   :</div>
  
<strong>Valor Actualizado :</strong> <br>
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {valor_actualizado}</div>
		 <span id='valor_actualizado_{key}_campo_max'> caracteres de un máximo de 300</span><br /><textarea name="valor_actualizado_{key}" id="valor_actualizado_{key}"  {modificacion_solo_lectura}   onKeyDown="textCounter('valor_actualizado_{key}','valor_actualizado_{key}_campo_max',300);" onKeyUp="textCounter('valor_actualizado_{key}','valor_actualizado_{key}_campo_max',300);"   >{valor_revision}</textarea>  <a href="javascript:convertirMinusculaInput('valor_actualizado_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
 
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
