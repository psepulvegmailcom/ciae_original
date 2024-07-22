 <!-- INCLUDE BLOCK : www/templates/evaluaciones/base_header.tpl -->

 <!-- INCLUDE BLOCK : www/templates/evaluaciones/revision/titulo.tpl -->

 
<!-- START BLOCK : bloque_evaluacion_anterior -->
<!-- INCLUDE BLOCK : www/templates/evaluaciones/envio/form_envio_evaluacion.tpl -->
<!-- END BLOCK : bloque_evaluacion_anterior -->
 

 <!-- START BLOCK : bloque_evaluacion_envio_archivo -->
 <!-- INCLUDE BLOCK : www/templates/evaluaciones/envio/form_simple.tpl -->
  <!-- END BLOCK : bloque_evaluacion_envio_archivo -->
 
<!-- START BLOCK : bloque_no_mas_nuevo_trabajo -->


<div style="padding:10px">
<small>Ya complet&oacute; esta etapa. Podrá modificar su entrega hasta <em>{fecha_cierre}</em>.<br>
Para modificar, elimine su entrega y luego vuelva a completar el formulario.
</small>

</div>
 
<!-- END BLOCK : bloque_no_mas_nuevo_trabajo -->

 <script>
	function guardarDetalleFormulario()
	{
		if(trim(document.main.archivo.value) == '')
		{
			showAlert('Debe seleccionar un archivo para ingresar');
			return false;
		}
		if(trim(document.main.id_tipo_envio.value) == '')
		{
			alert('Debe seleccionar tipo de envio');
			return false;
		}  		
		return true;
	}
 
 	function eliminarArchivo(id_envio)
	{
		if(confirm("Esta seguro de eliminar archivo?"))
		{
			document.main.id_envio.value = id_envio;
			irOpcionFormulario('|eliminar');
		}
	}
 </script>
 <!-- INCLUDE BLOCK : www/templates/evaluaciones/revision/mant_cierre.tpl -->
  <!-- INCLUDE BLOCK : www/templates/evaluaciones/base_footer.tpl -->