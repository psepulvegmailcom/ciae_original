<a name="formulario"></a>
 <div class="contenido_titulo_separador">	<big> <strong>Proceso Validaci&oacute;n de Prueba para Estudiantes</strong></big>
</div>

 <input type="hidden" name="form_tipo_inscripcion" value="201212-ValidacionPrueba_Rendicion_Estudiante">
 
<table class="tabla_simple" border="0">
  <tr>
 <td>
 <strong>Inscripci&oacute;n para estudiantes de pedagog&iacute;as m&aacute;ximo pen&uacute;ltimo a&ntilde;o.<br> Si ud tiene alguna duda comun&iacute;quese al correo <a href="investigacion@ciae.uchile.cl" >investigacion@ciae.uchile.cl</a></strong><br><br><br><br>
 </td>
 </tr>
<tr>
<td style="width:100% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje_inicia.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_inicia_rendicion_estudiante.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/validacionpruebas_cerradas.tpl -->
 
 
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