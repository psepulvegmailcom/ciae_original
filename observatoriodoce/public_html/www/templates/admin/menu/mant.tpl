 
	<center> 
	
	<input type="button" class="buttontype" onclick="javascript:enviar_accion('ingresar','');" title="Ingresar Elemento" value="Ingresar Nuevo Elemento" />
	 </center><br />
	<table id="tabla_noborder_admin"  >
 
<tr> 
<th    style="text-align:left"> Men&Uacute; </th> 
<!--<th  width="2%">Idioma </th>  -->
<th  width="2%">Opcion </th>  
<th  width="2%">Tipo </th>  
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
	<!--<td class="{class_color}"><img src="cea/images/flags/{menu_lang}.jpg" style="padding:0"  border="0"/></td>
	-->
 	<td  valign="top"  class="{class_color}">   {opcion} 	</td> 
 	<td  valign="top"  class="{class_color}">   {tipo} 	</td> 
 	<td   class="{class_color}" style="text-align:center"   > <img src="cea/images/iconos/{publicar_no}publicar.gif" >	</td>  
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion('modificar',{id_item});">
		 	 <img src="cea/images/iconos/edit.gif" border="0"></a>	 	  
	</td>  
 	<td    class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion('eliminar',{id_item});">
		 	 <img src="cea/images/iconos/delete.gif"border="0" ></a>	</td>
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
  
 <script type="text/javascript">
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