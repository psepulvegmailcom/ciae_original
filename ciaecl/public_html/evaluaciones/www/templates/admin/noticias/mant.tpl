 
	<center>  
	<input type="button" class="buttontype" onclick="javascript:enviar_accion('ingresar','');" title="Ingresar Elemento" value="Ingresar Nuevo Elemento" />
	 </center><br />
	<table id="tabla_noborder_admin"    >
 
<tr> 
<th    style="text-align:left"> Noticia </th> 
<th  width="5%">  Idioma </th> 
<th  width="5%">  Publicar </th> 
<th  width="5%">   Home  </th> 
<th  width="5%">   Editar  </th> 
<th width="5%">   Eliminar   </th>
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 	<td  valign="top"  class="{class_color}" style=" border:0px;" > 
		<div style="padding-bottom: 5px;"><small>({fecha})</small><br /> <strong> {titulo}</strong> 
		 
	</td> 
	<td class="{class_color}" style=" border:0px; text-align:center"><img src="cea/images/flags/{elem_lang}.jpg" style="padding:0"  border="0"/></td>
 	<td   class="{class_color}" style="text-align:center; border:0px;"   > <img src="cea/images/iconos/{publicar_no}publicar.gif" border="0"  >	</td> 
 	<td   class="{class_color}" style="text-align:center; border:0px;"> 	 <img src="cea/images/iconos/{popup_no}publicar.gif" border="0" >	</td> 
 	<td     class="{class_color}" style="text-align:center; border:0px;">  <a href="javascript:enviar_accion('modificar',{id_noticia});"  style="border:none" >
		 	 <img src="cea/images/iconos/edit.gif" border="0" ></a>	 	  
	</td>  
 	<td    class="{class_color}" style="text-align:center; border:0px;">  <a href="javascript:enviar_accion('eliminar',{id_noticia});">
		 	 <img src="cea/images/iconos/delete.gif" border="0"  ></a>	</td>
</tr> 
  

 <!-- END BLOCK : lista_item --> 
 </table>
 <input type="hidden" name="id_noticia" />
 <script>
 function enviar_accion(proceso,id)
 {
 	var accion = 'mantnews|'+proceso;
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