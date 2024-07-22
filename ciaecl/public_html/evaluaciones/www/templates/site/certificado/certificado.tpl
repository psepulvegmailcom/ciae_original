

<input type="hidden" value="view_certificado"  name="opcion" />
<table width="95%" border="0" cellpadding="3">
  
  
<!-- START BLOCK : bloque_email_noexiste -->
<tr><td colspan="2">
<font style="font-size:110%; color:#FF0000; font-weight:bold">
El email <em>{email}</em> no se encuentra registrado en nuestra base de datos.<br />
Ingrese nuevamente el email a consultar. <br />Si asistió al congreso por favor comuníquese al email <a href="mailto:contacto@ciie2012.cl">contacto@ciie2012.cl</a> 
</font><br /><br />
</td></tr>

<!-- END BLOCK : bloque_email_noexiste -->

<!-- START BLOCK : bloque_email_sinasistencia -->
<tr><td colspan="2">

Estimado(a) <strong>{nombre}</strong><br /><br />
Su inscripción en el Congreso fue exitosa, pero no tenemos registro de su asistencia.<br />
Si asistió al congreso por favor comuníquese al email <a href="mailto:contacto@ciie2012.cl">contacto@ciie2012.cl</a>
</td></tr>

<!-- END BLOCK : bloque_email_sinasistencia -->
<!-- START BLOCK : bloque_email_conasistencia -->
<tr><td colspan="2">

Estimado(a) <strong>{nombre}</strong><br /><br />
Le agradecemos su participación en el Congreso.<br />
Puede descargar su certificado de asistencia <a href="docs/tmp/{archivo}" target="_blank">AQUÍ</a><br />

<br />

<br /> 
<small style="font-size:96%"> 
(*)&nbsp;&nbsp;Si hubiese algún error de tipeo en su nombre, comuníquese al email <a href="mailto:contacto@ciie2012.cl">contacto@ciie2012.cl</a><br />
(**)&nbsp;&nbsp;Si tiene problemas para visualizar el certificado, descárguelo en su computador, haga click con botón derecho sobre el link y seleccione la opción de guardar el archivo, luego seleccione la carpeta de su computador donde desea guardar el archivo<br />
(***)&nbsp;&nbsp;Para visualizar el certificado requiere tener instalado en su computador <a href="http://get.adobe.com/es/reader/?promoid=BUIGO" target="_blank">Adobe Reader</a> </small>
</td></tr>

<!-- END BLOCK : bloque_email_conasistencia -->
<!-- START BLOCK : bloque_consulta_email -->
<tr><td colspan="2">
<font style="  font-weight:bold">
Para obtener su certificado de participación en el Congreso, por favor ingrese su email para confirmar su asistencia.
</font>
</td></tr>

<!-- END BLOCK : bloque_consulta_email -->

<!-- START BLOCK : bloque_formulario_email -->
<tr>
    <td style=" width:30%"><strong>Email (*)</strong> </td>
    <td style="width:70%"> 
        <input type="text" name="email" style="width:60%" maxlength="255" value="{email}" onchange="javascript:consultarPorEmail();"> 
		
		<button type="button" name="submit_enviar"  value="submit_enviar" tabindex="28" onclick="javascript:consultarPorEmail();" id="submit-submit_enviar">
Consultar Email</button> 
		</td>
  </tr>
<!-- END BLOCK : bloque_formulario_email -->

  </table>
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="caso" value="consultar">
<script>
	function consultarPorEmail()
	{
		if(document.main.email.value == '')
		{
			alert('Debe ingresar email');
			document.main.email.focus();
			return false;
		}  
		document.main.page.value = document.main.opcion.value;
		document.main.submit();
	}
</script>