
<div  style="text-align: center;padding-bottom: 20px;">  <a href='download.php?file={estados_solicitudes_archivo}&tipo=tmp' target="_blank"><img src='www/images/filetypes/excel.gif'   width="20" height="20" border=0> Descargar listado de solicitudes</a>

</div>


	 <div class="contenido_titulo_separador" style=" ">Solicitudes que requieren mi revisi&Oacute;n</div>
		 
		 <div style="padding-left:20px">
	
	<table id="tabla_noborder_admin"    >
 
<tr> 
	<th style=" width:3px"></th>
<th   width="8%"  style="text-align:left"> ID solicitud  </th> 
<th    style="text-align:left"> Solicitante  </th> 
  
<th  width="15%"> Fecha estado </th>  
<th  width="15%"> Estado actual  </th>
<th  width="15%">Responsable</th>  
<th  width="15%"> Beneficiario  </th>      
<th  width="15%">   Revisar  </th>    
</tr>
 <!-- START BLOCK : lista_item -->
<tr> 
	<td style=" widtd:3px"></td>
<td    style="text-align:center">{id_solicitud}  </td> 
<td    style="text-align:left">{solicitantes}  </td> 
  
<td  style="text-align:center" > {fecha_solicitud}  </td>  
<td  style="text-align:center"  > {tipo_estado}   </td> 
<td  style="text-align:center"  > {id_usuario_responsable} </td> 
<td  style="text-align:center"  > {beneficiario}  </td>      
<td  style="text-align:center"  >    <a href="javascript:enviar_accion_admin('view_administracion_viajes_revision|ficha','{id_solicitud}');">
		 	 <img src="www/images/iconos/edit.gif" ></a></td>    
</tr>
 <!-- END BLOCK : lista_item -->

  
 </table>
 	  
 </div>
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->
 
<div class="contenido_titulo_separador" style=" ">Solicitudes  </div>
		 
		 <div style="padding-left:20px">
	
	<table id="tabla_noborder_admin"    >
 
<tr> 
	<th style=" width:3px"></th>
<th   width="8%"  style="text-align:left"> ID solicitud  </th> 
<th    style="text-align:left"> Solicitante  </th> 
  
<th  width="15%"> Fecha estado  </th>  
<th  width="15%"> Estado actual  </th>
<th  width="15%">Responsable</th>  
<th  width="15%"> Beneficiario  </th>      
<th  width="15%">   Revisar  </th>    
</tr>
 <!-- START BLOCK : lista_item_realizadas -->
<tr> 
	<td style=" widtd:3px"></td>
<td    style="text-align:center">{id_solicitud}  </td> 
<td    style="text-align:left">{solicitantes}  </td> 
  
<td  style="text-align:center" > {fecha_solicitud}  </td>  
<td  style="text-align:center"  > {tipo_estado}   </td> 
<td  style="text-align:center"  > {id_usuario_responsable} </td> 
<td  style="text-align:center"  > {beneficiario}  </td>      
<td  style="text-align:center"  >    <a href="javascript:enviar_accion_admin('view_administracion_viajes_revision|ficha','{id_solicitud}');">
		 	 <img src="www/images/iconos/edit.gif" ></a></td>    
</tr>
 <!-- END BLOCK : lista_item_realizadas -->

  
 </table>
 	  
 </div>
 
 <!-- START BLOCK : item_lista_nohay_realizadas -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay_realizadas -->