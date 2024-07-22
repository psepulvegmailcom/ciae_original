{tag_volver}

 <strong>{contact_firma}</strong><br />
	 
<fieldset>
<div>
<label>{titulo_nombre}</label><br /> 
<input type='text'  class='inputtext' name="nombre"     > (*)
</div>
<div>
<label>{titulo_direccion}</label><br /> 
<input type='text'  class='inputtext' name="direccion"   >
</div>
<div>
<label>{titulo_ciudad}</label><br /> 
<input type='text'  class='inputtext' name="ciudad"  >
</div>
<div>
<label>{titulo_pais}</label><br /> 
<input type='text'  class='inputtext' name="pais"  >
</div>
<div>
<label>{titulo_profesion}</label><br /> 
<input type='text'  class='inputtext' name="profesion"  >
</div>
<div>
<label>{titulo_actividad}</label><br /> 
<input type='text'  class='inputtext' name="actividad"  >
</div>
<div>
<label>{titulo_telefono}</label><br /> 
<input type='text'  class='inputtext' name="telefono"  >
</div>
<div>
<label>{titulo_fax}</label><br /> 
<input type='text'  class='inputtext' name="fax"  >
</div>
<div>
<label>{titulo_email}</label><br /> 
<input type='text'  class='inputtext' name="email"  > (*)
</div>
<div>
<label>{titulo_comentario}</label><br /> 
<textarea  class='inputtext' name="comentario"  style="  height:150px"></textarea>  (*)
</div>

<button onclick="javascript:enviarFormulario();" type="button" title="{titulo_enviar}"><span>{titulo_enviar}</span></button>  
</fieldset>
<script type="text/javascript">
	function enviarFormulario()
	{	  
		if(document.main.email.value == '' || !checkMail(document.main.email.value))
		{
			alert('{titulo_requiere_campo} {titulo_email}');
			document.main.email.focus();
			return false;
		} 
		if(document.main.nombre.value == '')
		{
			alert('{titulo_requiere_campo} {titulo_nombre}');
			document.main.nombre.focus();
			return false;
		}
		if(document.main.comentario.value == '')
		{
			alert('{titulo_requiere_campo} {titulo_comentario}');
			document.main.comentario.focus();
			return false;
		}
		process('enviar',1);
	}
</script>