 <a  name="formtitulo_{orden}_completo_{orden}"></a>
 <tr  id='formtitulo_{orden}_completo_{orden}' >
 <td colspan="2" >
	<table style="width:100%" border="0">
    <tr><td  colspan="2"><strong style=" text-decoration:underline">T&iacute;tulo {orden}</strong><br> <a  onClick="javascript:eliminarTitulo('{orden}');"  href="#formtitulo_{orden}_completo_{orden}">(-) Eliminar T&iacute;tulo</a></td></tr>
    <tr> 
    <td><strong> Tipo    (*)  </strong> </td>
    <td>
         <select name="formtitulo_{orden}_tipo" id="formtitulo_{orden}_tipo">
         <option></option>
         <option value="licenciatura">Licenciatura</option>
         <option value="profesional">Profesional</option>
         <option value="magister">Magister</option>
         <option value="doctorado">Doctorado</option>
         </select>
         
         <script>
		 if('{tipo}' != '')
		 {
				selectValue('formtitulo_{orden}_tipo','{tipo}'); 
		 }
		 </script>
         </td>
  </tr> 
      <tr>
    <td><strong>T&iacute;tulo o grado profesional   (*)  </strong><br><small>El nombre que aparece en su certificado de t&iacute;tulo</small></td>
    <td>
        <input type="text" name="formtitulo_{orden}_titulo" id="formtitulo_{orden}_titulo"  value="{titulo}" style="width:100%" maxlength="255"></td>
  </tr> 
      <tr>
    <td><strong>Instituci&oacute;n que otorgo t&iacute;tulo   (*)  </strong></td>
    <td>
        <input type="text" name="formtitulo_{orden}_institucion" id="formtitulo_{orden}_institucion"  value="{institucion}" style="width:100%" maxlength="255"> </td>
  </tr>  
  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_detalle.tpl --> 
  
	  <tr>
    <td><strong>Ciudad donde se otorgo t&iacute;tulo  (*)  </strong></td>
    <td> 
	
	 <input type="text" name="formtitulo_{orden}_ciudad" id="formtitulo_{orden}_ciudad" value="{ciudad}" style="width:100%" maxlength="255">
	</td>
  </tr>
  
    <tr>
    <td><strong>Pais donde se otorgo t&iacute;tulo  (*)  </strong></td>
    <td> 
	<select name="formtitulo_{orden}_pais" id="formtitulo_{orden}_pais">
	<option value="" selected></option>
	<!-- START BLOCK : bloque_pais -->
	<option value="{pais_id}">{pais}</option>
	<!-- END BLOCK : bloque_pais --> 
	</select>
    
    
         <script>
		 if('{pais}' != '')
		 {
			selectValue('formtitulo_{orden}_pais','{pais}'); 
		 }
		 </script> 
	</td>
  </tr>
  
   <tr>
    <td><strong>Archivo de t&iacute;tulo   (*)  </strong></td>
    <td>
       <input type="file" name="formtitulo_{orden}_archivo"  id="formtitulo_{orden}_archivo">
<br>(Peso m&aacute;ximo 2 Mb)
       <script>
	   if('{archivo}' != '')
	   {		   
			document.write('<br><a id="formtitulo_{orden}_archivo_link" href="download.php?file=honorarios/{archivo}">Ver archivo</a>');   
	   }
	   </script>
       <input type="hidden" name="formtitulo_{orden}_archivo_original" value="{archivo}" id="formtitulo_{orden}_archivo_original">
       </td>
  </tr>
  
     <tr>
    <td style="border-bottom:1px solid #DBD4D4" colspan="2">&nbsp; 
       </td>
  </tr>
    </table> 
    
 </td></tr> 
 
  
  <script>
  hidetr('formtitulo_{orden}_completo_{orden}');
  
  <!-- START BLOCK : bloque_mostrar_fila --> 
  showtr('formtitulo_{orden}_completo_{orden}');
  <!-- END BLOCK : bloque_mostrar_fila --> 
  </script>