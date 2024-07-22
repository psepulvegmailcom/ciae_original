<table id="tabla_noborder_admin"  class="tabla_noborder_admin"   >
 
<tr> 
<th     > Fecha   </th> 
<th    > Nombre </th> 
<th    > Email </th>  
<th>Estado</th>
<th  >  Revisar  </th> 
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
  	<td    class="{class_color}"  > 	<div align="center">{fecha_html}	</div></td>   
 	<td    class="{class_color}"  > 		 {nombre}  	</td>  
 	<td    class="{class_color}"  > 		 {email}  	</td>  
 	<td    class="{class_color}"  > 		 {pendiente}  	</td>  
	 
 	    
 	<td     class="{class_color}" style="text-align:center; ">  <a href="javascript:enviar_accion('modificar',{id_consulta});"  style="border:none" >
		 	 <img src="www/images/iconos/edit.gif" border="0" ></a>	 	  
	</td>   
</tr> 
  

 <!-- END BLOCK : lista_item --> 
 </table>
 <input type="hidden" name="id_consulta" />
 <script type="text/javascript">
 function enviar_accion(proceso,id)
 {
 	var accion = '{opcion}|'+proceso;
	document.main.id_consulta.value = id; 
	process(accion,0);	 
 }
 </script>
 
 <!-- START BLOCK : item_lista_nohay -->
 <br /> <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->