<a name="formulario"></a>
 <div class="contenido_titulo_separador">	SEMINARIO:
MET&aacute;FORAS, ANALOG&iacute;AS Y TECNOLOG&iacute;A PARA LA ENSE&ntilde;ANZA DE LA MATEM&aacute;TICA Y LAS CIENCIAS

</div>
<table class="tabla_simple" border="0">
 
<input type="hidden" name="form_tipo_inscripcion" value="{opcion_extra}">
<tr>
<td style="width:65% ">
<div id='ficha_objetivos'>
  <!-- INCLUDE BLOCK : www/templates/web/cursoenero2012/objetivos.tpl -->
 </div>
  
  
  
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

  
  <!-- INCLUDE BLOCK : www/templates/web/cursoenero2012/info_lateral.tpl --> 

	 
     <!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <div><br />
 <strong>Organizado por:</strong><br />
  <a href="http://www.metaforas.cl/" target="_blank"><img src="http://cdn.metaforas.cl/images/logo-metaforas.png"  border="0" ></a>
 </div>
</td>
 </tr> 
</table>
<input type="hidden"  name="page" value="view_cursoenero2012">
<input type="hidden"  name="usuario" value="{usuario}">
<input type="hidden"  name="clave" value="{clave}">
<input type="hidden"  name="login" value="{login}">

<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('ficha_objetivos');   
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
mostrarDiv('ficha_objetivos');


  <!-- START BLOCK : bloque_mostrar_div -->
  	mostrarDiv('{opcion}');
  <!-- END BLOCK : bloque_mostrar_div -->

</script>