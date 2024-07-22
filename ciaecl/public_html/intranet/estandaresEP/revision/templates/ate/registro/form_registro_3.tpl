

{tpl_ayuda_file}
<div   class="fieldset_title">Situaci&oacute;n Financiera</div>

<fieldset>
	 
	<div>
	<label>Informe financiero emitido por DICOM</label> <br  />
	<font id='bloque_ate_documento_financiera_dicom_estado' class="edicion_enrevision"> </font><br>
	<input type="file"  class="inputfile" name="ate_financiero_archivo_financiera_dicom"     /> 
		<span>(*)</span><span>{ayuda_financiera_dicom}</span>
	 
		{documento_financiera_dicom}		
		<!-- INCLUDE BLOCK : ../templates/ate/general/file_ayuda_extension.tpl --> 

	</div> 	
	
</fieldset>
	<!-- <div   class="fieldset_title">Nivel de Facturaci&oacute;n</div>
	 <fieldset>
	 <div>
		 <label>Por favor seleccione opción real y fidedigna. Esta información tiene s&oacute;lo fines estad&iacute;sticos. Estos datos ser&aacute;n validados con Fuentes Oficiales</label><br />
		 <select name="id_nivel">
		 <!-- START BLOCK : bloque_nivel_sinfacturacion -->
		<option value="" selected >	Seleccione Nivel Facturaci&oacute;n</option>
		<!-- END BLOCK : bloque_nivel_sinfacturacion -->
		 <!-- START BLOCK : bloque_nivel_facturacion -->
		<option value="{bloque_nivel_facturacion_id}" {bloque_nivel_facturacion_selected} >
		{bloque_nivel_facturacion_nombre}</option>
		<!-- END BLOCK : bloque_nivel_facturacion -->
		 </select>
		<span>(*)</span>
		<span>{ayuda_financiera_nivel}</span>
	 </div>
</fieldset>
<div   class="fieldset_title"> 	Datos Bancarios</div>
	 <fieldset>
	 <div>
		 <label>Se debe seleccionar el nombre de un s&oacute;lo banco y se indica que es en esta entidad en la cual se depositar&aacute; el monto de la factura por los servicios ATE que se contraten</label><br />
		  <select name="id_banco">
		 <!-- START BLOCK : bloque_sinbanco -->
		<option value="" selected >	Seleccione Banco</option>
		<!-- END BLOCK : bloque_sinbanco -->
		 <!-- START BLOCK : bloque_banco -->
		<option value="{bloque_banco_id}" {bloque_banco_selected} >{bloque_banco_nombre}</option>
		<!-- END BLOCK : bloque_banco -->
		 </select> 
		<span>(*)</span>
		<span>{ayuda_financiera_bancario}</span>
	 </div>
	 <div>
		<label>Tipo de Cuenta</label><br />
		<select name="id_tipo_cuenta">
		<!-- START BLOCK : bloque_sintipo_cuenta -->
		<option value="" selected >	Seleccione Tipo de Cuenta</option>
		<!-- END BLOCK : bloque_sintipo_cuenta -->
		<!-- START BLOCK : bloque_tipo_cuenta -->
		<option value="{bloque_tipo_cuenta_id}" {bloque_tipo_cuenta_selected} >{bloque_tipo_cuenta_nombre}</option>
		<!-- END BLOCK : bloque_tipo_cuenta -->
		</select>
		<span>(*)</span>
	 </div>
	 <div>
		<label>N&uacute;mero de cuenta</label><br />
		<input name="numero_cuenta" value="{numero_cuenta}"  maxlength="150"/> <span>(*)</span>
	 </div>
	 </fieldset>-->
	 
	 	 
<script>	
function chequeoTipoDatos(action,level)
{
	if(document.main.caso_revision.value == 'registro')
		desbloquearFormularioDevuelto();
	chequeoTipoDatosCompleto(action,level);
	if(document.main.caso_revision.value == 'registro')
		bloquearFormularioDevuelto();			
}
function chequeoTipoDatosCompleto(action,level)
{
	var chequeo = true;  

	if(chequeo)
	{
		process(action,level);
	}
}
</script>