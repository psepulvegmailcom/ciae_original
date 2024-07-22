
{tag_volver}
 
<!-- INCLUDE BLOCK : www/templates/general/calendario.tpl -->
		 
<fieldset >
	<table style="width: 100%">
		<tr><td style="width: 30%"><strong class="strong_especial_label">Persona solicitante</strong></td>
		<td> {usuario_solicitante} 		
		 <!-- START BLOCK : bloque_persona_solicitante_form -->
		 <select   class="inputtext" name="form_id_usuario_solicitante" id="form_id_usuario_solicitante" onChange="javascript:editElement();"   >
			 <option></option>
			  <!-- START BLOCK : bloque_persona_solicitante_form_option --> 
			 <option value="{id_persona}">{apellido_paterno}, {nombre}  ({email})</option>
			  <!-- END BLOCK : bloque_persona_solicitante_form_option -->
			</select>
		 <!-- END BLOCK : bloque_persona_solicitante_form -->  
		</td></tr>
		 
		<tr><td><strong class="strong_especial_label">Fecha de solicitud</strong></td>
		<td>  
		 <!-- START BLOCK : bloque_fecha_solicitud_form -->
		 <script type="text/javascript">
		$(document).ready(function() {
		   $("#form_fecha_solicitud").datepicker();
		});
		</script>
		<input type="text"  style="width:120px" class="inputtext" name="form_fecha_solicitud" id="form_fecha_solicitud" readonly size="12" value="{fecha_solicitud_html}"/> 
		 <!-- END BLOCK : bloque_fecha_solicitud_form -->
		
		 <!-- START BLOCK : bloque_fecha_solicitud_dato -->
		 {fecha_solicitud_html}
		 <input type="hidden" name="form_fecha_solicitud" id="form_fecha_solicitud" value='{fecha_solicitud_html}'>
		 <!-- END BLOCK : bloque_fecha_solicitud_dato -->
			</td></tr>
		
		<tr><td><strong class="strong_especial_label">Fecha de pr&eacute;stamo</strong></td>
		<td> 
		
		 <!-- START BLOCK : bloque_fecha_prestamo_form --> 
		 <script type="text/javascript">
		$(document).ready(function() {
		   $("#form_fecha_prestamo").datepicker();
		});
		</script>
		<input type="text"  style="width:120px" class="inputtext" name="form_fecha_prestamo" id="form_fecha_prestamo" readonly size="12" value="{fecha_prestamo_html}"  onClick="javascript:test();">
		 <!-- END BLOCK : bloque_fecha_prestamo_form -->
		
		 <!-- START BLOCK : bloque_fecha_prestamo_dato -->
		 {fecha_prestamo_html}
		 <input type="hidden" name="form_fecha_prestamo" id="form_fecha_prestamo" value='{fecha_prestamo_html}'>
		 <!-- END BLOCK : bloque_fecha_prestamo_dato -->
		</td></tr>
		
		
		<tr><td><strong class="strong_especial_label">Fecha de devoluci&oacute;n estimada</strong></td><td>  
		
		
		 <!-- START BLOCK : bloque_fecha_devolucion_estimada_form -->
		<script type="text/javascript">
		$(document).ready(function() {
		   $("#form_fecha_devolucion_estimada").datepicker();
		});
		</script>
		<input type="text"  style="width:120px" class="inputtext" name="form_fecha_devolucion_estimada" id="form_fecha_devolucion_estimada" readonly size="12" value="{fecha_devolucion_estimada_html}" onChange="javascript:actualizarFechaDevolucionEstimada();"  >
		 <!-- END BLOCK : bloque_fecha_devolucion_estimada_form -->
		
		 <!-- START BLOCK : bloque_fecha_devolucion_estimada_dato -->
		 {fecha_devolucion_estimada_html}
		 
		 <input type="hidden" name="form_fecha_devolucion_estimada" id="form_fecha_devolucion_estimada" value="{fecha_devolucion_estimada_html}">
		 
		 <!-- END BLOCK : bloque_fecha_devolucion_estimada_dato -->
		 
		</td></tr> 
	     <tr><td colspan="2"	> 
	  
	  
	  <table id="tabla_noborder_admin" border="0" >
	  <tr>
		  <th style="text-align: left">Libro</th> <th style="text-align: left">Fecha  
		  Estimada<br> 
		  Devoluci&oacute;n </th> <th style="text-align: left">Fecha  
		   
		  Devoluci&oacute;n </th> 
		  </tr>
		  
 		<!-- START BLOCK : bloque_libros_prestamos_detalle -->
		  <tr><td>
			  <strong>{id_libro}</strong> <i>"{titulo_libro}"</i>  <br>{autores_libro}	<br>{editorial_libro}
		  </td>
			  <td>
			  <!-- START BLOCK : bloque_fecha_devolucion_estimada_libro_form_detalle -->
			  
			<script type="text/javascript">
			$(document).ready(function() {
			   $("#formdetalle_fecha_devolucion_estimada_libro_{fila}").datepicker();
			});
			</script>
			<input type="text"  style="width:120px" class="inputtext" name="formdetalle_fecha_devolucion_estimada_libro_{fila}" id="formdetalle_fecha_devolucion_estimada_libro_{fila}" readonly size="12" value="{fecha_devolucion_estimada_libro_html}"/> 
			   
			  <!-- END BLOCK : bloque_fecha_devolucion_estimada_libro_form_detalle --> 
			  <!-- START BLOCK : bloque_fecha_devolucion_estimada_libro_detalle_dato -->
			  {fecha_devolucion_estimada_libro_html}
			  <input type="hidden" name="formdetalle_fecha_devolucion_estimada_libro_{fila}" id="formdetalle_fecha_devolucion_estimada_libro_{fila}"  value="{fecha_devolucion_estimada_libro_html}"> 
			  <!-- END BLOCK : bloque_fecha_devolucion_estimada_libro_detalle_dato -->
			   </td>
			  
			   <td>
			  <!-- START BLOCK : bloque_fecha_devolucion_libro_form_detalle -->
			  
			<script type="text/javascript">
			$(document).ready(function() {
			   $("#formdetalle_fecha_devolucion_libro_{fila}").datepicker();
			});
			</script>
			<input type="text"  style="width:120px" class="inputtext" name="formdetalle_fecha_devolucion_libro_{fila}" id="formdetalle_fecha_devolucion_libro_{fila}" readonly size="12" value="{fecha_devolucion_libro_html}"/> 
			  <!-- END BLOCK : bloque_fecha_devolucion_libro_form_detalle --> 
			  <!-- START BLOCK : bloque_fecha_devolucion_libro_detalle_dato -->
			  {fecha_devolucion_libro_html}
			  <input type="hidden" name="formdetalle_fecha_devolucion_libro_{fila}" id="formdetalle_fecha_devolucion_libro_{fila}"  value="{fecha_devolucion_libro_html}"> 
			  <input  name="formdetalle_estado_{fila}" id="formdetalle_estado_{fila}" type="hidden" value='devuelto'>
			  <!-- END BLOCK : bloque_fecha_devolucion_libro_detalle_dato -->
			   </td>
			   
		  </tr>
		<script> 
		if(trim('{estado_libro}') != '' && trim('{estado_libro}') != '0')
		{
			selectValue('formdetalle_estado_{fila}','{estado_libro}');
		}
		if('{fecha_devolucion_estimada_libro_html}' == '00-00-0000' && document.getElementById('formdetalle_fecha_devolucion_estimada_libro_{fila}'))
		{
			document.getElementById('formdetalle_fecha_devolucion_estimada_libro_{fila}').value = '';
		}
		if('{fecha_devolucion_libro_html}' == '00-00-0000' && document.getElementById('formdetalle_fecha_devolucion_libro_{fila}'))
		{
			document.getElementById('formdetalle_fecha_devolucion_libro_{fila}').value = '';
		}
		</script>
 		<!-- END BLOCK : bloque_libros_prestamos_detalle -->
			
		<!-- START BLOCK : bloque_libros_prestamos_detalle_nuevo -->
		  <tr><td >
		  	<select style="max-width: 400px;" name="formdetallenuevo_id_libro" id="formdetallenuevo_id_libro" onChange="javascript:editElement();" onClick="javascript:copiarDatos('form_fecha_devolucion_estimada','formdetallenuevo_fecha_devolucion_estimada');" >
				<option></option>
		  	<!-- START BLOCK : bloque_libros_prestamos_detalle_libros -->
				<option value="{id_libro}">{id_libro} "{titulo}" ({estado})</option>
 			<!-- END BLOCK : bloque_libros_prestamos_detalle_libros -->
			  </select>  
		  </td>
			  <td colspan="2"> 
			  <script type="text/javascript">
			$(document).ready(function() {
			   $("#formdetallenuevo_fecha_devolucion_estimada").datepicker();
			});
			</script>
			<input type="text"  style="width:120px" class="inputtext" name="formdetallenuevo_fecha_devolucion_estimada" id="formdetallenuevo_fecha_devolucion_estimada" readonly size="12" /> 
			  </td> 
			    
			   
		  </tr> 
 <!-- END BLOCK : bloque_libros_prestamos_detalle_nuevo -->	
			 </table>
		  </td></tr>
		  <!-- START BLOCK : bloque_libros_prestamos_generacion_documento_prestamo -->
		<tr><td ><strong class="strong_especial_label">	Documento pr&eacute;stamos </strong> </td> <td  ><a href="download.php?tipo=tmp&file={archivo}" style="border:none ">Descargar documento pr&eacute;stamos propuesto</a></td></tr>
		  <!-- END BLOCK : bloque_libros_prestamos_generacion_documento_prestamo -->	
		  
		  
			<!-- START BLOCK : bloque_libros_prestamos_generacion_documento_prestamo_form -->
		  <tr><td ><strong class="strong_especial_label">	Documento pr&eacute;stamo firmado </strong></td>
		   <td>  
		   		 
		   
		   
		   
			   <input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
                <ul id="lista-archivoUnico1" >                </ul>
                <div id="responseArchivoUnico1"></div>          
              
			<input type="hidden" id="ruta_archivo1" value="doc/solicitudes_gestion/libros_prestamos/" name="ruta_archivo1"/>
			<input type="hidden" id="nombre_campo_archivo1" value="form_archivo_prestamo_firmado" name="nombre_campo_archivo1"/>
     	<input type="hidden" name="form_archivo_prestamo_firmado" id="form_archivo_prestamo_firmado" value="{archivo}">
	     	</div>
	     	
			</td></tr>
			<!-- END BLOCK : bloque_libros_prestamos_generacion_documento_prestamo_form -->
			
			<!-- START BLOCK : bloque_libros_prestamos_generacion_documento_prestamo_descarga -->
			<tr><td><strong class="strong_especial_label">Documento de pr&eacute;stamo </strong></td><td> 
				<a href="download.php?file=solicitudes_gestion/libros_prestamos/{archivo_prestamo_firmado}" style="border:none ">Descargar Documento</a></td></tr>
			<!-- END BLOCK : bloque_libros_prestamos_generacion_documento_prestamo_descarga -->
			 	
		  
		<!-- START BLOCK : bloque_libros_devolucion_fecha_form -->
			<tr><td><strong class="strong_especial_label">Fecha de devoluci&oacute;n  </strong></td><td>  
		
		
		 <!-- START BLOCK : bloque_fecha_devolucion_form -->
		<script type="text/javascript">
		$(document).ready(function() {
		   $("#form_fecha_devolucion").datepicker();
		});
		</script>
		<input type="text"  style="width:120px" class="inputtext" name="form_fecha_devolucion" id="form_fecha_devolucion" readonly size="12" value="{fecha_devolucion_html}" onChange="javascript:editElement();" />
		 <!-- END BLOCK : bloque_fecha_devolucion_form -->
		
		 <!-- START BLOCK : bloque_fecha_devolucion_dato -->
		 {fecha_devolucion_html}
		 <input type="hidden" name="form_devolucion" id="form_devolucion" value='{fecha_devolucion_html}'>
		 <!-- END BLOCK : bloque_fecha_devolucion_dato -->
		
		</td></tr> 
		<!-- END BLOCK : bloque_libros_devolucion_fecha_form --> 
		
		<!-- START BLOCK : bloque_libros_devolucions_generacion_documento_devolucion -->
		<tr><td  ><strong class="strong_especial_label">	Documento devoluci&oacute;n </strong> </td> <td ><a href="download.php?tipo=tmp&file={archivo}" style="border:none ">Descargar Documento</a></td></tr>
		  <!-- END BLOCK : bloque_libros_devolucions_generacion_documento_devolucion -->	
		  			<!-- START BLOCK : bloque_libros_devolucion_generacion_documento_prestamo_descarga -->
			<tr><td><strong class="strong_especial_label">Documento de pr&eacute;stamo </strong></td><td> 
				<a href="download.php?file=solicitudes_gestion/libros_devoluciones/{archivo_prestamo_firmado}" style="border:none ">Descargar Documento</a></td></tr>
			<!-- END BLOCK : bloque_libros_devolucion_generacion_documento_prestamo_descarga -->
		  
			<!-- START BLOCK : bloque_libros_devolucions_generacion_documento_devolucion_form -->
		  <tr><td ><strong class="strong_especial_label">	Documento devoluci&oacute;n firmado </strong></td>
		   <td>  
		   		  
			   <input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
                <ul id="lista-archivoUnico1" >                </ul>
                <div id="responseArchivoUnico1"></div>          
              
			<input type="hidden" id="ruta_archivo1" value="doc/solicitudes_gestion/libros_devoluciones/" name="ruta_archivo1"/>
			<input type="hidden" id="nombre_campo_archivo1" value="form_archivo_devolucion_firmado" name="nombre_campo_archivo1"/>
     	<input type="hidden" name="form_archivo_devolucion_firmado" id="form_archivo_devolucion_firmado" value="{archivo}">
	     	</div>
	     	
			</td></tr>
			<!-- END BLOCK : bloque_libros_devolucions_generacion_documento_devolucion_form -->
			
			
			
			
			
<tr><td><strong class="strong_especial_label">	Comentario interno</strong></td><td  	>
	<textarea class="inputtext" name='form_comentario' id='form_comentario'>{comentario}</textarea>
     </td></tr>
	</table> 
	
		<center>
	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
	<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button>
</center>
	</fieldset>  

 <input type="hidden" id="form_id_prestamo"  name="form_id_prestamo" value="{id_prestamo}">  
 <input type="hidden" name="form_estado" value="{estado}"  id="form_estado" > 

<script type="text/javascript">
 document.main.id_item.value = '{id_prestamo}';
 document.main.form_id_prestamo.value = '{id_prestamo}';
	
	
<!-- START BLOCK : bloque_nuevo_ingreso_temporal -->
document.main.id_item.value = '{id_prestamo}';
document.main.form_id_prestamo.value = '{id_prestamo}';
<!-- END BLOCK : bloque_nuevo_ingreso_temporal -->
function editElement()
{        
	document.getElementById('form_estado').value = 'solicitud';
	
	if(!validacionCampoTextoSimple('form_id_usuario_solicitante'))
	{
		return false;
	}
	if(!validacionCampoTextoSimple('form_numero_memo'))
	{
		return false;
	}
	if(!validacionCampoTextoSimple('form_fecha_solicitud'))
	{
		return false;
	}
	if(!validacionCampoTextoSimple('form_fecha_prestamo'))
	{
		return false;
	}
	if(!validacionCampoTextoSimple('form_fecha_devolucion_estimada'))
	{
		return false;
	}
	
	document.getElementById('form_estado').value = 'prestado';
	var fecha_solicitud = invertirFecha(document.getElementById('form_fecha_solicitud').value,'-'); 
	var fecha_prestamo  = invertirFecha(document.getElementById('form_fecha_prestamo').value,'-');
	if(fecha_prestamo < fecha_solicitud)
	{
		alert('La fecha de solicitud debe ser igual o menor que la fecha de prestamo');
		return false;
	}
	var fecha_devolucion_estimada = invertirFecha(document.getElementById('form_fecha_devolucion_estimada').value,'-');
	 
	if(fecha_prestamo > fecha_devolucion_estimada)
	{
		alert('La fecha de devolucion estimada debe ser igual o mayor que la fecha de prestamo');
		return false;
	}	
	
	if(document.getElementById('form_fecha_devolucion'))
	{
		var fecha_devolucion = document.getElementById('form_fecha_devolucion').value;
		if(trim(fecha_devolucion) != '')
		{
			var fecha_devolucion = invertirFecha(fecha_devolucion,'-');
			if(fecha_prestamo > fecha_devolucion)
			{
				alert('La fecha de devolucion debe ser igual o mayor que la fecha de prestamo');
				document.getElementById('form_fecha_devolucion').value = '';
				return false;
			}
			/*if(fecha_devolucion_estimada > fecha_devolucion)
			{
				alert('Las fechas de devoluciones deben ser iguales, o la de devolucion real debe ser mayor a la fecha estimada');
				return false;
			}*/

			if(!validacionCampoTextoSimple('Archivo1'))
			{
				return false;
			}	

			document.getElementById('form_estado').value = 'devuelto';
		}
	}
	 
	if(trim(document.getElementById('form_id_prestamo').value) == '')
	{
		/* deben ingresar al menos un libro nuevo*/
		if(!validacionCampoTextoSimple('formdetalle_id_libro'))
		{
			return false;
		}
	}
	
	process('{opcion_modulo}|guardar',0);	  
} 
	
function copiarDatos(valorOrigen,valorDestino)
{
	if(document.getElementById(valorOrigen) && document.getElementById(valorDestino))
	{
		document.getElementById(valorDestino).value = document.getElementById(valorOrigen).value;
	}
}

function actualizarFechaDevolucionEstimada()
{
	copiarDatos('form_fecha_devolucion_estimada','formdetallenuevo_fecha_devolucion_estimada');
	var filas_maximo = 1000;
	for(var i=0; i < filas_maximo; i++)
	{
		if(document.getElementById('formdetalle_fecha_devolucion_estimada_libro_'+i))
		{ 
			copiarDatos('form_fecha_devolucion_estimada','formdetalle_fecha_devolucion_estimada_libro_'+i);
		}
		else
		{
			i = filas_maximo + 1;
		}	
	}
}
</script>

{tag_volver}