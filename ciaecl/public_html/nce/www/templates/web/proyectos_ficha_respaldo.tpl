<div class="contenido_titulo_separador">{proyecto}. {tipo} {codigo}</div>


<!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->

 
<!-- START BLOCK : bloque_proyectos_por_ficha_campos_tipo -->
<div class="contenido_titulo_secundario">{lang_proyectos_tipo_proyecto} <font class="contenido_descripcion">{tipo_proyecto}</font></div>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_tipo -->
<!-- START BLOCK : bloque_proyectos_por_ficha_campos_url -->
<div class="contenido_titulo_secundario">{lang_proyectos_proyectos_web}</div>
<p class="contenido_descripcion_secundario"><a href="{url}" target="_blank">{url}</a></p>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_url -->
<!-- START BLOCK : bloque_proyectos_por_ficha_campos_previo -->
<div class="contenido_titulo_secundario">{lang_campo}</div>
<p class="contenido_descripcion_secundario">{valor_campo}</p>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_previo --> 
 

<!-- START BLOCK : bloque_proyectos_por_ficha_campos_posterior -->
<div class="contenido_titulo_secundario">{lang_campo} <font class="contenido_descripcion">{valor_campo}</font></div>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_posterior --> 

 <!-- INCLUDE BLOCK : www/templates/web/bloques/orden_bloque.tpl -->