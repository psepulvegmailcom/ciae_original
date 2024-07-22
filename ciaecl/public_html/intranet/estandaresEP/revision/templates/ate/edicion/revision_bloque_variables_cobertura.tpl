<!-- START BLOCK : bloque_actualizacion_variables_bloque -->
<div class="fieldset_title" style="font-size:14px" id="titulo_{key}">
<img src="images/iconos/actualizacion{estado}.gif">  Cobertura <small>{fecha_actualizacion_real}</small></div>


 <a href="javascript:AbrirBloqueRevision('bloque_{key}');" >Ver Datos</a>
<div  id='bloque_{key}' class="div_oculto"> 
<fieldset>
	<div id='valores_originales_{key}'>
	
	<div class="fieldset_title_interno">Valores originales   :</div> 
<div id='area_cobertura_comunas_originales' style="margin-left:30px">
{comunas_cobertura_originales_lista}
  </div>
  </div>
  
  
	<div id='valores_actualizados_{key}'>
	
	<div class="fieldset_title_interno">Valores actualizados   :</div>
  <div id='area_cobertura_comunas_actualizados' style="margin-left:30px">
{comunas_cobertura_actualizados_lista}
  </div>
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
