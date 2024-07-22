 
	  
	<fieldset>
	
				 <!-- START BLOCK : bloque_reporte_base -->
	<div>
	<label>Tipo de oferente</label><br />
	<select name='reporte_tipooferente'>
		<option value="">Tipo de Oferente </option>
		<option value="postulando">Oferentes Postulantes</option>
		<option value="validados">Oferentes Validados</option>
		<option value="en_revision">Oferentes En revisión</option>
		<option value="no_activos">Oferentes No Activos</option>
	</select>
	</div>
		<div>
		<label class="selecciona"> Valores a exportar </label><br  /> 
				 <!-- START BLOCK : bloque_reporte_valores_checked -->
			<input type="checkbox" value="{id}" name="valores_reporte[]"  checked="checked"  />{valor}<br />
		<!-- END BLOCK : bloque_reporte_valores_checked -->		  
		<br />
		<input  type="checkbox" name="selectAll" onclick="javascript:checkInputAll('valores_reporte[]');document.main.selectAll.checked=true;document.main.unselectAll.checked=false;" /> Seleccionar Todo | 		<input type="checkbox"  name="unselectAll" onclick="javascript:uncheckInputAll('valores_reporte[]');document.main.selectAll.checked=false;document.main.unselectAll.checked=true;" /> Deseleccionar Todo 
		<br />
			<br /> <label class="selecciona">Cobertura</label><br  /> <input type="radio" value="" name="valores_reporte_especial"  checked="checked"   />Sin Cobertura<br />
		 <!-- START BLOCK : bloque_reporte_valores -->
			<input type="radio" value="{id}" name="valores_reporte_especial" onclick="showAlert('Recuerde que esta selección puede tomar más tiempo de lo esperado dependiendo de la combinación de variables y tipo de oferente');"    />{valor}<br />
		<!-- END BLOCK : bloque_reporte_valores -->		  
	</div>  
	<!-- END BLOCK : bloque_reporte_base -->
	<!-- START BLOCK : bloque_reporte_revisores -->
		<div>
	<label>Fecha Inicio Consulta</label><br />
	<input type="text" name="fecha_inicio" value='{fecha_inicio}' style="width:150px;" /> (Formato : dd-mm-aaaa hh:mm:ss)	
	</div><div>
	<label>Fecha Cierre Consulta</label><br />
	<input type="text" name="fecha_cierre" value='{fecha_cierre}' style="width:150px;"  /> (Formato : dd-mm-aaaa hh:mm:ss)	
	</div>
	<div>
	<label>Tipo Revisión</label><br />
	<select name="tipo_revision">
	<option value="verificacion">Verificación</option>
	<option value="validacion">Validación</option>
	<option value="ambos">Verificación y Validación</option>
	</select>
	</div>
	<!-- END BLOCK : bloque_reporte_revisores -->
	 <button onclick="javascript:enviarFormulario()" type="button" title="Generar Reporte"><span>Generar Reporte</span></button> 
 
	
	
	<!-- START BLOCK : bloque_reporte_resultado --> 
	<div style="text-align:center; padding:15px;"><a href='download.php?caso=tmp&file={archivo}&nombre=reporte_{archivo}' target="_blank">Bajar Archivo Excel</a>&nbsp;&nbsp;&nbsp;
	<a href='download.php?caso=tmp&file={archivohtml}&nombre=reporte_{archivohtml}' target="_blank">Bajar Archivo Html</a>
	</div>
<div style=" overflow:scroll;    height:420px; width:670px">
 
	
				{tabla_resultado}
</div>
	<!-- END BLOCK : bloque_reporte_resultado -->
		</fieldset>
	<script>
	function enviarFormulario()
	{
		var enviar = true;
		if(document.main.reporte_tipooferente)
		{
			if(document.main.reporte_tipooferente.value == '')
			{
				showAlert('Debe seleccionar tipo de oferente');
				document.main.reporte_tipooferente.focus();
				enviar = false;
			}
		}
		if(document.main.fecha_inicio)
		{
			if(document.main.fecha_inicio.value == '' || document.main.fecha_cierre.value == '')
			{
				showAlert('Debe ingresar ambas fechas');
				document.main.fecha_inicio.focus();
				enviar = false;
			}
		}
		if(enviar)
		{
			process('generar',1);
		}
	}	
	<!-- START BLOCK : bloque_reporte_resultado_error -->
	showAlert('Debe seleccionar al menos un valor a mostrar como resultado');
	<!-- END BLOCK : bloque_reporte_resultado_error -->
	</script>