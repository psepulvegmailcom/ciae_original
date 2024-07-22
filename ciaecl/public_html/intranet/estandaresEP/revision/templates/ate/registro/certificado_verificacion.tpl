	
	<!-- START BLOCK : bloque_resultado -->
	
<div  class="fieldset_title" id='titulo_resultado_certificado' >{mensaje_chequeo}</div>
	<fieldset>
	<!-- <label> <big>{mensaje_chequeo}</big> </label><br /><br /> -->
	<label> <strong>Folio : </strong>&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{folio}<br /> 
	<label> <strong>C�digo Verificaci�n:   </strong>   </label>&nbsp; {codigo}<br />
	<!-- START BLOCK : bloque_resultado_datos -->
	<label> <strong>Fecha Emisi�n :</strong> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{fecha}<br /> 
	<label><strong> Fecha Caducidad :</strong> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{fecha_caducidad}<br /> 
	<label> <strong>Informaci�n Certificado :</strong> </label> <br />{texto}<br /><br />
	<center> <a href="download.php?caso=tmp&file={certificado_tmp}&nombre=certificadoATE"> Descargar Copia Certificado </a></center><br /> 
	
	<!-- END BLOCK : bloque_resultado_datos -->
	<!-- START BLOCK : bloque_resultado_datos_novigente -->
	<label><strong> Fecha Emisi�n :</strong> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{fecha}<br /> 
	<label><strong> Fecha Caducidad :</strong> </label> &nbsp;&nbsp;&nbsp;&nbsp; <font style="color:#E60F0F; font-weight:bold; font-size:110%"><B>{fecha_caducidad}</B> NO VIGENTE</font><br /> 

	<label> Informaci�n Certificado : </label> <br />{texto}<br /><br />  <br />  

	<font style="color:#E60F0F; font-weight:bold; font-size:130%; text-transform:uppercase">  La validaci�n y verificaci�n de este oferente no se encuentra vigente en este per�odo, vigencia anterior hasta <b>{fecha_caducidad}</b></font>
	<!-- END BLOCK : bloque_resultado_datos_novigente -->
	</fieldset>
	<!-- END BLOCK : bloque_resultado -->
<div  class="fieldset_title" id="titulo_formulario_certificado"  > Formulario Verificaci�n </div>
	<fieldset>
	<p>Ingrese el folio y c�digo de verificaci�n del certificado que desea revisar</p><br />
	<div>
		<label class="selecciona"> Folio </label><br  />
		<input type="text" name="folio" value="{folio}" />
		<span>(*)</span> 
	</div>  
	<div class="selecciona">
		<label>  C�digo </label><br  />
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
		showAlert('Debe ingresar c�digo de verificaci�n');
		document.main.codigo.focus();
		return false;
	}
	process('{opcion_valida}|chequeo',1);
}
</script>

 