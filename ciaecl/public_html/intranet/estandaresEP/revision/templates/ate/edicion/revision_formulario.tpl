
	<input type="hidden" name="{prefijo}_revision_modifico_texto" value="{revision_modifico_texto}" />
	<input type="hidden" name="{prefijo}_revision_estado" value="{estado_revision}" />
	<!-- *******************FORMULARIO REVISION {prefijo} ******************* --> 
	 <div class='{revision_div_ocultos}' style="padding:10px 0px 5px 0">
		<div class="fieldset_title_interno">Revisi�n Datos Actualizados</div>
	
		<div style="padding:10px 0px 10px 0">  
			<span class="span_modificacion" >Fecha Actualizaci�n :</span> {fecha_actualizacion_real}<br />
			<span class="span_modificacion" >Estado Revisi�n :</span> {estado_html}<br />
			
			<span class="span_modificacion" >Usuario Revisor Verificaci�n :</span> {verificacion_revisor}<br />		
					  
			<span class="span_modificacion" >Estado Revisi�n Verificaci�n :</span> {verificacion_estado}<br />
			<span class="span_modificacion" >Decisi�n Revisi�n Verificaci�n :</span> {verificacion_decision}<br />
			<span class="span_modificacion" >Fecha Revisi�n Verificaci�n :</span> {verificacion_fecha_real}<br />	 
			 	 
			<span class="span_modificacion" >Usuario Revisor Validaci�n :</span> {validacion_revisor}<br />		
					  
			<span class="span_modificacion" >Estado Revisi�n Validaci�n :</span> {validacion_estado}<br />
			<span class="span_modificacion" >Decisi�n Revisi�n Validaci�n :</span> {validacion_decision}<br />
			<span class="span_modificacion" >Fecha Revisi�n Validaci�n :</span> {validacion_fecha_real}<br />	 
			 	 
		</div>  
	 
	<table style="width:100%">
	<tr>
		<td style="text-align: left; width:50%; padding:0 10px 0 10px">
		<span class="span_modificacion" >Comentario Interno  </span></td>
		
		<td style="text-align:left; width:50%; padding:0 10px 0 10px">
		<span class="span_modificacion" >Mensaje Oferente </span></td>
	</tr>
	<tr>
		<td width="50%" style="text-align:center; width:50%; padding:0 10px 0 10px">
		 <textarea   class="textarea_revision" name="revision_mensaje_interno_{key}"  {disabled_mensaje_interno} id="mensaje_interno_{id_externo}">{comentario_interno}</textarea></td>
		
		<td width="50%" style="text-align:center; width:50%; padding:0 10px 0 10px">
		 <textarea   class="textarea_revision" name="revision_mensaje_oferente_{key}"  {disabled_mensaje_oferente} id="revision_mensaje_oferente_{key}">{mensaje_oferente}</textarea></td>
	</tr> 
	 <!-- START BLOCK : revision_botones -->
	<tr>
	<td colspan="2" style="text-align:center;  padding:10px 0 0 0">
	 <button type="button" onClick="javascript:guardarActualizacion('{option}','{prefijo}','enviado','{key}');" ><span>Aceptar Revisi�n Actualizaci�n</span></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <button type="button" onClick="javascript:guardarActualizacion('{option}','{prefijo}','rechazo','{key}');" ><span>Rechazar Actualizaci�n </span></button>  
	</td></tr>
	<!-- END BLOCK : revision_botones --> 
	</table>
	 
	    
	 <!-- *******************FORMULARIO REVISION {prefijo} ******************* -->
	 </div>