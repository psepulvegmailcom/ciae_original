
<script>
function desbloquearFormularioDevuelto(){} 
function bloquearFormularioDevuelto(){} 
</script>
<div style="float:right; padding-bottom:10px; "><a href="javascript:process('portafolio_lista',0);" style="  padding-bottom:10px; ">{volver_listado}</a></div><br />

<input type="hidden" name="con_volver" value="{con_volver}" />
		<div  class="fieldset_title" >Portafolio de Evidencias</div><br />
		
		 
<div id='bloque_botones_sup'>
	<center>
		<button type="button" onclick="javascript:chequeoTipoDatos('portafolio',0);"  ><span>Guardar y Agregar Otra Experiencia</span></button>  <button type="button" onclick="javascript:chequeoTipoDatos('portafolio|cerrar',0);"  ><span>Guardar y Cerrar</span></button>     <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		  
	</center>
</div>	 
<br /> (*) Campos Obligatorios  <br /><br />
<strong>Es obligatorio indicar todas las experiencias que ha tenido en los últimos 5 años</strong><br />
	
	<!-- START BLOCK : bloque_portafolio_sin_programa -->
		<input type="hidden" name="rut" value="{rut}" />
		<input type="hidden" name="dv" value="{dv}" /> 
	<fieldset>
	<div> 
	<label>Nombre  : </label> {nombre} {apellido_paterno} {apellido_materno} <br />
	<label>Rut  : </label> {rut} - {dv}
	</div> 
	 </fieldset>
	<!-- END BLOCK : bloque_portafolio_sin_programa -->	
	<input type="hidden" name='id_portafolio' value="{id_portafolio}" /> 
	<div  class="fieldset_title" >Área y subárea Asistencia Técnica</div>
	<fieldset>
	<div>
	<label>Área : </label> {area_portafolio} <input type="hidden" name='id_area' value="{area_portafolio_id}" />
	<br />
	<label>Subárea : </label> {subarea_portafolio}  <input type="hidden" name='id_programa' value="{subarea_portafolio_id}" />
	</div>
	 </fieldset> 
		



	<div  class="fieldset_title" >Nombre del Proyecto</div>
	<fieldset>
	<label></label><span id='ate_portafolio_nombre_proyecto_max'>{max_largo_actual_proyecto} caracteres de un máximo de {max_largo_texto}</span><br />
		
		<textarea name="ate_portafolio_nombre_proyecto" id='ate_portafolio_nombre_proyecto' onKeyDown="textCounter('ate_portafolio_nombre_proyecto','ate_portafolio_nombre_proyecto_max',{max_largo_texto});" onKeyUp="textCounter('ate_portafolio_nombre_proyecto','ate_portafolio_nombre_proyecto_max',{max_largo_texto});">{ext_ate_portafolio_proyecto}</textarea> <span>(*)</span><span>{ayuda_nombre_proyecto}</span>
	</fieldset>

	<div class="fieldset_title">Institución que contrató el servicio <span>(*)</span><span>{ayuda_intitucion_contratante}</span></div>
	 <fieldset>
	 <div>
	   <label>Seleccione solo la institución donde usted ofreció el servicio ATE</label><br />
		 
		 <input type="checkbox"  class="inputcheckbox" name="ext_ate_portafolio_ministerio" onclick="javascript:chequeoProgramaMineduc();" />	 <strong>MINEDUC</strong> <span>{ayuda_intitucion_contratante_mineduc}</span>
		   <br />
		   <input name="mineduc_id_aux" value="0"  type="hidden"/>
		<!-- START BLOCK : select_programa_mineduc -->
		<input type="radio"  class="inputcheckbox"  {ate_portafolio_programa_mineduc_id_checked} name='ate_portafolio_programa_mineduc_id'   onclick="document.main.mineduc_id_aux.value={programa_mineduc_id}" disabled="disabled" value="{programa_mineduc_id}">{programa_mineduc} <br />
	 
		<!-- END BLOCK : select_programa_mineduc -->  
		</div>
		<div> 
		<input type="checkbox"  class="inputcheckbox" name="ext_ate_portafolio_establecimiento" onclick="javascript:chequeoRBD();"	 /> <strong>Establecimiento Educacional</strong><span>{ayuda_intitucion_contratante_establecimiento}</span><br />
		<strong>	RBD: </strong>
		 <input type="text" name="ate_portafolio_rbd" value="{rbd}"  disabled="disabled"  onchange="javascript:obtenerRBD('ate_portafolio_rbd','rbd_nombre');" style="width:30%" >
		 
		   <img src="images/spinner.gif" id="rbd_spinner" class="div_oculto" />
		   
		 <div id='rbd_nombre'></div>
		  
		</div>
		<div> 
		<input type="checkbox"  class="inputcheckbox" name="ext_ate_portafolio_otra_institucion" onclick="javascript:chequeoRut();"		 /> <strong>Otra institución</strong><span>{ayuda_intitucion_contratante_otra}</span><br />
		<strong>	Rut: </strong>
		 <input type="text" name="ate_portafolio_rut_institucion" value="{rut_institucion}"  disabled="disabled" style="width:100px" maxlength="10">  - 
		 <input type="text" name="ate_portafolio_dv_institucion"  value="{dv_institucion}"  disabled="disabled"   style="width:20px" maxlength="1">
		 <br /><strong>Nombre institución:</strong><br />
		 <input type="text" name="ate_portafolio_institucion"  value="{institucion_institucion}"  disabled="disabled"  />
		 </div>
	</fieldset>
	 <div class="fieldset_title"> Período de ejecución  (solo los últimos  5 años) <span>{ayuda_periodo}</span></div>
	 <fieldset>
	 <div>
	 <table width="100%">
				<tr>
					<td class="form_tabla_campo" align="center"><strong>Período Inicio</strong></td>
					<td class="form_tabla_campo" align="center"><strong>Período Término</strong></td>
				</tr>
				<tr>
					<td style="border: 0px;" align="center">
					
					<select name="ate_portafolio_mes_inicio" style=" width:55px">{template_mes_inicio}</select> /
					<select name="ate_portafolio_agno_inicio" style=" width:55px">{template_ano_inicio}</select>
					(*)
					</td>
					<td style="border: 0px;" align="center">
					
					<select name="ate_portafolio_mes_termino" style=" width:55px">{template_mes_termino}</select> / 
					<select name="ate_portafolio_agno_termino" style=" width:55px">{template_ano_termino}</select> (*)
					</td>
				</tr>
			</table>
	 </div>
	 </fieldset>
		
	 
	
	<div class="fieldset_title">Zona geográfica de ejecución <span>(*)</span><span>{ayuda_zona_geografica}</span></div>
	<div style="text-align:center">
	 <button type="button"  onclick="javascript:verFormularioPopup('comunas_multiple_portafolio','comunas_portafolio');hiddenId('area_cobertura_comunas');hiddenId('area_cobertura_comunas_ocultar');showId('area_cobertura_comunas_ver');"><span>Seleccionar Zona Geográfica</span></button></div>
	 
	 
	 <br />
<div  align='right' id='area_cobertura_comunas_ver'>
<a href="javascript:showAreaCoberturaOferente(); showId('area_cobertura_comunas_ocultar');showId('comuna_spinner');"> 
Ver/Refrescar Lista de Comunas Seleccionadas</a></div>

<div style="text-align:center" id="comuna_spinner" class="div_oculto">
 <img src="images/spinner.gif"    />
 </div>
 <img src="images/spinner.gif" id="comuna_spinner" class="div_oculto" />
<div id='area_cobertura_comunas'   class='div_oculto' > </div>
<div  align='right' id='area_cobertura_comunas_ocultar'  class='div_oculto'><a href="javascript:hiddenId('area_cobertura_comunas');hiddenId('area_cobertura_comunas_ocultar');hiddenId('comuna_spinner');showId('area_cobertura_comunas_ver');">Ocultar Lista de Comunas Seleccionadas</a></div> 
	 
	 
	 
	 
	 
	<div class="fieldset_title">Coordinador Proyecto  </div>
	<fieldset>
	<div>
	<label>Nombre</label><br />
	<input type="text" name="ate_portafolio_coordinador"	 value="{portafolio_coordinador}"	 />		<span>(*)</span><span>{ayuda_coordinador}</span>
	</div>
	</fieldset>
	<div class="fieldset_title">Descripción Servicio   </div>
	<fieldset>
	<div> 
	<label>Descripción 	</label>
		<br /><span id='ate_portafolio_descripcion_servicio_max'>({max_largo_actual_descripcion_servicio} caracteres de un máximo de {max_largo_texto})</span>
	<br />
	<textarea name="ate_portafolio_descripcion_servicio" onKeyDown="textCounter('ate_portafolio_descripcion_servicio','ate_portafolio_descripcion_servicio_max',{max_largo_texto});" onKeyUp="textCounter('ate_portafolio_descripcion_servicio','ate_portafolio_descripcion_servicio_max',{max_largo_texto});">{descripcion_servicio}</textarea>	<span>(*)</span><span>{ayuda_descripcion}</span>
	</div>
		<div> 
	<label>Resultado</label><br />
		<span id='ate_portafolio_resultado_servicio_max'>({max_largo_actual_resultado_servicio} caracteres de un máximo de {max_largo_texto})</span>
		<br />
	<textarea name="ate_portafolio_resultado_servicio" onKeyDown="textCounter('ate_portafolio_resultado_servicio','ate_portafolio_resultado_servicio_max',{max_largo_texto});" onKeyUp="textCounter('ate_portafolio_resultado_servicio','ate_portafolio_resultado_servicio_max',{max_largo_texto});">{resultado_servicio}</textarea>	<span>(*)</span><span>{ayuda_resultados}</span>
	</div>
	</fieldset>
	 
	<div class="fieldset_title">Referencia del contratante del servicio</div>
	{tpl_ayuda_file} 
	<fieldset>
	<div>
	<label>Nombre</label><br />
	 <input type="text" name="ate_portafolio_referencia_nombre" value="{referencia_nombre}" maxlength="150"> <span>(*)</span><span>{ayuda_referencia_nombre}</span>
	 </div>
	 <div>
	<label>Cargo </label><br />
	<input type="text" name="ate_portafolio_referencia_cargo" value="{referencia_cargo}" maxlength="150">	<span>(*)</span><span>{ayuda_referencia_cargo}</span>
	 </div>
	 <div>
	<label>Teléfono </label><br />
	<select name="ate_portafolio_referencia_telefono_codigo" style="width:60px; "  >
<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_area_option.tpl -->
	</select>
	<script>
	selectValue('ate_portafolio_referencia_telefono_codigo','{referencia_telefono_codigo}'); 
	</script>
	<!--<input type="text"  style="width:30px" maxlength="3"  name="ate_portafolio_referencia_telefono_codigo" value="{referencia_telefono_codigo}">--> - <input type="text" name='ate_portafolio_referencia_telefono' value="{referencia_telefono}" style="width:100px" maxlength="7">	<span>(*)</span><span>{ayuda_referencia_telefono}</span>
	 </div>
	 <div>
	<label>Email </label><br />
	<input type="text" name="ate_portafolio_referencia_email" value="{referencia_email}">	<span>(*)</span><span>{ayuda_referencia_email}</span>
	 </div>
	<div>
	<label>Carta Referencia </label>(*)<br />
	Descargue el documento disponible <a href="download.php?file=carta_referencia.doc&caso=general" target="_blank">aquí</a>, que le servirá para redactar su carta de referencia<br />
	
	 <input type="file"  class="inputfile" name="archivo_ate_portafolio_referencia_carta"> 
	 <span>{ayuda_referencia_carta}</span>
	  
	<!-- START BLOCK : portafolio_archivo -->	
		<input type="hidden" name="referencia_carta_archivo" value="{nombre_documento}" />
		<input type="hidden" name="referencia_carta_extension" value="{extension_documento}" />
		 
	 	<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=carta_referencia.{extension_documento}" target="_blank"  title="Ver Carta" id='ver_carta'>		<img src="images/download_act.jpg" border="0" />		</a>	 
		<a onclick="javascript:eliminarArchivoTmp();"  title="Eliminar Documento Actual" id='eliminar_carta'>
		<img src="images/delete.jpg" border="0" /></a>
		<script> 
			function eliminarArchivoTmp()
			{
				if(confirm('Esta seguro de eliminar este documento?'))
				{
					hiddenId('ver_carta');
					hiddenId('eliminar_carta');
					document.main.referencia_carta_archivo.value   = '';
					document.main.referencia_carta_extension.value = '';
				}
			}
		</script>
	<!-- END BLOCK : portafolio_archivo -->
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	 </div>
	 </fieldset>
	

<div id='bloque_botones_inf'>
	<center>
	<button type="button" onclick="javascript:chequeoTipoDatos('portafolio',0);"><span>Guardar y Agregar Otra Experiencia</span></button>  	<button type="button" onclick="javascript:chequeoTipoDatos('portafolio|cerrar',0);"  ><span>Guardar y Cerrar</span></button>     <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		 
	</center>
</div>	 
 
<!-- START BLOCK : ventana_cerrar -->
<script>self.close();</script>
<!-- END BLOCK : ventana_cerrar -->

<input type="hidden" name="guardar_caso" value="guardar{guardaredicion}" />
<input type="hidden" name="ext_ate_portafolio_comuna_id" value="{valores_comuna_id}" />


<script>	
function chequeoTipoDatos(action,level)
{
	 
			desbloquearFormularioDevuelto();
		chequeoTipoDatosCompleto(action,level); 
			bloquearFormularioDevuelto();			
}
function chequeoTipoDatosCompleto(action,level)
	{
		var chequeo = true;  
		
		/* revision de ingreso de carta de referencia */ 
		var chequeo_carta = true;
		if(document.main.archivo_ate_portafolio_referencia_carta.value == '')
		{
			if(document.main.referencia_carta_archivo)
			{
				if(document.main.referencia_carta_archivo.value == '')
				{
					chequeo_carta = false;
				}
			}
			else
				chequeo_carta = false;		
		}
		if(!chequeo_carta)
		{
			showAlert('El ingreso de la carta de referencia es obligatorio');
			document.main.archivo_ate_portafolio_referencia_carta.focus();
			return false;
		}		

		/* revision de fecha de servicio */	
		if(document.main.ate_portafolio_agno_inicio.value == '' || document.main.ate_portafolio_mes_inicio.value == '')
		{
			showAlert('Debe ingresar el período de inicio de ejecución del servicio');
			document.main.ate_portafolio_agno_inicio.focus();
			return false; 
		} 
		 
		if(document.main.ate_portafolio_agno_termino.value == '' || document.main.ate_portafolio_mes_termino.value == '')
		{
			showAlert('Debe ingresar el período de término de ejecución del servicio');
			document.main.ate_portafolio_agno_termino.focus();
			return false; 
		} 	 		
		if(parseInt(document.main.ate_portafolio_agno_inicio.value) > parseInt(document.main.ate_portafolio_agno_termino.value))
		{
			showAlert('El año de término debe ser mayor o igual al año de inicio');
			document.main.ate_portafolio_agno_inicio.focus();
			return false; 
		}
		else
		{ 
			if(parseInt(document.main.ate_portafolio_agno_inicio.value) == parseInt(document.main.ate_portafolio_agno_termino.value) && parseInt(document.main.ate_portafolio_mes_inicio.value)  > parseInt(document.main.ate_portafolio_mes_termino.value) )
			{
				showAlert('El mes de término debe ser mayor o igual al mes de inicio');
				document.main.ate_portafolio_mes_inicio.focus();
				return false; 
			}
		}
		 
		if(document.main.ext_ate_portafolio_comuna_id.value == '')
		{
			showAlert('Debe seleccionar al menos una comuna en la que se realizó el servicio'); 
			return false; 
		} 		
		 
		/*revision de institucion, rbd o programa ministerio*/
		if(document.main.ext_ate_portafolio_ministerio.checked || document.main.ext_ate_portafolio_establecimiento.checked || document.main.ext_ate_portafolio_otra_institucion.checked)
		{ 
			if( document.main.ext_ate_portafolio_ministerio.checked)
			{
				if(document.main.mineduc_id_aux.value == 0)
				{
					showAlert('Debe seleccionar el servicio del Mineduc relacionado');
					document.main.ext_ate_portafolio_ministerio.focus();
					return false; 
				}
				else
				{
					document.main.ate_portafolio_programa_mineduc_id.value = document.main.mineduc_id_aux.value;
				} 
			} 
			
			if(document.main.ext_ate_portafolio_establecimiento.checked && document.main.ate_portafolio_rbd.value == '')
			{
				showAlert('Debe ingresar el RBD del establecimiento');
				document.main.ate_portafolio_rbd.focus();
				return false; 
			}
			if(document.main.ext_ate_portafolio_otra_institucion.checked)
			{
				if(document.main.ate_portafolio_institucion.value == '' || document.main.ate_portafolio_dv_institucion.value == '' || 
				document.main.ate_portafolio_rut_institucion.value == '' )
				{
					showAlert('Debe ingresar la información completa de la institución relacionada');
					document.main.ate_portafolio_institucion.focus();
					return false;
				}

				if(!revisaRut(document.main.ate_portafolio_rut_institucion.value,document.main.ate_portafolio_dv_institucion.value))
				{
					showAlert('El rut y dígito verificador de la institución deben ser válidos. Deben coincidir rut y dv. El rut debe ser númerico y sin puntos');	
					document.main.ate_portafolio_institucion.focus();	
					return false;
				}	
			} 
		}
		else
		{	
			showAlert('Debe ingresar el detalle de la institución que contrató el servicio');
			document.main.ext_ate_portafolio_ministerio.focus();
			return false; 
		}
				
		/* revision de nombre proyecto */	
		if(document.main.ate_portafolio_nombre_proyecto.value == '')
		{
			showAlert('Debe ingresar el nombre del proyecto');
			document.main.ate_portafolio_nombre_proyecto.focus();
			return false; 
		} 
		
		if(document.main.ate_portafolio_coordinador.value == '')
		{
			showAlert('Debe ingresar el nombre del coordinador del servicio realizado');
			document.main.ate_portafolio_coordinador.focus();
			return false; 
		} 		
		if(document.main.ate_portafolio_descripcion_servicio.value == '')
		{
			showAlert('Debe ingresar la descripción del servicio realizado');
			document.main.ate_portafolio_descripcion_servicio.focus();
			return false; 
		} 		
		if(document.main.ate_portafolio_resultado_servicio.value == '')
		{
			showAlert('Debe ingresar el resultado del servicio realizado');
			document.main.ate_portafolio_resultado_servicio.focus();
			return false; 
		} 		
		if(document.main.ate_portafolio_referencia_nombre.value == '')
		{
			showAlert('Debe ingresar el nombre de la persona de referencia del servicio realizado');
			document.main.ate_portafolio_referencia_nombre.focus();
			return false; 
		} 			
		if(document.main.ate_portafolio_referencia_cargo.value == '')
		{
			showAlert('Debe ingresar el cargo de la persona de referencia del servicio realizado');
			document.main.ate_portafolio_referencia_cargo.focus();
			return false; 
		} 			

		var aux_codigo = searchElement('ate_portafolio_referencia_telefono_codigo');
		if(aux_codigo.value == '')
		{
			showAlert('Debe ingresar el código de área del teléfono de la persona de referencia');	
			aux_codigo.focus();				 
			return false;
		} 			
		var aux_telefono = searchElement('ate_portafolio_referencia_telefono');
		if(aux_telefono.value != '' && !isNumber(aux_telefono.value))
		{
			showAlert('Debe ingresar el teléfono numérico de la persona de referencia');	
			aux_telefono.focus();				 
			return false;
		} 			
		if(aux_telefono.value == '')
		{
			showAlert('Debe ingresar el teléfono numérico de la persona de referencia ');	
			aux_telefono.focus();				 
			return false;
		} 		
		if(document.main.ate_portafolio_referencia_telefono_codigo.value == '' || document.main.ate_portafolio_referencia_telefono.value == '')
		{
			showAlert('Debe ingresar el número telefónico completo de la persona de referencia del servicio realizado');
			document.main.ate_portafolio_referencia_telefono_codigo.focus();
			return false; 
		} 		 
		if(document.main.ate_portafolio_referencia_email.value == '' || !checkMail(document.main.ate_portafolio_referencia_email.value))
		{
			showAlert('Debe ingresar un email válido de la persona de referencia del servicio realizado');
			document.main.ate_portafolio_referencia_email.focus();
			return false; 
		} 		  
/*		if(document.main.archivo_ate_portafolio_referencia_carta.value == '')
		{
			showAlert('Debe ingresar la carta de referencia del servicio realizado');
			document.main.archivo_ate_portafolio_referencia_carta.focus();
			return false; 
		} 				
		*/
		
		if(chequeo)
		{
			process(action,level);
		}
	} 
	
	function chequeoProgramaMineduc()
	{
		if( document.main.ext_ate_portafolio_ministerio.checked)
		{
			/*habilitacion mineduc*/
			habilitacionMineduc('habilitar');			
			/*deshabilitacion rbd*/
			habilitacionRDB('deshabilitar');
			/*deshabilitacion de rut*/
			habilitacionRUT('deshabilitar'); 
		}
		else
		{ 
			/*deshabilitacion mineduc*/
			habilitacionMineduc('deshabilitar');	
		}
	}
	
	function habilitacionRDB(caso)
	{
		if(caso=='habilitar')
		{
			document.main.ate_portafolio_rbd.disabled= false; 
			document.main.ext_ate_portafolio_establecimiento.checked = true;
			document.main.ate_portafolio_rbd.value= ''; 
		}
		else
		{
			document.main.ext_ate_portafolio_establecimiento.checked = false;			
			document.main.ate_portafolio_rbd.value= ''; 
			document.main.ate_portafolio_rbd.disabled= true;
			document.getElementById('rbd_nombre').innerHTML = '';
					
		}
	}
	
	function habilitacionMineduc(caso)
	{
		var aux = document.main.ate_portafolio_programa_mineduc_id;
		document.main.mineduc_id_aux.value = 0;
		for(var i=0; i < aux.length ; i++)
		{
			if(caso == 'habilitar')
			{
				aux[i].disabled = false;
				aux[i].checked = false;
				document.main.ext_ate_portafolio_ministerio.checked = true;
			}
			else
			{
				aux[i].checked = false;
				aux[i].disabled = true;
				document.main.ext_ate_portafolio_ministerio.checked = false;
			}
		}
	}
	
	function chequeoRBD()
	{
		if( document.main.ext_ate_portafolio_establecimiento.checked)
		{
			/* habilitacion de rbd*/
			habilitacionRDB('habilitar'); 
			/*deshabilitacion de rut*/
			habilitacionRUT('deshabilitar');
			/*deshabilitacion mineduc*/
			habilitacionMineduc('deshabilitar');
		}
		else
		{ 
			/* deshabilitacion de rbd*/ 
			habilitacionRDB('deshabilitar');
		}	
	}

	function chequeoRut()
	{
		if( document.main.ext_ate_portafolio_otra_institucion.checked)
		{
			/*habilitacion de rut*/
			habilitacionRUT('habilitar'); 
			/*deshabilitacion rbd*/
			habilitacionRDB('deshabilitar');
			/*deshabilitacion mineduc*/
			habilitacionMineduc('deshabilitar');			 		
		}
		else
		{  
			/*deshabilitacion de rut*/
			habilitacionRUT('deshabilitar');
		}	
	}	
	
	function habilitacionRUT(caso)
	{	
		document.main.ate_portafolio_institucion.value = '';
		document.main.ate_portafolio_dv_institucion.value = '';
		document.main.ate_portafolio_rut_institucion.value = ''; 
		if(caso == 'habilitar')
		{
			document.main.ate_portafolio_institucion.disabled		= false;
			document.main.ate_portafolio_dv_institucion.disabled	= false;
			document.main.ate_portafolio_rut_institucion.disabled	= false; 
			document.main.ext_ate_portafolio_otra_institucion.checked = true;		
		}
		else
		{
			document.main.ate_portafolio_institucion.disabled		= true;
			document.main.ate_portafolio_dv_institucion.disabled	= true;
			document.main.ate_portafolio_rut_institucion.disabled	= true;
			document.main.ext_ate_portafolio_otra_institucion.checked = false;
		}
	}
	
	
		<!-- START BLOCK : editar_rbd -->		 
			habilitacionRDB('habilitar');
			document.main.ate_portafolio_rbd.value= '{rbd}';		 
			obtenerRBD('ate_portafolio_rbd','rbd_nombre');	
		<!-- END BLOCK : editar_rbd -->
		<!-- START BLOCK : editar_institucion -->
		 	habilitacionRUT('habilitar');	
			document.main.ate_portafolio_rut_institucion.value = '{rut_institucion}';
			document.main.ate_portafolio_dv_institucion.value = '{dv_institucion}';
			document.main.ate_portafolio_institucion.value = '{institucion_institucion}'; 	 
		<!-- END BLOCK : editar_institucion -->
		<!-- START BLOCK : editar_mineduc -->
		 	habilitacionMineduc('habilitar');	
			
		var aux_mineduc = document.main.ate_portafolio_programa_mineduc_id;
		var sel_mineduc = '{sel_mineduc}';
		document.main.mineduc_id_aux.value = {sel_mineduc};
		for(var i=0; i < aux_mineduc.length ; i++)
		{
			if(sel_mineduc == aux_mineduc[i].value)
			{ 
				aux_mineduc[i].checked = true; 
				break;
			}
		}			 	 
		<!-- END BLOCK : editar_mineduc -->
	
</script>
