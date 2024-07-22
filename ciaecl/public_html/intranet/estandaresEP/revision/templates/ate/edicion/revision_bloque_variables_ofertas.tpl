<!-- START BLOCK : bloque_actualizacion_variables_bloque -->
<div class="fieldset_title" style="font-size:14px" id="titulo_{key}">
<img src="images/iconos/actualizacion{estado}.gif">  Oferta  N° {fila} "{nombre}" <small>({tipo_actualizacion}) {fecha_actualizacion_real}</small></div>


 <a href="javascript:AbrirBloqueRevision('bloque_{key}');textCounter('nombre_oferta_{key}','nombre_oferta_{key}_campo_max',300);textCounter('descripcion_oferta_{key}','descripcion_oferta_{key}_campo_max',300);" >Ver Datos</a>
<div  id='bloque_{key}' class="div_oculto"> 
<fieldset>


  <div id='valores_originales_{key}' class="{ocultar_original}">
  
	<div class="fieldset_title_interno">Valores originales   :</div> 
  
  <label>Área oferta :</label><br> {area}<br>
  <label>Subárea oferta :</label><br> {subarea}<br>
  <label>Nombre oferta :</label><br> {nombre_original}<br>
  <label>Descripción oferta :</label><br> {descripcion_original}<br>
  
  <label>Áreas Integrales :</label><br><div style="padding-left:30px"> {areaintegrales_original}</div><br>
  
  </div>
  
	<div id='valores_actualizados_{key}'>
	
	<div class="fieldset_title_interno">Valores actualizados   :</div>
  
  <label>Área oferta :</label><br> {area}<br>
  <label>Subárea oferta :</label><br> {subarea}<br>
	 
	<label>Nombre Oferta</label><br  />
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {nombre}</div>
		 <span id='nombre_oferta_{key}_campo_max'> caracteres de un máximo de 300</span><br />
		<textarea name="nombre_oferta_{key}" id="nombre_oferta_{key}"  {modificacion_solo_lectura}  onKeyDown="textCounter('nombre_oferta_{key}','nombre_oferta_{key}_campo_max',300);" onKeyUp="textCounter('nombre_oferta_{key}','nombre_oferta_{key}_campo_max',300);"    >{nombre_revision}</textarea>		
		 <a href="javascript:convertirMinusculaInput('nombre_oferta_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
	 <br  /> 
	<label>Descripción Oferta</label><br  />
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {descripcion}</div>
		 <span id='descripcion_oferta_{key}_campo_max'> caracteres de un máximo de 300</span><br />
		<textarea name="descripcion_oferta_{key}" id="descripcion_oferta_{key}"  {modificacion_solo_lectura}   onKeyDown="textCounter('descripcion_oferta_{key}','descripcion_oferta_{key}_campo_max',300);" onKeyUp="textCounter('descripcion_oferta_{key}','descripcion_oferta_{key}_campo_max',300);"   >{descripcion_revision}</textarea>		
		 <a href="javascript:convertirMinusculaInput('descripcion_oferta_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a><br  /> 
		 
		 
  <label>Áreas Integrales :</label><br><div style="padding-left:30px"> {areaintegrales}</div><br>
		 
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
