
<p> 
En esta secci&oacute;n podr&aacute; ingresar a la administraci&oacute;n de las  actualizaciones de los oferentes con postulaciones  validadas. En la columna "Actualizaciones por revisar" podr&aacute; visualizar  las cantidades de &iacute;temes por revisar para cada uno de los oferentes. <br>
Para ingresar a la revis&oacute;n particular de cada ofereter haga click en el  icono <img src="images/iconos/edit.gif" > y podr&aacute; revisar cada uno de los elementos pendientes.</p>
 
  <br> <br>

  <!-- START BLOCK : search_info -->
  <strong>Buscar por</strong> Rut : 
  <input type="text" name="buscar_rut" value=""  onchange="document.main.pagina_sistema.value = 1" style="width:100px" title="sólo rut, sin punto, guión  ni dígito verificador"/> 
</p>
<button onclick="javascript:process('',1);" type="button" title="Ingresar Noticia"><span>Filtrar</span></button>
<!-- END BLOCK : search_info -->

{paginamiento_orden}
{paginamiento}
 
 
<table id="tabla_noborder_admin"  >
<tr>
	<th style=" width:3px"></th>
	<th style="text-align:left" width="5%">Rut</th>
	
	<th style="text-align:left"> Nombre </th>
	
	<th width="10%">Tipo </th>  
	<th  width="10%">Fecha Actualización</th> 
	<th width="20%"> Actualizaciones Por Revisar </th>  
	<th width="5%"  > Revisar&nbsp; </th> </tr>

<script>var info_porrevisar='';</script>

<!-- START BLOCK : user_info -->
<script> info_porrevisar =  '{id_oferente}'+'-'+info_porrevisar;</script>
<tr>
<td class="{fondo}" style="text-align:left; color: #999999; font-size:9px;"><small>{fila}</small></td>
<td class="{fondo}" style="text-align:left"><small>{rut}</small></td>
<td class="{fondo}"><small>{nombre}</small></td>
<td class="{fondo}" style="text-align:center"><small>{tipo}</small></td>
<td class="{fondo}" style="text-align:center"><small>{fecha_real}</small></td> 
<td class="{fondo}" style="text-align:left"><small>Variables Generales : {total_variables}<br>
Experiencias : {total_experiencias}<br>
Ofertas : {total_ofertas}<br>
Cobertura : {total_cobertura}<br> 
Documentos : {total_documentos}<br> 
<span id='solo_instituciones_{id_oferente}'>Capital Humano : {total_capital}<br>
Sedes : {total_sedes} </span>
 </small></td> 
 
 <script>
 if('{id_tipo}' == 'persona')
 {
 	hiddenId('solo_instituciones_{id_oferente}');
 }
 </script>

<td class="{fondo}" style="text-align:center"> <a href="javascript:verUser('{id_oferente}');"> 
<img src="images/iconos/edit.gif" > </a>
  
</td> 


</tr>
<!-- END BLOCK : user_info -->
</table>
 

<!-- START BLOCK : info_no_data -->
<br /> <center>No se registran elementos</center><br />
<!-- END BLOCK : info_no_data -->


{paginamiento} 
<script>
document.main.caso_revision.value = '{caso_revision}';
 

function verUser(id_oferente)
{  
	document.main.caso_revision.value 	= 'edicion';
	document.main.id_oferente.value 	= id_oferente;
	process('verficha',1);
	 
} 
</script>