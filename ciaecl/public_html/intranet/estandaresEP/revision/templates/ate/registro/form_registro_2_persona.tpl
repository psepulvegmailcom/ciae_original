
{tpl_ayuda_file} 

 
{doc_obligaciones_laborales} 

<!-- START BLOCK : bloque_ate_persona_con_registro_texto -->
<div class="fieldset_title"> Documentos de acreditación o pertenencia en los registros validados por MINEDUC.<br /> 
	<small> Estos documentos deben certificar una antigüedad mínima de hace un año en estos registros.</small>
</div>	  
<fieldset> 
	<div> 
		<label>
			Certificado de membresía y o participación de los registros o estrategias mencionados en los criterios de ingreso, emitido por la institución que realizó la acreditación o que llevó a cabo la estrategia o programa.
		</label> </div>
		<div>
		<font id='bloque_ate_documento_persona_acreditacion_estado' class="edicion_enrevision"> </font><br>
		<strong>1</strong>  	<input type="file"  class="inputfile" name="ate_legal_archivo_persona_acreditacion"   /> 
	<span>(*) </span><span>{ayuda_persona_acreditacion}</span> 		
	{documento_persona_acreditacion}	
	
			
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> </div>
	
	<div>
		<font id='bloque_ate_documento_persona_acreditacion_2_estado' class="edicion_enrevision"> </font><br>
		<strong>2</strong>  	<input type="file"  class="inputfile" name="ate_legal_archivo_persona_acreditacion_2"   /> 
<span>{obligatorio_2} </span> 
	 <span>{ayuda_persona_acreditacion}</span> 		
	{documento_persona_acreditacion_2}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> </div>
	<div>
		<font id='bloque_ate_documento_persona_acreditacion_3_estado' class="edicion_enrevision"> </font><br>
		<strong>3</strong>  	<input type="file"  class="inputfile" name="ate_legal_archivo_persona_acreditacion_3"   /> 
<span>{obligatorio_3} </span> 
	 <span>{ayuda_persona_acreditacion}</span> 		
	{documento_persona_acreditacion_3}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> </div>
	<div>
		<font id='bloque_ate_documento_persona_acreditacion_4_estado' class="edicion_enrevision"> </font><br>
		<strong>4 </strong> 	<input type="file"  class="inputfile" name="ate_legal_archivo_persona_acreditacion_4"   /> 
<span>{obligatorio_4} </span> 

	<span>{ayuda_persona_acreditacion}</span> 		
	{documento_persona_acreditacion_4}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 
		</div>	 
	</fieldset>
<!-- END BLOCK : bloque_ate_persona_con_registro_texto -->
<!-- START BLOCK : bloque_ate_persona_sin_registro_texto --> 
	<div class="fieldset_title"> 
	   Cartas de Recomendaci&oacute;n </div>
	  
<fieldset>  
	<div> 
		<label>
			Adjunte cartas de recomendación de al menos tres sostenedores o establecimientos educacionales que hayan contado con sus servicios profesionales.<span>{ayuda_persona_carta_recomandacion_no_registro}</span>
		</label> 
	</div>
	<div>
		<strong>Carta n&deg;	1</strong>
		<input type="file"  class="inputfile" name="ate_legal_archivo_persona_carta_recomendacion_1"   /> 
		<span>(*) </span> 		
		{documento_persona_carta_recomendacion_1}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl -->  

	</div>
	<div>
		<strong>	Carta n&deg;	2</strong> 	<input type="file"  class="inputfile" name="ate_legal_archivo_persona_carta_recomendacion_2"   /> 
		<span>(*) </span> 
		{documento_persona_carta_recomendacion_2}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div>
	<div>
		<strong>Carta n&deg;	3</strong>	
	    <input type="file"  class="inputfile" name="ate_legal_archivo_persona_carta_recomendacion_3"   /> 
		<span>(*) </span> 	
		{documento_persona_carta_recomendacion_3}	
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div>
	<br />
	Si desea proporcionar cartas adicionales, &eacute;stas deben ser adjuntadas  en el portafolio de experiencias (Paso 4) 
	<br /><!--<br /><label>Las cartas de  recomendaci&oacute;n <u>no son documentos obligatorios</u> en esta primera etapa de  postulaci&oacute;n al registro ATE. <br />Sin embargo, en caso de que su oferta sea validada  por el Ministerio de Educaci&oacute;n, Usted tendr&aacute; la <u>obligaci&oacute;n de adjuntar</u> estas referencias durante la segunda quincena de Marzo, una vez que el registro  sea publicado.</label>-->
<!-- END BLOCK : bloque_ate_persona_sin_registro_texto -->  
 
	 
<!-- START BLOCK : bloque_ate_persona_no_seleccion_registro -->
<div class="fieldset_title">Para continuar su registro debe completar el Paso 1, indicando el tipo de registro al cual pertenece</div>
<!-- END BLOCK : bloque_ate_persona_no_seleccion_registro --> 
  
</fieldset> 	

<script>	

	function chequeoTipoDatos(action,level)
	{
	 
			desbloquearFormularioDevuelto();
		chequeoTipoDatosCompleto(action,level); 
			bloquearFormularioDevuelto();			
	}
	function chequeoTipoDatosCompleto(action,level)
	{	 	
		process(action,level);
	}
</script>	