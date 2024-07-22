    <script type="text/javascript">
    $(function() {
        $('#noticia a').lightBox();
    }); 
	changeTitle('{titulo}');
    </script>
	<table class="tabla_simple" style=" width:100%   " border="0">
	<tr><td>
 <div class="contenido_titulo_separador">  {titulo}     </div> 
  
 <p><small>{fecha_html_full}</small></p>
  <p>
<!-- INCLUDE BLOCK : www/templates/web/noticias_compartir.tpl -->
 </p>  
<!-- INCLUDE BLOCK : www/templates/web/noticias_traducir.tpl -->
  

<div style="padding-top:10px; ">
<!-- START BLOCK : bloque_elemento_bajada -->
<p><em>{bajada}</em></p>
<!-- START BLOCK : bloque_elemento_bajada -->

<!-- START BLOCK : bloque_elemento_imagen -->
<!-- INCLUDE BLOCK : www/templates/web/noticias_ficha_imagen.tpl -->
<!-- END BLOCK : bloque_elemento_imagen -->

 

 <p>  {noticia}  	</p>
 </div>
</td></tr> 
 <tr><td>
 
<ul>
<!-- START BLOCK : bloque_elemento_url -->
<li><a href="{link}" target="_blank">{texto}</a>&nbsp;<a href="{link}" target="_blank"   id="link_blank" ><img src="www/images/iconos/32x32/Target_blank.png" alt='open_target_blank' class="open_target_blank"></a></li>
<!-- END BLOCK : bloque_elemento_url -->
<!-- START BLOCK : bloque_elemento_doc -->
<li><a href="download.php?file=noticias/{link}" target="_blank">{texto}</a>&nbsp;<a href="download.php?file=noticias/{link}" target="_blank"   id="link_blank" ><img src="www/images/iconos/32x32/Target_blank.png" alt='open_target_blank' class="open_target_blank"></a></li>
<!-- END BLOCK : bloque_elemento_doc -->
</ul>
<p><small>Texto: {autor}</small></p>
</td></tr>
 <tr><td>


<!-- INCLUDE BLOCK : www/templates/web/noticias_ficha_galeria.tpl -->
</td></tr>
 <tr><td>
 <div style="padding-top:15px ">
<!-- INCLUDE BLOCK : www/templates/web/noticias_compartir.tpl -->
</div>

</td></tr>
</table>
</table>