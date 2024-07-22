<table  class="tabla_formulario">
<tr>
<tr><td>

<table class="tabla_noborder_admin" >
<tr>  
<th  style=" text-align:center ">Retroalimentaciones recibidas:</th></tr>
<tr><td>


<table class="tabla_noborder_admin"  >

<tr>  
<td style=" text-align:center "><strong>Pregunta</strong></td>  
<td style=" text-align:center "><strong>Nota</strong></td> 
<td style=" text-align:center "><strong>Retroalimentación</strong></td>
<td style=" text-align:center "><strong>Fecha retroalimentación</strong></td>
</tr>

 <!-- START BLOCK : bloque_lista_todas_retroalimentaciones -->
  
 <tr >  
 	<td  valign="top"  class="{class_color}" style="text-align:center" >{orden}</td> 
 	<td  valign="top"  class="{class_color}" style="text-align:center"  >{nota}</td>
 	<td  valign="top"  class="{class_color}" style="text-align:left"  >{texto}</td>
	<td  valign="top"  class="{class_color}" style="text-align:center"  >{fecha_envio_html}</td>
 	</tr>
 <!-- END BLOCK : bloque_lista_todas_retroalimentaciones -->
</table>

<br><br><br><br>

 <!-- START BLOCK : bloque_lista_item_pendiente -->
  
 <tr ><th  style=" text-align:center ">Evaluar retroalimentaciones recibidas:</th>

</tr>
<br><br>
<tr>
 	<td style=" text-align:center ">  
	 <a href="javascript:revisarEnvio('{id_evaluacion}','{id_etapa}','{username_revisado}');">Evaluar Revisor {fila}</a></td>
 </tr>
 <!-- END BLOCK : bloque_lista_item_pendiente -->
 
</table>


</td></tr>
</table>



<!-- INCLUDE BLOCK : www/templates/evaluaciones/envio/evaluacion_final_general.tpl -->