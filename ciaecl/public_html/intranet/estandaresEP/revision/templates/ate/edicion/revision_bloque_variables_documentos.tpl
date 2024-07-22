<!-- START BLOCK : bloque_actualizacion_variables_bloque -->
<div class="fieldset_title" style="font-size:14px" id="titulo_{key}">
<img src="images/iconos/actualizacion{estado}.gif">  {paso} {variable_html} <small>({tipo_actualizacion}) {fecha_actualizacion_real}</small></div>


 <a href="javascript:AbrirBloqueRevision('bloque_{key}');" >Ver Datos</a>
<div  id='bloque_{key}' class="div_oculto"> 
<fieldset>


	<div id='valores_originales_{key}'>
	<div class="fieldset_title_interno">Valores originales   :</div> 
  
    <a href="download.php?caso=oferente_documento_file&file={md5_documento_original}&nombre=documento_original.{extension_documento_original}" target="_blank"  title="Bajar Documento Actual"><img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
  </div>
  
  
	<div id='valores_actualizados_{key}'>
	
	<div class="fieldset_title_interno">Valores actualizados   :</div> 
    <a href="download.php?caso=oferente_documento_file&file={md5_documento}&nombre=documentoactualizado.{extension_documento}" target="_blank"  title="Bajar Documento Actual"><img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
  
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
