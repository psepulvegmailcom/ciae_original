<input name="caso_original" value="{original}" type="hidden"> 
<input type="hidden" name="ate_persona_nombre" value="{nombre}" />
<input type="hidden" name="ate_persona_apellido_paterno" value="{apellido_paterno}" />
<input type="hidden" name="ate_persona_apellido_materno" value="{apellido_materno}" />
<input type="hidden" name="ate_persona_rut" value="{rut}" />
<input type="hidden" name="ate_persona_dv" value="{dv}" /> 
<script>

function agregarExperiencia(id_area,id_programa ){

	verFormularioPortafolio(id_area,id_programa );
}

function verFormularioPortafolio(id_area,id_programa )
{ 
      var nuevo_ventana = window.open('indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option=portafolio&id_area='+id_area+'&id_programa='+id_programa+'&rut={rut}','ventana_extra_formulario_form',optionOpenW);
}

function agregarOferta(id_area,id_programa ){ 
		 /*funciones fantasma para que la ficha de la persona no tire error js*/
	}
 

function verListaPortafolio(rut,dv)
{ 
      var nuevo_ventana = window.open('indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option=portafolio_lista&rut='+rut+'&dv='+dv,'ventana_extra_portafolio_lista',optionOpenW);
}

function setValoresExternos(numero_fila){
	var input = searchParentElement('ate_capital_'+numero_fila+'_nombre');
	//showAlert(input.value);
	document.main.ate_persona_nombre.value = input.value;
	var input = searchParentElement('ate_capital_'+numero_fila+'_apellido_paterno');
	//showAlert(input.value);
	document.main.ate_persona_apellido_paterno.value = input.value;
	var input = searchParentElement('ate_capital_'+numero_fila+'_apellido_materno');
	//showAlert(input.value);
	document.main.ate_persona_apellido_materno.value = input.value;
	var input = searchParentElement('ate_capital_'+numero_fila+'_rut');
	//showAlert(input.value);
	document.main.ate_persona_rut.value = input.value;
	var input = searchParentElement('ate_capital_'+numero_fila+'_dv');
	//showAlert(input.value);
	document.main.ate_persona_dv.value = input.value;
}
function escribirDatosPersona(){
	 
	var texto = '<big>Nombre : '+document.main.ate_persona_nombre.value+" "+document.main.ate_persona_apellido_paterno.value+" "+document.main.ate_persona_apellido_materno.value;
	texto = texto + " <br /> Rut : "+document.main.ate_persona_rut.value+"-"+document.main.ate_persona_dv.value+"</big>  ";
 	document.getElementById("datos_persona").innerHTML = texto;
}

				
function chequeoTipoDatos(action,level)
{	 
	desbloquearFormularioDevuelto();
	chequeoTipoDatosCompleto(action,level); 
	bloquearFormularioDevuelto();			
}
function chequeoTipoDatosCompleto(action,level)
{
	if(isEmpty(document.main.ate_persona_horas.value) ||  !isNumber(document.main.ate_persona_horas.value) || document.main.ate_persona_horas.value > 170)
	{
		showAlert('Las horas de disponibilidad no puede ser mayor a 170 horas'); 
		document.main.ate_persona_horas.focus();
		return false; 
	}  
 
 	if(isEmpty(document.main.ate_persona_nombre_nueva.value) || isEmpty(document.main.ate_persona_apellido_paterno_nueva.value) || isEmpty(document.main.ate_persona_apellido_materno_nueva.value))
	{
		showAlert('El nombre de la persona debe estar completo');
			document.main.ate_persona_nombre_nueva.focus();
		return false; 
	}	
	 	
	 /*  REVISION DE CARGO */
	if(isEmpty(document.main.ate_persona_cargo.value) )
	{
		showAlert('Debe ingresar el cargo que desempeña en la institución');
		document.main.ate_persona_cargo.focus();
		return false; 
	} 	 
	
	/*   REVISION DE JORNADA TRABAJO */
	var inputJornada = document.main.ate_persona_jornada;
	seleccionado= false;
	for(var i=0; i < inputJornada.length; i++)
	{
		if(inputJornada[i].checked == true)
		{
			seleccionado = true;
			break;
		}	  
	}
	if(!seleccionado)
	{
		showAlert('Debe seleccionar una jornada de trabajo'); 
		return false;
	}
 
	 /*   REVISION DE OTRO REGISTRO */ 
	var envioRegistro 	= false; 	 
	var x = document.main.elements;	 
	if(document.main.ate_persona_otro_registro[0].checked)
	{
		for (var i=0 ; i < x.length ; i++)
		{	 
			if(x[i].name == 'ate_persona_otro_registros[]' )
			{
				for(var j=0; j < x[i].length ; j++)
				{ 									
					if(x[i][j].selected)
					{
						envioRegistro = true;
						if(x[i][j].value == 'otro' && isEmpty(document.main.ate_persona_otro_registros_otro.value))
						{											
							 envioRegistro = false;
						}							 
					} 
				} 
			} 			 			 									
		 }	 
	}
	else
		envioRegistro = true;
	
	 if(!envioRegistro)
	 {	 	
		showAlert('Debe seleccionar al menos un registro o ingresar un nuevo registro'); 
		return false;
	 }
	 
	
	/*  REVISION DE TITULO ACADÉMICO */
	if(isEmpty(document.main.ate_persona_titulo_nombre.value))
	{
		showAlert('Debe ingresar el nombre correspondiente al título académico');
		document.main.ate_persona_titulo_nombre.focus();
		return false; 
	} 

	if(isEmpty(document.main.ate_persona_archivo_titulo.value) && !searchElement('ate_persona_archivo_titulo_existe'))
	{
		showAlert('Debe ingresar el archivo correspondiente al título académico');
		document.main.ate_persona_archivo_titulo.focus();
		return false; 
	} 
	 
	var aux = document.main.ate_persona_titulo_institucion;
	if( aux.value == '')
	{
		showAlert('Debe ingresar el nombre de la institución que otorgó el título académico');
		aux.focus();
		return false; 
	} 
	 /*   REVISION DE POSTITULO */
	if(!isEmpty(document.main.ate_persona_postitulo_nombre.value) || !isEmpty(document.main.ate_persona_postitulo_institucion.value) || !isEmpty(document.main.ate_persona_archivo_postitulo.value))
	{ 			
		if(isEmpty(document.main.ate_persona_archivo_postitulo.value))
		{
			
			var a = searchElement('ate_persona_archivo_postitulo_existe');
			if(a.value == 'yes')
			{
				/*no se hace nada*/
			}
			else
			{
				showAlert('Debe ingresar el archivo correspondiente al post-título');
				document.main.ate_persona_archivo_postitulo.focus();
				return false; 
			}
		}
		if(isEmpty(document.main.ate_persona_postitulo_nombre.value))
		{
			showAlert('Debe ingresar el nombre del post-título');
			document.main.ate_persona_postitulo_nombre.focus();
			return false; 
		}
		if(isEmpty(document.main.ate_persona_postitulo_institucion.value))
		{
			showAlert('Debe ingresar el nombre de la institución que otorgó el post-título');
			document.main.ate_persona_postitulo_institucion.focus();
			return false; 
		}
	}   
	process(action,level);
 
}
</script>

	<script>document.main.casoFormularioBloqueo.value = 'capital';</script>
	<!-- INCLUDE BLOCK : ../templates/ate/revision/form_registro_bloqueo_inclusion.tpl -->
<div  class="fieldset_title" >Ficha Personal 
<font id='ate_capital_estado' style="text-align:left" class="edicion_enrevision">  </font></div>
<div id='bloque_botones_sup'>
	<center>
		  <button type="button" onclick="javascript:chequeoTipoDatos('ficha_persona',0);"  ><span>Guardar</span></button>     <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		  <button type="button" onclick="javascript:chequeoTipoDatos('ficha_persona|cerrar',0);"  ><span>Guardar y Cerrar</span></button>  
	</center>
</div>	

<div class="fieldset_title" id='datos_persona' style="text-align:center">  
		<script>
		var recurso_nuevo = false;
		 <!-- START BLOCK : obtener_datos_externos -->
		 setValoresExternos('{numero_fila}');
		 recurso_nuevo = true;
		 <!-- END BLOCK : obtener_datos_externos -->
		 escribirDatosPersona();
		 </script></div>
		 
		 
		 
		 <div class="fieldset_title">Edici&oacute;n Nombre Persona  </div>

		 <fieldset>
		 <div>
		 	<label>Nombre</label><br />
			<input type="text" name="ate_persona_nombre_nueva" value="" />
		 </div>
		 <div>
		 	<label>Apellido Paterno</label><br />
			<input type="text" name="ate_persona_apellido_paterno_nueva" value="" />
		 </div>
		 <div>
		 	<label>Apellido Materno</label><br />
			<input type="text" name="ate_persona_apellido_materno_nueva" value="" />
		 </div>
		 </fieldset>
		 <script>
		 	document.main.ate_persona_nombre_nueva.value 			= document.main.ate_persona_nombre.value;
		 	document.main.ate_persona_apellido_paterno_nueva.value 	= document.main.ate_persona_apellido_paterno.value;
		 	document.main.ate_persona_apellido_materno_nueva.value 	= document.main.ate_persona_apellido_materno.value;		  
		 </script>
		 
		 <div class="fieldset_title">Datos Profesionales </div>
		 {tpl_ayuda_file}
		 
<fieldset>
<div>
<label>Título profesional o primer grado académico</label><br />
<input  type="hidden" name="ate_persona_titulo_nombre_nuevo" value="{titulo_nombre}">
<input type="text" name="ate_persona_titulo_nombre" value="{titulo_nombre}"> <span>(*)</span><span>{ayuda_persona_titulo}</span><br />
<span><strong>Adjunte certificado de título</strong></span>  <br />
 <input type="file"  class="inputfile" name="ate_persona_archivo_titulo" >	 	
		<span>(*)</span>  
		 <!-- START BLOCK : datos_archivo_titulo -->
		<span id='documento_titulo{caso_edicion}' ><a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=titulo_{rut_documento}.{extension_documento}" target="_blank" id='documento_titulo_href' title="Ver Certificado Título">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
	<a onclick="javascript:borrarArchivoOferenteRecurso('titulo','{rut_documento}');"  id='boton_borrar_titulo{caso_edicion}'  title="Eliminar Documento Actual"><img src="images/delete.jpg" border="0" /></a>
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
	<div >
	<label> Post-título o postgrado académico </label> <span>En caso de tener más de uno, indique el que le parezca más relevante</span><br />
	<input type="text" name="ate_persona_postitulo_nombre" value="{postitulo_nombre}"><span>{ayuda_persona_postitulo}</span>
			  <br />
<span>Adjuntar certificado de Post-título</span>   <br />
 <input type="file"  class="inputfile" name="ate_persona_archivo_postitulo" >	 	
		  
		 <!-- START BLOCK : datos_archivo_postitulo -->
		<span id='documento_postitulo{caso_edicion}' >
		<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=postitulo_{rut_documento}.{extension_documento}" target="_blank" id='documento_postitulo_href'   title="Ver Certificado Título">
		<img src="images/download_act.jpg" border="0" /></a>&nbsp;&nbsp;
	<a onclick="javascript:borrarArchivoOferenteRecurso('postitulo','{rut_documento}');" id='boton_borrar_postitulo{caso_edicion}' title="Eliminar Documento Actual"><img src="images/delete.jpg" border="0" /></a>
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
</fieldset>
<div class="fieldset_title">&iquest;Est&aacute; usted inscrito en otro registro? <span>{ayuda_persona_registro}</span></div>	 
<fieldset>
	<div> 
		<input type="radio"  class="inputcheckbox" name="ate_persona_otro_registro" value="si" {checked_si}/>Si  &nbsp;&nbsp;&nbsp;
		<input type="radio"  class="inputcheckbox" name="ate_persona_otro_registro" value="no" onclick="otroRegistroNo();"  {checked_no}/>No
		<span>(*)</span>
	</div>
	<div>
		<label>&iquest;Cu&aacute;l?</label><br  />
		  <img src="images/Info.ico" border='0'   />	Para seleccionar m&aacute;s de un registro mantenga presionada la tecla CTRL + click en el elemento a seleccionar. Para deseleccionar un registro mantenga presionada la tecla CTRL + click en el elemento a deseleccionar <br />
			<select  name="ate_persona_otro_registros[]"  onchange="javascript:chequeoOtroRegistro();" multiple="multiple" size="6" style="height:auto" >
			
			<!--<option value="" onclick="javascript:otroRegistroNo();">SELECCIONE REGISTRO</option>-->
			<!-- START BLOCK : bloque_ate_legal_otro -->
			<option value="{ate_legal_otro_id}" {ate_legal_otro_selected} onclick="otroRegistroSi(); ">{ate_legal_otro_registro}</option>
			<!-- END BLOCK : bloque_ate_legal_otro -->
			<option value="otro" onclick="javascript:otroRegistro();" {select_registro_otros}>OTRO REGISTRO</option>
			</select>
		<span>(*)</span>
		
		<br />
		<label>Otro</label><br  />
		<input name="ate_persona_otro_registros_otro" value="{otro_registro}"  maxlength="70" disabled="disabled"/>
		<script>
			
			var inputRegistroTexto 	= document.main.ate_persona_otro_registros_otro; 
			var inputRegistroSelect = searchElement('ate_persona_otro_registros');
			var inputRegistroRadio 	= document.main.ate_persona_otro_registro;
			<!-- START BLOCK : bloque_ate_legal_otro_nodisable -->
			otroRegistroSi();
			inputRegistroTexto.disabled 	= false;  
			<!-- END BLOCK : bloque_ate_legal_otro_nodisable -->
			function otroRegistro(){
				inputRegistroTexto.disabled 	= false;
				inputRegistroTexto.focus();
				otroRegistroSi();
			}
			function otroRegistroSi(){
				inputRegistroRadio[0].checked 		= true;
			}
			function desabilitarOtro(){
				inputRegistroTexto.value 		= '';
				inputRegistroTexto.disabled 	= true;			
			} 
			function otroRegistroNo(){
				desabilitarOtro();  				
				unselectInputAll('ate_persona_otro_registros');
				inputRegistroRadio[1].checked 		= true;
			}

			function chequeoOtroRegistro()
			{
				var name = 'ate_persona_otro_registros[]'; 
					
				var x = searchElement(name);
				   
				for (var i=0 ; i < x.length ; i++)
				{			    
					if(x[i].selected )
					{
						otroRegistroSi();
						if(x[i].value == 'otro')						
						{
							otroRegistro();
						} 
					} 
				}  
			}			
		</script>
	</div>
</fieldset>
<div class="fieldset_title">Tipo de Jornada en la Institución <span>{ayuda_persona_jornada}</span></div>
	 
<fieldset>
	<div>  
			 
			<!-- START BLOCK : bloque_ate_persona_jornada -->
			<input  type="radio"  class="inputcheckbox" name="ate_persona_jornada" value="{ate_persona_jornada_id}" {ate_persona_jornada_selected}  ><strong>{ate_legal_otro_registro} </strong><br />  
			<!-- END BLOCK : bloque_ate_persona_jornada --> 
			 <span>(*)</span>	
	</div>
	</fieldset>
<div class="fieldset_title"> Cargo que desempeña en la Institución</div>
	 
<fieldset>
	<div>  
		<input type="text" name="ate_persona_cargo" value="{cargo}">
			 <span>(*)</span><span>{ayuda_persona_cargo}</span>
	</div>
	</fieldset>
	<div class="fieldset_title">Horas semanales disponibles para realizar Asistencia Técnica  </div>
	 
<fieldset>
	<div>  
		<input type="text" name="ate_persona_horas" value="{horas}" />
			     
			 <span>(*)</span> <span>{ayuda_persona_horas}</span>	
	</div>
	</fieldset>
<div class="fieldset_title"> Especialización y Experiencia Individual<span>{ayuda_area_asistencia}</span></div>
Señale la(s) subárea(s) en la(s) que el profesional tiene especialización, luego marque si ha tenido experiencia(s) en los últimos 5 años, en este caso complete el (los) portafolio(s) con los documentos requeridos.<br />
 Para editar o eliminar algún elemento, deberá hacerlo en el listado correspondiente
	{tpl_experiencia_persona} 
<input type="hidden" name="guardar_caso" value="guardar" />

 
<div id='bloque_botones_inf'>
	<center>
		  <button type="button" onclick="javascript:chequeoTipoDatos('ficha_persona',0);"  ><span>Guardar</span></button>     <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		  <button type="button" onclick="javascript:chequeoTipoDatos('ficha_persona|cerrar',0);"  ><span>Guardar y Cerrar</span></button>  
	</center>
</div>


	
<!-- START BLOCK : ventana_cerrar -->
<script> 
	self.close();
</script>
<!-- END BLOCK : ventana_cerrar -->
