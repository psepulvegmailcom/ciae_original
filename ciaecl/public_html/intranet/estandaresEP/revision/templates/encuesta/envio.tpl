
<!-- INCLUDE BLOCK : ../templates/encuesta/barra_superior.tpl -->

 El estado de su registro es el siguiente:<br />
 
 <table  style="width:95%; border:none;" border="0">
 
  <tr><td colspan="2" style="border:none;height:40px; vertical-align:bottom"> <strong>Simbología</strong> </td></tr>
 <tr><td style="border:none;">
 
 <img src="images/iconos/check.gif"   style="  margin-left:10px; margin-bottom:10px;  " width="25" height="25"/> </td><td style="border:none;"><small>Información Completa</small>
 </td></tr><td style="border:none;"><img src="images/iconos/message-warning.gif"   style="  margin-left:10px; margin-bottom:10px;  "  width="25" height="25"/></td><td style="border:none;"> <small>Información Incompleta o Pendiente</small></td></tr>
   <tr><td colspan="2"  style="border:none;height:40px; vertical-align:middle"> <strong>Atención: para poder enviar su registro debe ingresar todos los datos solicitados. Una vez que la información esté completa aparecerá la opción "Enviar Registro" en la parte inferior de esta sección.</strong></td></tr>
   <tr><td colspan="2" style="border:none;height:20px; vertical-align:bottom">  </td></tr>
   
   
	 <!-- START BLOCK : bloque_revision_item -->
	 <tr>
	 <td  class="revision_fila" width="10%"   style="border:none;text-align:center; vertical-align:top;"> 

		 <!-- START BLOCK : bloque_revision_item_ok --> 
		
		<img src="images/iconos/check.gif" 
		 <!-- END BLOCK : bloque_revision_item_ok -->
		 <!-- START BLOCK : bloque_revision_item_error --> 
		<img src="images/iconos/message-warning.gif"   
		 <!-- END BLOCK : bloque_revision_item_error -->
		  style="float:left; margin-left:10px; margin-bottom:10px;  "/>
	 </td><td  class="revision_fila" style="border:none;">
	 
		 {revision_item}
		<br /><small>{revision_item_msg}	  </small>
	</td> 
	 </tr>
	 <!-- END BLOCK : bloque_revision_item -->
	 
	 <!-- START BLOCK : bloque_revision_enviar_encuesta --> 
	 <tr>
	 <td colspan="2" style="text-align: center;border:none;"><input  type="button" onclick="javascript:enviarEncuesta();" value="Enviar Encuesta" style="height:60px"></td>
	 </tr>
   
	 <!-- END BLOCK : bloque_revision_enviar_encuesta --> 
   
   </table>

<script>
function enviarEncuesta()
{
	if(confirm('¿Esta seguro(a) de enviar su encuesta? Si la envia, no podrá editar sus respuestas'))
	
		process('guardar_encuesta',1);
}
</script>
<!-- INCLUDE BLOCK : ../templates/encuesta/barra_superior.tpl -->