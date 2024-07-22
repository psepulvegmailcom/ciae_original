<a name="formulario"></a>
 <div class="contenido_titulo_separador">	 Proceso Validaci&oacute;n de Prueba
</div>

 <input type="hidden" name="form_tipo_inscripcion" value="201212-ValidacionPruebaDemre">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:80% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpl -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_inicia.tpl -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpls -->
 
 
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