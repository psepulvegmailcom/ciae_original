<!-- abre bloque sedes {numero_div_mas} -->
<div class="fieldset_title" style="padding-left:30px;" id='titulo_{prefijo_bloque_sedes}_{numero_div_mas}' >
<img src="images/iconos/revision{revision_sedes_individual_estado_revision_img}.gif" /> <small> Sede {numero_div_mas}</small></div>
	 
<a href="javascript:AbrirBloqueRevision('bloque_{prefijo_bloque_sedes}_{numero_div_mas}');">Ver Datos</a>
<div id='bloque_{prefijo_bloque_sedes}_{numero_div_mas}' class="div_oculto">
<fieldset> 
 


	<div class="fieldset_title_interno">  Datos Postulación   </div> 
	 <div>
	<label>Comuna de sede : </label>    
		 {ate_sede_comuna}
	  <br />
	<label>Direcci&oacute;n de sede : </label>   
		 {ate_sede_direccion} 
		 <div   class="{modificacion_div_ocultos}">
		<br /> <span class="span_modificacion" >Modificación</span>  <input  maxlength='255'  {revision_sedes_individual_modificacion_solo_lectura}  onchange="javascript:modificacionTexto('revision_sedes_individual_revision_modifico_texto');" type="text" name="revision_sedes_individual_campo_revision_{id_externo}" value="{revision_sedes_individual_campo_revision}" />
		  <a href="javascript:convertirMinusculaInput('revision_sedes_individual_campo_revision_{id_externo}','{revision_sedes_individual_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		</div>
	  <br />
	<label>Tel&eacute;fono y c&oacute;digo de ciudad de la sede : </label>  
		 {ate_sede_telefono_codigo} - {ate_sede_telefono}	
		 
	  <br />
	<label>Email de contacto de sede : </label> 
	<a href="mailto:{ate_sede_email}" >{ate_sede_email}</a> 
		 
	 </div>  
{revision_sedes_individual_formulario}
	</fieldset> 
	
<a href="javascript:CerrarBloqueRevision('{prefijo_bloque_sedes}_{numero_div_mas}');">Ocultar Datos</a>

</div> 
 
<!-- cierre bloque sedes  {numero_div_mas} -->