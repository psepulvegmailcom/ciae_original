 
	<center> <button onclick="javascript:enviar_accion('ingresar','');" type="button" title="Ingresar Noticia"><span>Ingresar Nuevo Menú</span></button> </center><br />
	<table id="tabla_noborder_admin"  >
 
<tr> 
<th    style="text-align:left"> Menú </th> 
<th  width="5%">  Publicar </th>  
<th  width="5%">   Editar  </th> 
<th width="5%">   Eliminar   </th>
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 	<td  valign="top"  class="{class_color}"> 
		<div style="padding-bottom: 5px;">   <strong> {titulo}</strong>   <!--(Orden : {orden})-->
		 </div>
				   
	</td> 
 	<td   class="{class_color}" style="text-align:center"   > <img src="images/iconos/{publicar_no}publicar.gif" >	</td>  
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion('modificar',{id_item});">
		 	 <img src="images/iconos/edit.gif" ></a>	 	  
	</td>  
 	<td    class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion('eliminar',{id_item});">
		 	 <img src="images/iconos/delete.gif" ></a>	</td>
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 <input type="hidden" name="id_item" />
 <script>
 function enviar_accion(proceso,id)
 {
 	var accion = 'mantmenu|'+proceso;
	document.main.id_item.value = id;
 	if(proceso == 'eliminar')
	{
		if(confirm('Esta seguro que desea eliminar este elemento?'))
		{
			process(accion,0); 
		}
	}
	else
	{
		process(accion,0);
	}
 }
 </script>
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->