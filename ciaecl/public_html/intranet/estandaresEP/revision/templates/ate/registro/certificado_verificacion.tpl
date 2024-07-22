	
	<!-- START BLOCK : bloque_resultado -->
	
<div  class="fieldset_title" id='titulo_resultado_certificado' >{mensaje_chequeo}</div>
	<fieldset>
	<!-- <label> <big>{mensaje_chequeo}</big> </label><br /><br /> -->
	<label> <strong>Folio : </strong>&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{folio}<br /> 
	<label> <strong>Código Verificación:   </strong>   </label>&nbsp; {codigo}<br />
	<!-- START BLOCK : bloque_resultado_datos -->
	<label> <strong>Fecha Emisión :</strong> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{fecha}<br /> 
	<label><strong> Fecha Caducidad :</strong> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{fecha_caducidad}<br /> 
	<label> <strong>Información Certificado :</strong> </label> <br />{texto}<br /><br />
	<center> <a href="download.php?caso=tmp&file={certificado_tmp}&nombre=certificadoATE"> Descargar Copia Certificado </a></center><br /> 
	
	<!-- END BLOCK : bloque_resultado_datos -->
	<!-- START BLOCK : bloque_resultado_datos_novigente -->
	<label><strong> Fecha Emisión :</strong> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{fecha}<br /> 
	<label><strong> Fecha Caducidad :</strong> </label> &nbsp;&nbsp;&nbsp;&nbsp; <font style="color:#E60F0F; font-weight:bold; font-size:110%"><B>{fecha_caducidad}</B> NO VIGENTE</font><br /> 

	<label> Información Certificado : </label> <br />{texto}<br /><br />  <br />  

	<font style="color:#E60F0F; font-weight:bold; font-size:130%; text-transform:uppercase">  La validación y verificación de este oferente no se encuentra vigente en este período, vigencia anterior hasta <b>{fecha_caducidad}</b></font>
	<!-- END BLOCK : bloque_resultado_datos_novigente -->
	</fieldset>
	<!-- END BLOCK : bloque_resultado -->
<div  class="fieldset_title" id="titulo_formulario_certificado"  > Formulario Verificación </div>
	<fieldset>
	<p>Ingrese el folio y código de verificación del certificado que desea revisar</p><br />
	<div>
		<label class="selecciona"> Folio </label><br  />
		<input type="text" name="folio" value="{folio}" />
		<span>(*)</span> 
	</div>  
	<div class="selecciona">
		<label>  Código </label><br  />
		<input type="text" name="codigo" value="{codigo}" />
		<span>(*)</span> 
	</div>  
	<br />
	<!-- END BLOCK : bloque_botton -->
		<button onclick="javascript:revisarCertificado();" type="button" title="Verificar Validez de Certificado"><span>Verificar Datos</span></button> 	
	<!-- END BLOCK : bloque_botton -->
	<!-- END BLOCK : bloque_botton_simple -->
		<input type="button" onclick="javascript:revisarCertificado();"   style="width:auto; height:auto;" title="Verificar Validez de Certificado" value="Verificar Datos "> 	
	<!-- END BLOCK : bloque_botton_simple -->
	</fieldset>

<script>
function revisarCertificado()
{
	if(document.main.folio.value == '')
	{
		showAlert('Debe ingresar folio');
		document.main.folio.focus();
		return false;
	}
	if(document.main.codigo.value == '')
	{
		showAlert('Debe ingresar código de verificación');
		document.main.codigo.focus();
		return false;
	}
	process('{opcion_valida}|chequeo',1);
}
</script>

 