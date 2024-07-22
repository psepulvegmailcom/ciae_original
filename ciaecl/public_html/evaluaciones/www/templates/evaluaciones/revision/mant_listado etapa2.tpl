<table  class="tabla_formulario">
<tr><th  style=" text-align:center ">Trabajos de compañeros para revisar y evaluar</th></tr>
<tr><td>
<table class="tabla_noborder_admin" >
<tr>  
<th></th>
<th>Trabajos</th>
</tr>

 <!-- START BLOCK : bloque_lista_item_pendiente -->
  
 <tr >  
 	<td valign="top"  class="{class_color}" style="text-align:center ">{fila}</td>
 	<td  valign="top"  class="{class_color}" style="text-align:center " >  
	 <a href="javascript:revisarEnvio('{id_evaluacion}','{id_etapa}','{username_revisado}');">Revisar y Evaluar</a></td> 
 </tr>
 <!-- END BLOCK : bloque_lista_item_pendiente -->
 </td></tr>
</table>

<br><br>
<tr><th  style=" text-align:center ">Trabajos revisados</th></tr>
<tr><td>


<table class="tabla_noborder_admin"  >
<tr>  
<th>Pregunta</th>  
<th>Nota</th> 
<th>Retroalimentación entregada</th>
<th>Fecha</th>
</tr>

 <!-- START BLOCK : bloque_lista_todas_retroalimentaciones_realizadas -->
  
 <tr >  
 	
 	<td  valign="top"  class="{class_color}" style="text-align:center" >{orden}</td> 
 	<td  valign="top"  class="{class_color}" style="text-align:center"  >{nota}</td>
 	<td  valign="top"  class="{class_color}" style="text-align:center"  >{texto}</td>
	<td  valign="top"  class="{class_color}" style="text-align:center"  >{fecha_envio_html}</td>
 	</tr>
 <!-- END BLOCK : bloque_lista_todas_retroalimentaciones_realizadas -->
</table>

</td></tr>
</table>



<!-- INCLUDE BLOCK : www/templates/evaluaciones/envio/evaluacion_final_general.tpl -->