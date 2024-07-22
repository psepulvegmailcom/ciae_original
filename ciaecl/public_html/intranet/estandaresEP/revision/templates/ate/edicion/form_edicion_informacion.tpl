<div style="text-align:center; padding-top:30px; padding-bottom:30px;">
	<button onclick="process('1',1);" type="button" title="Actualizar Información"><span>Actualizar Información</span></button>
</div>

<strong>Estimado oferente:</strong><br><br>
  Con el fin de mantener el Registro de asistencia t&eacute;cnica educativa en  permanente actualizaci&oacute;n y brindar la oportunidad a los oferentes validados de  modificar aspectos de su postulaci&oacute;n, se ha dispuesto la modificaci&oacute;n de datos  ya ingresados y la incorporaci&oacute;n de nuevos antecedentes. <br>
  A continuaci&oacute;n se entrega en forma detallada un listado con los datos que  podr&aacute; modificar en su formulario. Les solicitamos leer con atenci&oacute;n la  informaci&oacute;n que se entrega, puesto que no todos los datos son modificables y  muchos de ellos pasar&aacute;n nuevamente por los procesos de verificaci&oacute;n y validaci&oacute;n.<br><br>
 

<ol>
<!-- START BLOCK : bloque_edicion_persona -->
	<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_informacion_persona.tpl -->
<!-- END BLOCK : bloque_edicion_persona -->
<!-- START BLOCK : bloque_edicion_empresa -->
	<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_informacion_empresa.tpl -->
<!-- END BLOCK : bloque_edicion_empresa -->
<!-- START BLOCK : bloque_edicion_universidad -->
	<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_informacion_universidad.tpl -->
<!-- END BLOCK : bloque_edicion_universidad -->


<li>
	<a href="javascript:showId('bloque_NOTA'); ">Importante a tener en cuenta</a></li>
   
<div id='bloque_NOTA'>
	 <ul>
	 <li  class="lista_principal">Los datos de identificación como: rut y nombre completos son inmodificables. Sin embargo, en caso de ser legalmente necesario, podrá solicitar a la Mesa de Ayuda el cambio de estos datos. </li>
	 
	 <li  class="lista_principal">Las ofertas pueden ser editadas y eliminadas. Sin embargo, el sistema no le permitir&aacute; eliminar el 100% de ellas, y tendr&aacute; que dejar al menos una por &aacute;rea seleccionada. De lo contrario se mantendr&aacute;n las ofertas originales.</li>
<li  class="lista_principal"> Las experiencias ya ingresadas no son modificables y tampoco pueden ser eliminadas.</li></ul>
 <a href="javascript:hiddenId('bloque_NOTA');">Cerrar </a>
</div>
</ol>
  
<script>
	hiddenId('bloque_IM'); 
	hiddenId('bloque_MA'); 	
	hiddenId('bloque_MRA');
	hiddenId('bloque_MRN');  
	hiddenId('bloque_NOTA');  
	 </script>
 