 El estado de su registro es el siguiente:<br />
 
 <table  style="width:95%" border="0">
 
  <tr><td colspan="2" style="height:40px; vertical-align:bottom"> <strong>Simbología</strong> </td></tr>
 <tr><td>
 
 <img src="images/iconos/check.gif"   style="  margin-left:10px; margin-bottom:10px;  " width="25" height="25"/> </td><td><small>Información Completa</small>
 </td></tr><td><img src="images/iconos/message-warning.gif"   style="  margin-left:10px; margin-bottom:10px;  "  width="25" height="25"/></td><td> <small>Información Incompleta o Pendiente</small></td></tr>
   <tr><td colspan="2"  style="height:20px;"> <strong>Atención: para poder enviar su registro debe ingresar todos los datos solicitados. Una vez que la información esté completa aparecerá la opción "Enviar Registro" en la parte inferior de esta sección.</strong></td></tr>
   <tr><td colspan="2" style="height:20px; vertical-align:bottom">  </td></tr>

 
 
 <!-- START BLOCK : bloque_revision -->
	 <!-- START BLOCK : bloque_revision_paso -->
	 <tr>
	 <td colspan="2"  class="revision_fila"  style="margin:30px 0px 30px 5px;"> 
	 <strong>{revision_paso}</strong> &nbsp;&nbsp;&nbsp;&nbsp;
	  
	 <button onclick="javascript:ate_registro_paso('{revision_paso_boton}',0);" type="button" title="Ir Formulario respectivo"><span>Ir Formulario </span></button> 
	</td>
	 </tr>
	 <!-- END BLOCK : bloque_revision_paso -->
	 <!-- START BLOCK : bloque_revision_item -->
	 <tr>
	 <td  class="revision_fila" width="10%"   style="text-align:center; vertical-align:top;"> 

		 <!-- START BLOCK : bloque_revision_item_ok --> 
		
		<img src="images/iconos/check.gif" 
		 <!-- END BLOCK : bloque_revision_item_ok -->
		 <!-- START BLOCK : bloque_revision_item_error --> 
		<img src="images/iconos/message-warning.gif"   
		 <!-- END BLOCK : bloque_revision_item_error -->
		  style="float:left; margin-left:10px; margin-bottom:10px;  "/>
	 </td><td  class="revision_fila">
	 
		 {revision_item}
		<br /><small>{revision_item_msg}	  </small>
	</td> 
	 </tr>
	 <!-- END BLOCK : bloque_revision_item -->
 <!-- END BLOCK : bloque_revision -->
 

 </table> 
 
	<!-- START BLOCK : bloque_revision_boton_envio --> 
		<br /> <br />
		<center>
			<button onclick="javascript:enviarRegistro();" type="button"><span>Enviar Registro</span></button>
		</center>
	<!-- END BLOCK : bloque_revision_boton_envio --> 
<input type="hidden" name="guardar_caso" value="" /> 
<script>
function enviarRegistro(){
	if(confirm('¿Esta seguro de haber ingresado todo sus datos y desea enviar su registro?'))
	{
		chequeoTipoDatos('registro_revision',0);
	}
}
</script>