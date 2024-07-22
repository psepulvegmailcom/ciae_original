<a name="formulario"></a>
 <div class="contenido_titulo_separador">	CURSO:
TAREAS WEB 2.0 PARA
LA ENSE&ntilde;ANZA BASADA EN MET&aacute;FORAS
</div>
<table class="tabla_simple" border="0">
 
<input type="hidden" name="form_tipo_inscripcion" value="{opcion_extra}">
<tr>
<td style="width:75% ">
<div id='ficha_inscripcion'>
  <!-- INCLUDE BLOCK : www/templates/web/cursometaforas/inscripcion.tpl -->
 </div>
<div id='ficha_ingreso'>
  <!-- INCLUDE BLOCK : www/templates/web/cursometaforas/ingreso.tpl -->
 </div>
<div id='ficha_programa'>
  <!-- INCLUDE BLOCK : www/templates/web/cursometaforas/contenido.tpl -->
 </div>
 <div id='ficha_fotos'>
  <!-- INCLUDE BLOCK : www/templates/web/cursometaforas/fotos.tpl -->
 </div>
 <div id='ficha_videos'>
 
  <!-- INCLUDE BLOCK : www/templates/web/cursometaforas/video.tpl -->
 </div>
 <div id='ficha_videos_13'>
  <div><a href="http://deportes.13.cl/nacional/profesores-se-capacitan-en-aprendizaje-entretenido" target="_blank">Nota Canal 13</a></div>
 <br />
 <!-- START BLOCK : bloque_visualizacion_13 -->
 <!-- INCLUDE BLOCK : www/templates/web/video_flv.tpl -->
 <!-- END BLOCK : bloque_visualizacion_13 -->
 
 </div>
  
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<!-- <li><big><a href="index.php?langSite=es&page=view_cursometaforas">Ingresar</a></big></li> -->
<li><big><a href="index.php?langSite=es&page=view_cursometaforas&opcion=ficha_programa">Contenidos</a></big></li>
<li><big><a href="index.php?langSite=es&page=view_cursometaforas&opcion=ficha_fotos">Fotos</a></big></li> 
<li><big><a href="index.php?langSite=es&page=view_cursometaforas&opcion=ficha_videos">Videos</a></big></li>
<li><big><a href="index.php?langSite=es&page=view_cursometaforas&opcion=ficha_videos_13">Nota Canal 13</a></big></li>
<li><big><a href="index.php?langSite=es&page=view_cursometaforas&opcion=ficha_inscripcion">Interesados pr&oacute;ximos cursos</a></big></li>

	 
     <!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <div><br />
 <strong>Organizado por:</strong><br />
  <a href="http://www.metaforas.cl/" target="_blank"><img src="http://cdn.metaforas.cl/images/logo-metaforas.png"  border="0" ></a>
 </div>
</td>
 </tr> 
</table>
<input type="hidden"  name="page" value="view_cursometaforas">
<input type="hidden"  name="usuario" value="{usuario}">
<input type="hidden"  name="clave" value="{clave}">
<input type="hidden"  name="login" value="{login}">

<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('ficha_ingreso');  
	hiddenId('ficha_programa');  
	hiddenId('ficha_fotos'); 
	hiddenId('ficha_videos');
	hiddenId('ficha_videos_13');
	hiddenId('ficha_inscripcion');
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
mostrarDiv('ficha_ingreso');


  <!-- START BLOCK : bloque_mostrar_div -->
  	mostrarDiv('{opcion}');
  <!-- END BLOCK : bloque_mostrar_div -->

</script>