 
	<br /><br />
	 {mensaje_resultado} 
	<br /><br /><br />
	<!-- START BLOCK : ingresar -->
		<button type="button"  onclick="javascript:sendNewLogin();" ><span>Continuar Registro</span></button>
		<script>
		function sendNewLogin()
		{
			document.main.login_nombre.value = '{email_persona_username}';
			document.main.login_clave.value  = '{email_persona_password}';
			document.main.login_checkcaptcha.value = 0;
			sendUserdata();
		}
		</script>
	<!-- END BLOCK : ingresar -->
	<!-- START BLOCK : registrar -->	
		<button  type="button"  onclick="javascript:ate_ir_form_registro();" />
		<span>Intentar Registro Nuevamente</span></button> 
	<!-- END BLOCK : registrar -->
 