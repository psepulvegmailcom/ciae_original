  
  <!-- START BLOCK : item_lista_descarga_completa -->
	 <div style="text-align:center; padding:10px; ">
	  <a href="downloadtmp.php?file={archivo_tmp}" target="_blank">Descargar Listado de Envios </a>
	 </div>
	 
 <!-- END BLOCK : item_lista_descarga_completa -->
 <!-- START BLOCK : item_lista_descarga -->
	 <div style="text-align:center; padding:10px; ">
	  <a href="downloadtmp.php?file={archivo_tmp}" target="_blank">Descargar Listado de Evaluaciones </a>
	 </div>
	 
 <!-- END BLOCK : item_lista_descarga -->
 <!-- START BLOCK : item_lista_descarga_no_definitivo -->
	 <div style="text-align:center; padding:10px; ">
	  <a href="downloadtmp.php?file={archivo_tmp}" target="_blank">Descargar Listado de Últimas Evaluaciones No Definitivas </a>
	 </div>
	 
 <!-- END BLOCK : item_lista_descarga_no_definitivo -->
 <!-- START BLOCK : item_lista_descarga_completa_full -->
	 <div style="text-align:center; padding:10px; ">
	  <a href="downloadtmp.php?file={archivo_tmp}" target="_blank">Descargar Listado de Evaluaciones Completas </a>
	 </div>
	 
 <!-- END BLOCK : item_lista_descarga_completa_full -->

	<table id="tabla_noborder_admin"  class="tabla_noborder_admin"   >
 
<tr> 
<th     > ID   </th> 
<th   style="width:45%"  > Título trabajo </th> 
<th    > Autor </th>  
<th    > Área</th>  
 
<th  style="width:30px">  Estado   </th>

<th   >  N° revisiones   </th>
<th  style="width:30px">  Estado Decisión Final   </th>
<th  >  Revisar  </th> 
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
  	<td    class="{class_color}"  > 	<div align="center">{id_envio}	</div></td>  
  	<td    class="{class_color}"  > 	{titulo}	</td>  
 	<td    class="{class_color}"  > 		 {apellidos}, {nombre}  	</td>  
	
  	<td    class="{class_color}" style="text-align:center"  > 	{area}	</td>  
 	   
 	<td   class="{class_color}" style="text-align:center;text-transform:capitalize;  "   > {estado} </td>
 	<td   class="{class_color}" style="text-align:center;  "   > {revisiones} </td>
 	<td   class="{class_color}" style="text-align:center; text-transform:capitalize; "   > {estado_decision} </td>
 	<td     class="{class_color}" style="text-align:center; ">  <a href="javascript:enviar_accion('modificar',{id_envio});"  style="border:none" >
		 	 <img src="www/images/iconos/edit.gif" border="0" ></a>	 	  
	</td>   
</tr> 
  

 <!-- END BLOCK : lista_item --> 
 </table>
 <input type="hidden" name="id_envio" />
 <script>
 function enviar_accion(proceso,id)
 {
 	var accion = '{opcion}|'+proceso;
	document.main.id_envio.value = id;
 	if(proceso == 'eliminar')
	{
		if(confirm('Esta seguro que desea eliminar este elemento?'))
		{
			process(accion,1); 
		}
	}
	else
	{
		process(accion,0);
	}
 }
 </script>
 
 <!-- START BLOCK : item_lista_nohay -->
 <br /> <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->