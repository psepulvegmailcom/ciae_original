 
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
		<div style="padding-bottom: 5px;"><small>({fecha_inicio_real})</small><br /> <strong> {titulo}</strong> 
		 
	</td> 
	<td class="{class_color}" style=" border:0px; text-align:center"><img src="cea/images/flags/{idioma}.jpg" style="padding:0"  border="0"/></td>
 	<td   class="{class_color}" style="text-align:center; border:0px;"   > <img src="cea/images/iconos/{publicar}publicar.gif" >	</td> 
 	<td   class="{class_color}" style="text-align:center; border:0px;"> 	 <img src="cea/images/iconos/{home}publicar.gif" >	</td> 
 	<td     class="{class_color}" style="text-align:center; border:0px;">  <a href="javascript:enviar_accion('modificar',{id_item});">
		 	 <img src="cea/images/iconos/edit.gif" ></a>	 	  
	</td>  
 	<td    class="{class_color}" style="text-align:center; border:0px;">  <a href="javascript:enviar_accion('eliminar',{id_item});">
		 	 <img src="cea/images/iconos/delete.gif" ></a>	</td>
</tr> 
  

 <!-- END BLOCK : lista_item --> 
 </table>
 <input type="hidden" name="id_item" />
 <script>
 function enviar_accion(proceso,id)
 {
 	var accion = 'mant_agenda|'+proceso;
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
 <br /> <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->