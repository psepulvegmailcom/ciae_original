<input type="hidden" name="existe_previamente" value="{email}">
<div>Por favor ingrese su rut, revise y actualice sus datos personales.</div>
<table width="95%" border="0" cellpadding="3">
 
  <tr><td  > </td><td > </td></tr>
    <tr><td colspan="2"> <p  class="titulo_1_noticia_azul_oscuro">Antecedentes personales</p></td></tr>
      
  <tr>
    <td  ><strong>Rut o pasaporte (*)</strong></td>
    <td  > 
        <input type="text" name="form_rut" style="width:100px" maxlength="10" value="{rut}" onChange="javascript:limpiarNumero('form_rut');consultarPorRut('form_rut');" > <small> (sin puntos ni gui&oacute;n, incluya el digito verificador) </small>   </td>
  </tr>
    <tr>
    <td><strong>Archivo c&eacute;dula de identidad escaneada  (*)  </strong></td>
    <td>
       <input type="file" name="form_ci" id="form_ci"><br>(Peso m&aacute;ximo 2 Mb)
       
       <script>
	   if('{archivo_ci}' != '')
	   {		   
			document.write('<br><a href="download.php?file=honorarios/{archivo_ci}">Ver archivo</a>');   
	   }
	   </script>
       <input type="hidden" name="form_ci_original" value="{archivo_ci}" id="form_ci_original">
       
       </td>
  </tr>
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_simple_sin_texto.tpl -->
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/genero.tpl --> 
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_nacimiento.tpl -->  
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/direccion.tpl -->
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/comuna.tpl --> 
    
    
	 <tr><td colspan="2"><p  class="titulo_1_noticia_azul_oscuro">Antecedentes acad&eacute;micos </p></td></tr>
     
    <!-- START BLOCK : bloque_titulos_profesionales -->
    {formulario_titulo_profesional}    
    <!-- END BLOCK : bloque_titulos_profesionales -->  
     <tr><td colspan="2" style="text-align:right"> 
     <button  type="button" name="submit_mas_titulos" value="submit_mas_titulos"    onclick="javascript:agregarTitulo();" id="submit-submit_mas_titulos">(+) Agregar m&aacute;s t&iacute;tulos</button>
     
     </td></tr> 
      
  
    <tr><td colspan="2"><p  class="titulo_1_noticia_azul_oscuro">Antecedentes laborales </p></td></tr>
    <tr><td colspan="2"><strong style="text-decoration:underline">En caso de tener nombramiento(s) a contrata, planta o honorario vigentes en alguna instituci&oacute;n p&Uacute;blica, indique: instituci&oacute;n, cargo/labor, tipo de contrato, per&Iacute;odo y renta:  </strong></td></tr>
          
  
   
      <!-- START BLOCK : bloque_convenio_honorarios -->
      {formulario_bloque_convenio_honorarios}  
      <!-- END BLOCK : bloque_convenio_honorarios -->
      
   <tr><td colspan="2" style="text-align:right"> 
   <button  type="button" name="submit_mas_labores" value="submit_mas_labores"    onclick="javascript:agregarLabores();" id="submit-submit_mas_labores">(+) Agregar m&aacute;s nombramientos</button>
   
   </td></tr> 
    
   
  
    <tr><td colspan="2"><p  class="titulo_1_noticia_azul_oscuro">Curriculum Vitae</p></td></tr>
       <tr>
    <td><strong>Archivo CV  (*)  </strong></td>
    <td>
       <input type="file" name="form_cv" id="form_cv"><br>(Peso m&aacute;ximo 2 Mb)
       
       <script>
	   if('{archivo_cv}' != '')
	   {		   
			document.write('<br><a href="download.php?file=honorarios/{archivo_cv}">Ver archivo</a>');   
	   }
	   </script>
       <input type="hidden" name="form_cv_original" value="{archivo_cv}" id="form_cv_original">
       
       </td>
  </tr>
  
  <tr><td colspan="2"><p  class="titulo_1_noticia_azul_oscuro">Comisiones Constructoras de &Iacute;temes </p></td></tr>
  <td><strong>&aacute;rea  (*)  </strong></td>
    <td>
  <select name="form_area" id="form_area">
  
  <option></option>
  <option value="Artes_Visuales">Artes Visuales</option>
  <option value="Biologia">Biolog&Iacute;a</option>
  <option value="Educacion_Especial">Educaci&oacute;n Especial</option>
  <option value="Fisica">F&Iacute;sica</option>
  <option value="Parvularia">Educaci&oacute;n Parvularia</option>
  <option value="Musica">M&Uacute;sica</option>
  <option value="Quimica">Qu&Iacute;mica</option>
  <option value="Basica">Educaci&oacute;n B&aacute;sica</option>
  <option value="Historia">Historia</option>
  <option value="Basica_Parvularia">B&aacute;sica / Parvularia</option>
  <option value="Lenguaje">Lenguaje</option>
  <option value="Biologia_Quimica">Biolog&Iacute;a / Qu&Iacute;mica</option>
  <option value="Matematica">Matem&aacute;tica</option>
  <option value="Matematica_Fisica">Matem&aacute;tica / F&Iacute;sica</option>
   
  </select>
  
           <script>
		 if('{area}' != '')
		 {
				selectValue('form_area','{area}'); 
		 }
		 </script>
  </td></tr>
  <tr>
  <td colspan="2" style="text-align:center; padding-top:20px;">
   <button  type="button" name="submit_enviar" value="submit_enviar" style="width:200px" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar Datos</button>
  </td></tr>
<tr>
<td colspan="2">Los datos consignados en esta ficha son de su exclusiva responsabilidad y cualquier omisi&oacute;n o error de &eacute;stos atrasar&aacute; la tramitaci&oacute;n del convenio.<br><small>
(*) Campos obligatorios 
<br></small><br /> 
<br />  
   </td>
</tr>

   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value=""> 
<input type="hidden" name="tipo_formulario_confirmacion" value="actualizacion">
<input type="hidden" name="guardar" value="guardar">

<div id='testing'></div>

<script type="text/javascript">
 
	function enviarFormulario()
	{ 
		var x = document.main.elements;	 	
		
		if(document.main.form_rut.value == ''  )
		{
			alert('Debe ingresar rut completo');
			document.main.form_rut.focus();
			return false;
		}

 		if(document.main.form_ci_original.value == '' && document.main.form_ci.value == '')
		{
			alert('Debe ingresar/seleccionar valores indicados');
			mostrarErrorCampo('form_ci');
			return false;	
		}
		 		
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->   
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/genero.tpl -->  
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/fecha_nacimiento.tpl -->
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl --> 
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/direccion.tpl -->  
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/comuna.tpl --> 
 	

		<!-- START BLOCK : bloque_validacion_titulo -->
		var elemento = 'formtitulo_{orden}_completo_{orden}'; 
		if(document.getElementById(elemento).style.display != 'none')
		{ 
			if(!validacionCampoTextoSimple('formtitulo_{orden}_tipo'))
				return false; 
			if(!validacionCampoTextoSimple('formtitulo_{orden}_titulo'))
				return false;
			if(!validacionCampoTextoSimple('formtitulo_{orden}_institucion'))
				return false;
 			if(document.main.formtitulo_{orden}_archivo_original.value == '' && document.main.formtitulo_{orden}_archivo.value == '')
			{
				alert('Debe ingresar/seleccionar valores indicados');
				mostrarErrorCampo('formtitulo_{orden}_archivo');
				return false;	
			}				
			if(!checkSelectedMultiple('formtitulo_{orden}_pais'))
				return false;				
			if(!validacionCampoTextoSimple('formtitulo_{orden}_ciudad'))
				return false;	 
		}
		<!-- END BLOCK : bloque_validacion_titulo -->
		<!-- START BLOCK : bloque_validacion_labores -->
		var elemento = 'formlabores_{orden}_completo_{orden}'; 
		if(document.getElementById(elemento).style.display != 'none')
		{ 
			if(!validacionCampoTextoSimple('formlabores_{orden}_institucion'))
			{
				alert('Si no tienen ningun nombramiento, elimine el elemento para continuar');
				return false;  
			}
			if(!validacionCampoTextoSimple('formlabores_{orden}_tipo_contrato'))
				return false;  
			if(!validacionCampoTextoSimple('formlabores_{orden}_cargo'))
				return false;  
			if(!validacionCampoTextoSimple('formlabores_{orden}_monto'))
				return false;  
			if(!checkSelectedMultiple('formlabores_{orden}_periodo_termino_mes'))
				return false;  
			if(!checkSelectedMultiple('formlabores_{orden}_periodo_inicio_mes'))
				return false;  
			if(!checkSelectedMultiple('formlabores_{orden}_periodo_inicio_agno'))
				return false;  
			if(!checkSelectedMultiple('formlabores_{orden}_periodo_termino_agno'))
				return false;   
			 
		}
		<!-- END BLOCK : bloque_validacion_labores -->

 		if(document.main.form_cv_original.value == '' && document.main.form_cv.value == '')
		{
			alert('Debe ingresar/seleccionar valores indicados');
			mostrarErrorCampo('form_cv');
			return false;	
		}		
				 
 
		if(!validacionCampoTextoSimple('form_area'))
				return false; 	
		enviarFormularioBase();
	}


	function agregarTitulo()
	{
		for(var i=1; i < {cantidad_elementos};i++)
		{
			var elemento = 'formtitulo_'+i+'_completo_'+i; 
			if(document.getElementById(elemento).style.display == 'none')
			{
				showtr(elemento);	
				gotoHref(elemento);	
				return true;
			}
		}
	} 
	

	function agregarLabores()
	{
		for(var i=1; i < {cantidad_elementos};i++)
		{
			var elemento = 'formlabores_'+i+'_completo_'+i; 
			if(document.getElementById(elemento).style.display == 'none')
			{
				showtr(elemento);
				gotoHref(elemento);	
				return true;
			}
		}
	} 
	
	function eliminarTitulo(orden)
	{
		if(orden < 2)
		{
			alert("Ud debe agregar al menos 1 grado o titulo academico");	
		}
		else
		{		
			if(confirm("Esta seguro de eliminar este elemento? esta accion eliminara los datos ingresados"))
			{								
				var elemento = 'formtitulo_'+orden+'_completo_'+orden;
				limpiarCampoTextoSimple('formtitulo_'+orden+'_tipo');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_titulo');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_institucion'); 
				limpiarCampoTextoSimple('formtitulo_'+orden+'_archivo_original');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_archivo');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_pais');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_ciudad');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_dia');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_mes');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_agno');
				limpiarCampoTextoSimple('formtitulo_'+orden+'_formfecha');
				
				hiddenId('formtitulo_'+orden+'_archivo_link');
				hidetr(elemento);
				gotoHref(elemento);	
			}
		}
	}
	
	function eliminarLabor(orden)
	{ 
		if(confirm("Esta seguro de eliminar este elemento? esta accion eliminara los datos ingresados"))
		{ 	
			var elemento = 'formlabores_'+orden+'_completo_'+orden;  
			limpiarCampoTextoSimple('formlabores_'+orden+'_institucion');
			limpiarCampoTextoSimple('formlabores_'+orden+'_tipo_contrato');
			limpiarCampoTextoSimple('formlabores_'+orden+'_cargo');
			limpiarCampoTextoSimple('formlabores_'+orden+'_monto');
			limpiarCampoTextoSimple('formlabores_'+orden+'_periodo_termino_mes');
			limpiarCampoTextoSimple('formlabores_'+orden+'_periodo_inicio_mes');
			limpiarCampoTextoSimple('formlabores_'+orden+'_periodo_inicio_agno');
			limpiarCampoTextoSimple('formlabores_'+orden+'_periodo_termino_agno');				
			hidetr(elemento);
			gotoHref(elemento);	
		}
		 
	}
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->