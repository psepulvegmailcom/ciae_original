<!-- INCLUDE BLOCK : ../templates/ate/evaluacion/ficha_oferta_datos.tpl -->


<div  class="fieldset_title_separador" id='ficha_evaluacion_datos_general'> Encuesta Sostenedores</div>
 <table  id='tabla_noborder_admin'  >
<tr>
<th></th>
<th>Sostenedor</th>   
 <!-- START BLOCK : bloque_evaluacion_inscripcion_oferta_preguntas --> 
<th class="{clase_oculto}"  > {pregunta}</th> 
 <!-- END BLOCK : bloque_evaluacion_inscripcion_oferta_preguntas -->
<th class="div_oculto"  >Totales de respuesta Objetivos</th> 
<th class="div_oculto"  >Totales de respuesta Resultados</th>  
</tr>

 

<!-- START BLOCK : bloque_evaluacion_inscripcion_oferta -->
<tr>
<td  style="border-bottom:1px solid #333333; "><small>{fila}</small></td>
<td style="border-bottom:1px solid #333333">{rut_sostenedor}<br>{nombre_sostenedor}</td>   
 <!-- START BLOCK : bloque_evaluacion_inscripcion_oferta_respuesta --> 
<td style="border-bottom:1px solid #333333; text-align:center" class="{clase_oculto}"    >{respuesta} <div style="text-align:left">{txt_respuesta}</div></td>  
 <!-- END BLOCK : bloque_evaluacion_inscripcion_oferta_respuesta -->
<td style="border-bottom:1px solid #333333" class="div_oculto" ></td> 
<td style="border-bottom:1px solid #333333" class="div_oculto"  ></td> 
</tr>

<!-- END BLOCK : bloque_evaluacion_inscripcion_oferta -->



</table>

<div  class="fieldset_title_separador" id='ficha_evaluacion_datos_general'> Encuesta Directores</div>
<table id='tabla_noborder_admin' >
<tr>
<th></th>

<th>Sostenedor</th>  
<th>RBD</th>   
 <!-- START BLOCK : bloque_evaluacion_inscripcion_oferta_rbd_preguntas --> 
<th class="{clase_oculto}"  >{pregunta}</th> 
 <!-- END BLOCK : bloque_evaluacion_inscripcion_oferta_rbd_preguntas -->
<th class="div_oculto"  >Totales de respuesta Objetivos</th> 
<th class="div_oculto"  >Totales de respuesta Resultados</th>  
</tr>

<!-- START BLOCK : bloque_evaluacion_inscripcion_oferta_rbd -->
<tr>
<td  style="border-bottom:1px solid #333333; "><small>{fila}</small></td>  
<td style="border-bottom:1px solid #333333">{rut_sostenedor}<br>{nombre_sostenedor}</td> 
<td style="border-bottom:1px solid #333333">{rut_rbd}<br>{nombre_rbd}</td>

 <!-- START BLOCK : bloque_evaluacion_inscripcion_oferta_rbd_respuesta --> 
<td style="border-bottom:1px solid #333333; text-align:center" class="{clase_oculto}"    >{respuesta} <div style="text-align:left">{txt_respuesta}</div></td>  
 <!-- END BLOCK : bloque_evaluacion_inscripcion_oferta_rbd_respuesta -->
<td style="border-bottom:1px solid #333333" class="div_oculto" ></td> 
<td style="border-bottom:1px solid #333333" class="div_oculto"  ></td> 
</tr>

<!-- END BLOCK : bloque_evaluacion_inscripcion_oferta_rbd -->
</table>