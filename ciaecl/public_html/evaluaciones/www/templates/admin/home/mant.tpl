 
	<center> <button onclick="javascript:enviar_accion('ingresar','');" type="button" title="Ingresar Noticia"><span>Ingresar Nuevo Home</span></button> </center><br />
	<table id="tabla_noborder_admin"    >
 
<tr> 
<th    style="text-align:left">  Home</th> 
<th  width="15%">   Tipo Usuario</th>  
<th  width="5%">   Editar  </th> 
<th width="5%">   Eliminar   </th>
</tr>
 <!-- START BLOCK : lista_item -->
 
 <tr > 
 	<td  valign="top"  class="{class_color}" style=" border:0px;" > 
		<div style="padding-bottom: 5px;">  <strong> {titulo}</strong> <br />
		<a href="javascript:showId('ver_elemento_{id_permiso}');hiddenId('ver_link_elemento_{id_permiso}');"  id='ver_link_elemento_{id_noticia}'><small>Ver Home</small></a></div>
				  
		 
	</td> 
 	<td  valign="top"  class="{class_color}" style=" border:0px;" >{nombre_permiso} </td>
 	 
 	<td     class="{class_color}" style="text-align:center; border:0px;">  
	<a href="javascript:enviar_accion('modificar',{id_noticia});"> 	 <img src="cea/images/iconos/edit.gif" ></a>	 	  
	</td>  
 	<td    class="{class_color}" style="text-align:center; border:0px;">
	  <a href="javascript:enviar_accion('eliminar',{id_noticia});">	 <img src="cea/images/iconos/delete.gif" ></a>	</td>
</tr> 
 
<tr >
<td colspan="3" class="{class_color}" >
<div class="div_oculto"  style="  text-align:justify;" id='ver_noticia_{id_noticia}'>
<br />{aviso}		 <br /><br /><a href="javascript:hiddenId('ver_noticia_{id_noticia}');showId('ver_link_noticia_{id_noticia}');"><small>Ocultar Home</small></a></div>
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
 <br /> <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->