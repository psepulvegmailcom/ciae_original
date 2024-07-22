
{tag_volver}
<div class="fieldset_title">Ficha de libro</div>
	
		
		<fieldset > 
		
  <!-- <div style="padding-top: 20px; font-weight: bold;font-size: 13px; "> 
	   <p >Si desea consultar este libro, cont&aacute;ctese con Carolina Fern&aacute;ndez <a href="mailto:carolina.fernandez@ciae.uchile.cl?subject=[INTRANET-Biblioteca CIAE] Consulta libro ID {id_libro}&bcc=webmaster@ciae.uchile.cl">carolina.fernandez@ciae.uchile.cl</a> o con el investigador responsable.</p>
    
	</div> -->
  <table style="width: 99%;" cellpadding="15" cellspacing="15">
   <tr   ><td>
    <strong class="strong_especial_label">		Fecha ingreso a la base de datos </strong> </td><td>
				 {fecha_ingreso_base} 
   </td></tr>
  <tr><td style="width: 30% ">
    
	  <strong class="strong_especial_label">ID CIAE (uso interno)</strong> 	</td><td>    {id_libro} 	</td></tr>
  	 
   	 
    <tr><td>
		<strong class="strong_especial_label">	 	Titulo </strong> </td><td> {titulo}   
   </td></tr>
   	 
    <tr><td>
		<strong class="strong_especial_label">	 	Autores </strong> </td><td> {autores}   
   </td></tr>
   	 
    <tr  id='detalle_editorial'><td>
		<strong class="strong_especial_label">	 	Editorial </strong> </td><td> {editorial}  
    </td></tr>
   	 
    <tr id='detalle_agno_publicacion'><td>
		<strong class="strong_especial_label">		A&ntilde;o  </strong></td><td> {agno_publicacion} 
     </td></tr>
     <tr id='detalle_isbn'><td> 
		<strong class="strong_especial_label">		ISBN </strong>
		</td><td><a href="https://www.bookfinder.com/buscar/?keywords={isbn}&currency=USD&il=es&lang=en&st=sh&ac=qr&submit=" target="_blank">{isbn}</a> 
		     </td></tr>
     <tr id='detalle_doi'><td> 
			

	  <strong class="strong_especial_label">		DOI </strong></td><td>
		 <a href="https://doi.org/{doi}" target="_blank">{doi}</a> 
			 </td></tr>
			
   
     <tr id='detalle_tipo_libro'><td> 
	  <strong class="strong_especial_label">		Tipo </strong></td><td>
		 <span style="text-transform: capitalize">{tipo_libro} </span>
			</td></tr>
     <!--<tr  id='detalle_proyecto'><td> 
	  <label id='detalle_proyecto_label'>		Proyecto </strong></td><td>
		 {proyecto} 
			</td></tr>
       
       <div >
	  <label>		Investigador responsable </strong>
			<p>{investigador_acargo} </p>
			</div>-->
			
    
     <tr  id='detalle_numero_copias'><td>
		<strong class="strong_especial_label">		N&uacute;mero de copias </strong></td><td> {numero_copias} 
    
			</td></tr>
		 	 	 	 	
   
     <tr  id='detalle_estado'><td>
		 <strong class="strong_especial_label">		Estado libro </strong></td><td> <span style="text-transform: capitalize"><script>limpiezaEstadoLibros('{estado}');</script></span>
    
			</td></tr> 
			 	 	 	 		 	 	
			 	 	 	
     <tr   ><td style="vertical-align: top">
		 <strong class="strong_especial_label"> Palabras claves </strong> </td>
		 <td>  {palabra_clave} 
    
			</td></tr>  		 	 		 	 		 	 	
			
            
    
</table>
     	 
	 
		  
	</fieldset>
	
<div class="fieldset_title">Pr&eacute;stamos</div>
	<fieldset>
	 <br>
    <div > 
    <table id="tabla_noborder_admin"  >
 
<tr>  
<th    style="text-align:left"> Responsable  </th> 
<th    style="text-align:left"> Fecha solicitud  </th>
<th    style="text-align:left"> Fecha pr&eacute;stamo  </th>
<th    style="text-align:left"> Fecha devoluci&oacute;n  </th> 
   
		</tr>
		
		 <!-- START BLOCK : bloque_form_prestamos -->
		 <tr>
			 <td style="text-decoration: none">{nombre} {apellido_paterno}</td>
			 <td style="text-decoration: none">{fecha_solicitud_html}</td>
			 <td style="text-decoration: none">{fecha_prestamo_html}</td>
			 <td style="text-decoration: none">{fecha_devolucion_html}</td>
		</tr>
		 <!-- END BLOCK : bloque_form_prestamos -->
		 <!-- START BLOCK : bloque_form_prestamos_editar -->
		 <tr>
			 <td>{usuario}</td>
			 <td>{fecha_solici_html}</td>
			 <td>{fecha_prestamo_html}</td>
			 <td><input  class="inputtext" type="text"   name="fecha_devolucion"  id="fecha_devolucion"  value="" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.fecha_devolucion,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A></td>
		</tr>
		 <!-- END BLOCK : bloque_form_prestamos_editar -->
		 <!-- START BLOCK : bloque_form_prestamos_nuevo -->
		 <tr>
			 <td>
    <input  class="inputtext" type="text"    name="usuario"  id="usuario"     maxlength="250" ></td>
    <td><input  class="inputtext" type="text"   name="fecha_solicitud"  id="fecha_solicitud"  value="" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.fecha_solicitud,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A></td>
			 <td><input  class="inputtext" type="text"   name="fecha_prestamo"  id="fecha_prestamo"  value="" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.fecha_prestamo,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A></td>
			 <td><input  class="inputtext" type="text"   name="fecha_devolucion"  id="fecha_devolucion"  value="" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.fecha_devolucion,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A></td>
		</tr><tr>
		<td  >Registrar documento entrega firmado </td>
		
		<td colspan="2"> <input type="file" name="entrega"> </td>
		</tr><tr>
		<td  >Registrar documento devoluci&oacute;n firmado </td>
		
		<td colspan="2"> <input type="file" name="devolucion"> </td>
		</tr>
		 <!-- END BLOCK : bloque_form_prestamos_nuevo -->
		
		</table>
    </div> 
</fieldset>
	
	
	

 

<input type="hidden" name="id_libro" value="{id_libro}" /> 
<input  class="inputtext" type="hidden" name="id_item" value="{id_libro}" id="id_item" />

<script>
	if(trim('{isbn}') == '')
	{
		hidetr('detalle_isbn');
	}
	if(trim('{editorial}') == '')
	{
		hidetr('detalle_editorial');
	}
	if(trim('{agno_publicacion}') == '')
	{
		hidetr('detalle_agno_publicacion');
	} 
	if(trim('{tipo_libro}') == '')
	{
		hidetr('detalle_tipo_libro');
	}
	if(trim('{proyecto}') == '')
	{
		hidetr('detalle_proyecto'); 
	}	
	if(trim('{doi}') == '')
	{
		hidetr('detalle_doi');
	}	
	if(trim('{estado}') != 'activo')
	{
		hidetr('detalle_solicitud_prestamos');
	}	 
	function editElement()
	{  
		process('{opcion_modulo}|guardar_solicitud',0);	 
	}
	function editElementPalabrasClaves()
	{  
		process('{opcion_modulo}|guardar_palabras_claves',0);	 
	}
</script> 
 
{tag_volver}