<table id="tabla_noborder">
<tr>
<th><small>Estados</small></th>
<!-- START BLOCK : bloque_estadistica_titulo --> 

<th><small>{tipo_oferente}</small></th>
<!-- END BLOCK : bloque_estadistica_titulo --> 
<th><small>Total</small></th>
</tr>

<!-- START BLOCK : bloque_estadistica --> 
<tr>
<th style="text-align: left"><small>{estado_nombre} <!-- {id_estado_nombre} --></small></th> 
<td style="text-align:center">{total_empresa}</td>
<td style="text-align:center">{total_persona}</td>
<td style="text-align:center">{total_universidad}</td>

<td style="text-align:center"><strong>{total}</strong></td>
</tr> 
<!-- END BLOCK : bloque_estadistica --> 

</table>

<br>

<ul>
<!-- START BLOCK : bloque_estadistica_descripcion --> 
<li  class="lista_principal"  style='padding-right:20px;'><strong>{estado} : </strong>{descripcion}</li>
<!-- END BLOCK : bloque_estadistica_descripcion --> 
</ul>