 
{doc_obligaciones_laborales}

 
<div class="fieldset_title"> Acreditaci�n de vigencia de la sociedad </div>
	  
<fieldset> 
	<div> 
	<label>	<u>Certificado de vigencia de la Persona Jur�dica</u>, emanado de la autoridad competente, emitido con una fecha que no exceda a los 6 meses anteriores a la presentaci�n de la solicitud de incorporaci�n al registro.</label>
	<br /><font id='bloque_ate_documento_empresa_vigencia_estado' class="edicion_enrevision"> </font><br />
	<input type="file"  class="inputfile" name="ate_legal_archivo_empresa_vigencia"   /> 
	<span>(*) </span><span>{ayuda_certificado_vigencia}</span> 		
	{documento_empresa_vigencia}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 
</div>
	  <div>
	<label> <u>Documento legal</u> que estipule los nombres de los socios de la instituci�n o del directorio actual (original o copia legalizada ante notario).
</label>
	<br /><font id='bloque_ate_documento_empresa_socio_estado' class="edicion_enrevision"> </font><br />
	<input type="file"  class="inputfile" name="ate_legal_archivo_empresa_socio" />
	<span>(*) </span><span>{ayuda_empresa_socio}</span> 	
	{documento_empresa_socio}
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div>
	  <!--
	<div>
	<label>Fotocopia del RUT de la empresa</label><br />
	<input type="file"  class="inputfile" name="ate_legal_archivo_empresa_rut" />
	<span>(*) </span> <span>{ayuda_empresa_rut}</span> 
	{documento_empresa_rut}
	</div> -->
</fieldset> 

	<div class="fieldset_title"> Acreditaci�n de  oficina administrativa permanente </div>
	
<fieldset>
	Ud. podr� soleccionar solamente uno de las posibilidades de certificado, pues <b>ambos documentos son excluyentes</b>.
	<br /><br />
	<div>
	<label>  <u>Certificado de Propiedad del inmueble emitido por el Conservador de Bienes Ra&iacute;ces</u></label>	
	<br /><font id='bloque_ate_documento_empresa_cbrs_estado' class="edicion_enrevision"> </font><br />
	<input type="file"  class="inputfile" name="ate_legal_archivo_empresa_cbrs" />
	<span>(*) </span><span>{ayuda_empresa_cbrs}</span> 
	{documento_empresa_cbrs}
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div>  
	<div>
	<label> <u>Copia autorizada ante notario del Contrato de Arrendamiento o de Comodato de la Oficina Administrativa</u> a
nombre de la entidad postulante y firmado por �l o los Representante(s) Legal(es)</label>
	<br /><font id='bloque_ate_documento_empresa_copia_arriendo_estado' class="edicion_enrevision"> </font><br />
<input type="file"  class="inputfile" name="ate_legal_archivo_empresa_copia_arriendo" />
	<span>(*) </span><span>{ayuda_empresa_copia_arriendo}</span> 
	{documento_empresa_copia_arriendo}
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div>  
	<!--<div>
	<label>Escritura de Acta de Poderes vigentes</label><br />
<input type="file"  class="inputfile" name="ate_legal_archivo_empresa_poderes_vigentes" />
	<span>(*) </span>&nbsp;&nbsp;
	{documento_empresa_poderes_vigentes}
	</div>  -->
</fieldset>   
 
 
 