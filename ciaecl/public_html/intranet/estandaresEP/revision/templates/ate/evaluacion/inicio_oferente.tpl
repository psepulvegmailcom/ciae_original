<!-- START BLOCK : search_info -->
<strong>Buscar por</strong> Rut : <input type="text" name="buscar_rut" value=""  onchange="document.main.pagina_sistema.value = 1" style="width:100px" title="sólo rut, sin punto, guión  ni dígito verificador"/>  
<strong>o por</strong> <small style=" font-size:8px;">Razón Social&nbsp;/&nbsp;Nombre</small> : <input type="text" name="buscar_nombre" value=""  onchange="document.main.pagina_sistema.value = 1"  style="width:150px"  />
<!-- END BLOCK : search_info -->

{paginamiento_orden}
{paginamiento}
 
 
<script>var info_porrevisar='';</script>
<table id="tabla_noborder_admin"  >
<tr>
	<th style=" width:3px"></th>
	<th style="text-align:left" width="5%">Rut</th>
	
	<th style="text-align:left"> Nombre </th>
	
	<th width="15%">Tipo </th>  
	<th width="15%">Fecha Validación </th>  
	<th width="10%" colspan="7">Inscripción/Evaluación </th>
	<th width="5%"  > Revisar&nbsp; </th> 
</tr>


<!-- START BLOCK : user_info -->
<script> info_porrevisar =  '{id_oferente}'+'-'+info_porrevisar;</script>
<tr>
<td class="{fondo}" rowspan="2" style="text-align:left; color: #999999; font-size:9px;"><small>{fila}</small></td>
<td class="{fondo}"  rowspan="2" style="text-align:left"><small>{rut_html}</small></td>
<td class="{fondo}" rowspan="2" ><small>{nombre}</small></td>
<td class="{fondo}"  rowspan="2" style="text-align:center"><small  id='info_tipo_oferente_{id_oferente}'>{tipo}</small></td> 
<td class="{fondo}"  rowspan="2" style="text-align:center" id='info_fecha_oferente_{id_oferente}'><small class="{fecha_real_clase_old}" >{fecha_real}</small></td> 

 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_est.tpl --> 
<td class="{fondo}" rowspan="2"  style="text-align:center"> <a href="javascript:verUser('{id_oferente}','{option_revision}');"> 
<img src="images/iconos/edit.gif" > </a>  
</td>  
</tr>
<tr>


 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/semaforo_fila_sost.tpl --> 
</tr>
<!-- END BLOCK : user_info -->
</table>
 

<!-- START BLOCK : info_no_data -->
<br /> <center>No se registran elementos</center><br />
<!-- END BLOCK : info_no_data -->




{paginamiento} 


 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/descarga.tpl -->
<script>

document.main.caso_revision.value = '{caso_revision}';


function verUser(id_oferente)
{  
	document.main.id_oferente.value 		= id_oferente;
	document.main.buscar_id_oferente.value 	= id_oferente; 
	document.main.buscar_id_oferta.value	= 0;
	process('ficha',2); 
} 
</script>