 
<fieldset>  
<table  id="tabla_noborder_admin" style="width:680px">
<tr>
<th>Id</th><th  >Oferta</th><th>�rea</th><th>Sub�rea</th><th colspan="7" >Inscripci�n/Evaluaci�n</th><th >Resoluci�n</th> <th width="5%">Evaluaci�n</th><th >Inscripci�n</th
</tr>

<!-- START BLOCK : bloque_evaluacion_listado_ofertas -->
<tr><td class='{fondo}' colspan="14" style="border:none"><a name="detalle_oferta_{id_oferta}"></a></td></tr>

<tr   >
<td class='{fondo}' rowspan="2" >{id_oferta}</td>
<td class='{fondo}' rowspan="2"  >{oferta_nombre}</td>
<td class='{fondo}'  rowspan="2" >{oferta_area}</td>
<td class='{fondo}'  rowspan="2" >{oferta_subarea}</td>

 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_est.tpl --> 
<td class='{fondo}' rowspan="2" style="text-align:center" ><a href="javascript:verResolucionOferta('{id_oferta}');">Ver detalle</a></td>
<td class='{fondo}' rowspan="2" style="text-align:center" >
<a href="javascript:verEvaluacionConsolidadaOferta('{id_oferta}');">Ver detalle consolidado</a><br><br><a href="javascript:verEvaluacionOferta('{id_oferta}');">Ver detalle</a></td>
<td class='{fondo}' rowspan="2" style=" text-align:center" >
<a href="javascript:verInscripcionConsolidadaOferta('{id_oferta}');">Ver detalle consolidado</a><br><br>
<a href="javascript:verInscripcionOferta('{id_oferta}');">Ver detalle</a></td>
</tr>
<tr  >  
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_sost.tpl --> 
</tr>
<!-- END BLOCK : bloque_evaluacion_listado_ofertas -->
</table> 
 
</fieldset>