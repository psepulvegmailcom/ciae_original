<!--  ÁREA DE DOCUMENTOS DE OBLIGACION LABORAL -->
<div class="fieldset_title">Obligaciones Laborales y Previsionales:</div>
<fieldset>  
	<div>
		<label>  Se&ntilde;ale si tiene obligaciones laborales y previsionales sobre alg&uacute;n tipo de empleado (profesionales, personal de servicio, choferes, empleadas dom&eacute;sticas, etc.)   
		</label>
	</div>
	<div style=" padding-left:30px; font-weight:bold;">
		Si 	<input name="doc_obligaciones_laborales" type="radio" value="si" onclick="javascrip:cambiarDocumentoLaboral('certificado');"  class="inputcheckbox " /> &nbsp;&nbsp;&nbsp;&nbsp; No 	<input name="doc_obligaciones_laborales" type="radio" value="no"  class="inputcheckbox "  onclick="javascript:cambiarDocumentoLaboral('declaracion');"/> 
	</div>
	<div id='bloque_ate_legal_archivo_certificado_obligaciones_laborales' class="oculto"> 
		<label>Certificado de Cumplimiento de Obligaciones Laborales y Previsionales</label><br />
		Adjunte el Certificado de Cumplimiento de Obligaciones Laborales y Previsionales emitido por la Direcci&oacute;n del Trabajo<br /><br /> <font id='bloque_ate_documento_certificado_obligaciones_laborales_estado' class="edicion_enrevision"> </font><br /> 
		<input type="file"  class="inputfile" name="ate_legal_archivo_certificado_obligaciones_laborales"   /> 
		<span>(*) </span><span>{ayuda_certificado_obligaciones_laborales}</span> 	 
		<span id='bloque_ate_documento_certificado_obligaciones_laborales_archivo'></span>		
		{documento_certificado_obligaciones_laborales}
 
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 
	</div> 	
	<div id='bloque_ate_legal_archivo_declaracion_obligaciones_laborales' class="oculto"> 
		<label>Declaración de Obligaciones Laborales y Previsionales </label><br />
		 Adjunte una Declaraci&oacute;n Jurada Simple ante Notario que d&eacute; cuenta que no tiene v&iacute;nculos contractuales con empleados, que le exija cumplir con las obligaciones laborales y previsionales 
		<br /><br /><font id='bloque_ate_documento_declaracion_obligaciones_laborales_estado' class="edicion_enrevision"></font><br />		
		<input type="file"  class="inputfile" name="ate_legal_archivo_declaracion_obligaciones_laborales"   /> 
		<span>(*) </span><span>{ayuda_declaracion_obligaciones_laborales}</span> 	 	
		<span id='bloque_ate_documento_declaracion_obligaciones_laborales_archivo'></span>	
		{documento_declaracion_obligaciones_laborales}  

		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 
	</div> 
	<script>
		hiddenId('bloque_ate_legal_archivo_certificado_obligaciones_laborales');
		hiddenId('bloque_ate_legal_archivo_declaracion_obligaciones_laborales');	
		function cambiarDocumentoLaboral(caso)
		{
			if(caso == 'certificado')
			{	
				var id_mostar	= 'certificado';
				var id_cerrar 	= 'declaracion';
				var i_seleccion = 0;
				var i_prev 		= 1;
			}
			else
			{					
				var id_mostar 	= 'declaracion';
				var id_cerrar 	= 'certificado';
				var i_seleccion = 1;
				var i_prev 		= 0;
			}
			var nombre_documento = id_cerrar+'_obligaciones_laborales';
			var ocultar_div = false; 

			/* REVISION ONLINE DE EXISTENCIAS DEL DOCUMENTO */
			
			 
			var valores 	= 'nombre_documento='+nombre_documento;   
			var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=existefileoferente&needlogin=1&'+valores; 
			var url 		= 'indexExt.php'; 
			var ajax 		= objetoAjax();       
			ajax.open("POST", url , true);
			ajax.onreadystatechange=function()
			{
			   if (ajax.readyState==4)
			   {	 
					var salida = ajax.responseText;
					if(salida == 'ok'  && document.main.caso_revision.value == 'registro')
					{
						if(confirm('¿Esta seguro de cambiar su situación de Obligaciones Laborales y Previcionales? Esta acción eliminará el documento previamente ingresado'))
						{
							borrarArchivoOferente(nombre_documento);
							ocultar_div = true;
						}
					}
					else
					{
						ocultar_div = true;
					}

					if(ocultar_div)
					{
						hiddenId('bloque_ate_legal_archivo_'+id_cerrar+'_obligaciones_laborales');	
						showId('bloque_ate_legal_archivo_'+id_mostar+'_obligaciones_laborales');
						document.main.doc_obligaciones_laborales[i_seleccion].checked = true;
					}		
					else
					{
						document.main.doc_obligaciones_laborales[i_prev].checked = true;
					}
			   }
			}           
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(opciones+repairAjaxIE());	
			/* END REVISION ONLINE DE EXISTENCIAS DEL DOCUMENT	O */			 
		}
		<!-- START BLOCK : bloque_caso_documento_laboral --> 
		cambiarDocumentoLaboral('{caso_documento_laboral}');
		<!-- END BLOCK : bloque_caso_documento_laboral -->
	</script>
</fieldset>
<!--  ÁREA DE DOCUMENTOS DE OBLIGACION LABORAL -->