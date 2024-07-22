<strong>Total Inscritos Actual:</strong> {total_inscritos}<br />

<table id="tabla_noborder_admin"  class="tabla_noborder_admin"   >
 
<tr> 

<th     >  </th> 
<th     > Fecha Inscripci&oacute;n  </th> 
<th     > Nombre </th> 
<th     > Apellidos </th> 
<!--<th     > Email </th> 
<th    > Confirmaci&oacute;n</th>  -->   
<th  >  Ver  </th> 
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 	<td    class="{class_color}"  > 		<small style="color: #666666"> {fila}  </small>	</td>  
  	<td    class="{class_color}"  > 	<div align="center">{fecha_html}	</div></td>   
 	<td    class="{class_color}"  > 		 {nombre}  	</td>  
	<td    class="{class_color}"  > 	{apellidos}</td>  
 	<!--<td    class="{class_color}"  > 		 <small>{email}</small>  	</td> 
 	<td    class="{class_color}"  style="text-transform:capitalize" > 		 {confirmacion}  	</td>    -->
	 
 	    
 	<td     class="{class_color}" style="text-align:center; ">  <a href="javascript:enviar_accion('modificar','{email}');"  style="border:none" >
		 	 <img src="www/images/iconos/edit.gif" border="0" ></a>	 	  
	</td>   
</tr> 
  

 <!-- END BLOCK : lista_item --> 
 </table>
 <input type="hidden" name="email" />
 <script type="text/javascript">
 function enviar_accion(proceso,id)
 {
 	var accion = '{opcion}|'+proceso;
	document.main.email.value = id; 
	process(accion,0);	 
 }
 </script>
 
 <!-- START BLOCK : item_lista_nohay -->
 <br /> <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->