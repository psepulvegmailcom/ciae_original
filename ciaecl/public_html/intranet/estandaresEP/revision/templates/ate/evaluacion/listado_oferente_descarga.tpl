<strong> Resultado Búsqueda por oferente</strong><BR>
<strong>Fecha Descarga : </strong>{fecha_descarga}<br><br>

<table id="tabla_noborder_admin"  border="1" >
<tr>
	<th style=" width:3px" rowspan="2">Fila</th>
	<th rowspan="2">id oferente</th>
	<th style="text-align:left" rowspan="2" width="5%">Rut oferente</th> 
	<th style="text-align:left" rowspan="2" width="5%">Rut oferente sin formato</th> 
	<th style="text-align:left" rowspan="2" width="5%">DV oferente</th>
	<th style="text-align:left" rowspan="2"> Nombre </th> 
	<th   rowspan="2">Tipo </th>  
	<th   rowspan="2">Fecha Validación </th>  
	<th   colspan="14">Inscripción/Evaluación </th> 
</tr>
<tr> 
	<th  >Tipo   </th> 
	<th  >Total Inscripción  </th> 
	<th  >Evaluación Rojo  </th> 
	<th  >Evaluación Naranjo </th> 
	<th  >Evaluación Amarillo </th> 
	<th  >Evaluación Verde </th> 
	<th  >Evaluación Total </th> 
	<th  >Tipo   </th> 
	<th  >Total Inscripción  </th> 
	<th  >Evaluación Rojo  </th> 
	<th  >Evaluación Naranjo </th> 
	<th  >Evaluación Amarillo </th> 
	<th  >Evaluación Verde </th> 
	<th  >Evaluación Total </th> 
</tr>


<!-- START BLOCK : user_info --> 
<tr>
<td class="{fondo}"  style="text-align:left; ">{fila}</td>
<td class="{fondo}"  style="text-align:left; ">{id_oferente}</td>
<td class="{fondo}"   style="text-align:left">{rut_html}</td>
<td class="{fondo}"   style="text-align:left">{rut}</td>
<td class="{fondo}"   style="text-align:left">{dv}</td>
<td class="{fondo}"  >{nombre}</td>
<td class="{fondo}"   style="text-align:center">{tipo}</td> 
<td class="{fondo}"   style="text-align:center" id='info_fecha_oferente_{id_oferente}'> {fecha_real}</td> 

 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_est.tpl -->  
 


 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_sost.tpl --> 
</tr>
<!-- END BLOCK : user_info -->
</table> 

 