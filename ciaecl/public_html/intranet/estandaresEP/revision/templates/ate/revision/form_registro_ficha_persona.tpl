  

<div  class="fieldset_title"  id='titulo_revision_portafolio_capital_humano-datos-{rut}' >
<img src="images/iconos/revision{revision_persona_natural_estado_revision_img}.gif" />   Datos Personales</div>

<a href="javascript:AbrirBloqueRevision('bloque_revision_portafolio_capital_humano-datos-{rut}');">Ver Datos</a>
<div id='bloque_revision_portafolio_capital_humano-datos-{rut}' class="div_oculto">

		 <fieldset>
 <div class="fieldset_title_interno">Datos Postulación</div> 
<input type="hidden" name="revision_persona_natural_rut" value="{rut}" /> 
	<div><label>Rut</label> {rut_formato} - {dv} &nbsp;&nbsp;&nbsp;&nbsp;
	
	<!-- ESTRUCTURA DE CONSULTA AL SII POR RUT -->
	<a href="javascript:findRutSII('{rut}','{dv}','ver_datos_sii_rut');showId('sii_spinner');">Ver datos SII</a>
		<div style="text-align:center" id="sii_spinner" class="div_oculto"> <img src="images/spinner.gif"    /> </div>	
		<div id='ver_datos_sii_rut' class="div_oculto"  >
			<span class="span_modificacion" >Información SII</span>
			<div id='ver_datos_sii_rut_interno'   style=" margin-top:20px;height:180px; overflow: scroll;">		</div>
			<a href=javascript:hiddenId('ver_datos_sii_rut'); >Ocultar </a>
		</div>
	</div>
	<!-- ESTRUCTURA DE CONSULTA AL SII POR RUT -->
	
		 <div>
		 	<label>Nombre Persona</label> {nombre} {apellido_paterno} {apellido_materno}  
			  <div   class="{modificacion_div_ocultos}">
			  <span class="span_modificacion" >Modificación</span>
<input type="text" name="revision_persona_natural_nombre_revision"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  {revision_persona_natural_modificacion_solo_lectura} value="{revision_persona_natural_nombre_revision}"  style="width:150px;"/>
<a href="javascript:convertirMinusculaInput('revision_persona_natural_nombre_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
<input type="text" name="revision_persona_natural_apellido_paterno_revision" onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  {revision_persona_natural_modificacion_solo_lectura}  value="{revision_persona_natural_apellido_paterno_revision}"  style="width:150px;"/>
<a href="javascript:convertirMinusculaInput('revision_persona_natural_apellido_paterno_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
<input type="text" name="revision_persona_natural_apellido_materno_revision"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  {revision_persona_natural_modificacion_solo_lectura} value="{revision_persona_natural_apellido_materno_revision}" style="width:150px;" /> <a href="javascript:convertirMinusculaInput('revision_persona_natural_apellido_materno_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
</div>
		 </div>
		 
		  
<div>
<label>Título o Grado Académico</label> {titulo_nombre}<br />

 <div   class="{modificacion_div_ocultos}">
			  <span class="span_modificacion" >Modificación</span><input  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');" type="text" {revision_persona_natural_modificacion_solo_lectura}  name="revision_persona_natural_titulo_nombre_revision" value="{revision_persona_natural_titulo_nombre_revision}">  <a href="javascript:convertirMinusculaInput('revision_persona_natural_titulo_nombre_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		 </div>
 
		 <!-- START BLOCK : datos_archivo_titulo -->
		 Archivo Actual :  <span id='documento_titulo' ><a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=titulo_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Título">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
	 
	</span>
		  <!-- END BLOCK : datos_archivo_titulo -->  
</div>
	<div >
	<label>Institución que otorgó el diploma</label> {titulo_institucion}
 <div   class="{modificacion_div_ocultos}">
  <span class="span_modificacion" >Modificación</span><input type="text"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  {revision_persona_natural_modificacion_solo_lectura} name="revision_persona_natural_titulo_institucion_revision" value="{revision_persona_natural_titulo_institucion_revision}" >	 <a href="javascript:convertirMinusculaInput('revision_persona_natural_titulo_institucion_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
			</div> 
	</div>
	<div >
	<label> Post-título</label> {postitulo_nombre}
	<div   class="{modificacion_div_ocultos}">
 
	 <span class="span_modificacion" >Modificación</span><input type="text"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  {revision_persona_natural_modificacion_solo_lectura} name="revision_persona_natural_postitulo_nombre_revision" value="{revision_persona_natural_postitulo_nombre_revision}"> 
	  <a href="javascript:convertirMinusculaInput('revision_persona_natural_postitulo_nombre_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
			  </div>
		 <!-- START BLOCK : datos_archivo_postitulo -->
		  Archivo Actual : <span id='documento_postitulo' >
		<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=postitulo_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Título">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp; 
	</span>
		  <!-- END BLOCK : datos_archivo_postitulo -->  
	</div>
	<div >
		<label>Institución que otorgó el diploma</label> {postitulo_institucion}
		<div   class="{modificacion_div_ocultos}">
		<span class="span_modificacion" >Modificación</span><input  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  {revision_persona_natural_modificacion_solo_lectura} type="text" name="revision_persona_natural_postitulo_institucion_revision" value="{revision_persona_natural_postitulo_institucion_revision}"> 
		  <a href="javascript:convertirMinusculaInput('revision_persona_natural_postitulo_institucion_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
			  </div> 
	</div>
	
	
	
<div >
	<label> Post-título 2 </label> (solo habra datos si la persona postuló como persona natural) {postitulo2_nombre}
	<div   class="{modificacion_div_ocultos}">
 
	 <span class="span_modificacion" >Modificación</span><input   onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');" {revision_persona_natural_modificacion_solo_lectura} type="text" name="revision_persona_natural_postitulo2_nombre_revision" value="{revision_persona_natural_postitulo2_nombre_revision}"> 
	  <a href="javascript:convertirMinusculaInput('revision_persona_natural_postitulo2_nombre_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
			  </div>
	 <!-- START BLOCK : datos_archivo_postitulo2 -->
	<span id='documento_postitulo2' >
		<strong>Archivo actual :</strong>
		<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=doctorado_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Doctorado">
		<img src="images/download_act.jpg" border="0" /></a>  
	</span>
		  <!-- END BLOCK : datos_archivo_postitulo2 -->    
	</div>
	<div >
		<label>Institución que otorgó el diploma</label> {postitulo2_institucion}
		<div   class="{modificacion_div_ocultos}">
		<span class="span_modificacion" >Modificación</span><input  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');" {revision_persona_natural_modificacion_solo_lectura} type="text" name="revision_persona_natural_postitulo2_institucion_revision" value="{revision_persona_natural_postitulo2_institucion_revision}"> 
		  <a href="javascript:convertirMinusculaInput('revision_persona_natural_postitulo2_institucion_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
			  </div> 
	</div>	
	


 <div>
 <label> Inscripción en Registros Externos</label>   <br />
	    
		<input type="radio"  class="inputcheckbox"  disabled="disabled" name="ate_persona_otro_registro" value="si" {checked_si}/>Si  &nbsp;&nbsp;&nbsp;
		<input type="radio"  class="inputcheckbox"  disabled="disabled" name="ate_persona_otro_registro" value="no"   {checked_no}/>No
	  <br /> <br />
		<label>&iquest;Cu&aacute;l?</label><br  />
		   
			<select  disabled="disabled" name="ate_persona_otro_registros[]"   multiple="multiple" size="8" style="height:auto" >
			 
			<!-- START BLOCK : bloque_ate_legal_otro -->
			<option value="{ate_legal_otro_id}" {ate_legal_otro_selected}  >{ate_legal_otro_registro}</option>
			<!-- END BLOCK : bloque_ate_legal_otro --> 
			</select> 
		
		<br />
		<label>Otro</label> {otro_registro}
					<!-- START BLOCK : bloque_ate_legal_otro_nodisable -->
		<script>
	inputRegistroRadio[0].checked 		= true;  
</script>
			<!-- END BLOCK : bloque_ate_legal_otro_nodisable -->
		<div   class="{modificacion_div_ocultos}">
		<span class="span_modificacion" >Modificación</span><input name="revision_persona_natural_otro_registro_revision"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');" {revision_persona_natural_modificacion_solo_lectura} value="{revision_persona_natural_otro_registro_revision}"  maxlength="70" />
		 <a href="javascript:convertirMinusculaInput('revision_persona_natural_otro_registro_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		 </div>
	</div> 
	
		{revision_persona_natural_formulario}
</fieldset>


<a href="javascript:CerrarBloqueRevision('revision_portafolio_capital_humano-datos-{rut}');">Ocultar Datos</a>
	
	  </div>

	
<div  class="fieldset_title"  id='titulo_revision_portafolio_capital_humano-relacion-{rut}' ><img src="images/iconos/revision{revision_portafolio_capital_humano_estado_revision_img}.gif" />  Relación con Institución</div>

<input type="hidden" name="revision_portafolio_capital_humano_rut" value="{rut}" /> 

<a href="javascript:AbrirBloqueRevision('bloque_revision_portafolio_capital_humano-relacion-{rut}');">Ver Datos</a>
<div id='bloque_revision_portafolio_capital_humano-relacion-{rut}' class="div_oculto">


<fieldset>

 <div class="fieldset_title_interno">Datos Postulación</div> 
	
	<div>
<label>Tipo de Jornada en la Institución  </label> <br />
	      
			 
			<!-- START BLOCK : bloque_ate_persona_jornada -->
			<input  type="radio"  disabled="disabled" class="inputcheckbox" name="ate_persona_jornada" value="{ate_persona_jornada_id}" {ate_persona_jornada_selected}  ><strong>{ate_legal_otro_registro} </strong><br />  
			<!-- END BLOCK : bloque_ate_persona_jornada --> 
		</div>
			<div>	   
<label> Cargo que desempeña en la Institución</label> <br />
	   
	<strong>Cargo </strong>{cargo}
		
		
		 <div   class="{modificacion_div_ocultos}">
		  <span class="span_modificacion" >Modificación</span><input  onchange="javascript:modificacionTexto('revision_portafolio_capital_humano_revision_modifico_texto');"  {revision_portafolio_capital_humano_modificacion_solo_lectura} type="text" name="revision_portafolio_capital_humano_cargo_revision" value="{revision_portafolio_capital_humano_cargo_revision}">
		   <a href="javascript:convertirMinusculaInput('revision_portafolio_capital_humano_cargo_revision','{revision_portafolio_capital_humano_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		  
		  </div>
			  </div><div>
			  
<label> Horas semanales disponibles para realizar Asistencia Técnica  </label> <br />
 
		<strong>Horas :</strong> {horas} 
		
		 <div   class="{modificacion_div_ocultos}">
		  <a href="javascript:mostrarHHRecursos('{rut}','ver_datos_hh_recursos','hh_recursos_spinner');">Ver Horas en otras instituciones</a>
		
		<div style="text-align:center" id="hh_recursos_spinner" class="div_oculto"> <img src="images/spinner.gif"    /> </div>	
		
		<div id='ver_datos_hh_recursos' class="div_oculto"  >
		 <strong><u>Información de Horas Disponibles como Persona Natural y Capital Humano de otras Instituciones</u></strong>
		<div id='ver_datos_hh_recursos_interno'   style=" margin-top:10px;height:180px; overflow: scroll;">	
		
		
		</div>
		<a href=javascript:hiddenId('ver_datos_hh_recursos');hiddenId('ver_datos_hh_recursos_interno');hiddenId('hh_recursos_spinner'); >Ocultar </a>
		</div>
		</div>
		
		
		
			      
	</div> 
	
	<div>
<label> Especialización y Experiencia Individual </label> 
	{tpl_experiencia_persona}  

  </div>

{revision_portafolio_capital_humano_formulario}
 </fieldset>
 
  
<a href="javascript:CerrarBloqueRevision('revision_portafolio_capital_humano-relacion-{rut}');hiddenId('ver_datos_hh_recursos');hiddenId('ver_datos_hh_recursos_interno');hiddenId('hh_recursos_spinner');">Ocultar Datos</a>
	
	  </div>