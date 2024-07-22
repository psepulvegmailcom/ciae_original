{paginamiento_orden}
{paginamiento}
 <div  class="fieldset_title" >Mis Revisiones</div>
 
 <div  class="fieldset_title" >Revisiones Pendientes</div>
 
<table id="tabla_noborder_admin" >
<tr>
	<th style=" width:3px"></th>
	<th style="text-align:left">Rut</th>
	<th style="text-align:left"> Nombre </th>
	<th width="15%">Tipo </th>  <th width="15%"> {campo_alternativo} </th><th width="5%"> Revisar </th> </tr>


<!-- START BLOCK : user_info -->
<tr>
<td class="{fondo}" style="text-align:left; color: #999999; font-size:7px;"><small>{fila}</small></td>
<td class="{fondo}" style="text-align:left"><small>{rut}</small></td><td class="{fondo}"><small>{nombre}</small></td><td class="{fondo}" style="text-align:center"><small>{tipo}</small></td> <td class="{fondo}" style="text-align:center"><small>{fecha_registro}</small></td> <td class="{fondo}" style="text-align:center"><a href="javascript:verificarUser('{id_oferente}');"><img src="images/iconos/edit.gif" ></a></td> </tr>
<!-- END BLOCK : user_info -->
</table>
{paginamiento} 
<script>
document.main.caso_revision.value = '{caso_revision}';
function verificarUser(id_oferente)
{
	document.main.id_oferente.value = id_oferente;
	process('{caso_revision}',1);
} 
</script>