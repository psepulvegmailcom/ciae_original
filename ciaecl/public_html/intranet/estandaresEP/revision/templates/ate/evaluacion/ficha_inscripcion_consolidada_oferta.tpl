
<div id='informacion_bloque_descarga'>
 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/ficha_oferta_datos.tpl -->
 <div  class="fieldset_title_separador" id='ficha_evaluacion_datos_general'><strong>Inscripción</strong></div>
 

<div class="fieldset_title_interno">Total sostenedores inscritos</div>
{total_registros}
<br>

<div class="fieldset_title_interno">Total escuelas inscritas </div>
{total_escuelas}
<br> 
<br>

<table id="tabla_noborder_admin"  style=" max-width:800px">
<tr>
<th>     Costo total registros</th>
<th>Costo total Recursos SEP</th>
<th>Costo total Recursos Subvención Regular</th>
<th>Costo total Recursos Donación Privada</th>
<th>Costo total Recursos Otros Proyectos</th> 
<th>Costo estimado mensual por escuela del Servicio ATE contratado</th>
	 </tr>
	 <tr><td style="text-align:center">
${total_cos_total}
</td>
             <td style="text-align:center">
${total_cos_rec_sep}
</td>
             <td style="text-align:center">
${total_cos_sub_reg}
</td>
             <td style="text-align:center">
${total_cos_don_pri}
</td>
             <td style="text-align:center">
$ {total_cos_otro}
</td><td style="text-align:center">${costo_servicio}</td>
             </tr></table>