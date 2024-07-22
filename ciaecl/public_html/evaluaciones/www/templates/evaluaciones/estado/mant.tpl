 <!-- INCLUDE BLOCK : www/templates/evaluaciones/base_header_hidden.tpl -->
<table class="tabla_noborder_admin"    >
<tr>  
<th>Etapa</th> 
<th>Descripci&oacuten</th>  
<th>Estado</th> <!--
<th >   Estado Etapa </th>  -->
<th>Fecha Apertura</th> 
<th>Fecha Cierre</th> 
<th>¿Etapa Completada? </th>  
<th>Fecha &uacuteltimo env&iacuteo </th> 
<th>Opci&oacute;n </th> 
</tr>

 <!-- START BLOCK : bloque_lista_item -->
 <tr>
 <td valign="top"  class="{class_color}"  style=" text-align:center"><small>{fila}</small></td>
 <td valign="top"  class="{class_color}" ><strong> {nombre_etapa}</strong></td>
 <!--<td valign="top"  class="{class_color}"  style=" text-align:center">{orden}</td> -->
 <td valign="top"  class="{class_color}" >{estado_html}</td>
 <td valign="top"  class="{class_color}" >{fecha_inicio_html} </td>
 <td valign="top"  class="{class_color}" >{fecha_cierre_html} </td>
 <td valign="top"  class="{class_color}"  style=" text-align:center"><b>{estado_completo}</b></td> 
 <td valign="top"  class="{class_color}" >{fecha_cierre_completo_html} </td> 
 
 <td valign="top"  class="{class_color}"  style=" text-align:center">
 <script>
 if('{estado}' == 'activo' && '{estado_completo}' == 'no')
 {
 	document.write('<a href="?page=mant_{etapa}">Completar</a> ');
 }
 if('{estado}' == 'activo' && '{estado_completo}' == 'si')
 {
 	document.write('<a href="?page=mant_{etapa}">Ver Respuestas</a> ');
 }
 </script>
 
 </td> 
 </tr>
  <!-- END BLOCK : bloque_lista_item -->
</table>
<br />
<p><strong>Nota:</strong> <ul>

<li>Recuerde que debe completar cada una de las etapas de la actividad para acceder a la certificaci&oacute;n de &eacute;stas.</li>
<li>Los horarios de inicio y cierre de las etapas corresponden a la zona horaria de Chile Continental (GMT-4). Si se encuentra en otro país le recordamos chequear la diferencia de horario para que pueda completar correctamente las distintas etapas. Si tiene mayor dudas con la diferencia de horario le invitamos a consultar el siguiente link <a href="http://www.diferenciahoraria.info/24h/chile-y-otros-paises.htm" target="_blank">http://www.diferenciahoraria.info</a>.</li>
</ul>

</p>

