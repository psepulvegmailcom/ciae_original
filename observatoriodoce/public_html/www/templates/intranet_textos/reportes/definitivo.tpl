<table id='texto_tabla_reporte' cellpadding="0" cellspacing="0">
<tr>
<th>codigo</th>
<th>tipo_texto</th>
<th>id_tipo_texto</th>
<th>forma</th>
<th>folio</th>
<th>criterio_1</th>
<th>criterio_2</th>
<th>criterio_3</th>
<th>criterio_4</th>
<th>criterio_5_1</th>
<th>criterio_5_2</th>
<th>criterio_5_3</th>
<th>criterio_5_4</th>
<th>criterio_5_5</th>
<th>criterio_6</th> 
<th>Ver Imagen</th> 
<th>Url Imagen</th> 

</tr>

 <!-- START BLOCK : reporte_lista_item -->
<tr><td> {id_texto}</td>
<td>{id_tipo_texto}</td>
<td>{tipo}</td>
<td>{forma}</td>
<td>{folio}</td> 
<td>{criterio_1}</td>
<td>{criterio_2}</td>
<td>{criterio_3}</td>
<td>{criterio_4}</td>
<td>{criterio_5_1}</td>
<td>{criterio_5_2}</td>
<td>{criterio_5_3}</td>
<td>{criterio_5_4}</td>
<td>{criterio_5_5}</td>
<td>{criterio_6}</td>
<td><a href="javascript:verImagenBloqueGeneral('textos/revision/{id_texto}.jpg');">Ver texto</a> </td> 
<td><a href="{url}imageview.php?image=textos/revision/{id_texto}.jpg" target="_blank">{url}imageview.php?image=textos/revision/{id_texto}.jpg</a> </td> 

 
 <!-- END BLOCK : reporte_lista_item -->

 
</table>