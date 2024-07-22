<!-- START BLOCK : bloque_revisiones_hay -->

 Las revisiones anteriores arrojaron los siguientes resultados:<br />  
 <!-- START BLOCK : bloque_revisiones -->
	<br /><br /> <strong><u> {revision_caso} {fecha_inicio} </u></strong><br /> <a href="javascript:showId('revision_anterior_{revision_item}');" id='ver_revision_anterior'>(Ver Detalle Revisión)</a>
		<div id='revision_anterior_{revision_item}'  class="div_oculto" style="border: #666666 groove 1px; padding:5px 20px 5px 5px; ">
		<span class="span_modificacion"  style="margin-left:15px;" >Fecha Inicio Revisión:</span> <small>{fecha_inicio}</small><br /> 
 	<span class="span_modificacion"  style="margin-left:15px;" >Fecha Cierre Revisión:</span> <small>{fecha_cierre}</small> <br />
 	<span class="span_modificacion"  style="margin-left:15px;" >Tipo Revisión:</span> <small>{revision_caso}</small> <br />
	<!-- START BLOCK : bloque_revisiones_interno -->
	<span class="span_modificacion"  style="margin-left:15px;" >Estado Revisión :</span> <small>{estado}</small> <br />
	<span class="span_modificacion"  style="margin-left:15px;" >Usuario Revisor :</span> <small>{username_revisor}</small> <br />
	<span class="span_modificacion"  style="margin-left:15px;" >Usuario Supervisor :</span> <small>{username_supervisor}</small> <br />
	 <span class="span_modificacion" style="margin-left:15px;" >Comentarios Internos :</span> <div style="margin-left:25px; "><small>{mensaje_interno}</small></div>
	 <!-- END BLOCK : bloque_revisiones_interno -->	
 	<span class="span_modificacion" style="margin-left:15px;"  >Comentarios para Oferente :</span> <div style="margin-left:25px;"> <small>{mensaje_oferente}</small></div>   <br />	
	<a href="javascript:hiddenId('revision_anterior_{revision_item}');"  id='ocultar_revision_anterior'>Ocultar Detalle Revisión</a> </div><br />
 <!-- END BLOCK : bloque_revisiones -->
 <!-- END BLOCK : bloque_revisiones_hay -->
 
 <!-- START BLOCK : bloque_revisiones_no_hay -->
 	No se registran revisiones previas
 <!-- END BLOCK : bloque_revisiones_no_hay -->