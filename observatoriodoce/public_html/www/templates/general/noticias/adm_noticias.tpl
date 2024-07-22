<table width="100%">
<tr>
<td colspan="5">
<strong>Idioma :</strong> <select name="filtro_idioma" style="width:100px">
		<option   value="">Todos</option>
		<option  value="es">Espa&ntilde;ol</option>
		<option   value="en">Ingl&eacute;s</option></select>
&nbsp;&nbsp;
<strong>Per&iacute;odo :</strong> <select name="filtro_periodo"  style="width:120px">
<option   value="{ultimo_agno}">&Uacute;ltimos 4 meses</option> 
<!-- START BLOCK : filtro_periodo_bloque -->
<option   value="{agno}">{agno_simple}</option> 
<!-- END BLOCK : filtro_periodo_bloque --> 
</select>
&nbsp;&nbsp; <strong>Sitio :</strong> <select name="filtro_sitio" style="width:100px">
		<option   value="all">Todos</option>
		<option  value="cmm">Solo CMM</option>
		<option   value="dim">Solo DIM</option>
		<option   value="intranet">Solo Intranet</option></select>
&nbsp;&nbsp; <input type="button"  class='button' onclick="javascript: process('listado',1)"  value="Filtrar" style="width:100px" />
</td>
</tr>
<tr>
<td colspan="5" >&nbsp;</td></tr>
<tr>
<td class='Form' >&nbsp;</td>
<td class='Form' ><strong><big>Noticia</big></strong></td> 
<td class='Form'  align="center"><strong><big>Editar</big></strong></td>
<td class='Form'  align="center"><strong><big>Ver</big></strong></td>
<td class='Form' align="center" ><strong><big>Eliminar</big></strong></td>
</tr>
 <!-- START BLOCK : noticia_lista -->
 <tr class='Form'>
	 <td  class='Form' valign="top" width="80">
		<img src="scripts/imageview.php?image={img_noticia}&case=img_news" width="70"  />
	 </td>
 	<td class='Form' valign="top" width="80%"> 
		<div style="padding-bottom: 5px;"><strong> {titulo}</strong> </div>
				 <em>{resumen}</em><br />({fecha}) 
		 
	</td> 
 	<td class='Form'  valign="middle" align="center" style="padding:13px 1px 13px 1px">
		 <input type="button"  class='button' onclick="javascript:document.main.id_noticia.value = {id_noticia};process('modificar',1)"  value="Editar"  />
	</td> 
 	<td class='Form' valign="middle"   align="center" style="padding:13px 1px 13px 1px">
		 <input type="button"  class='button' onclick="javascript:document.main.id_noticia.value = {id_noticia};process('ver',1)"  value="Ver"   />
	</td> 
 	<td class='Form' valign="middle"   align="center" style="padding:13px 1px 13px 1px">
		 <input type="button" onclick="javascript:sendEliminar({id_noticia});"   class='button'   value="Eliminar"/>
	</td>
</tr>
 <!-- END BLOCK : noticia_lista --> 
 </table>
 <input type="hidden" name="id_noticia" />
 <script type="text/javascript">
 function sendEliminar(id)
 {
 	if(confirm('Esta seguro que desea eliminar esta noticia?'))
	{
		document.main.id_noticia.value = id;
		process('listado|eliminar',1); 
	}
 }
 </script>
 
 <!-- START BLOCK : noticia_lista_nohay -->
 <div style="text-align:center">No hay noticias disponibles</div>
 <!-- END BLOCK : noticia_lista_nohay -->