 <div  class="fieldset_title_separador">Identificación General y Antecedentes Académicos</div>
	
<div class="fieldset_title" id='titulo_revision_persona_natural'><img src="images/iconos/revision{revision_persona_natural_estado_revision_img}.gif" />    Datos Personales y Antecedentes Académicos </div>

<a href="javascript:AbrirBloqueRevision('bloque_revision_persona_natural'); extra_vista_postitulos('{modificacion_div_ocultos}','{revision_persona_natural_modificacion_solo_lectura}','{revision_persona_natural_postitulo2_institucion_revision}','{revision_persona_natural_postitulo2_nombre_revision}','{postitulo_nombre}','{postitulo_institucion}','{postitulo2_nombre}','{postitulo2_institucion}');">Ver Datos</a>

 
<input type="hidden" name="tmp_postitulo_modificacion_div_ocultos" value="{modificacion_div_ocultos}" />
<input type="hidden" name="tmp_postitulo_revision_persona_natural_modificacion_solo_lectura" value='{revision_persona_natural_modificacion_solo_lectura}'  />
<input type="hidden" name="tmp_postitulo_revision_persona_natural_postitulo2_institucion_revision"  value='{revision_persona_natural_postitulo2_institucion_revision}'  />
<input type="hidden" name="tmp_postitulo_revision_persona_natural_postitulo2_nombre_revision"  value='{revision_persona_natural_postitulo2_nombre_revision}'  />
<input type="hidden" name="tmp_postitulo_postitulo_nombre" value='{postitulo_nombre}'  />
<input type="hidden" name="tmp_postitulo_postitulo_institucion" value='{postitulo_institucion}'  />
<input type="hidden" name="tmp_postitulo_postitulo2_nombre" value='{postitulo2_nombre}'  />
<input type="hidden" name="tmp_postitulo_postitulo2_institucion"  value='{postitulo2_institucion}'  /> 
 

<div id='bloque_revision_persona_natural' class="div_oculto">
	<fieldset>
	<div class="fieldset_title_interno">Datos Postulación Identificación General</div>
	 	<div>
		<label>Nombre</label>  <span class="revision_informacion">{persona_nombre}    {persona_apellido_paterno}   {persona_apellido_materno} </span>
		
		 <div   class="{modificacion_div_ocultos}">
		  <span class="span_modificacion" >Modificación</span>  <input  maxlength='255'  {revision_persona_natural_modificacion_solo_lectura} style="width:150px"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');" type="text" name="revision_persona_natural_nombre_revision" value="{revision_persona_natural_nombre_revision}" /> 
		  <a href="javascript:convertirMinusculaInput('revision_persona_natural_nombre_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		  <input   maxlength='255'  {revision_persona_natural_modificacion_solo_lectura}  type="text" style="width:150px"  name="revision_persona_natural_apellido_paterno_revision" value="{revision_persona_natural_apellido_paterno_revision}"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');" />
		  <a href="javascript:convertirMinusculaInput('revision_persona_natural_apellido_paterno_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> <input  {revision_persona_natural_modificacion_solo_lectura}   maxlength='255'  style="width:150px"  type="text" name="revision_persona_natural_apellido_materno_revision" value="{revision_persona_natural_apellido_materno_revision}" onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  />
		  <a href="javascript:convertirMinusculaInput('revision_persona_natural_apellido_materno_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		  </div>
	</div> 
	<div>
		<label>Rut  </label> 
		 
			<!-- START BLOCK : bloque_ate_persona_rut_fijo -->
			
		<input  type="hidden" name="ate_persona_rut" value="{rut_persona}"      >   
		<input type="hidden"  name="ate_persona_dv"    value="{rut_persona_dv}"      >
		  <span class="revision_informacion"> {rut_persona_formato} -  {rut_persona_dv}  </span>
		  
		  
		<!-- ESTRUCTURA DE CONSULTA AL SII POR RUT -->
			<a href="javascript:findRutSII('{rut_persona}','{rut_persona_dv}','ver_datos_sii_rut');showId('sii_spinner');">Ver datos SII</a>
				<div style="text-align:center" id="sii_spinner" class="div_oculto"> <img src="images/spinner.gif"    /> </div>	
			<div id='ver_datos_sii_rut' class="div_oculto"  >
			
			<span class="span_modificacion" >Información SII</span>
			<div id='ver_datos_sii_rut_interno'   style=" margin-top:20px;height:180px; overflow: scroll;">	
			
			
			</div>
			<a href=javascript:hiddenId('ver_datos_sii_rut'); >Ocultar </a>
			</div>
			
		<!-- ESTRUCTURA DE CONSULTA AL SII POR RUT -->
		
			<!-- END BLOCK : bloque_ate_persona_rut_fijo -->
		 	
	</div>  

	<div>
	<label>Email</label>   <span class="revision_informacion"> {persona_email}</span> 
	</div>

<div>
		<label>Direcci&oacute;n  </label> 
	 {persona_direccion}
		
		 <div   class="{modificacion_div_ocultos}">
	 	<span class="span_modificacion" >Modificación</span>
<textarea  class="textarea_revision"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  {revision_persona_natural_modificacion_solo_lectura}  name="revision_persona_natural_direccion_revision" >{revision_persona_natural_direccion_revision}</textarea> <a href="javascript:convertirMinusculaInput('revision_persona_natural_direccion_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 </div>
	</div> 	
	<div>
		<label>Comuna  	</label>  {comuna_persona}	</div>
	<div>



	<div>
	<label>Teléfono de Contacto </label>   <span class="revision_informacion">&nbsp;&nbsp;&nbsp;&nbsp;{telefono_codigo} - {telefono}</span> 
	</div>
	<div>
	<label>Celular de Contacto </label>   <span class="revision_informacion">&nbsp;&nbsp;&nbsp;&nbsp;{celular_codigo} - {celular}</span> 
	</div>
	 
	 
	   
	<div>
		<label>P&aacute;gina Web</label>  <a href="{url}" target="_blank">{url}</a>
	</div> 
	
	 
	   
<div>
	<div class="fieldset_title_interno">Datos Postulación Antecedentes Académicos</div>
<label>Título o Grado Académico</label>   {titulo_nombre}  


		 <div   class="{modificacion_div_ocultos}">
		  <span class="span_modificacion" >Modificación</span>  <textarea  class="textarea_revision_text"    onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"   maxlength='255'  {revision_persona_natural_modificacion_solo_lectura}  name="revision_persona_natural_titulo_nombre_revision"  />{revision_persona_natural_titulo_nombre_revision}</textarea>
		   <a href="javascript:convertirMinusculaInput('revision_persona_natural_titulo_nombre_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>  
 </div>
 <br />
<label>Archivo Título o Grado Académico</label>    <br />
		 <!-- START BLOCK : datos_archivo_titulo -->
	<span id='documento_titulo' >
	<strong>Archivo actual :</strong>	<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=titulo_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Título">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
	 
	</span>
		  <!-- END BLOCK : datos_archivo_titulo -->  
</div>
	<div >
	<label>Institución que otorgó el diploma</label>    {titulo_institucion} 
	
		 <div   class="{modificacion_div_ocultos}">
		  <span class="span_modificacion" >Modificación</span>  <textarea  class="textarea_revision_text"    onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"   maxlength='255'  {revision_persona_natural_modificacion_solo_lectura}  name="revision_persona_natural_titulo_institucion_revision" >{revision_persona_natural_titulo_institucion_revision} </textarea>
		   <a href="javascript:convertirMinusculaInput('revision_persona_natural_titulo_institucion_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		 </div>
	</div>
	 
	
	<div >
	<label> Postitulo 1</label>   <span id='postitulo_nombre_revision_span'></span>
	
		 <div   class="{modificacion_div_ocultos}"> <span class="span_modificacion" >Modificación</span>  <textarea  class="textarea_revision_text"    onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"   maxlength='255'  {revision_persona_natural_modificacion_solo_lectura}  name="revision_persona_natural_postitulo_nombre_revision"  />{revision_persona_natural_postitulo_nombre_revision} </textarea>
		   <a href="javascript:convertirMinusculaInput('revision_persona_natural_postitulo_nombre_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		 </div>
			  <br />  	
		 
<label>Archivo Postítulo o Grado Académico</label>    <br />
		 <!-- START BLOCK : datos_archivo_postitulo -->
	<span id='documento_postitulo' >
		<strong>Archivo actual :</strong>
		<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=postitulo_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Título">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
	 
	</span>
		  <!-- END BLOCK : datos_archivo_postitulo -->  
	</div>
	<div >
	<label>Institución que otorgó el diploma</label>     <span id='postitulo_institucion_revision_span'></span>
	
		 <div   class="{modificacion_div_ocultos}">
		 <span class="span_modificacion" >Modificación</span>  <textarea  class="textarea_revision_text"   onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');" type="text"  maxlength='255'  {revision_persona_natural_modificacion_solo_lectura} name="revision_persona_natural_postitulo_institucion_revision" >{revision_persona_natural_postitulo_institucion_revision}</textarea>
		   <a href="javascript:convertirMinusculaInput('revision_persona_natural_postitulo_institucion_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		  </div>
	</div>
	
	<!-- START BLOCK : bloque_postitulo2_sin_registro -->
	<div >
	<label> Postitulo 2</label>   {postitulo2_nombre} <span id='postitulo2_nombre_revision_span'></span>
	<div   class="{modificacion_div_ocultos}" id='revision_persona_natural_postitulo2_nombre_div'>
		 <span class="span_modificacion" >Modificación</span> 
		 <textarea  class="textarea_revision_text"  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"    maxlength='255'  {revision_persona_natural_modificacion_solo_lectura} name="revision_persona_natural_postitulo2_nombre_revision"  ></textarea> 
			  	
		   <a href="javascript:convertirMinusculaInput('revision_persona_natural_postitulo2_nombre_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		  </div>
	
<label>Archivo Doctorado</label>    <br />	 
		 <!-- START BLOCK : datos_archivo_postitulo2 -->
	<span id='documento_postitulo2' >
		<strong>Archivo actual :</strong>
		<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=doctorado_{rut_documento}.{extension_documento}" target="_blank"  title="Ver Certificado Doctorado">
		<img src="images/download_act.jpg" border="0" /></a>  
	</span>
		  <!-- END BLOCK : datos_archivo_postitulo2 -->  
	</div>
	<div >
	<label>Institución que otorgó el diploma</label>   {postitulo2_institucion} <span id='postitulo2_institucion_revision_span'></span>
	<div   class="{modificacion_div_ocultos}" id='revision_persona_natural_postitulo2_institucion_div'>
	 <span class="span_modificacion" >Modificación</span> 
	 <textarea  onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"   class="textarea_revision_text"  maxlength='255'  {revision_persona_natural_modificacion_solo_lectura} name="revision_persona_natural_postitulo2_institucion_revision"  ></textarea>
		  
		   <a href="javascript:convertirMinusculaInput('revision_persona_natural_postitulo2_institucion_revision','{revision_persona_natural_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		  </div>
	</div>

	
	<!-- END BLOCK : bloque_postitulo2_sin_registro -->



<div>
 <label> Inscripción en Registros Externos (caso particular cuando pertenece a capital humano de alguna institución)</label>   <br />
	    
		<input type="radio"  class="inputcheckbox"  disabled="disabled" name="ate_persona_otro_registro" value="si" {checked_si}/>Si  &nbsp;&nbsp;&nbsp;
		<input type="radio"  class="inputcheckbox"  disabled="disabled" name="ate_persona_otro_registro" value="no"   {checked_no}/>No
	  <br /> <br />
		<label>&iquest;Cu&aacute;l?</label><br  />
		   
			<select  disabled="disabled" name="ate_persona_otro_registros[]"    multiple="multiple" size="8" style="height:auto" >
			 
			<!-- START BLOCK : bloque_ate_legal_otro -->
			<option value="{ate_legal_otro_id}" {ate_legal_otro_selected} >{ate_legal_otro_registro}</option>
			<!-- END BLOCK : bloque_ate_legal_otro --> 
			</select> 
		
		<br />
		<label>Otro</label> {otro_registro}
		<div   class="{modificacion_div_ocultos}">
		<input name="revision_persona_natural_otro_registro_revision" {revision_persona_natural_modificacion_solo_lectura} value="{revision_persona_natural_otro_registro_revision}" onchange="javascript:modificacionTexto('revision_persona_natural_revision_modifico_texto');"  maxlength="70" />
		 <a href="javascript:convertirMinusculaInput('revision_persona_natural_otro_registro_revision','{revision_recursos_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a> 
		 </div>
	</div>



	 {revision_persona_natural_formulario} 
</fieldset>
 
 
<a href="javascript:hiddenId('ver_datos_sii_rut_interno');hiddenId('ver_datos_sii_rut');CerrarBloqueRevision('revision_persona_natural');">Ocultar Datos</a>
</div>
 
	 
	 
	 <!-- REGISTROS PERSONAS NATURALES -->
	 
	 
	  <div  class="fieldset_title_separador">Registros Experto</div> 
	 
 <div class="fieldset_title" id='titulo_revision_registros_persona_natural' ><img src="images/iconos/revision{revision_registros_persona_natural_estado_revision_img}.gif" />   Registros    </div>
 
<a href="javascript:AbrirBloqueRevision('bloque_revision_registros_persona_natural');">Ver Datos</a>
<div id='bloque_revision_registros_persona_natural' class="div_oculto">
 <fieldset><div class="fieldset_title_interno">Datos Postulación</div>
	<div> 
			<!-- START BLOCK : bloque_ate_persona_registro -->
			<br /><input type="checkbox"  class="inputcheckbox"   {ate_persona_registro_checked}   value="{bloque_ate_persona_registro_id}"  disabled="disabled" ><strong>{bloque_ate_persona_registro} </strong>
			<!-- END BLOCK : bloque_ate_persona_registro -->
			<br />
			
	</div>
 <div> 
	 
	<strong>&ldquo;Experto  fuera de los registros anteriores&rdquo;</strong> <br />  
	   
			  <input type="checkbox"  class="inputcheckbox"  {ate_persona_noregistro_checked}  disabled="disabled" name="ate_persona_noregistro">
			  <strong> Experto  fuera de los registros anteriores  </strong> 
			  <br /> 
	</div> 
 {revision_registros_persona_natural_formulario}
	 
	</fieldset>


<a href="javascript:CerrarBloqueRevision('revision_registros_persona_natural');">Ocultar Datos</a>
</div>