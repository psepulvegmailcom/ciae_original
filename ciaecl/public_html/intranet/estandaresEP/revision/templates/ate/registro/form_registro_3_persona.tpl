
  <div class="fieldset_title"> Antecedentes Académicos</div>
  {tpl_ayuda_file}


 <fieldset>
<div>

	

<label>Título profesional o primer grado académico</label><br />

<input type="text" name="ate_persona_titulo_nombre" value="{titulo_nombre}"> <span>(*)</span><span>{ayuda_persona_titulo}</span><br />
<span> Adjunte certificado de título </span>  <br />
 <input type="file"  class="inputfile" name="ate_persona_archivo_titulo" >	 	
		<span>(*)</span> 
		 <!-- START BLOCK : datos_archivo_titulo -->
	<span id='documento_titulo' >
	<strong>Archivo actual :</strong>	<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=titulo_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Título">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
	<a onclick="javascript:borrarArchivoOferenteRecurso('titulo','{rut_documento}');" id='boton_borrar_titulo' title="Eliminar Documento Actual"><img src="images/delete.jpg" border="0" /></a>
	<input type="hidden" name="ate_persona_archivo_titulo_existe"  value="yes" />
	</span>
		  <!-- END BLOCK : datos_archivo_titulo -->  
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 
</div>
	<div >
	<label>Institución que otorgó el diploma</label><br />
	<input type="text" name="ate_persona_titulo_institucion" value="{titulo_institucion}" >	
			<span>(*)</span> <span>{ayuda_persona_titulo_institucion}</span>
	</div>
	
	<!-- START BLOCK : bloque_texto_sin_registro --> 
	<div><strong>Señale al menos un post grado (*)</strong></div>
	<!-- END BLOCK : bloque_texto_sin_registro --> 
	
	<div >
	<label> {titulo_postitulo}</label> <span>{titulo_postitulo_explicacion}</span><br />
	<input type="text" name="ate_persona_postitulo_nombre" value="{postitulo_nombre}"><span>{ayuda_persona_postitulo}</span>
			  <br />
<span>Adjuntar certificado de {titulo_postitulo}</span>   <br />
 <input type="file"  class="inputfile" name="ate_persona_archivo_postitulo" >	 	
		 
		 <!-- START BLOCK : datos_archivo_postitulo -->
	<span id='documento_postitulo' >
		<strong>Archivo actual :</strong>
		<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=postitulo_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Título">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
	<a onclick="javascript:borrarArchivoOferenteRecurso('postitulo','{rut_documento}');"  id='boton_borrar_postitulo'  title="Eliminar Documento Actual">
	<img src="images/delete.jpg" border="0" /></a>
	<input type="hidden" name="ate_persona_archivo_postitulo_existe"  value="yes" />
	</span>
		  <!-- END BLOCK : datos_archivo_postitulo --> 
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl -->  
	</div>
	<div >
	<label>Institución que otorgó el diploma</label><br />
	<input type="text" name="ate_persona_postitulo_institucion" value="{postitulo_institucion}">
		 <span>{ayuda_persona_postitulo_institucion}</span>
	</div>
	
	<!-- START BLOCK : bloque_postitulo2_sin_registro -->
	<div >
	<label> Doctorado</label><br />
<font class="edicion_enrevision" id='ate_persona_postitulo2_nombre_estado'></font><br>
	<input type="text" name="ate_persona_postitulo2_nombre" value="{postitulo2_nombre}"><span>{ayuda_persona_postitulo}</span>
			  <br />
<span>Adjuntar certificado de Doctorado</span>   <br />
<font class="edicion_enrevision" id='bloque_ate_documento_ate_persona_archivo_postitulo2_estado'></font><br>
 <input type="file"  class="inputfile" name="ate_persona_archivo_postitulo2" >	 	
		 
		 <!-- START BLOCK : datos_archivo_postitulo2 -->
	<span id='documento_postitulo2{edicion}' >
		<strong>Archivo actual :</strong>
		<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=doctorado_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Doctorado">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
	<a onclick="javascript:borrarArchivoOferenteRecurso('postitulo2','{rut_documento}');"  id='boton_borrar_postitulo2{edicion}' title="Eliminar Documento Actual">
	<img src="images/delete.jpg" border="0" /></a>
	<input type="hidden" name="ate_persona_archivo_postitulo2_existe{edicion}"  value="yes" />
	</span>
		  <!-- END BLOCK : datos_archivo_postitulo2 -->  
	</div>
	<div >
	<label>Institución que otorgó el diploma</label><br />
<font class="edicion_enrevision" id='ate_persona_postitulo2_institucion_estado'></font><br>
	<input type="text" name="ate_persona_postitulo2_institucion" value="{postitulo2_institucion}">
		 <span>{ayuda_persona_postitulo_institucion}</span>
	</div>

	<!-- END BLOCK : bloque_postitulo2_sin_registro -->

	
</fieldset>
{nuevos_titulos_old}
 
<div class="fieldset_title">Horas semanales disponibles para realizar Asistencia Técnica <span>{ayuda_persona_jornada}</span></div>
	 
<fieldset>
	<div>  
<font class="edicion_enrevision" id='ate_persona_horas_disponibles_estado'></font><br>
		<input type="text" name="ate_persona_horas" value="{ate_personas_horas}"  onChange="document.main.ate_persona_horas_disponibles.value=document.main.ate_persona_horas.value"/>
			     <input type="hidden" name="ate_persona_horas_disponibles"  value="{ate_personas_horas}">
				
			 <span>(*)</span> <span>{ayuda_persona_horas}</span>	
	</div>
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
	if((!isEmpty(document.main.ate_persona_horas.value) &&  !isNumber(document.main.ate_persona_horas.value)) || document.main.ate_persona_horas.value > 170 )
	{
		showAlert('Las horas de disponibilidad no puede ser mayor a 170 horas'); 
		document.main.ate_persona_horas.focus();
		return false; 
	} 	
	process(action,level);
 
}
</script>