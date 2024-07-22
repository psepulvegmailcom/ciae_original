
	<!-- *******************FORMULARIO REVISION {prefijo} ******************* --> 
	 <div class='{revision_div_ocultos}' style="padding:10px 0px 5px 0">
		<div class="fieldset_title_interno">Revisión Datos Postulación</div>
	
		<div style="padding:10px 0px 10px 0">  
			<span class="span_modificacion" >Fecha Inicio Revisión :</span> <small>{fecha_inicio}</small><br />
			<span class="span_modificacion" >Estado Revisión :</span> <small>{estado}</small><br />
			<span class="span_modificacion" >Usuario Inicio Revisión (Revisor) :</span> <small>{username}</small><br />		
			 <!-- START BLOCK : revision_datos_revisor -->		  
			<span class="span_modificacion" >Modificación de datos originales :</span> <small>{modificacion_datos}</small><br />
			<span class="span_modificacion" >Fecha Cierre Verificador :</span> <small>{fecha}</small><br />	 
			 <!-- END BLOCK : revision_datos_revisor -->
			 <!-- START BLOCK : revision_datos_supervisor -->		 
			<span class="span_modificacion" >Usuario Cierre Revisión (Supervisor) :</span> <small>{username}</small><br />
			<span class="span_modificacion" >Fecha Cierre Revisión :</span> <small>{fecha}</small><br />
			<!-- END BLOCK : revision_datos_supervisor -->
		</div>  
	
	<input type="hidden" name="{prefijo}_revision_modifico_texto" value="{revision_modifico_texto}" />
	<input type="hidden" name="{prefijo}_revision_estado" value="{estado_revision}" />
	
	<table style="width:100%">
	<tr>
		<td style="text-align: left; width:50%; padding:0 10px 0 10px">
		<span class="span_modificacion" >Comentario Interno Revisi&oacute;n </span></td>
		
		<td style="text-align:left; width:50%; padding:0 10px 0 10px">
		<span class="span_modificacion" >Mensaje Postulante </span></td>
	</tr>
	<tr>
		<td width="50%" style="text-align:center; width:50%; padding:0 10px 0 10px">
		 <textarea   class="textarea_revision" name="{prefijo}_revision_mensaje_interno_{id_externo}"  {disabled_mensaje_interno} id="{prefijo}_mensaje_interno_{id_externo}">{mensaje_interno}</textarea></td>
		
		<td width="50%" style="text-align:center; width:50%; padding:0 10px 0 10px">
		 <textarea   class="textarea_revision" name="{prefijo}_revision_mensaje_oferente_{id_externo}"  {disabled_mensaje_oferente} id="{prefijo}_mensaje_oferente_{id_externo}">{mensaje_oferente}</textarea></td>
	</tr> 
	 <!-- START BLOCK : revision_botones -->
	<tr>
	<td colspan="2" style="text-align:center;  padding:10px 0 0 0">
	 <button type="button" onClick="javascript:modificacionIdExterno('');guardarRevision('{option}','{prefijo}','enviado','{id_externo}');" ><span>Aceptar Revisión Postulación</span></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <button type="button" onClick="javascript:modificacionIdExterno('');guardarRevision('{option}','{prefijo}','rechazo','{id_externo}');" ><span>Rechazar Revisión Postulación </span></button>  
	</td></tr>
	<!-- END BLOCK : revision_botones -->


	 <!-- START BLOCK : revision_botones_liberar -->
	<tr>
	<td colspan="2" style="text-align:center;  padding:10px 0 0 0">
	 <button type="button" onClick="javascript:liberarRevision('{id_externo}','{option}','{prefijo}');" ><span>Desbloquear Revisión Postulación</span></button> 
	</td></tr>
	<!-- END BLOCK : revision_botones_liberar -->	
	</table>
	 
	    
	 <!-- *******************FORMULARIO REVISION {prefijo} ******************* -->
	 </div>