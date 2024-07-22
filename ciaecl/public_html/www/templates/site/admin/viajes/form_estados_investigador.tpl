
 <div style="padding-left:20px; padding-right:20px">
	{tag_volver}
<div class="fieldset_title">Revisi&oacute;n de solicitud   </div>
	
{mensaje_guardar}<br>
<table id="tabla_noborder_admin_tab"      >
 
<tr  style="  margin: 0px;">  
	<th><a href="#" onClick="javascript:verBloque('formulario_ficha_persona');"><strong><div>  Ver informaci&oacute;n beneficiario</div> </strong></a></th>
    
    <!-- START BLOCK : bloque_estado_ficha_documentos_pestana -->
    <th><a href="#" onClick="javascript:verBloque('formulario_ficha_documentos');"><strong> Revisar documentaci&oacute;n  </strong></a></th>
    <!-- END BLOCK : bloque_estado_ficha_documentos_pestana -->
    <!-- START BLOCK : bloque_estado_vista_tramo -->
    <th><a href="#" onClick="javascript:verBloque('formulario_ficha_tramo_{orden}');"><strong> Tramo {orden} </strong></a></th>    
    <!-- END BLOCK : bloque_estado_vista_tramo -->
	<th><a href="#" onClick="javascript:verBloque('formulario_ficha_observaciones');"><strong>  Historial de estados y observaciones </strong></a></th>
</tr>
<tr id='formulario_ficha_observaciones' >
<td colspan="{colspan_tabla}" style="border: 0px">
<fieldset id='formulario_admin_estado'>   
<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_estados_historial.tpl --> 
<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_estados_persona.tpl -->
<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_estados_tramos.tpl --> 
</table> 
<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_ficha_detalle.tpls -->
     
 	

<input type="hidden" name="time_ingreso" value="{fecha_ingreso}" />
<input type="hidden" name="usuario" value="{usuario}" />

<input  class="inputtext" type="hidden" name="id_item" value="{id_item}">
<input  class="inputtext" type="hidden" name="id_solicitud" value="{id_solicitud}">
<input  class="inputtext" type="hidden" name="fecha" value="{fecha_solicitud}">
<input  class="inputtext" type="hidden" name="id_solicitud_estado" value="{id_solicitud_estado}">
 

<script type="text/javascript">
verBloque('formulario_ficha_observaciones');
 function verBloque(id_bloque)
 {
	 hidetr('formulario_revision'); 
	 hidetr('formulario_ficha_persona'); 
	 hidetr('formulario_ficha_documentos'); 
	 hidetr('formulario_ficha_observaciones'); 
	 for(var i=1; i < 10; i++)
	 {	 
		 hidetr('formulario_ficha_tramo_'+i);
	 } 
	 showtr(id_bloque); 
 }
 
 
function editElement()
{     
	/*if(isEmpty(document.getElementById('form_titulo').value) || isEmpty(document.getElementById('form_noticia').value) || isEmpty(document.getElementById('form_fecha').value) || isEmpty(document.getElementById('form_autor').value))
	{
		alert('Debe los campos basicos del formulario (titulo, noticia, fecha y autor)'); 
		return false;
	}    */
	process('view_administracion_viajes_revision|guardar',0);	 
}

 
</script>
{tag_volver}
</div>