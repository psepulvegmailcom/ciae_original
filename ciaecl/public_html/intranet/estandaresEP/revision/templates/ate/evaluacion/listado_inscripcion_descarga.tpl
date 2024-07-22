
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/listado_inscripcion_resultado.tpl --> 
  
<table id="tabla_noborder_admin"  >
<tr>
	<th rowspan="2" style=" width:3px">Fila</th>
	<th rowspan="2" style=" width:3px">id_oferta</th>
	<th rowspan="2" >Oferta </th>  
	<th rowspan="2" >Área  </th> 
	
	<th rowspan="2">id oferente</th>
	<th style="text-align:left" rowspan="2" width="5%">Rut oferente</th> 
	<th style="text-align:left" rowspan="2" width="5%">Rut oferente sin formato</th> 
	<th style="text-align:left" rowspan="2" width="5%">DV oferente</th> 
	
	<th style="text-align:left" rowspan="2"> Nombre </th>
	
	<th  width="5%" rowspan="2"	  >Tipo </th>  
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


<!-- START BLOCK : bloque_evaluacion_ofertas --> 
<tr>
<td class="{fondo}"  style="text-align:left;  ">{fila_html}</td>
<td class="{fondo}"  style="text-align:left;  ">{id_oferta}</td>
<td class="{fondo}"   style="text-align:left">{oferta_nombre}</td>
<td class="{fondo}"   style="text-align:left">{oferta_area}</td>
 
<td class="{fondo}"  style="text-align:left; ">{id_oferente}</td>
<td class="{fondo}"   style="text-align:left">{rut_html}</td>
<td class="{fondo}"   style="text-align:left">{rut}</td>
<td class="{fondo}"   style="text-align:left">{dv}</td>
<td class="{fondo}"  >{nombre}</td>
<td class="{fondo}"   style="text-align:center">{tipo}</td> 



 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_est.tpl --> 
  
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_sost.tpl -->  
</tr>
<!-- END BLOCK : bloque_evaluacion_ofertas -->
</table> 

  