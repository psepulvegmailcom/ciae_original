<div  class="fieldset_title_separador">Identificación General</div>

<div  class="fieldset_title"  id='titulo_{prefijo_informacion_general}' >
<img src="images/iconos/revision{revision_informacion_general_estado_revision_img}.gif" /> Identificaci&oacute;n General  </div> 

 <a href="javascript:AbrirBloqueRevision('bloque_{prefijo_informacion_general}');" >Ver Datos</a>
<div  id='bloque_{prefijo_informacion_general}' class="div_oculto"> 
<fieldset>
	
	<div class="fieldset_title_interno">Datos Postulación</div> 
	<div>
		<label>Raz&oacute;n Social Instituci&oacute;n </label> 
		  {razon_social}  
		 <div   class="{modificacion_div_ocultos}">
		 <span class="span_modificacion" >Modificación</span> <input {revision_informacion_general_modificacion_solo_lectura} type="text" name="{prefijo_informacion_general}_razon_social_revision"   onchange="javascript:modificacionTexto('{prefijo_informacion_general}_revision_modifico_texto');" maxlength='255' value="{revision_informacion_general_razon_social_revision}" /> 
		 <a href="javascript:convertirMinusculaInput('{prefijo_informacion_general}_razon_social_revision','{revision_informacion_general_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 </div>
	</div> 
	<div>
		<label>Rut Institucional </label> 
		 {rut_institucion_formato} - {rut_institucion_dv} 
		 
	<!-- ESTRUCTURA DE CONSULTA AL SII POR RUT -->
		<a href="javascript:findRutSII('{rut_institucion}','{rut_institucion_dv}','ver_datos_sii_rut');showId('sii_spinner');">Ver datos SII</a>
		 	<div style="text-align:center" id="sii_spinner" class="div_oculto"> <img src="images/spinner.gif" /> </div>	
		<div id='ver_datos_sii_rut' class="div_oculto"  >
		 <span class="span_modificacion" >Información SII </span>
		<div id='ver_datos_sii_rut_interno'   style=" margin-top:5px;height:180px; overflow: scroll;">	</div>
		<a href="javascript:hiddenId('ver_datos_sii_rut');" >Ocultar </a>
		</div>		
	<!-- ESTRUCTURA DE CONSULTA AL SII POR RUT -->
		
	</div>  
	<div>
		<label>Nombre de Fantas&iacute;a</label> 
		{nombre_fantasia} 
		 <div   class="{modificacion_div_ocultos}">
		 <span class="span_modificacion" >Modificación</span>  <input  type="text"  {revision_informacion_general_modificacion_solo_lectura} onchange="javascript:modificacionTexto('{prefijo_informacion_general}_revision_modifico_texto');"  name="{prefijo_informacion_general}_nombre_fantasia_revision"  maxlength='255' value="{revision_informacion_general_nombre_fantasia_revision}" />
		 <a href="javascript:convertirMinusculaInput('{prefijo_informacion_general}_nombre_fantasia_revision','{revision_informacion_general_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		</div>
	</div>
	<div>
		<label>A&ntilde;o de Fundaci&oacute;n</label>	   {ano_fundacion}  
		 
	</div>
	<div>		
		<label>Objeto Social / Giro de la Institución</label> {giro} 
		 <div   class="{modificacion_div_ocultos}">
		   <span class="span_modificacion" >Modificación</span>  <input maxlength='255'  {revision_informacion_general_modificacion_solo_lectura}  type="text" onchange="javascript:modificacionTexto('{prefijo_informacion_general}_revision_modifico_texto');"  name="{prefijo_informacion_general}_giro_revision" value="{revision_informacion_general_giro_revision}" />
		   <a href="javascript:convertirMinusculaInput('{prefijo_informacion_general}_giro_revision','{revision_informacion_general_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a></div>
	</div>
	<div>		
		<label>Representante Legal</label>  	 
	   {representante} {representante_apellido_paterno} {representante_apellido_materno} 
		 <div   class="{modificacion_div_ocultos}">
		  <span class="span_modificacion" >Modificación</span>  <input   onchange="javascript:modificacionTexto('{prefijo_informacion_general}_revision_modifico_texto');"  maxlength='150' {revision_informacion_general_modificacion_solo_lectura}  style="width:150px" type="text" name="{prefijo_informacion_general}_representante_revision" value="{revision_informacion_general_representante_revision}" />
		  <a href="javascript:convertirMinusculaInput('{prefijo_informacion_general}_representante_revision','{revision_informacion_general_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		   <input  onchange="javascript:modificacionTexto('{prefijo_informacion_general}_revision_modifico_texto');" maxlength='150' type="text" style="width:150px"  {revision_informacion_general_modificacion_solo_lectura}  name="{prefijo_informacion_general}_representante_apellido_paterno_revision"    value="{revision_informacion_general_representante_apellido_paterno_revision}" /> 
		    <a href="javascript:convertirMinusculaInput('{prefijo_informacion_general}_representante_apellido_paterno_revision','{revision_informacion_general_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		   <input  {revision_informacion_general_modificacion_solo_lectura}  onchange="javascript:modificacionTexto('{prefijo_informacion_general}_revision_modifico_texto');"  maxlength='150'  style="width:150px"  type="text" name="{prefijo_informacion_general}_representante_apellido_materno_revision" value="{revision_informacion_general_representante_apellido_materno_revision}" />
		    <a href="javascript:convertirMinusculaInput('{prefijo_informacion_general}_representante_apellido_materno_revision','{revision_informacion_general_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		</div>
	</div>
	<div>
		<label>Direcci&oacute;n Instituci&oacute;n</label> 
	 {institucion_direccion}
		
		 <div   class="{modificacion_div_ocultos}">
	 	<span class="span_modificacion" >Modificación</span>
<textarea  class="textarea_revision"  onchange="javascript:modificacionTexto('{prefijo_informacion_general}_revision_modifico_texto');"  {revision_informacion_general_modificacion_solo_lectura}  name="{prefijo_informacion_general}_direccion_revision" >{revision_informacion_general_direccion_revision}</textarea> <a href="javascript:convertirMinusculaInput('{prefijo_informacion_general}_direccion_revision','{revision_informacion_general_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 </div>
	</div> 	
	<div>
		<label>Comuna Instituci&oacute;n	</label>  {comuna_institucion}	</div>
	<div>
		<label>Tel&eacute;fono  </label> {telefono_codigo} - {telefono}  
	</div>
	<div>
		<label>Email Contacto</label> {email}
	</div>
	<div>
		<label>P&aacute;gina Web</label>  <a href="{url}" target="_blank">{url}</a>
	</div>  
	
		{revision_informacion_general_formulario} 
   
	
	</fieldset>
	
 <a href="javascript:hiddenId('ver_datos_sii_rut_interno');hiddenId('ver_datos_sii_rut');CerrarBloqueRevision('{prefijo_informacion_general}');">Ocultar Datos</a>
	</div> 
	
	
<!-- **********************PERSONA RESPONSABLE BLOQUE********************** -->	
 
<div class="fieldset_title" id='titulo_{prefijo_persona_responsable}'  > 
<img src="images/iconos/revision{revision_persona_responsable_estado_revision_img}.gif" />
Persona Responsable de las Asesorías ATE  
  </div>
 
<a href="javascript:AbrirBloqueRevision('bloque_{prefijo_persona_responsable}');" >Ver Datos</a>

<div  id='bloque_{prefijo_persona_responsable}' class="div_oculto">  
<fieldset>
 
	<div class="fieldset_title_interno">Datos Postulación</div> 
	<div>
		<label>Nombre Completo</label> 
		 {responsable_nombre} {responsable_apellido_paterno} {responsable_apellido_materno} 
		 
		 <div   class="{modificacion_div_ocultos}">
		  <span class="span_modificacion" >Modificación</span>  <input  style="width:150px" {revision_persona_responsable_modificacion_solo_lectura} type="text"  onchange="javascript:modificacionTexto('{prefijo_persona_responsable}_revision_modifico_texto');"  maxlength='255'  name="{prefijo_persona_responsable}_nombre_revision" value="{revision_persona_responsable_nombre_revision}" />
		   <a href="javascript:convertirMinusculaInput('{prefijo_persona_responsable}_nombre_revision','{revision_persona_responsable_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		   <input  type="text" style="width:150px" {revision_persona_responsable_modificacion_solo_lectura}  onchange="javascript:modificacionTexto('{prefijo_persona_responsable}_revision_modifico_texto');"  maxlength='255'   name="{prefijo_persona_responsable}_apellido_paterno_revision" value="{revision_persona_responsable_apellido_paterno_revision}" /> 
		      <a href="javascript:convertirMinusculaInput('{prefijo_persona_responsable}_apellido_paterno_revision','{revision_persona_responsable_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
			  <input  style="width:150px"  type="text" name="{prefijo_persona_responsable}_apellido_materno_revision" {revision_persona_responsable_modificacion_solo_lectura}  maxlength='255'  onchange="javascript:modificacionTexto('{prefijo_persona_responsable}_revision_modifico_texto');" value="{revision_persona_responsable_apellido_materno_revision}" />
			    <a href="javascript:convertirMinusculaInput('{prefijo_persona_responsable}_apellido_materno_revision','{revision_persona_responsable_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 </div>
	</div>
	<div>
		<label>Direcci&oacute;n</label> 
	 {responsable_direccion} 
	 
		 <div   class="{modificacion_div_ocultos}">
		 <span class="span_modificacion" >Modificación</span>   
		 
		 <textarea  class="textarea_revision"  onchange="javascript:modificacionTexto('{prefijo_persona_responsable}_revision_modifico_texto');"  {revision_persona_responsable_modificacion_solo_lectura}  name="{prefijo_persona_responsable}_direccion_revision" >{revision_persona_responsable_direccion_revision}</textarea>
		 
		  <a href="javascript:convertirMinusculaInput('{prefijo_persona_responsable}_direccion_revision','{revision_persona_responsable_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 
		 
		 </div>
	</div>
	<div>
		<label>Tel&eacute;fono  </label>  {responsable_telefono_codigo} - {responsable_telefono}  
	</div>
	<div>
		<label>Celular  	</label> {responsable_celular_codigo} - {responsable_celular} 	 
	</div>
	<div>
		<label>Email</label>  {responsable_email} 	 
	</div>
	<div>
	<label>Cargo</label>  {responsable_cargo} 	  
		 <div class="{modificacion_div_ocultos}">
		  <span class="span_modificacion" >Modificación</span>  <input  onchange="javascript:modificacionTexto('{prefijo_persona_responsable}_revision_modifico_texto');"   maxlength='255'   {revision_persona_responsable_modificacion_solo_lectura}   type="text" name="{prefijo_persona_responsable}_cargo_revision" value="{revision_persona_responsable_cargo_revision}" />  
		  
		  
		  <a href="javascript:convertirMinusculaInput('{prefijo_persona_responsable}_cargo_revision','{revision_persona_responsable_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		  
		  </div>
	</div>  
	 
	 
	 {revision_persona_responsable_formulario} 
	
	</fieldset>
 <a href="javascript:CerrarBloqueRevision('{prefijo_persona_responsable}');">Ocultar Datos</a>
	</div> 
	
	
	
<!-- ********************** OPEN SEDES BLOQUE ********************** -->	
	
<div class="fieldset_title" id='titulo_revision_sedes' ><img src="images/iconos/revision{revision_sedes_estado_revision_img}.gif" /> Sedes </div>	 
<a href="javascript:AbrirBloqueRevision('bloque_{prefijo_sedes}');">Ver Datos</a>
<div id='bloque_{prefijo_sedes}' class="div_oculto"> 
{revision_sedes_formulario} 
<a href="javascript:CerrarBloqueRevision('{prefijo_sedes}');">Ocultar Datos</a></div>   
<div>
{ate_sedes_div_revision}	 
<!-- START BLOCK : div_sede_revision_vacia -->
	 <br />No se registraron sedes	 <br />
<!-- END BLOCK : div_sede_revision_vacia -->

 </div>
<!-- ********************** CLOSE SEDES BLOQUE ********************** -->	
 