 
 <fieldset>
	<div>
	<label></label> Estimado usuario/a, solo si usted est&aacute; inscrito  en cualquiera de los siguientes registros contin&uacute;e el ingreso de datos. <br />  
			<!-- START BLOCK : bloque_ate_persona_registro -->
			<br /><input type="checkbox"  class="inputcheckbox"    name="ate_persona_registro[]" value="{bloque_ate_persona_registro_id}" ><strong>{bloque_ate_persona_registro} </strong>
			<!-- END BLOCK : bloque_ate_persona_registro -->
			<br />
			
	</div>
	<div>
		<label>Rut  </label><br  />		
		<input type="text"  name="ate_persona_rut" value="{rut_persona}"  style="width:100px" maxlength="8"   >  - 
		<input type="text"  name="ate_persona_dv"    value="{rut_persona_dv}" style="width:25px" maxlength="1"    >
		<span>(*)</span><span>{ayuda_rut}</span>		
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
	<label>Email</label><br  />
	 <input type="text" name='ate_persona_email'  value="{persona_email}" >
	<span>(*)</span><span>{ayuda_email}</span>
	</div>
	
	</fieldset>
 <button onclick="chequeoTipoDatos('mi_registro|persona',0);" type="button"><span> Enviar</span></button>
	</center> 
	
	<br /><br />
Gracias por aportarnos esta informaci&oacute;n. El Ministerio de
Educaci&oacute;n verificar&aacute; sus datos y en el plazo de una semana
nos pondremos en contacto con usted al correo electr&oacute;nico
proporcionado en este registro.
	<script>
	 	
function chequeoTipoDatos(action,level)
{
	 
			desbloquearFormularioDevuelto();
		chequeoTipoDatosCompleto(action,level); 
			bloquearFormularioDevuelto();				
}
function chequeoTipoDatosCompleto(action,level){
	 
	 
 
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
			if(!revisaRut(document.main.ate_persona_rut.value,document.main.ate_persona_dv.value))
			{
				showAlert('El rut y dígito verificador deben ser válidos. Deben coincidir rut y dv. El rut debe ser númerico y sin puntos');		
				return false;
			}		
		}
		else
		{
			showAlert('Debe ingresar rut completo');
			return false;
		}
		 
		 
		if(document.main.ate_persona_email.value != '')
		{
			if(!checkMail(document.main.ate_persona_email.value))
			{
				showAlert('La dirección de email debe ser válida');
				return false;
			}
		}  
		else
		{
			showAlert('Debe ingresar email');
			return false;
		}

		if(document.main.ate_persona_nombre.value == '')
		{
			showAlert('Debe ingresar nombre');
			return false;
		}		
		if(document.main.ate_persona_apellido_paterno.value == '')
		{
			showAlert('Debe ingresar apellido paterno');
			return false;
		}		
		
		if(document.main.ate_persona_apellido_materno.value == '')
		{
			showAlert('Debe ingresar apellido materno');
			return false;
		}		
		 	
		process(action,level);
		 
	}
	
	</script>
