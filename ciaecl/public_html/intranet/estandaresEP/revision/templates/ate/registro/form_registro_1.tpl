<div  class="fieldset_title" >Identificaci&oacute;n General</div> 
<fieldset>
	<div>
		<label>Rut Institucional </label><br  />		
		<input type="text"  name="ate_institucion_rut"  value="{rut_institucion}"  style="width:100px" maxlength="8"  />  - 
		<input type="text"  name="ate_institucion_dv"    value="{rut_institucion_dv}" style="width:25px" maxlength="1"    >
		<span>(*)</span><span>{ayuda_institucion_rut}</span>		
	</div>  

	<div>
		<label>Raz&oacute;n Social Instituci&oacute;n <font id='ate_institucion_razon_social_estado' class="edicion_enrevision"> </font></label><br  />
		<input type="text" name="ate_institucion_razon_social"  maxlength="255" value="{razon_social}"> 
		<span>(*)</span><span>{ayuda_institucion_razon_social}</span>
	</div> 
	<div>
		<label>Nombre de Fantas&iacute;a<font id='ate_institucion_nombre_fantasia_estado' class="edicion_enrevision"> </font></label><br  />
		<input type="text"name="ate_institucion_nombre_fantasia"  maxlength="255"  value="{nombre_fantasia}">
		<span>(*)</span><span>{ayuda_institucion_nombre_fantasia}</span>
	</div>
	<div>
		<label>A&ntilde;o de Fundaci&oacute;n</label><br  />
		<select name="ate_institucion_agno_fundacion" style=" width:100px">{template_ano_fundacion}</select>
		<span>(*)</span>	<span>{ayuda_institucion_ano_fundacion}</span>	
	</div>
	<div>		
		<label>Objeto Social / Giro de la Institución<font id='ate_institucion_giro_estado' class="edicion_enrevision"> </font></label> 	<br  />
		<input type="text" name="ate_institucion_giro"  maxlength="255"  value="{giro}">
		<span>(*) </span><span>{ayuda_institucion_giro}</span>
	</div>
	<div>		
		<label>Representante Legal</label> <span>(*) </span>	<span>{ayuda_institucion_representate}</span>
		<br  /> Nombre <font id='ate_institucion_representante_estado' class="edicion_enrevision"> </font><br /> <input type="text" name="ate_institucion_representante"  maxlength="150"  value="{representante}"  style=" width:150px"> <br />
		 Apellido Paterno <font id='ate_institucion_representante_apellido_paterno_estado' class="edicion_enrevision"> </font><br /> <input type="text" name="ate_institucion_representante_apellido_paterno"  maxlength="150"  value="{representante_apellido_paterno}" style=" width:150px"> <br />
		 Apellido Materno <font id='ate_institucion_representante_apellido_materno_estado' class="edicion_enrevision"> </font><br /> <input type="text" name="ate_institucion_representante_apellido_materno"  maxlength="150"  value="{representante_apellido_materno}" style=" width:150px"> <br />
		
	</div>
	<div>
		<label>Direcci&oacute;n Instituci&oacute;n<font id='ate_institucion_direccion_estado' class="edicion_enrevision"> </font></label><br  />
		<textarea name="ate_institucion_direccion"  >{institucion_direccion}</textarea>
		<span>(*)</span><span>{ayuda_institucion_direccion}</span>
	</div>
	<div>
		<label>Regi&oacute;n Instituci&oacute;n</label><br  />
		<select name="ate_noinstitucion_region_id" onchange="javascript:showComuna('ate_noinstitucion_region_id','ate_institucion_comuna_id');" >
		{template_region_institucion}
		</select>		
		<span>(*)</span>	<span>{ayuda_institucion_region}</span>
	</div>
	<div>
	<label>Comuna Instituci&oacute;n	</label><br  />	
		<select name="ate_institucion_comuna_id" id="ate_institucion_comuna_id" >
		{template_comuna_institucion} 	
		</select>			
		<span>(*)</span><span>{ayuda_institucion_comuna}</span>
	</div>
	<div>
	<label>Tel&eacute;fono (anteponga el c&oacute;digo ciudad)<font id='ate_institucion_telefono_estado' class="edicion_enrevision"> </font></label><br  /> 
	
			<select name="ate_institucion_telefono_codigo" style="width:60px">
		<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_area_option.tpl --> 		
		</select>
		<script> 			
		selectValue('ate_institucion_telefono_codigo','{telefono_codigo}'); 	
		</script>
	 - <input type="text"  maxlength="7" name='ate_institucion_telefono'  value="{telefono}" style="width:100px">		
	<span>(*)</span>	<span>{ayuda_institucion_telefono}</span>
	</div>
	<div>
	<label>Email Contacto<font id='ate_institucion_email_estado' class="edicion_enrevision"> </font></label><br  />
	 <input type="text" name="ate_institucion_email" value="{email}"  maxlength="150" >
	<span>(*)</span><span>{ayuda_institucion_email}</span>
	</div>
	<div>
	<label>P&aacute;gina Web<font id='ate_institucion_url_estado' class="edicion_enrevision"> </font></label><br  />
	 <input type="text" name="ate_institucion_url"   value="{url}" maxlength="150"   > 	<span>{ayuda_institucion_www}</span>
	</div>
	</fieldset>
<div class="fieldset_title">Sedes </div>
	 Señale sólo aquella/as sedes que participarán conjuntamente con la sede principal en las asesorías {sigla_sistema} 
	 

<div id='ate_sedes_div'>
{ate_sedes_div}	
<!-- START BLOCK : div_sede_vacia -->
<div id='ate_sedes_div_0'> 
</div>
<!-- END BLOCK : div_sede_vacia -->
</div>
<script>
var total_sede={numero_sedes};
var ate_sede_comuna_id_nueva = '';
</script> 
<fieldset > 
	<button type="button"  onclick="javascript:agregarSede(total_sede)"><span>Agregar Sede</span></button>
</fieldset> 
 
<div class="fieldset_title">Persona responsable de las Asesorías ATE    </div>

 
<fieldset> 
<div>Debe ingresar los datos de la persona que estará en contacto con las escuelas que contraten los servicios ATE ofrecidos por la institución.</div>
	<div>
		<label>¿Desea repetir los datos de usuario registrado o del representante legal?</label><br />
		<input type="radio"  class="inputcheckbox" name="repetir_info" value='1' onclick="javascript:copiarInfoUsuario();"/> Usuario Registrado<br />
		<input type="radio"  class="inputcheckbox" name="repetir_info" value='0' onclick="javascript:copiarInfoRepresentante();"/> Representante Legal
	</div>
	<div>
		<label>Nombre<font id='ate_responsable_nombre_estado' class="edicion_enrevision"> </font></label><br  />
		<input type="text" name="ate_responsable_nombre" value="{responsable_nombre}" >
		<span>(*)</span>
	</div>
	<div>
		<label>Apellido Paterno<font id='ate_responsable_apellido_paterno_estado' class="edicion_enrevision"> </font></label><br  />
		<input type="text" name="ate_responsable_apellido_paterno" value="{responsable_apellido_paterno}" >
		<span>(*)</span>
	</div>
	<div>
		<label>Apellido Materno<font id='ate_responsable_apellido_materno_estado' class="edicion_enrevision"> </font></label><br  />
		<input type="text" name="ate_responsable_apellido_materno" value="{responsable_apellido_materno}" >
		<span>(*)</span>
	</div>
	<div>
		<label>Direcci&oacute;n<font id='ate_responsable_direccion_estado' class="edicion_enrevision"> </font></label><br  />
		<textarea name="ate_responsable_direccion">{responsable_direccion}</textarea>
		<span>(*)</span><span>{ayuda_responsable_direccion}</span>
	</div>
	<div>
	<label>Teléfonos de contacto (*) (ingrese al menos uno)</label>
	</div>
	<div style="padding-left:20px">
		<label>Tel&eacute;fono (anteponga el c&oacute;digo ciudad)<font id='ate_responsable_telefono_estado' class="edicion_enrevision"><font id='ate_responsable_telefono_codigo_estado' class="edicion_enrevision"> </font> </font></label><br  /> 
		<select name="ate_responsable_telefono_codigo" style="width:60px">
		<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_area_option.tpl --> 		
		</select>
		<script> 			
		selectValue('ate_responsable_telefono_codigo','{responsable_telefono_codigo}'); 	
		</script>
		  - <input type="text"  maxlength="7" name='ate_responsable_telefono' style="width:100px" value="{responsable_telefono}" >
		<span>(*)</span><span>{ayuda_responsable_telefono}</span>
	</div>
	<div style="padding-left:20px">
	<label>Celular (incluya el c&oacute;digo)	<font id='ate_responsable_celular_estado' class="edicion_enrevision"><font id='ate_responsable_celular_codigo_estado' class="edicion_enrevision"> </font> </font></label><br  /> 
	
		<select name="ate_responsable_celular_codigo" style="width:60px">
		<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_celular_option.tpl --> 		
		</select>
		<script> 			
		selectValue('ate_responsable_celular_codigo','{responsable_celular_codigo}'); 	
		</script>
	 - <input type="text" maxlength="7"  name='ate_responsable_celular' style="width:100px"  maxlength="7" value="{responsable_celular}"  > 
	<span>&nbsp;&nbsp;&nbsp;</span><span>{ayuda_responsable_celular}</span>
	</div>
	<div>
	<label>Email<font id='ate_responsable_email_estado' class="edicion_enrevision"> </font></label><br  />
	 <input type="text" name='ate_responsable_email'  value="{responsable_email}" >
	<span>(*)</span><span>{ayuda_responsable_email}</span>
	</div>
	<div>
	<label>Cargo<font id='ate_responsable_cargo_estado' class="edicion_enrevision"> </font></label><br  />
	 <input type="text" name='ate_responsable_cargo'  value="{responsable_cargo}" >
	<span>(*)</span><span>{ayuda_responsable_cargo}</span>
	</div>
</fieldset> 
<input type="hidden" name="nombre_usuario" value="{nombre_usuario}" />
<input type="hidden" name="apellido_paterno_usuario" value="{apellido_paterno_usuario}" />
<input type="hidden" name="apellido_materno_usuario" value="{apellido_materno_usuario}" />
<input type="hidden" name="email_usuario" value="{email_usuario}" />
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
		
		/* revision previa de codigos de telefonos */ 		
		
		if(document.main.ate_institucion_rut.value != '')
		{
			if(document.main.ate_institucion_rut.value > 100000000 || document.main.ate_institucion_rut.value < 30000000)
			{			
				showAlert('El rut de una persona natural no puede ser mayor a 100.000.000 ni menor a 30.000.000');	
				document.main.ate_institucion_rut.focus();	
				return false;
			}				
			if(!revisaRut(document.main.ate_institucion_rut.value,document.main.ate_institucion_dv.value))
			{
				showAlert('El rut y dígito verificador de la institución deben ser válidos. Deben coincidir rut y dv. El rut debe ser númerico y sin puntos');				
				return false;
			}		
		} 
	
		/*  var aux = document.main.ate_institucion_representante;
		var msg = "La información del representante legal debe estar completa (nombre y apellido paterno) ";
		if(!isEmpty(aux.value) && isEmpty(document.main.ate_institucion_representante_apellido_paterno.value))
		{
			showAlert(msg);
			document.main.ate_institucion_representante_apellido_paterno.focus();				
			return false;
		} */	 
		
		var aux = document.main.ate_institucion_telefono_codigo;
		var msg = "El código de área del teléfono de la institución debe ser numérico ";
		if(!isEmpty(aux.value) && !isNumber(aux.value))
		{
			showAlert(msg);
			aux.focus();				
			return false;
		} 
	 
		aux = document.main.ate_institucion_telefono;
		msg = "El teléfono de la institución debe ser numérico";
		if(!isEmpty(aux.value) && !isNumber(aux.value))
		{
			showAlert(msg);
			aux.focus();				
			return false;
		} 
		 
		 
		if((isEmpty(document.main.ate_institucion_telefono_codigo.value) && !isEmpty(document.main.ate_institucion_telefono.value)) || (!isEmpty(document.main.ate_institucion_telefono_codigo.value) && isEmpty(document.main.ate_institucion_telefono.value)))
		{
			showAlert('Debe incluir el teléfono de la institución completamente (código de área y número)'); 				
			return false;		
		}
		
		aux = document.main.ate_responsable_telefono_codigo;
		msg = "El código de área del teléfono del responsable de la institución debe ser numérico";
		if(!isEmpty(aux.value) && !isNumber(aux.value))
		{
			showAlert(msg);
			aux.focus();				
			return false;
		} 
		 
		aux = document.main.ate_responsable_telefono;
		msg = "El teléfono del responsable de la institución debe ser numérico";
		if(!isEmpty(aux.value) && !isNumber(aux.value))
		{
			showAlert(msg);
			aux.focus();				
			return false;
		} 
		if((isEmpty(document.main.ate_responsable_telefono_codigo.value) && !isEmpty(document.main.ate_responsable_telefono.value)) || (!isEmpty(document.main.ate_responsable_telefono_codigo.value) && isEmpty(document.main.ate_responsable_telefono.value)))
		{
			showAlert('Debe incluir el teléfono del responsable de la institución completamente (código de área y número)'); 				
			return false;		
		}
		
		aux = document.main.ate_responsable_celular_codigo;
		msg = "El código de celular del responsable de la institución debe ser numérico";
		if(!isEmpty(aux.value) && !isNumber(aux.value))
		{
			showAlert(msg);
			aux.focus();				
			return false;
		} 
		aux = document.main.ate_responsable_celular;
		msg = "El  celular del responsable de la institución debe ser numérico";
		if(!isEmpty(aux.value) && !isNumber(aux.value))
		{
			showAlert(msg);
			aux.focus();				
			return false;
		} 
		
		if((isEmpty(document.main.ate_responsable_celular_codigo.value) && !isEmpty(document.main.ate_responsable_celular.value)) || (!isEmpty(document.main.ate_responsable_celular_codigo.value) && isEmpty(document.main.ate_responsable_celular.value)))
		{
			showAlert('Debe incluir el celular del responsable de la institución completamente (código y número)'); 				
			return false;		
		}
		if(document.main.ate_institucion_email.value != '')
		{ 
			if(!checkMail(document.main.ate_institucion_email.value))
			{
				showAlert('La dirección de email de la institución debe ser válida');
				return false;
			}
		}
		 
		if(document.main.ate_responsable_email.value != '')
		{
			if(!checkMail(document.main.ate_responsable_email.value))
			{
				showAlert('La dirección de email del responsable debe ser válido');
				return false;
			}
		} 
		if(!checkSede())
			return false;

		var chequeoEdicion = true;
		if(typeof chequeoTipoDatosEdicion == 'function') {
			chequeoEdicion = chequeoTipoDatosEdicion(chequeo);
		} 
		
		if(chequeo && chequeoEdicion)
		{
			process(action,level);
		}
	}
	
function checkSede()
{
	var email_sede 		= 'ate_sede_0_email';
	var email_sede_obj	= searchElement(email_sede);
	var i = 0;
	var msg_quitar_defecto = " o en su defecto quitar la sede que no desee ingresar";	
	var msg_quitar = " de todas las sedes que desee incluir"+msg_quitar_defecto;
	while(email_sede_obj)
	{
		 var aux_oculto = searchElement('ate_sede_'+i+'_oculto');
		 
		 if(aux_oculto.value == 0)
		 {

			if(isEmpty(email_sede_obj.value))
			{
				showAlert('Debe ingresar el email' + msg_quitar);	
				email_sede_obj.focus();				 				 
				return false;
			}	 			 
			if(!isEmpty(email_sede_obj.value) && !checkMail(email_sede_obj.value))
			{
				showAlert('El email debe ser válido' + msg_quitar);	
				email_sede_obj.focus();				 
				return false;
			}
			var aux = searchElement('ate_sede_'+i+'_comuna_id');
			var aux_region = searchElement('ate_nosede_'+i+'_region_id');
			if( aux.value == '')
			{
				showAlert('Debe seleccionar la comuna' + msg_quitar);	
				aux.focus();				 				 
				return false;
			}
			var aux_codigo = searchElement('ate_sede_'+i+'_telefono_codigo');
			var aux_telefono = searchElement('ate_sede_'+i+'_telefono');
			
			if(isEmpty(aux_codigo.value) || isEmpty(aux_telefono.value))
			{
				showAlert('Debe ingresar el teléfono' + msg_quitar);	
				aux_codigo.focus();				 				 
				return false;
			}	 			
			if(!isEmpty(aux_codigo.value) && !isNumber(aux_codigo.value))
			{
				showAlert('Debe ingresar el código de área del teléfono' + msg_quitar);	
				aux_codigo.focus();				 
				return false;
			} 			
			
			if(!isEmpty(aux_telefono.value) && !isNumber(aux_telefono.value))
			{
				showAlert('Debe ingresar el teléfono numérico ' + msg_quitar);	
				aux_telefono.focus();				 
				return false;
			} 
			if((isEmpty(aux_telefono.value) && !isEmpty(aux_codigo.value)) || (!isEmpty(aux_codigo.value) && isEmpty(aux_telefono.value)))
			{
				showAlert('Debe incluir el teléfono completo (código de área y teléfono)' + msg_quitar); 				
				aux_codigo.focus();
				return false;		
			}				
			var aux = searchElement('ate_sede_'+i+'_direccion');
			if(aux.value == '')
			{
				showAlert('Debe ingresar la dirección' + msg_quitar);	
				aux.focus();				 				 
				return false;
			}	 
		 }
		i++;
		var email_sede = 'ate_sede_'+i+'_email';
		var email_sede_obj = searchElement(email_sede);
	}
	return true;
}

function copiarInfoUsuario()
{ 
	if(confirm('¿Está seguro de completar estos datos?'))
	{ 
		document.main.ate_responsable_email.value 				= document.main.email_usuario.value;
		document.main.ate_responsable_nombre.value 				= document.main.nombre_usuario.value;
		document.main.ate_responsable_apellido_paterno.value 	= document.main.apellido_paterno_usuario.value;
		document.main.ate_responsable_apellido_materno.value 	= document.main.apellido_materno_usuario.value; 
	}	
}
function copiarInfoRepresentante()
{ 
	if(confirm('¿Está seguro de completar estos datos?'))
	{  
		document.main.ate_responsable_email.value 				= document.main.ate_institucion_email.value;
		document.main.ate_responsable_nombre.value 				= document.main.ate_institucion_representante.value;
		document.main.ate_responsable_apellido_paterno.value 	= document.main.ate_institucion_representante_apellido_paterno.value;
		document.main.ate_responsable_apellido_materno.value 	= document.main.ate_institucion_representante_apellido_materno.value;	
		document.main.ate_responsable_direccion.value			= document.main.ate_institucion_direccion.value;
		document.main.ate_responsable_telefono_codigo.value		= document.main.ate_institucion_telefono_codigo.value;
		document.main.ate_responsable_telefono.value			= document.main.ate_institucion_telefono.value;		  
	}	
}
</script> 