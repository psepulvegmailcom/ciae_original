<a name="formulario"></a>
 <div class="contenido_titulo_separador">	<big> <strong>Proceso Validaci&oacute;n de instrumentos de medici&oacute;n</strong></big>
</div>

 <input type="hidden" name="form_tipo_inscripcion" value="2014-ValidacionPruebaINICIA_nuevo_junio">
 
<table class="tabla_simple" border="0">
 <tr>
 <td>
 <strong>Inscripci&oacute;n participante proceso validaci&oacute;n de instrumentos de medici&oacute;n. <br> Si ud tiene alguna  duda comun&iacute;quese al correo <a href="mailto:investigacion@ciae.uchile.cl" >investigacion@ciae.uchile.cl</a></strong><br><br><br><br>
 </td>
 </tr>
<tr>
<td style="width:100% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje_inicia.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_inicia_rendicion_2014.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/validacionpruebas_cerradas_2014.tpl -->
 
 
 </div>
  
 
  
 
  
</td>
<td>
  
</td>
 </tr> 
 
</table>
<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('inscripcion_ficha');   
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
ocultarDiv();
mostrarDiv('inscripcion_ficha');

</script>