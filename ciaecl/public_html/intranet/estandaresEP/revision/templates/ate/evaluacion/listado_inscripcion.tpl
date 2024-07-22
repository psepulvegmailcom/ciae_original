
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/listado_inscripcion_resultado.tpl --> 
 
 
  <div style="text-align:right">
  <a href="javascript:limpiarPaginamientoProcess('evaluacion|inscripcion');">&laquo; Realizar otra búsqueda
  </a></div>
{paginamiento}
 
 
<script>var info_porrevisar='';</script>
<table id="tabla_noborder_admin"  >
<tr>
	<th style=" width:3px"></th>
	<th  >Oferta </th>  
	<th  >Área  </th> 
	<th style="text-align:left" width="5%">Rut</th>
	
	<th style="text-align:left"> Nombre </th>
	
	<th  width="5%" 	  >Tipo </th>  
	<th width="10%" colspan="7">Inscripción/Evaluación </th>
	<th width="2%"  > Revisar&nbsp; </th> 
</tr>


<!-- START BLOCK : bloque_evaluacion_ofertas -->
<script> info_porrevisar =  '{id_oferente}'+'-'+info_porrevisar;</script>
<tr>
<td class="{fondo}" rowspan="2" style="text-align:left; color: #999999; font-size:9px;"><small>{fila_html}</small></td>
<td class="{fondo}" rowspan="2"  style="text-align:left"><small>{oferta_nombre}</small></td>
<td class="{fondo}" rowspan="2"  style="text-align:left"><small>{oferta_area}</small></td>
 
<td class="{fondo}"  rowspan="2" style="text-align:left"><small>{rut_html}</small></td>
<td class="{fondo}" rowspan="2" ><small>{nombre}</small></td>
<td class="{fondo}"  rowspan="2" style="text-align:center"><small  id='info_tipo_oferente_{id_oferente}'>{tipo}</small></td> 



 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_est.tpl --> 
<td class="{fondo}"  rowspan="2" style="text-align:center"> <a href="javascript:verDetalleOferta('{id_oferente}','{id_oferta}');"> 
<img src="images/iconos/edit.gif" > </a> 
</td>  
</tr> 
<tr>
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_sost.tpl -->  
</tr>
<!-- END BLOCK : bloque_evaluacion_ofertas -->
</table> 

<!-- START BLOCK : bloque_evaluacion_ofertas_no_data -->
<br /> <center>No se registran elementos con estos filtros</center><br />
<!-- END BLOCK : bloque_evaluacion_ofertas_no_data -->  
{paginamiento} 
<br>
  <div style="text-align:right">
  <a href="javascript:limpiarPaginamientoProcess('evaluacion|inscripcion');">&laquo; Realizar otra búsqueda
  </a></div>

 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/descarga.tpl -->
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/descarga_boton.tpl --> 
<script>
function verDetalleOferta(id_oferente,id_oferta)
{
	document.main.buscar_id_oferta.value  	= id_oferta;
	document.main.buscar_id_oferente.value 	= id_oferente; 
	document.main.id_oferente.value 		= id_oferente; 
	process('ficha',2);
}

document.main.caso_revision.value = '{caso_revision}';
 
</script>