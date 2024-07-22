<!-- INCLUDE BLOCK : www/templates/evaluaciones/base_header.tpl --> 
<!-- INCLUDE BLOCK : www/templates/evaluaciones/revision/titulo.tpl -->



<table class="tabla_noborder_admin">
	<tr><td colspan="2">
	<p>A continuaci&oacute;n se presentan las respuestas de un compañero de la etapa anterior.<br><br>L&eacute;alas detenidamente y luego complete las preguntas que se presentan para evaluar y retroalimentar a su compañero de forma an&oacutenima:<br></p> 
	</td></tr>

 <!-- START BLOCK : bloque_lista_envio -->
 	<tr>  
	<th style="text-align:center" colspan="2"> <big></big></th>
	</tr>

	<tr>
	<td><strong><u>Pregunta 1:</u>  &iquestPor qu&eacute; es interesante medir la segregaci&oacute;n de desempe&ntilde;os en diferentes pa&iacute;ses y a trav&eacute;s de los a&ntilde;os?</strong></td>
	</tr>

	<tr>
	<td>Respuesta: {texto}</td>
	</tr>
	
	<tr><td> &nbsp;</td></tr>

	<tr>
	<td><strong><u>Pregunta 2:</u>  Explica la necesidad de ajustar las m&eacute;tricas de segregaci&oacute;n por los tama&ntilde;os de las escuelas.</strong></td>
	</tr>

	<tr>
	<td>Respuesta: {texto2}</td>
	</tr>
	
	<tr><td> &nbsp;</td></tr>

	<tr>
	<td><strong>Fecha de envio:</strong></td><td>{fecha_envio_html} &nbsp;</td>
	</tr>


<tr>

<!-- INCLUDE BLOCK : www/templates/evaluaciones/revision/formulario_revision_simple.tpl -->

</td></tr> 
 <!-- START BLOCK : bloque_lista_envio -->

<tr><td colspan="2"  style="text-align:left ">

<button type="button" onClick="javascript:guardarFormulario();"><span>Guardar</span></button> 

<button onclick="javascript:cancelarFormulario();" type="button" title="Cancelar"><span>Cancelar</span></button> 

</td></tr>

</table>
 
 
<!-- INCLUDE BLOCK : www/templates/evaluaciones/revision/formulario_revision_chequeo.tpl -->
 
<!-- INCLUDE BLOCK : www/templates/evaluaciones/base_footer.tpl -->