 
  
	
	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>
<th  style="text-align:left">  Folio  </th>
<th  style="text-align:left">  Tipo  </th> 
<th  style="text-align:left">  Criterio  </th>
<th  style="text-align:left">  Evaluaci&oacute;n 1  </th>
<th  style="text-align:left">  Evaluaci&oacute;n 2  </th>  
<th  style="text-align:left">  Correcci&oacute;n  </th>  
   
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:left; color: #999999; font-size:7px;"><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}">    <strong> {id_texto}</strong>   	</td>  
 	<td  valign="top"  class="{class_color}">     {id_tipo_texto}   	</td>  
 	<td  valign="top"  class="{class_color}">     {criterio}    	</td>  
 	<td  valign="top"  class="{class_color}">      {evaluacion_1}    	</td>  
 	<td  valign="top"  class="{class_color}">    {evaluacion_2}    	</td> 
 	<td  valign="top"  class="{class_color}">     <select name="nivel[{id_texto}][{criterio}]" onChange="javascript:guardarNivel('{id_texto}','{criterio}');"><option value="">--</option><option value="1">Nivel 1</option><option value="2">Nivel 2</option><option value="3">Nivel 3</option><option value="4">Nivel 4</option></select>  	</td>   
 	 	 	  
	</td>  
 	 
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	 
  
 
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->
 <input type="hidden" name="id_texto">
 <input type="hidden" name="criterio">
 
 <script>
 function guardarNivel(id_texto,criterio)
 {
 	if(confirm('\u00BFEst\u00E1 seguro de guardar el nivel?'))
	{
		document.main.id_texto.value = id_texto;
		document.main.criterio.value = criterio; 
		process('{opcion_modulo}|guardar|',0);	 
 	}
 }
 </script>