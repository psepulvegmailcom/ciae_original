  <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/ficha_oferta_datos.tpl -->
<table  id='tabla_noborder_admin'  >
<tr>
<th></th>
<th>Sostenedor</th> 
<th>Fecha Registro Servicio</th>
<th>Fecha Inicio Servicio</th>
<th>Fecha Término Servicio</th>
<th>Total Escuelas</th>
<th>RBD</th> 
<th>Datos Contacto</th>
<th>Horas  promedio semanal ATE</th>
<th>Costo Total</th>
<th>Recursos SEP</th>
<th>Total otros recurso</th>
<th class="div_oculto" >Recursos Subvención Regular</th>
<th class="div_oculto" >Recursos Donación Privada</th>
<th class="div_oculto" >Recursos Otros Proyectos</th>
<th  class="div_oculto">Destinatarios</th>
 
</tr>
 
<!-- START BLOCK : bloque_evaluacion_inscripcion_oferta -->  
<tr >
<td   class='{fondo}' style=" border:none;vertical-align:top" ><a name="fila_registro_{id_registro}"></a>  <a name="fila_registro_{id_registro}-{rbd}"></a> {fila}</td>
<td  class='{fondo}'  style=" border:none;vertical-align:top"> {rut_sostenedor}-{dv_sostenedor}<br><br> {nombre_sostenedor}</td>  
	<td  class='{fondo}'  style=" border:none;vertical-align:top">  {fecha_creacion}</td>
	<td  class='{fondo}'  style=" border:none;vertical-align:top">  {fecha_inicio}</td>
	<td  class='{fondo}'  style=" border:none;vertical-align:top">  {fecha_termino}</td>
	  
	<td  class='{fondo}'  style=" border:none;vertical-align:top; text-align:center">{total_escuela}</td>
	
	 <td  class='{fondo}'  style=" border:none;vertical-align:top; text-align:left">  
	<a href="javascript:showId('bloque_rbd_{id_registro}-{rbd}')">Ver RBD</a><br>
	<div  id='bloque_rbd_{id_registro}-{rbd}' style="visibility:hidden; height:0px;">
	<table  id='tabla_noborder_admin'  >
	  <tr><th>RBD</th><th>Establecimiento</th></tr>
	  
		 <!-- START BLOCK : bloque_evaluacion_inscripcion_oferta_detalle_rbd -->
	  <tr><td>  {rbd}-{rbd_dgv}</td><td> {nom_esta}</td></tr> 
	 <!-- END BLOCK : bloque_evaluacion_inscripcion_oferta_detalle_rbd -->
	 </table> 
	<br><a href="javascript:hiddenId('bloque_rbd_{id_registro}-{rbd}');gotoHref('fila_registro_{id_registro}');">Ocultar RBD</a>
	</div>
  </td>  
	
	<td  class='{fondo}'  style=" border:none;vertical-align:top"> {nom_llena_reg} <br> <br>{mail_llena_reg}<br><br> 
	</td>
	
	<td  class='{fondo}' style="border:none;text-align:center;vertical-align:top" >  {horas_pro}</td>
	<td  class='{fondo}'  style=" border:none;vertical-align:top">  ${cos_total}</td> 	
	<td  class='{fondo}'  style=" border:none;vertical-align:top">  ${cos_rec_sep}</td> 
	<td  class='{fondo}'  style=" border:none;vertical-align:top">  ${costo_total_otros}</td>
	<td  class='{fondo}'  style=" border:none;vertical-align:top; visibility:hidden;"  > ${cos_sub_reg}</td>
	<td  class='{fondo}'  style=" border:none; visibility:hidden;vertical-align:top"  >  ${cos_don_pri}</td>
	<td  class='{fondo}'  style=" border:none; visibility:hidden;vertical-align:top" >  ${cos_otro}</td>
	 
	 
	  <td  class='{fondo}'  class="div_oculto" style=" border:none;vertical-align:top; visibility:hidden">  
	<div  class="div_oculto" > 
	  <table  id='tabla_noborder_admin'  >
	  <tr><th>Destinatario</th><th>Niveles</th><th>Áreas Curriculares</th></tr>
	  
	 <!-- START BLOCK : bloque_evaluacion_inscripcion_oferta_detalle_destinatario -->
	<tr><td>{valor_destinatario}</td> 
	 <td>{valor_nivel}</td> 
	 <td>{valor_area}</td> </tr>
	 <!-- START BLOCK : bloque_evaluacion_inscripcion_oferta_detalle_destinatario -->
	    
	 </table>
	 </div>
 </td>  
	</tr>
	 
<!-- END BLOCK : bloque_evaluacion_inscripcion_oferta -->
</table>
 
