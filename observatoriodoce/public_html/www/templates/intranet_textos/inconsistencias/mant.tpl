 
  
	
	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>
<th  style="text-align:left">  Texto  </th>
<th  style="text-align:left">  Tipo  </th> 
<th  style="text-align:left">  Criterio  </th> 
<th  style="text-align:left">  Inconsistencias  </th>  
<th  style="text-align:left">  Correcci&oacute;n Definitiva  </th>
<th style="text-align:left">   Imagen </th>
   
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:left; color: #999999; "><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}">    <strong> {id_texto}</strong>   	</td>  
 	<td  valign="top"  class="{class_color}">     {id_tipo_texto}   	</td>  
 	<td  valign="top"  class="{class_color}">     {criterio}    	</td>  
 	<td  valign="top"  class="{class_color}">      
	
 <!-- START BLOCK : lista_item_correcto_valor -->
 <strong>{username}</strong> : {valor_criterio}<br>
  <!-- END BLOCK : lista_item_correcto_valor -->
	
	   	</td>   
 	<td  valign="top"  class="{class_color}">  
		<select name="nivel[{id_texto}][{id_tipo_texto}][{criterio}]" onChange="javascript:guardarNivel('{id_texto}','{id_tipo_texto}','{criterio}');">
		<option value="">--</option>
		<!-- START BLOCK : lista_item_criterio_numerico -->
	   <option value="1">Nivel 1</option><option value="2">Nivel 2</option><option value="3">Nivel 3</option><option value="4">Nivel 4</option>   
		<!-- END BLOCK : lista_item_criterio_numerico -->
		
		<!-- START BLOCK : lista_item_criterio_textual -->
	   <option value="si">Utiliza</option><option value="no">No Utiliza</option>    
		<!-- END BLOCK : lista_item_criterio_textual -->
		
		</select>
			</td>   
 	 	 	  
	</td>  
	<td  class="{class_color}"><a href="javascript:verImagenBloqueGeneral('textos/revision/{id_texto}.jpg');" ><img src="www/images/iconos/Search.gif" border="0" ></a></td>
 	 
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	 
  
 
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->
 <input type="hidden" name="id_texto">
 <input type="hidden" name="id_tipo_texto">
 <input type="hidden" name="criterio">
 
 <script>
 function guardarNivel(id_texto,id_tipo_texto,criterio)
 {
 	if(confirm('\u00BFEst\u00E1 seguro de guardar el nivel?'))
	{
		document.main.id_texto.value = id_texto;
		document.main.id_item.value = id_texto;
		document.main.id_tipo_texto.value = id_tipo_texto;
		document.main.criterio.value = criterio; 
		process('{opcion_modulo}|guardar|',0);	 
 	}
 }
 </script>