 
	<center> <button onclick="javascript:enviar_accion('ingresar','');" type="button" title="Ingresar Noticia"><span>Ingresar Nueva Noticia</span></button> </center><br />
	<table id="tabla_noborder_admin"    >
 
<tr> 
<th    style="text-align:left"> Noticia </th> 
<th  width="5%">  Publicar </th> 
<th  width="5%">   Destacada  </th> 
<th  width="5%">   Editar  </th> 
<th width="5%">   Eliminar   </th>
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 	<td  valign="top"  class="{class_color}" style=" border:0px;" > 
		<div style="padding-bottom: 5px;"><small>({fecha})</small><br /> <strong> {titulo}</strong> <br />
		<a href="javascript:showId('ver_noticia_{id_noticia}');hiddenId('ver_link_noticia_{id_noticia}');"  id='ver_link_noticia_{id_noticia}'><small>Ver Noticia</small></a></div>
				  
		 
	</td> 
 	<td   class="{class_color}" style="text-align:center; border:0px;"   > <img src="images/iconos/{publicar_no}publicar.gif" >	</td> 
 	<td   class="{class_color}" style="text-align:center; border:0px;"> 	 <img src="images/iconos/{popup_no}publicar.gif" >	</td> 
 	<td     class="{class_color}" style="text-align:center; border:0px;">  <a href="javascript:enviar_accion('modificar',{id_noticia});">
		 	 <img src="images/iconos/edit.gif" ></a>	 	  
	</td>  
 	<td    class="{class_color}" style="text-align:center; border:0px;">  <a href="javascript:enviar_accion('eliminar',{id_noticia});">
		 	 <img src="images/iconos/delete.gif" ></a>	</td>
</tr> 
 
<tr >
<td colspan="5" class="{class_color}" >
<div class="div_oculto"  style="  text-align:justify;" id='ver_noticia_{id_noticia}'>
<br />{aviso}		 <br /><br /><a href="javascript:hiddenId('ver_noticia_{id_noticia}');showId('ver_link_noticia_{id_noticia}');"><small>Ocultar Noticia</small></a></div>
		 </td></tr>

 <!-- END BLOCK : lista_item --> 
 </table>
 <input type="hidden" name="id_noticia" />
 <script>
 function enviar_accion(proceso,id)
 {
 	var accion = 'mant_noticias|'+proceso;
	document.main.id_noticia.value = id;
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