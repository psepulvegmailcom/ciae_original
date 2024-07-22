<!-- INCLUDE BLOCK : ../templates/encuesta/barra_superior.tpl -->
<p>Para cada  uno de los elementos de gesti&oacute;n del modelo propuesto se plantean un conjunto de  medios de verificaci&oacute;n. Le solicitamos que revise el listado de medios de  verificaci&oacute;n,&nbsp; los eval&uacute;e en base a los  criterios que se exponen a continuaci&oacute;n y se&ntilde;ale sugerencias para esta  propuesta. Para ver la s&iacute;ntesis de medios de verificaci&oacute;n, haga clic  <a href="javascript:showId('cuadro');">AQU&Iacute; </a></p>

<div id='cuadro' >
<img src="scripts/vistaPropuestas.php?propuesta=VII2" />
<div style="text-align: center; font-size:110%;  padding:10px 0 10px 0;">
<a href="javascript:hiddenId('cuadro');gotoHref('top');">Cerrar </a></div>
</div>
<p>
  <script>
hiddenId('cuadro');
</script>
</p>
<p>Los criterios de evaluaci&oacute;n son: </p>
<ol>
  <ol>
    <li><strong>Suficiencia: </strong>Los  medios de verificaci&oacute;n requeridos permiten dar cuenta de las pr&aacute;cticas y  resultados del sostenedor.</li>
    <li><strong>Pertinencia: </strong>Los  medios de verificaci&oacute;n requeridos corresponden a la informaci&oacute;n con que el  sostenedor debiera contar para realizar su gesti&oacute;n.<strong></strong></li>
    <li><strong>Factibilidad: </strong>Los  medios de verificaci&oacute;n presentados corresponden a informaci&oacute;n que el sostenedor  actualmente tiene o que es posible de recoger (considere las competencias  t&eacute;cnicas y el tiempo con el que cuenta para recoger esta informaci&oacute;n).<strong></strong></li>
    <li><strong>Apoyo espec&iacute;fico requerido:</strong> Tipo de apoyo que necesita el sostenedor, para recolectar y/o generar  informaci&oacute;n.<strong></strong></li>
  </ol>
</ol>
<p>Las<strong> preguntas breves </strong>corresponden a los  criterios<strong> 1, 2 y 3. </strong>Las<strong> preguntas para desarrollar </strong>corresponden  al criterio<strong> 4, apoyo espec&iacute;fico  requerido. </strong></p>
<p><br />
  <br />
  
</p>
<table style="  width:99%;" id="tabla_noborder_admin" cellspacing="0" cellpadding="0">
  <tr>
    <th  colspan="5" valign="top"><p><strong>PREGUNTAS BREVES </strong> </p></th>
  </tr>
  <tr>
    <td width="839" valign="top"><p><strong>1) Los medios de verificaci&oacute;n presentados, &iquest;Son    suficientes para dar cuenta del trabajo del sostenedor?</strong></p></td> 
    <td  valign="top"><p><strong>si</strong></p></td>
    <td  valign="top"><p><strong> <input type="radio" name="guardar_valor_pregunta_breve_1" value="Si"></strong></p></td>
    <td  valign="top"><p><strong>no</strong></p></td>
    <td  valign="top"><p><strong> <input type="radio" name="guardar_valor_pregunta_breve_1" value="No"></strong></p></td>
  </tr>
  		<script>
		var valor_aux = '{pregunta_breve_1}';
		for (var i=0;i < document.main.guardar_valor_pregunta_breve_1.length;i++)
		{  
		   if (document.main.guardar_valor_pregunta_breve_1[i].value == valor_aux) 
			 document.main.guardar_valor_pregunta_breve_1[i].checked = true; 
		}	
		</script>
  <tr>
    <td width="839" valign="top"><p><strong>2) &iquest;El sostenedor cuenta    con esta informaci&oacute;n?</strong></p></td>
    <td  valign="top"><p><strong>si</strong></p></td>
    <td  valign="top"><p><strong><input type="radio" name="guardar_valor_pregunta_breve_2" value="Si"></strong></p></td>
    <td  valign="top"><p><strong>no</strong></p></td>
    <td  valign="top"><p><strong><input type="radio" name="guardar_valor_pregunta_breve_2" value="No"></strong></p></td>
  </tr>
    		<script>
		 valor_aux = '{pregunta_breve_2}';
		for (var i=0;i < document.main.guardar_valor_pregunta_breve_2.length;i++)
		{  
		   if (document.main.guardar_valor_pregunta_breve_2[i].value == valor_aux) 
			 document.main.guardar_valor_pregunta_breve_2[i].checked = true; 
		}	
		</script>
  <tr>
    <td width="839" valign="top"><p><strong>3) Si no es as&iacute;, &iquest;Es    posible recoger esta informaci&oacute;n?</strong></p></td>
    <td  valign="top"><p><strong>si</strong></p></td>
    <td  valign="top"><p><strong><input type="radio" name="guardar_valor_pregunta_breve_3" value="Si"></strong></p></td>
    <td  valign="top"><p><strong>no</strong></p></td>
    <td  valign="top"><p><strong><input type="radio" name="guardar_valor_pregunta_breve_3" value="No"></strong></p></td>
  </tr>
      		<script>
		 valor_aux = '{pregunta_breve_3}';
		for (var i=0;i < document.main.guardar_valor_pregunta_breve_3.length;i++)
		{  
		   if (document.main.guardar_valor_pregunta_breve_3[i].value == valor_aux) 
			 document.main.guardar_valor_pregunta_breve_3[i].checked = true; 
		}	
		</script>
</table>
<p>&nbsp;</p>
<table   style="  width:99%;"  id="tabla_noborder_admin" cellspacing="0" cellpadding="0">
  <tr>
    <th  valign="top"><p><strong>PREGUNTAS PARA DESARROLLAR </strong><strong>(Especifique)</strong> </p></th>
  </tr>
  <tr>
    <td  valign="top"><p><strong>4.1) De los medios de verificaci&oacute;n presentados,    &iquest;Cu&aacute;les requerir&iacute;an apoyo espec&iacute;fico externo para su recolecci&oacute;n (enumere)?</strong> </p></td>
  </tr>
  <tr>
    <td  valign="top"><textarea name="guardar_valor_pregunta_desarrollo_1" style="height:120px; width:98%">{pregunta_desarrollo_1}</textarea></td>
  </tr>
  <tr>
    <td  valign="top"><p><strong>4.2) &iquest;Qu&eacute; apoyo espec&iacute;fico externo requiere el sostenedor    para generar la     informaci&oacute;n con que actualmente no cuenta?</strong> </p></td>
  </tr>
  <tr>
    <td  valign="top"><textarea name="guardar_valor_pregunta_desarrollo_2" style="height:120px; width:98%">{pregunta_desarrollo_2}</textarea></td>
  </tr>
  <tr>
    <td  valign="top"><p><strong>4.3) De los medios de verificaci&oacute;n presentados, &iquest;Qu&eacute;    informaci&oacute;n es dif&iacute;cil o inviable recoger, a&uacute;n    considerando la opci&oacute;n de    apoyo?</strong> </p></td>
  </tr>
  <tr>
    <td  valign="top"><textarea name="guardar_valor_pregunta_desarrollo_3" style="height:120px; width:98%">{pregunta_desarrollo_3}</textarea></td>
  </tr>
  <tr>
    <td  valign="top"><p><strong>4.4) Comentarios y sugerencias generales</strong></p></td>
  </tr>
  <tr>
    <td  valign="top"><textarea name="guardar_valor_pregunta_desarrollo_4" style="height:120px; width:98%">{pregunta_desarrollo_4}</textarea></td>
  </tr>
</table> 
<p>&nbsp;</p>
<br />
<center><input  type="button" onclick="javascript:guardar_datos();" style="height:30px"  value="Guardar" /></center>
<script>
function guardar_datos()
{
	process('guardar_datos',1);	
}
 
</script>
<!-- INCLUDE BLOCK : ../templates/encuesta/barra_superior.tpl -->