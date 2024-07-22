 
  
  
 <div style="padding-left:20px; padding-right:20px">
	{tag_volver}
<div class="fieldset_title">Revisi&oacute;n de solicitud   </div>
	
{mensaje_guardar}<br>
<table  id="tabla_noborder_admin_tab" > 
<tr> 
	<th><a href="#" onClick="javascript:verBloque('formulario_revision');"><strong> Revisi&oacute;n estado </strong></a></th> 
    <th><a href="#" onClick="javascript:verBloque('formulario_ficha_persona');"><strong>  Ver informaci&oacute;n beneficiario </strong></a></th> 
    <!-- START BLOCK : bloque_estado_ficha_documentos_pestana -->
    <th><a href="#" onClick="javascript:verBloque('formulario_ficha_documentos');"><strong> Revisar documentaci&oacute;n  </strong></a></th>
    <!-- END BLOCK : bloque_estado_ficha_documentos_pestana --> 
    <!-- START BLOCK : bloque_estado_vista_tramo -->
    <th><a href="#" onClick="javascript:verBloque('formulario_ficha_tramo_{orden}');"><strong> Tramo {orden} </strong></a></th>    
    <!-- END BLOCK : bloque_estado_vista_tramo -->
	<th><a href="#" onClick="javascript:verBloque('formulario_ficha_observaciones');"><strong>  Historial de estados y observaciones </strong></a></th>
</tr> 
<tr id='formulario_ficha_observaciones'>
<td colspan="{colspan_tabla}" style="border: 0px">
<fieldset id='formulario_admin_estado'>   
<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_estados_historial.tpl --> 
<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_estados_persona.tpl -->
<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_estados_tramos.tpl -->
 


<tr id='formulario_revision'>
<td colspan="{colspan_tabla}" style="border:none">
<fieldset id='formulario_admin_estado'> 

 <!-- START BLOCK : bloque_estado_revision_presupuesto -->
<div class="fieldset_campos">
<table style="width:100%">
<tr>
<td style="border:none">
		<p> <label>		Aprobar solicitud</label> </p>  </td></tr>
        <tr><td style="border:none">
		 <div>
         <input type="radio" name="aprobacion_solicitud" value="aprobado" > Si <br>
         <input  type="radio" name="aprobacion_solicitud"  value="rechazado"> No </div>
         
         </td></tr> 
         
         </table>
	</div>
     
 <!-- END BLOCK : bloque_estado_revision_presupuesto -->
 <!-- START BLOCK : bloque_estado_revision_presupuesto_direccion -->
<div class="fieldset_campos">
		 
		<table style="width:100%" border="0">
<tr>
<td style="border:none">
		<p> <label>		Aprobar solicitud</label> </p>  </td></tr>
        <tr><td style="border:none">
		 <div><input  type="radio" name="aprobacion_solicitud" value="aprobado" > Si <br>
         <input  type="radio" name="aprobacion_solicitud"  value="rechazado"> No </div>
         
         </td></tr></table>
	</div>
     
 <!-- END BLOCK : bloque_estado_revision_presupuesto_direccion -->
 <!-- START BLOCK : bloque_estado_solicitud_revision_cotizacion -->
<div class="fieldset_campos">
		 
		<table style="width:100%" border="0">
<tr>
<td style="border:none">
		<p> <label>		Acepto cotizaci&oacute;n</label> </p>  </td></tr>
        <tr><td style="border:none">
		 <div><input  type="radio" name="aprobacion_solicitud" value="aprobado" > Si <br>
         <input  type="radio" name="aprobacion_solicitud"  value="rechazado"> No </div>
         
         </td></tr></table>
	</div>
     
 <!-- END BLOCK : bloque_estado_solicitud_revision_cotizacion -->
 <!-- START BLOCK : bloque_estado_cotizacion -->
 
         <input  type="hidden" name="aprobacion_solicitud" id='aprobacion_solicitud' value="aprobado" >
         <input  type="hidden" name="archivo_1" id="archivo_1" value="" >
<div class="fieldset_campos">
		<p><label>		Ingresar cotizaci&oacute;n</label> </p> 
		
		<input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
                <ul id="lista-archivoUnico1" >                </ul>
                <div id="responseArchivoUnico1"></div>          
              
			<input type="hidden" id="ruta_archivo1" value="doc/solicitudes_gestion/archivos/" name="ruta_archivo1"/>
			<input type="hidden" id="nombre_campo_archivo1" value="archivo_1" name="nombre_campo_archivo1"/>
        <input type="hidden" name="nombre_archivo_1" value="Cotizaci&oacute;n pasajes">
		
		 
	</div>
     
 <!-- END BLOCK : bloque_estado_cotizacion -->
 
 
 <!-- START BLOCK : bloque_estado_cotizacion_ejecucion -->
 
         <input  type="hidden" name="aprobacion_solicitud" id='aprobacion_solicitud' value="aprobado" >
         <input  type="hidden" name="archivo_1" id="archivo_1" value="" >
<div class="fieldset_campos">
		<p><label>		Ingresar ticket aereo</label> </p> 
		
		<input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
                <ul id="lista-archivoUnico1" >                </ul>
                <div id="responseArchivoUnico1"></div>          
              
			<input type="hidden" id="ruta_archivo1" value="doc/solicitudes_gestion/archivos/" name="ruta_archivo1"/>
			<input type="hidden" id="nombre_campo_archivo1" value="archivo_1" name="nombre_campo_archivo1"/>
        <input type="hidden" name="nombre_archivo_1" value="Ticket aereos">
		
		 
	</div>
         <input  type="hidden" name="archivo_2" id="archivo_2" value="" >
<div class="fieldset_campos">
		<p><label>		Ingresar orden de compra</label> </p> 
		
		<input type="file" class="ArchivoUnico" id="Archivo2" name="file[]"/>
                <ul id="lista-archivoUnico2" >                </ul>
                <div id="responseArchivoUnico2"></div>          
              
			<input type="hidden" id="ruta_archivo2" value="doc/solicitudes_gestion/archivos/" name="ruta_archivo2"/>
			<input type="hidden" id="nombre_campo_archivo2" value="archivo_2" name="nombre_campo_archivo2"/>
        <input type="hidden" name="nombre_archivo_2" value="Orden de compra">
		
		 
	</div>
     
 <!-- END BLOCK : bloque_estado_cotizacion_ejecucion -->
 
 
 
 
 <!-- START BLOCK : bloque_estado_pago -->
 
         <input  type="hidden" name="aprobacion_solicitud" value="aprobado" >
 
    
    <!-- START BLOCK : bloque_estado_pago_archivo -->
         <input  type="hidden" name="archivo_{i_archivo}" id="archivo_{i_archivo}" value="" >
<div class="fieldset_campos">
		<p><label>		Ingresar documento {i_archivo} </label> </p> 
		
		<input type="file" class="ArchivoUnico" id="Archivo{i_archivo}" name="file[]"/>
                <ul id="lista-archivoUnico{i_archivo}" >                </ul>
                <div id="responseArchivoUnico{i_archivo}"></div>          
              
			<input type="hidden" id="ruta_archivo{i_archivo}" value="doc/solicitudes_gestion/archivos/" name="ruta_archivo{i_archivo}"/>
			<input type="hidden" id="nombre_campo_archivo{i_archivo}" value="archivo_{i_archivo}" name="nombre_campo_archivo{i_archivo}"/>  
		       <strong>Tipo documento</strong>   <select  name="nombre_archivo_{i_archivo}" id=="nombre_archivo_{i_archivo}">
         <option></option>
         <option >Factura</option> 
         <option >Boleta</option> 
         <option >Otros</option>
         </select>
	</div>
         <!-- START BLOCK : bloque_estado_pago_archivo -->
    
    
    
    
     
 <!-- END BLOCK : bloque_estado_pago -->
 
 
 <!-- START BLOCK : bloque_estado_resolucion -->
 
         <input  type="hidden" name="aprobacion_solicitud" value="aprobado" >
         
          <!-- START BLOCK : bloque_estado_resolucion_archivo -->
         <input  type="hidden" name="archivo_{i_archivo}" id="archivo_{i_archivo}" value="" >
<div class="fieldset_campos">
		<p><label>		Ingresar documento {i_archivo} </label> </p> 
		
		<input type="file" class="ArchivoUnico" id="Archivo{i_archivo}" name="file[]"/>
                <ul id="lista-archivoUnico{i_archivo}" >                </ul>
                <div id="responseArchivoUnico{i_archivo}"></div>          
              
			<input type="hidden" id="ruta_archivo{i_archivo}" value="doc/solicitudes_gestion/archivos/" name="ruta_archivo{i_archivo}"/>
			<input type="hidden" id="nombre_campo_archivo{i_archivo}" value="archivo_{i_archivo}" name="nombre_campo_archivo{i_archivo}"/>  
		       <strong>Tipo documento</strong>   <select  name="nombre_archivo_{i_archivo}" id=="nombre_archivo_{i_archivo}">
         <option></option>
         <option >Resoluci&oacute;n</option>
         <option >Viatico</option>
         <option >Oficios</option>
         <option >Cometido funcionario</option>
         <option >Otros</option>
         </select>
	</div>
         <!-- START BLOCK : bloque_estado_resolucion_archivo -->
          
     
 <!-- END BLOCK : bloque_estado_resolucion -->
 
 
 
 <div class="fieldset_campos">
 comun
		<p><label>		Comentario</label> </p> 
		 <textarea name="comentario" id='comentario' style="width:100%; height:150px;"></textarea>
	</div>
<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button>  
</fieldset>
</td>
</tr>
</table>



 
		<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_ficha_detalle.tpls -->
     
 	

<input type="hidden" name="time_ingreso" value="{fecha_ingreso}" />
<input type="hidden" name="usuario" value="{usuario}" />

<input  class="inputtext" type="hidden" name="id_item" value="{id_item}">
<input  class="inputtext" type="hidden" name="id_solicitud" value="{id_solicitud}">
<input  class="inputtext" type="hidden" name="fecha" value="{fecha_solicitud}">
<input  class="inputtext" type="hidden" name="id_solicitud_estado" value="{id_solicitud_estado}">
 

<script type="text/javascript">
verBloque('formulario_revision');
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
	 
	if(emptyCheckValue('aprobacion_solicitud') == 'aprobado' || emptyCheckValue('aprobacion_solicitud') == 'rechazado')
	{
					 
	}
	else
	{ 
		if(document.main.aprobacion_solicitud.value != 'aprobado')
		{
			alert('Debe indicar si aprueba o rechaza estado');
			return false;
		}
	}
	
	if(confirm('Estado seguro de cerrar el estado? ingreso toda la informacion solicitada?'))
	{
		process('view_administracion_viajes_revision|guardar_estado',0);	 
	}
}

 
</script>
{tag_volver}
</div>