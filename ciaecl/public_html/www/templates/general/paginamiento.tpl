

<br>&nbsp;
<!-- START BLOCK : bloque_paginamiento_anterior -->
<a href="javascript:buscarPaginamiento('{pagina_anterior}');"><big>&laquo;</big> <!--</a>
<a href="index.php?pagina={pagina_anterior}&page={page}&busqueda=1&rangoNombre={rango}">anterior--></a>
<!-- END BLOCK : bloque_paginamiento_anterior -->

<!-- START BLOCK : bloque_paginamiento_numero -->

<!--<a href='index.php?langSite={lang_site}&page={page}&pagina={pagina}&busqueda=1&rangoNombre={rango}'>-->
<a href="javascript:buscarPaginamiento('{pagina}');">  

<!-- START BLOCK : bloque_paginamiento_numero_simple -->
{pagina}
<!-- END BLOCK : bloque_paginamiento_numero_simple -->

<!-- START BLOCK : bloque_paginamiento_numero_seleccionada -->
<b>{pagina}</b>
<!-- END BLOCK : bloque_paginamiento_numero_seleccionada -->

</a>
<!-- END BLOCK : bloque_paginamiento_numero -->
 
<!-- START BLOCK : bloque_paginamiento_siguiente -->
<a href="javascript:buscarPaginamiento('{pagina_siguiente}');"><big>&raquo;</big></a>
<!-- END BLOCK : bloque_paginamiento_siguiente -->

<!-- START BLOCK : bloque_paginamiento_total -->
&nbsp;&nbsp;&nbsp;&nbsp;  <strong>Total: </strong>{total} 
<!-- END BLOCK : bloque_paginamiento_total -->
