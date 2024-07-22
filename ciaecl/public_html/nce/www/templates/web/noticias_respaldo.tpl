<div class="contenido_titulo_separador">{titulo}</div>

<!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->

 <table class="tabla_simple">
 <tr><td style="width:20%"> 
<!-- START BLOCK : bloque_noticias_filtro_lateral -->
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 
<ul>
<!-- START BLOCK : bloque_noticias_filtro_agno -->
<li ><a href="?page={filtro_link_caso}&langSite={langSiteEspecial_seleccionado}&agno={agno}"> <span class="{clase_texto_destacada}">{agno}</span></a>

<!-- START BLOCK : bloque_noticias_filtro_meses -->
<ul style="padding-left:15px">
<!-- START BLOCK : bloque_noticias_filtro_meses_detalle -->
<li ><a href="?page={filtro_link_caso}&langSite={langSiteEspecial_seleccionado}&agno={agno}&mes={mes_numero}"> <span class="{clase_texto_destacada}">{mes_texto}</span></a>
</li>
<!-- END BLOCK : bloque_noticias_filtro_meses_detalle -->
</ul>
<!-- END BLOCK : bloque_noticias_filtro_meses -->

</li>
<!-- END BLOCK : bloque_noticias_filtro_agno -->
</ul> 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
<!-- START BLOCK : bloque_noticias_filtro_lateral -->	
 </td>
 <td>
<ul>
<!-- START BLOCK : bloque_elemento --> 
 			 <li><a href="index.php?page=view_noticias&id={id_noticia}&langSite={langSiteEspecial_seleccionado}">{titulo}</a> <br /><small> {fecha_html_full}</small></li>
		<!-- END BLOCK : bloque_elemento --> 
<!-- START BLOCK : bloque_no_elemento --> 
 			 {langSite_general_no_hay_elementos}
		<!-- END BLOCK : bloque_no_elemento --> 
</ul>

</td></tr></table>