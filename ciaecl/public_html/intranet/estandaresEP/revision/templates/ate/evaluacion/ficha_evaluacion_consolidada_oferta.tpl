

<div id='informacion_bloque_descarga'>
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/ficha_oferta_datos.tpl -->
 
 <br>
 <br>
 <table id="tabla_noborder_admin" style="width:95%">
 <tr>
 <th>Logro de objetivos/resultados </th> 
 
 <th>Si</th>
 
 <th>Parcialmente</th>
 <th>No</th>
 
 <th>Total Evaluaciones</th>
 </tr>
 <tr >
 <td><strong >Nivel de logro de los objetivos definidos en el contrato, seg&uacute;n directores.</strong></td> 
 <td style="text-align:center">{Objetivos_total}</td>
 <td style="text-align:center">{Objetivos_parcial}</td>
 <td style="text-align:center">{ObjetivosNoCumplidos_total}</td>
  <td style="text-align:center">{Total_totalDir}</td> 
 </tr>
 <tr>
 <td><strong>Nivel de logro de los objetivos definidos, según Sostenedores.</strong></td> 
 <td style="text-align:center">{ObjetivosSost_total}</td>
 <td style="text-align:center">{ObjetivosSost_parcial}</td>
 <td style="text-align:center">{ObjetivosNoCumplidosSost_total}</td>
  <td style="text-align:center">{TotalS_total}</td> 
 </tr>
 <tr>
 <td><strong>Nivel de logro de los resultados esperados, según directores.</strong></td> 
 <td style="text-align:center">{Resultados_total}</td>
 <td style="text-align:center">{Resultados_parcial}</td>
 <td style="text-align:center">{ResultadosNoCumplidos_total}</td>
  <td style="text-align:center">{Total_totalDir}</td> 
 </tr>
 <tr>
 <td><strong>Nivel de logro de los resultados definidos, según Sostenedores.</strong></td> 
 <td style="text-align:center">{ResultadosSost_total}</td>
 <td style="text-align:center">{ResultadosSost_parcial}</td>
 <td style="text-align:center">{ResultadosNoCumplidosSost_total}</td>
  <td style="text-align:center">{TotalS_total}</td> 
 </tr>
 </table>
 <br>
 <br>

<table id="tabla_noborder_admin"  style="width:500px">
<tr> 
	<th   colspan="7">Nivel de Satisfacción de usuarios con plazos, productos y equipo ATE.</th> 
</tr> 
<tr> 
	<th   colspan="2">Tipo</th> 
	<th    >Rojo</th> 
	<th    >Naranjo</th> 
	<th    >Amarillo</th> 
	<th    >Verde</th> 
	<th    >Total</th> 
</tr> 
<tr>  
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_est.tpl -->  
</tr> 
<tr>
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_sost.tpl -->  
</tr> 
</table>  


 <br>
 <br>

<table id="tabla_noborder_admin"  style="width:500px">
<tr> 
	<th   colspan="7">Calificación del servicio ATE según los directores, en consulta con los beneficiarios directos del servicio.</th> 
</tr> 
<tr>  
  <th>Calificaciones</th>
  <th>Muy bueno</th>
  <th>Bueno</th>
  <th>Regular</th>
  <th>Malo</th>
  <th>No Aplica</th>
  <th>Total Evaluaciones</th>
</tr> 
<tr> 
  <td style="text-align:center">Cantidades</td>
  <td style="text-align:center">{Calificacion_A1}</td>
  <td style="text-align:center">{Calificacion_A2}</td>
  <td style="text-align:center">{Calificacion_A3}</td>
  <td style="text-align:center">{Calificacion_A4}</td>
  <td style="text-align:center">{Calificacion_A5}</td>
  <td style="text-align:center"><strong>{Total_totalDir}</strong></td>
</tr> 
</table>  

</div>


