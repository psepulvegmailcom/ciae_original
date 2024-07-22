
{doc_obligaciones_laborales}

<!--<div>
	 <img src="images/Info.ico" border="0">  
	 
	 <strong>  
	 En esta  primera etapa de postulaci&oacute;n al registro ATE, los documentos legales (estatutos  o reconocimiento oficial del MINEDUC, certificado de acreditaci&oacute;n, carta de  patrocinio) <u>no son obligatorios</u>. Para completar estos campos se deber&aacute;  ingresar una nota en la cual la instituci&oacute;n se comprometa a enviar estos  documentos a m&aacute;s tardar el 30 de abril 2008.  </strong></div>-->

<div class="fieldset_title">Para Instituciones de Educación superior del consejo de rectores:</div>
	  
<fieldset> 
	<div> 
	<label> Copia legalizada ante notario de los estatutos de la entidad.</label><br />
	
	<input type="file"  class="inputfile" name="ate_legal_archivo_universidad_estatutos"   /> 
	<span>(*) </span><span>{ayuda_estatutos}</span> 	 		
	{documento_universidad_estatutos} 
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div> 
	 
	 
	<div>
		<label>
		Copia legalizada ante notario del documento que certifica la acreditaci&oacute;n de la Universidad y su  duraci&oacute;n
		
		</label><br /><font id='bloque_ate_documento_universidad_acreditacion_estado' class="edicion_enrevision"> </font><br />
		<input type="file"  class="inputfile" name="ate_legal_archivo_universidad_acreditacion" />
		<span>(*) </span><span>{ayuda_acreditacion}</span> 	
		{documento_universidad_acreditacion}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 
</div> 
	<div>
		<label>Carta  de patrocinio de la   Universidad avalando la postulaci&oacute;n al registro ATE:</label>
		<br />
		<input type="file"  class="inputfile" name="ate_legal_archivo_universidad_patrocinio" />
		<span>(*)</span><span>{ayuda_patrocinio}</span> 
		{documento_universidad_patrocinio}  
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div>
</fieldset> 
	<div class="fieldset_title">Para universidades Privadas y Centros de
Formación Técnica - Profesional</div>
	  
<fieldset> 
	 
	<div>
	<label>  Copia legalizada ante notario del Decreto de reconocimiento, emanado del MINEDUC</label><br />
		 <input type="file"  class="inputfile" name="ate_legal_archivo_universidad_reconocimiento" /></td>
		<span>(*)</span> <span>{ayuda_reconocimiento}</span> 	
		{documento_universidad_reconocimiento} 
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 
	</div>
	 
	<div>
		<label>
		Copia  legalizada ante notario del documento que certifica la acreditaci&oacute;n de la Universidad y su  duraci&oacute;n</label><br /><font id='bloque_ate_documento_universidad_acreditacion_privada_estado' class="edicion_enrevision"> </font><br />
		<input type="file"  class="inputfile" name="ate_legal_archivo_universidad_acreditacion_privada" />
		<span>(*) </span><span>{ayuda_acreditacion}</span> 	
		{documento_universidad_acreditacion_privada}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl -->
		</div> 
	<div>
		<label>Carta  de patrocinio de la   Universidad avalando la postulaci&oacute;n al registro ATE:</label>
		<br />
		<input type="file"  class="inputfile" name="ate_legal_archivo_universidad_patrocinio_privada" />
		<span>(*)</span><span>{ayuda_patrocinio}</span> 
		{documento_universidad_patrocinio_privada}  
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div>
</fieldset> 
	 