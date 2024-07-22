	<script language="javascript" src="libjs/md5.js">	</script>
	<script language="javascript" src="libjs/login.js">	</script>
	<h2 style="padding-bottom:3px">Ingreso Usuarios Registrados</h2>
	<div class="login"> 
				<font color='red' style="height:1px"><b>{mensaje_login_error}</b></font>
				<fieldset id="login_form" class="loginx" >

					<label style="padding-top:2px;">Nombre Usuario</label><br />
					<input type="text"   name="login_nombre" value=""  maxlength='50' style=" height:20px">

					<label style="padding-top:2px;">Clave</label><br />
					<input type="password"    name="login_clave"  maxlength='50'   style=" height:20px" >
			
					<!--<label style="padding-top:2px;">Código Seguridad</label><br />
					<input type="text"   name="login_captcha"  maxlength='5'  style="width:50px;height:20px"  >
					<img id="imgCaptcha" src="scripts/captcha.php" width="65px" />-->
					 
				 <button type="button" onClick="chequeoPass();"><span><big>Ingresar</big></span></button> 
				 	
				</fieldset>  
	    	
	<input type="hidden" name="login_username" value="">
	<input type="hidden" name="login_challenge" value="{challenge}">
	<input type="hidden" name="login_response"  value="">	
	<input type="hidden" name="login_password"  value="">	
	<input type="hidden" name="login_porlogin" value="1">
	<input type="hidden" name="login_checkcaptcha" value="0">
	</div>
	
	<!--  <a href="javascript:process('no_acceso',0);" class="faq"  >No puedo acceder a mi cuenta</a> 
	 <a href="javascript:process('crear_cuenta',0);" class="faq"  >Crear nueva cuenta</a>  -->