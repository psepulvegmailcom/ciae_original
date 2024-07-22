<!-- INCLUDE BLOCK : www/templates/site/cartas/header.tpl -->
   
<p>Se registr&oacute; una nueva Solictud de viajes y vi&aacute;ticos.</p>


<p><strong>Solicitante:</strong> {nombre} {apellido_paterno}   </p>
 
<p><strong>Beneficiario:</strong> {form_nombre} {form_apellido_paterno} {form_apellido_materno} ({form_email}) </p> 
<p><strong>N&deg; de solictud:</strong> {id_solicitud}</p>

<!-- START BLOCK : bloque_envio_tramo -->
<p><strong>Tramo {tramo}</strong></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Fecha partida:</strong> {fecha_inicio}<br>
&nbsp;&nbsp;&nbsp;&nbsp;<strong>Fecha regreso:</strong> {fecha_fin}<br>
&nbsp;&nbsp;&nbsp;&nbsp;<strong>Origen:</strong> {origen}<br>
&nbsp;&nbsp;&nbsp;&nbsp;<strong>Destino:</strong> {destino}</p>
<!-- END BLOCK : bloque_envio_tramo --> 
<!-- START BLOCK : bloque_envio_responsable -->
<p><strong>Esta solicitud requiere su gesti&oacute;n.</strong></p>  

<!-- INCLUDE BLOCK : www/templates/site/admin/cartas/mensaje_revision_solicitudes.tpl --> 

<!-- END BLOCK : bloque_envio_responsable -->
<!-- START BLOCK : bloque_envio_solicitante -->
<p>Su solicitud ser&aacute; gestionada por el &aacute;rea de administraci&oacute;n. Recuerde que el estado de solicitud podr&aacute; revisarlo en sistema de intranet.</p>
<!-- END BLOCK : bloque_envio_solicitante -->

  

<!-- INCLUDE BLOCK : www/templates/site/cartas/footer.tpl -->       
 