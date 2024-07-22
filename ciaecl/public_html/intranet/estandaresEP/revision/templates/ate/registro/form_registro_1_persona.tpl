 
<div class="fieldset_title">Registros (*)</div>
 <fieldset>
	<div>
	<label> <strong>Estimado usuario/a, solo si usted est&aacute; inscrito  en cualquiera de los siguientes registros contin&uacute;e el ingreso de datos. </strong>{ayuda_persona_registro}</label> <br />  
			<!-- START BLOCK : bloque_ate_persona_registro -->
			<br /><input type="checkbox"  class="inputcheckbox"  readonly="readonly"    {ate_persona_registro_checked}  name="ate_persona_registro[]" value="{bloque_ate_persona_registro_id}" onclick="javascript:check_registro();" ><strong>{bloque_ate_persona_registro} </strong>
			<!-- END BLOCK : bloque_ate_persona_registro -->
			<br />
			
	</div>
 <div>
 <label> <strong>Si usted no pertenece a ninguno de los registros anteriores y s&oacute;lo si cumple con los siguientes requisitos: </strong></label><br />  
	<ul style=" list-style: outside; padding-left:25px;"> 
	      <li>Poseer t&iacute;tulo de mag&iacute;ster o doctorado en &aacute;reas  relevantes para el desarrollo de asesor&iacute;as a establecimientos educacionales.</li>
	      <li>Acreditar experiencia relevante en asesor&iacute;as a  establecimientos educacionales en los &uacute;ltimos 5 a&ntilde;os. </li>
	      <li>Presentar cartas de recomendaci&oacute;n de al menos  tres sostenedores o establecimientos educacionales que hayan contado con los  servicios profesionales del postulante.</li>
   </ul>
	<strong>&nbsp;Marque la opci&oacute;n: &ldquo;Experto  fuera de los registros anteriores&rdquo;</strong> <br />  
	  
			  <br />
			  <input type="checkbox"  class="inputcheckbox"  onclick="javascript:check_noregistro();"  {ate_persona_noregistro_checked}  name="ate_persona_noregistro" value="">
			  <strong> Experto  fuera de los registros anteriores  </strong> 
			  <br /> 
	</div>
	</fieldset>
	
<div class="fieldset_title">Datos Personales</div>
	<fieldset>
	<div id='mensaje_persona_edicion'  ></div>
	<div>
		<label>Rut</label> <br  />		
		
			<!-- START BLOCK : bloque_ate_persona_rut_form -->
		<input type="text"  name="ate_persona_rut"  value="{rut_persona}"  style="width:100px" maxlength="8"   >  - 
		<input type="text"  name="ate_persona_dv"    value="{rut_persona_dv}" style="width:25px" maxlength="1"    ><span>(*)</span>
		
			<!-- END BLOCK : bloque_ate_persona_rut_form -->
			<!-- START BLOCK : bloque_ate_persona_rut_fijo -->
			
		<input  type="text" name="ate_persona_rut" value="{rut_persona}"    style="width:100px" maxlength="8"     >  - 
		<input type="text"  name="ate_persona_dv"    value="{rut_persona_dv}"    style="width:25px" maxlength="1"      >
		<!-- <strong> {rut_persona_formato} -  {rut_persona_dv} </strong> -->
		
			<!-- END BLOCK : bloque_ate_persona_rut_fijo -->
		<span>{ayuda_persona_rut}</span>		
	</div>  
	<div>
		<label>Nombre</label><br  />
		<input type="text" name="ate_persona_nombre" value="{persona_nombre}" >
		<span>(*)</span>
	</div>
	<div>
		<label>Apellido Paterno</label><br  />
		<input type="text" name="ate_persona_apellido_paterno" value="{persona_apellido_paterno}" >
		<span>(*)</span>
	</div>
	<div>
		<label>Apellido Materno</label><br  />
		<input type="text" name="ate_persona_apellido_materno" value="{persona_apellido_materno}" >
		<span>(*)</span>
	</div> 
	<div>
	<label>Email<font id='ate_persona_email_estado' class="edicion_enrevision"> </font></label><br  />
	 <input type="text" name='ate_persona_email'  value="{persona_email}" >
	<span>(*)</span><span>{ayuda_email}</span>
	</div>
	
<div>
		<label>Direcci&oacute;n <font id='ate_persona_direccion_estado' class="edicion_enrevision"> </font></label><br  />
		<textarea name="ate_persona_direccion"  >{persona_direccion}</textarea>
		<span>(*)</span><span>{ayuda_persona_direccion}</span>
	</div>
	<div>
		<label>Regi&oacute;n </label><br  />
		<select name="ate_nopersona_region_id" onchange="javascript:showComuna('ate_nopersona_region_id','ate_persona_comuna_id');" >
		{template_region_persona}
		</select>		
		<span>(*)</span>	<span>{ayuda_persona_region}</span>
	</div>
	<div>
	<label>Comuna 	</label><br  />	
		<select name="ate_persona_comuna_id"   id="ate_persona_comuna_id" >
		{template_comuna_persona} 	
		</select>			
		<span>(*)</span><span>{ayuda_persona_comuna}</span>
	</div>	
	<div>
	<label>Teléfonos de contacto (*) (ingrese al menos uno)</label>
	</div>
	<div style="padding-left:20px">
	<label>Tel&eacute;fono de Contacto (anteponga el c&oacute;digo ciudad)</label>
	<font id='ate_persona_telefono_estado' class="edicion_enrevision"> </font><br  />

		<select name="ate_persona_telefono_codigo"  style="width:60px">
		<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_area_option.tpl --> 		
		</select>
		<script> 			
		/*selectValue('ate_persona_telefono_codigo','{telefono_codigo}'); */	
		
		crearOptionASelect("ate_persona_telefono_codigo",'{telefono_codigo}','{telefono_codigo}'); 	
		</script>
	  - <input type="text"  maxlength="7" name='ate_persona_telefono'  value="{telefono}" style="width:100px">		
	<span>(*)</span>	<span>{ayuda_persona_telefono}</span>
	</div>
	<div style="padding-left:20px">
	<label>Celular de Contacto (anteponga el c&oacute;digo)</label>
	<font id='ate_persona_celular_estado' class="edicion_enrevision"> </font><br  />
		 

		<select name="ate_persona_celular_codigo"  style="width:60px">
		<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_celular_option.tpl --> 		
		</select>
		<script> 			
		/*selectValue('ate_persona_celular_codigo','{celular_codigo}');*/
		crearOptionASelect("ate_persona_celular_codigo",'{celular_codigo}','{celular_codigo}'); 	
		</script>	  - <input type="text"  maxlength="10" name='ate_persona_celular'  value="{celular}" style="width:100px">		
	<span><!--(*)--></span>	<span>{ayuda_persona_celular}</span>
	</div>
	<div>
	<label>P&aacute;gina Web</label><br  />
	 <input type="text" name="ate_persona_url"   value="{url}" maxlength="150"   > 	
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
	 	var x = document.main.elements;	
		var sel = false;
		for (var i=0 ; i < x.length ; i++)
		{			    
			if(	x[i].checked == true)
				sel = true;		 
		}
		
		if(sel == false)
		{	
			showAlert('Debe seleccionar al menos un registro');	
			return false;
		}
		   
		if(document.main.ate_persona_rut.value != '' && document.main.ate_persona_dv.value != '')
		{ 
			if(document.main.ate_persona_rut.value > 30000000 || document.main.ate_persona_rut.value < 999999)
			{			
				showAlert('El rut de una persona natural no puede ser mayor a 30.000.000 ni menor a 999.999');	
				document.main.ate_persona_rut.focus();	
				return false;
			}		
			if(!revisaRut(document.main.ate_persona_rut.value,document.main.ate_persona_dv.value))
			{
				showAlert('El rut y dígito verificador deben ser válidos. Deben coincidir rut y dv. El rut debe ser númerico y sin puntos');	
				document.main.ate_persona_dv.focus();	
				return false;
			}				
		}
		else
		{
			showAlert('Debe ingresar rut completo');
			document.main.ate_persona_rut.focus();
			return false;
		}
	  
		 
		if(document.main.ate_persona_email.value != '')
		{
			if(!checkMail(document.main.ate_persona_email.value))
			{
				showAlert('La dirección de email debe ser válida');
				document.main.ate_persona_email.focus();
				return false;
			}
		}  
		else
		{
			showAlert('Debe ingresar email');
				document.main.ate_persona_email.focus();
			return false;
		}
	
		if(document.main.ate_persona_nombre.value == '')
		{
			showAlert('Debe ingresar nombre');
			document.main.ate_persona_nombre.focus();
			return false;
		}		
		if(document.main.ate_persona_apellido_paterno.value == '')
		{
			showAlert('Debe ingresar apellido paterno');
			document.main.ate_persona_apellido_paterno.focus();
			return false;
		}		
		
		if(document.main.ate_persona_apellido_materno.value == '')
		{
			showAlert('Debe ingresar apellido materno');
			document.main.ate_persona_apellido_materno.focus();
			return false;
		}		 
			 
	 	if(!revisionTelefonos())
		{
			return false;		  
		}
		process(action,level);
	}
	
	function check_noregistro()
	{
		/*if(document.main.ate_persona_noregistro.checked == true )
		{
			var x = document.main.elements;	 
			var name = 'ate_persona_registro[]';
			for (var i=0 ; i < x.length ; i++)
			{			    
				if(x[i].name == name)
				{
					x[i].checked = false;
				}
			}	
		}*/
	}
	
	function revisionTelefonos()
	{
		/* revision de formato numeros */
		aux = document.main.ate_persona_telefono;
		msg = "El teléfono fijo de contacto debe ser numérico";
		if(!isEmpty(aux.value) && !isNumber(aux.value))
		{
			showAlert(msg);
			aux.focus();				
			return false;
		} 		
		
		aux = document.main.ate_persona_celular;
		msg = "El teléfono celular de contacto debe ser numérico";
		if(!isEmpty(aux.value) && !isNumber(aux.value))
		{
			showAlert(msg);
			aux.focus();				
			return false;
		} 		 
		
		/* revision de completitud de numeros */
		if((isEmpty(document.main.ate_persona_telefono_codigo.value) && !isEmpty(document.main.ate_persona_telefono.value)) || (!isEmpty(document.main.ate_persona_telefono_codigo.value) && isEmpty(document.main.ate_persona_telefono.value)))
		{
			showAlert('Debe incluir el teléfono fijo de contacto completamente (código de área y número)'); 	
			document.main.ate_persona_telefono.focus();			
			return false;		
		}	

		if((isEmpty(document.main.ate_persona_celular_codigo.value) && !isEmpty(document.main.ate_persona_celular.value)) || (!isEmpty(document.main.ate_persona_celular_codigo.value) && isEmpty(document.main.ate_persona_celular.value)))
		{
			showAlert('Debe incluir el teléfono celular de contacto completamente (código de celular y número)'); 
			document.main.ate_persona_celular.focus();							
			return false;		
		}			
		
		/* revision de ingreso de al menos uno */
		if(isEmpty(document.main.ate_persona_celular.value) && isEmpty(document.main.ate_persona_telefono.value)  )
		{
			showAlert('Debe incluir al menos un teléfono de contacto completo (código y número)');  
			return false;		
		}			
		return true;
	}
	
	function check_registro()
	{
		/*var x = document.main.elements;	 
		var name = 'ate_persona_registro[]';
		for (var i=0 ; i < x.length ; i++)
		{			    
			if(x[i].name == name && x[i].checked == true )
			{
				document.main.ate_persona_noregistro.checked = false;
			}
		}	*/	
	}
	
	</script>
