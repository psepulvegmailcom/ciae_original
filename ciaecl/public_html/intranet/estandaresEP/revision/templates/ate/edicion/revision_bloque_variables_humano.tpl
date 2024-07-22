<!-- START BLOCK : bloque_actualizacion_variables_bloque -->
<div class="fieldset_title" style="font-size:14px" id="titulo_{key}">
<img src="images/iconos/actualizacion{estado}.gif"> Capital Humano {rut_html}  <small>({tipo_actualizacion})  {fecha_actualizacion_real}</small></div>


 <a href="javascript:AbrirBloqueRevision('bloque_{key}');" >Ver Datos</a>
<div  id='bloque_{key}' class="div_oculto"> 
<fieldset>


	<div id='valores_originales_{key}' class="{ocultar_original}">
	
	<div class="fieldset_title_interno">Valores originales    </div> 
	
  <label>Rut capital humano</label><br> {rut_capital_html}<br>
  <label>Nombre capital humano</label><br>  {nombre_original} 	{apellido_paterno_original} 	{apellido_materno_original}<br>
	
	
  <label>Título profesional o primer grado académico</label><br>    
	Título : {titulo_nombre_original} <br>
	Institución Título :  {titulo_institucion_original} <br>
	Certificado Título : <a href="download.php?caso=oferente_documento_file&file={titulo_archivo_original}&nombre=titulo_archivo.{titulo_extension_original}" target="_blank"  title="Bajar Documento Actual"><img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;<br><br>
	
	<div  class="{postitulo_ocultar_original}">
  <label>Post-título o postgrado académico</label><br>    
	 Título : {postitulo_nombre_original} <br>
	Institución Título :  {postitulo_institucion_original} <br>
	Certificado Título : <a href="download.php?caso=oferente_documento_file&file={postitulo_archivo_original}&nombre=postitulo_archivo.{postitulo_extension_original}" target="_blank"  title="Bajar Documento Actual"><img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;<br><br>
	
	</div>
	
  <label>Cargo</label><br>  
	{cargo_original} <br> 
	<label>Disponibilidad</label><br>    
	  {disponibilidad_original} <br>
	<label>Horas disponibles</label><br>    
	  {horas_disponibles_original} <br>
	  
	<label>Registro Externos</label><br>  
	  <div style="padding-left:30px">{registros_original_html}
	  
	
	   <br> {registros_otro_original_html}  </div><br>
	  
	<label>Área(s) de Asistencia Técnica   </label><br><br>    
	 <div style="padding-left:30px">{subarea_original_html} </div><br>
  </div>
  
  
	<div id='valores_actualizados_{key}'>
	
	<div class="fieldset_title_interno">Valores actualizados    </div>
   <label>Rut capital humano</label><br> {rut_capital_html}&nbsp;&nbsp;
   
   
		  
		<!-- ESTRUCTURA DE CONSULTA AL SII POR RUT -->
			<a href="javascript:findRutSII('{rut_capital}','{rut_dv_capital}','ver_datos_sii_rut_{key}');showId('sii_spinner_{key}');">Ver datos SII</a>
				<div style="text-align:center" id="sii_spinner_{key}" class="div_oculto"> 
					<img src="images/spinner.gif"    />
				 </div>	
			<div id='ver_datos_sii_rut_{key}' class="div_oculto"  >			
				<span class="span_modificacion" >Información SII</span>
					<div id='ver_datos_sii_rut_{key}_interno'   style=" margin-top:20px;height:180px; overflow: scroll;">				
					
					</div>
				<a href=javascript:hiddenId('ver_datos_sii_rut_{key}'); >Ocultar </a>
			</div>
			
		<!-- ESTRUCTURA DE CONSULTA AL SII POR RUT -->
   
   
   
   
   <br>  <br>  
   
  <label>Nombre capital humano</label><br>    
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {nombre} {apellido_paterno} {apellido_materno}</div>
	<input type="text" name="capital_nombre_{key}"	 value="{nombre_revision}"	 style="width:160px" maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_nombre_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
	<input type="text" name="capital_apellido_paterno_{key}"	 value="{apellido_paterno_revision}"	 style="width:160px" maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_apellido_paterno_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
	<input type="text" name="capital_apellido_materno_{key}"	 value="{apellido_materno_revision}"	 style="width:160px" maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_apellido_materno_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
	
	<br>
  <label>Título profesional o primer grado académico</label><br> 
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {titulo_nombre}</div>   
	Título : <input type="text" name="capital_titulo_nombre_{key}"	 value="{titulo_nombre_revision}"	   maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_titulo_nombre_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <br>
	Institución Título : <br>
	
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {titulo_institucion}</div>  
	<input type="text" name="capital_titulo_institucion_{key}"	 value="{titulo_institucion_revision}"	   maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_titulo_institucion_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>  <br>
	Certificado Título : <a href="download.php?caso=oferente_documento_file&file={titulo_archivo}&nombre=titulo_archivo.{titulo_extension}" target="_blank"  title="Bajar Documento Actual"><img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;<br><br>
	
	<div  class="{postitulo_ocultar_actualizados}">
  <label>Post-título o postgrado académico</label><br>    
	Título : <br>
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {postitulo_nombre}</div>  <br><input type="text" name="capital_postitulo_nombre_{key}"	 value="{postitulo_nombre_revision}"	  maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_postitulo_nombre_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <br>
	Institución Título : <br>
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {postitulo_institucion}</div><br><input type="text" name="capital_postitulo_institucion_{key}"	 value="{postitulo_institucion_revision}"	  maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_postitulo_institucion_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>  <br>
	Certificado Título : <a   href="download.php?caso=oferente_documento_file&file={postitulo_archivo}&nombre=postitulo_archivo.{postitulo_extension}" target="_blank"  title="Bajar Documento Actual"><img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;<br><br>
	</div>
	
  <label>Cargo</label><br>    
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {cargo}</div>
	  <input type="text" name="capital_cargo_{key}"	 value="{cargo_revision}"	  maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_cargo_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <br>
  <label>Disponibilidad</label><br>   
   
	  {disponibilidad_html} <br>
  <label>Horas disponibles</label><br>    
  <div class="edicion_enrevision_interna"  ><strong>Actualización usuario :</strong> {horas_disponibles}</div>
	  <input type="text" name="capital_horas_disponibles_{key}"	 value="{horas_disponibles_revision}"	  maxlength="255" />	<a href="javascript:convertirMinusculaInput('capital_horas_disponibles_{key}','{modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <br>
	  
	  
	  <!-- CANTIDAD DE HORAS CON OTRAS INSTITUCIONES -->
	  
	  		 <div   >
		 	<a href="javascript:mostrarHHRecursos('{rut_capital}','ver_datos_hh_recursos_{key}','hh_recursos_spinner_{key}');">Ver Horas en otras instituciones</a>
		
			<div style="text-align:center" id="hh_recursos_spinner_{key}" class="div_oculto"> 
				<img src="images/spinner.gif"    /> 
			</div>	
		
			<div id='ver_datos_hh_recursos_{key}' class="div_oculto"  >
				<strong><u>Información de Horas Disponibles como Persona Natural y Capital Humano de otras Instituciones</u></strong>
				<div id='ver_datos_hh_recursos_{key}_interno'   style=" margin-top:10px;height:180px; overflow: scroll;">	
					</div>
				<a href=javascript:hiddenId('ver_datos_hh_recursos_{key}');hiddenId('ver_datos_hh_recursos_{key}_interno');hiddenId('hh_recursos_spinner_{key}'); >Ocultar </a>
			</div>
		</div>
		
	  <!-- CANTIDAD DE HORAS CON OTRAS INSTITUCIONES -->
	  
		
	  
	  
	
		<label>Registro Externos</label><br>  
		
	 <div style=" padding-left:30px; ">
	  {registros_html} 
	   <br> {registros_otro_html} 
	   </div>
	  </ul><br>
	  
	<label>Área(s) de Asistencia Técnica (*) </label><br> <br>    
	 
	
	 <div style=" padding-left:30px; ">
	  {subarea_html}	 
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
