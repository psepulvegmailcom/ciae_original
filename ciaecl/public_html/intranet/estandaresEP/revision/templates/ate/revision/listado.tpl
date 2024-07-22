<!-- START BLOCK : search_info -->
<strong>Buscar por</strong> Rut : <input type="text" name="buscar_rut" value=""  onchange="document.main.pagina_sistema.value = 1" style="width:100px" title="sólo rut, sin punto, guión  ni dígito verificador"/>  
<strong>o por</strong> <small style=" font-size:8px;">Razón Social&nbsp;/&nbsp;Nombre&nbsp;/&nbsp;Email&nbsp;/&nbsp;Username</small> : <input type="text" name="buscar_nombre" value=""  onchange="document.main.pagina_sistema.value = 1"  style="width:150px"  />
<!-- END BLOCK : search_info -->

{paginamiento_orden}
{paginamiento}
 
 
<table id="tabla_noborder_admin"  >
<tr>
	<th style=" width:3px"></th>
	<th style="text-align:left" width="5%">Rut</th>
	
	<th style="text-align:left"> Nombre </th>
	
	<th width="10%">Tipo </th>  
	<th  width="10%">Estado</th> 
	<th width="10%"> {campo_alternativo} </th>
	<th width="5%"><div id='titulo_info_alternativo'>{usuario_titulo}</div> </th> 
	<th width="5%"  > Revisar&nbsp; </th> </tr>

<script>var info_porrevisar='';</script>

<!-- START BLOCK : user_info -->
<script> info_porrevisar =  '{id_oferente}'+'-'+info_porrevisar;</script>
<tr>
<td class="{fondo}" style="text-align:left; color: #999999; font-size:9px;"><small>{fila}</small></td>
<td class="{fondo}" style="text-align:left"><small>{rut}</small></td>
<td class="{fondo}"><small>{nombre}</small></td>
<td class="{fondo}" style="text-align:center"><small  id='info_tipo_oferente_{id_oferente}'>{tipo}</small></td>
<td class="{fondo}" style="text-align:center; " ><small id='info_estado_oferente_{id_oferente}'>{estado}</small></td> 
<td class="{fondo}" style="text-align:center" id='info_fecha_oferente_{id_oferente}'><small class="{fecha_real_clase_old}" >{fecha_real}</small></td> 
<td class="{fondo}" style="text-align:center"><small> <div  id='info_oferente_{id_oferente}'  >{usuario}</div>
 <div  id='info_oferente_porrevisar_{id_oferente}' style="font-size:9px; text-align:left;"></div></small></td>
 


<td class="{fondo}" style="text-align:center"> <a href="javascript:verificarUser('{id_oferente}','{option_revision}');"> 
<img src="images/iconos/edit.gif" > </a>
 
<!-- START BLOCK : user_info_postular -->
 <a href="javascript:verUser('{id_oferente}');"><img src="images/iconos/Search.gif"  width="24" height="24"></a>
<!-- END BLOCK : user_info_postular -->
</td> 


</tr>
<!-- END BLOCK : user_info -->
</table>

<script>
<!-- START BLOCK : info_porrevisar -->
ate_obtenerInformaciónOferentePorRevisar(info_porrevisar,0); 
<!-- END BLOCK : info_porrevisar --> 
<!-- START BLOCK : info_enrevision -->
ate_cambiarOferenteRevisor(info_porrevisar);
<!-- END BLOCK : info_enrevision -->
<!-- START BLOCK : info_revisionestado -->
ate_cambiarEstadoOferente(info_porrevisar);
<!-- END BLOCK : info_revisionestado -->
<!-- START BLOCK : info_ultimo_acceso -->
ate_mostrarUltimoAcceso(info_porrevisar); 
<!-- END BLOCK : info_ultimo_acceso -->
<!-- START BLOCK : info_cambiotipo --> 
ate_cambiarTipoOferente(info_porrevisar);
<!-- END BLOCK : info_cambiotipo -->
<!-- START BLOCK : info_fechaenviooferente --> 
ate_verFechaEnvioRevision(info_porrevisar);
<!-- END BLOCK : info_fechaenviooferente -->
</script> 

<!-- START BLOCK : info_no_data -->
<br /> <center>No se registran elementos</center><br />
<!-- END BLOCK : info_no_data -->


{paginamiento} 
<script>
document.main.caso_revision.value = '{caso_revision}';
function verificarUser(id_oferente,estado)
{
	var ver = true;
	if(estado == 'enviado')
	{
		ver = false;
		if(confirm('¿Esta seguro de revisar esta postulación?'))
			ver = true;
	}
	
	if(ver)
	{
		document.main.id_oferente.value = id_oferente;
		process('{caso_revision}',1);
	}
} 

function verUser(id_oferente)
{
	if(confirm('Tenga presenta que si entra a la ficha del postulante ud podrá modificar su información, esta seguro de continuar esta acción? '))
	{
		showAlert('Recuerde que lo mas recomendable es navegar por la Barra de navegación, utilizando los botones de guardar sólo en los casos necesario');
		document.main.caso_revision.value 	= 'registro';
		document.main.id_oferente.value 	= id_oferente;
		process('mi_registro|1',0);
	}
} 
</script>