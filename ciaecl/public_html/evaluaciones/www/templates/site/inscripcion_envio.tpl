 <script>
  document.main.enviandodatos.value = 'enviandodatos' ;
  </script>
 
    <tr>
    <td>&nbsp;</td>
    <td> </td>
  </tr>
    <tr>
    <td><span class="destacado"> Env�o de Trabajos</span></td>
    <td> </td>
  </tr>
      <tr>
    <td colspan="2">
	 
	   </td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td> </td>
  </tr>
  <tr>
    <td>T�tulo (*) </td>
    <td><input  type="text" name="titulo_trabajo"  style="width:100%" /></td>
  </tr>
  <tr>
  <td>�rea  (*) </td>
  <td>
        <select    name="area_trabajo" tabindex="7"  style="width:100%"  >

<option value="" >	-------------- </option>
<!-- START BLOCK : bloque_inscripcion_areas_envio --> 
<option value="{valor}"   >	{texto}   </option>
<!-- END BLOCK : bloque_inscripcion_areas_envio --> 
</select></td></tr>
  <tr>
    <td>Archivo (*) </td>
    <td><input type="file" name="archivo_trabajo"  style="width:100%" /> <strong><small> (S�lo doc, docx o pdf) </small></strong></td>
  </tr>
  <tr>
  <td></td>
    <td> �Desea que su trabajo sea evaluado para ser presentado en qu� tipo de sesi�n? (*)</td>
  </tr>
  
  <tr>
  <td></td>
    <td><strong>Sesi�n de trabajo regular</strong> <input type="radio" name="tipo_sesion" value="regular" onClick="javascript:showtr('fila_pregunta_poster');"> &nbsp;&nbsp;&nbsp;  <strong>Sesi�n de posters</strong>  <input type="radio" name="tipo_sesion" value="poster"  onClick="javascript:hidetr('fila_pregunta_poster');"> </td>
  </tr> 
  
  
    <tr  id='fila_pregunta_poster'>
    <td> </td>
    <td>  En caso que su trabajo no sea seleccionado para ser presentado en sesiones de trabajo regulares del Congreso, �est� usted dispuesto a que sea presentado en una sesi�n de posters? (*)  <br><strong>SI</strong> <input type="radio" name="posteroseleccion" value="si" checked >  &nbsp;&nbsp;&nbsp; <strong> NO</strong> <input type="radio" name="posteroseleccion" value="no"> </td>
  </tr>
  <tr>
  <td></td>
    <td>
	 Para mayor informaci�n respecto de en qu� consiste una sesi�n de posters, favor revisar la secci�n <a href="?page=view_faq">&quot;Preguntas Frecuentes&quot;</a><br> </td>
  </tr>
    <script>
	  hidetr('fila_pregunta_poster');  
  </script>
      <tr>
    <td colspan="2"><br><br></td> 
  </tr> <tr id='fila_titulo'>
    <td colspan="2"><span class="destacado"> Ficha de Inscripci�n</span></td> 
  </tr>
  
