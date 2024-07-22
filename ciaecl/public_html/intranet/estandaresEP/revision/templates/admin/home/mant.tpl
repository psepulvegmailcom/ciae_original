 
	<center> <button onclick="javascript:enviar_accion('ingresar','');" type="button" title="Ingresar Noticia"><span>Ingresar Nuevo Home</span></button> </center><br />
	<table id="tabla_noborder_admin">
 
<tr> 
<th    style="text-align:left">  Home</th> 
<th  width="25%"  style="text-align:center">   Tipo Usuario</th>  
<th  width="5%">   Editar  </th> 
<th width="5%">   Eliminar   </th>
</tr>
 <!-- START BLOCK : lista_item -->
<a name="ver_link_elemento_{id_permiso}" ></a>
 <tr > 
 	<td  valign="top"  class="{class_color}" style=" border:0px;" >  
		<div style="padding-bottom: 5px;">  <strong> {titulo}</strong> <br />
		<a href="javascript:showId('ver_elemento_{id_permiso}');hiddenId('ver_link_elemento_{id_permiso}');"  id='ver_link_elemento_{id_permiso}'><small>Ver Home</small></a></div>		 
	</td> 
 	<td  valign="top"  class="{class_color}" style=" border:0px; text-align:center"><small>{nombre_permiso}</small> </td> 	 
 	<td     class="{class_color}" style="text-align:center; border:0px;">  
	<a href="javascript:enviar_accion('modificar',{id_permiso});"> 	 <img src="images/iconos/edit.gif" ></a>	 	  
	</td>  
 	<td    class="{class_color}" style="text-align:center; border:0px;">
	  <a href="javascript:enviar_accion('eliminar',{id_permiso});">	 <img src="images/iconos/delete.gif" ></a>	</td>
</tr>  
<tr >
<td colspan="4" class="{class_color}" >
<div class="div_oculto"  style="  text-align:justify;" id='ver_elemento_{id_permiso}'>
<br />{texto}		 <br /><br /><a href="javascript:hiddenId('ver_elemento_{id_permiso}');showId('ver_link_elemento_{id_permiso}');gotoHref('ver_link_elemento_{id_permiso}');"><small>Ocultar Home</small></a></div>
		 </td></tr>
 <!-- END BLOCK : lista_item --> 
 </table>
 <input type="hidden" name="id_permiso" />
 <script>
 function enviar_accion(proceso,id)
 {
 	var accion = 'mant_home|'+proceso;
	document.main.id_permiso.value = id;
 	if(proceso == 'eliminar')
	{
		if(id == 0)
		{
			showAlert('El home por defecto no puede ser eliminado'); 
		}
		else
		{
			if(confirm('Esta seguro que desea eliminar este elemento?'))
			{
				process(accion,0); 
			}
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