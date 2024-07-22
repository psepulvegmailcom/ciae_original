
{tag_volver}
<div class="fieldset_title">Ficha de libro</div>
	
		
		<fieldset > 
		
  <!-- <div style="padding-top: 20px; font-weight: bold;font-size: 13px; "> 
	   <p >Si desea consultar este libro, cont&aacute;ctese con Carolina Fern&aacute;ndez <a href="mailto:carolina.fernandez@ciae.uchile.cl?subject=[INTRANET-Biblioteca CIAE] Consulta libro ID {id_libro}&bcc=webmaster@ciae.uchile.cl">carolina.fernandez@ciae.uchile.cl</a> o con el investigador responsable.</p>
    
	</div> -->
  <table style="width: 99%;" cellpadding="15" cellspacing="15">
   <tr   ><td>
    <strong class="strong_especial_label">		Fecha ingreso a la base de datos </strong> </td><td>
	   <script>escribirSimplePantalla(invertirFecha('{fecha_ingreso_base}')); </script>
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
		 <strong class="strong_especial_label">		Estado libro </strong></td><td> <span style="text-transform: capitalize"><script>limpiezaEstadoLibros('{estado}');</script> </span>
    
			</td></tr> 
			 	 	 	 		 	 	
			 	 	 	
     <tr   ><td style="vertical-align: top">
		 <strong class="strong_especial_label"> Palabras claves </strong><br><small> Por favor si considera que faltan palabras claves, ay&uacute;denos a completar esta informaci&oacute;n que nos sirva a todos como comunidad. <br>Separar conceptos mediante coma (,)</small></td>
		 <td> <textarea  class="inputtext" style="width: 99%; height: 50px" name="palabra_clave" onChange="javascript:editElementPalabrasClaves();">{palabra_clave} </textarea>
    
			</td></tr>  		 	 		 	 		 	 	
			
          <tr   id='detalle_solicitud_prestamos'><td style="vertical-align: top">
		 <strong class="strong_especial_label"> Solicitar libro para pr&eacute;stamo</strong><br><small>Esta solicitud ser&aacute; gestionada por &aacute;rea encargada y quienes se comunicar&aacute;n con ud. Indicar fecha de devoluci&oacute;n y/o alg&uacute;n comentario especial.</small></td>
		 <td> 
		 <textarea   class="inputtext"  style="width: 99%; height: 100px" name="comentario_solicitud">Solicito el libro 
C&oacute;digo CIAE {id_libro}, 
T&iacute;tulo: "{titulo}". </textarea>
		 <br>
		 <button type="button" onClick="javascript:editElement();"><span>Solicitar pr&eacute;stamo</span></button>
    
			</td></tr>   
    
</table>
     	 
	 
		  
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