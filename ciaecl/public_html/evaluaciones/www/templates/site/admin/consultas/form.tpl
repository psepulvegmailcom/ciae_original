
<input type="hidden" name="id_consulta" value="{id_consulta}">

<div class="fieldset_title">Consulta</div>
<table width="95%" border="0" cellpadding="3" style="font-size:">  

  <tr>
    <td  ><strong>Nombre</strong></td>
    <td  > 
        {nombre}    </td>
  </tr>
  <tr>
    <td style=" width:30%"><strong>Email </strong></td>
    <td style="width:70%"> 
        {email}    </td>
  </tr>
  <tr>
    <td   ><strong>Fecha</strong></td>
    <td  > 
        {fecha_html}    </td>
  </tr>
  <tr>
    <td style="vertical-align:top"  ><strong>Consulta</strong></td>
    <td  > 
        {consulta_html}    </td>
  </tr>
  
	 <!-- START BLOCK : bloque_respuesta_enviada -->
  <tr>
    <td style="vertical-align:top"  ><strong>Respuesta</strong></td>
    <td  > 
        {respuesta_html} 
	   </td>
  </tr>
    
	<!-- END BLOCK : bloque_respuesta_enviada -->	
  
	 <!-- START BLOCK : bloque_respuesta_form -->
  <tr>
    <td style="vertical-align:top"  ><strong>Respuesta</strong></td>
    <td  > 
        <textarea name="respuesta"  style="height:150px; width:100%"></textarea>
	   </td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>  <input   type="button" class="buttontype" onclick="javascript:enviarRevision();"  title="Enviar" value="Enviar" /> </td>
  </tr>
    
	<!-- END BLOCK : bloque_respuesta_form -->	
  
  
  </table>
  <script>
  
function enviarRevision()
{   
	if(document.main.respuesta.value == '')
	{
		alert('Debe ingresar una respuesta');
		return false;
	}

	 
	 process('guardar',2); 
}
  </script>